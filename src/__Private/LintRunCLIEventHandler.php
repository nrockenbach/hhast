<?hh // strict
/*
 *  Copyright (c) 2017-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the MIT license found in the
 *  LICENSE file in the root directory of this source tree.
 *
 */

namespace Facebook\HHAST\__Private;

use type Facebook\CLILib\ITerminal;
use type Facebook\DiffLib\{CLIColoredUnifiedDiff, StringDiff};
use namespace Facebook\HHAST\Linters;
use namespace HH\Lib\{C, Str, Vec};

final class LintRunCLIEventHandler implements LintRunEventHandler {
  public function __construct(private ITerminal $terminal) {}

  public async function linterRaisedErrorsAsync(
    Linters\BaseLinter $linter,
    LintRunConfig::TFileConfig $config,
    Traversable<Linters\LintError> $errors,
  ): Awaitable<LintAutoFixResult> {
    $class = \get_class($linter);
    $to_fix = vec[];
    $result = LintAutoFixResult::ALL_FIXED;
    $colors = $this->terminal->supportsColors();

    $fixing_linter = (
      $linter instanceof Linters\AutoFixingLinter &&
      !C\contains_key($config['autoFixBlacklist'], $class)
    )
      ? $linter
      : null;

    foreach ($errors as $error) {
      $position = $error->getPosition();
      /* HHAST_IGNORE_ERROR[DontAwaitInALoop] */
      await $this->terminal
        ->getStdout()
        ->writeAsync(Str\format(
          "%s%s%s\n"."  %sLinter: %s%s\n"."  Location: %s\n",
          $colors ? "\e[1;31m" : '',
          $error->getDescription(),
          $colors ? "\e[0m" : '',
          $colors ? "\e[90m" : '',
          \get_class($error->getLinter()),
          $colors ? "\e[0m" : '',
          $position === null
            ? $error->getFile()->getPath()
            : Str\format(
                '%s:%d:%d',
                $error->getFile()->getPath(),
                $position[0],
                $position[1],
              ),
        ));

      if ($fixing_linter) {
        /* HHAST_IGNORE_ERROR[DontAwaitInALoop] */
        $should_fix = await $this->shouldFixLintAsync($fixing_linter, $error);
        if ($should_fix) {
          $to_fix[] = $error;
        } else {
          $result = LintAutoFixResult::SOME_UNFIXED;
        }
        continue;
      }

      /* HHAST_IGNORE_ERROR[DontAwaitInALoop] */
      await $this->renderLintBlameAsync($error);
      $result = LintAutoFixResult::SOME_UNFIXED;
    }

    if (!C\is_empty($to_fix)) {
      invariant($fixing_linter, "Can't fix without a fixing linter");
      self::fixErrors($fixing_linter, $to_fix);
    }

    return $result;
  }

  public async function finishedFileAsync(
    string $_,
    LintRunResult $_,
  ): Awaitable<void> {
  }

  public async function finishedRunAsync(
    LintRunResult $result,
  ): Awaitable<void> {
    if ($result === LintRunResult::NO_ERRORS) {
      await $this->terminal->getStdout()->writeAsync("No errors.\n");
    }
  }

  private static function fixErrors<Terror as Linters\LintError>(
    Linters\AutoFixingLinter<Terror> $linter,
    vec<Terror> $errors,
  ): void {
    invariant(
      $linter instanceof Linters\AutoFixingLinter,
      '%s is not an auto-fixing-linter',
      \get_class($linter),
    );

    $file = $linter->getFixedFile($errors);
    \file_put_contents($file->getPath(), $file->getContents());
  }

  private async function shouldFixLintAsync<Terror as Linters\LintError>(
    Linters\AutoFixingLinter<Terror> $linter,
    Terror $error,
  ): Awaitable<bool> {
    $old = $linter->getFile()->getContents();
    $new = $linter->getFixedFile(vec[$error])->getContents();
    if ($old === $new) {
      await $this->renderLintBlameAsync($error);
      return false;
    }

    if ($this->terminal->supportsColors()) {
      await $this->terminal
        ->getStdout()
        ->writeAsync(CLIColoredUnifiedDiff::create($old, $new));
    } else {
      await $this->terminal
        ->getStdout()
        ->writeAsync(StringDiff::lines($old, $new)->getUnifiedDiff());
    }

    if (!$this->terminal->isInteractive()) {
      return false;
    }

    static $cache = dict[];
    $cache_key = \get_class($error->getLinter());
    if (C\contains_key($cache, $cache_key)) {
      $should_fix = $cache[$cache_key];
      await $this->terminal
        ->getStdout()
        ->writeAsync(Str\format(
          "Would you like to apply this fix?\n  <%s to all>\n",
          $should_fix ? 'yes' : 'no',
        ));
      return $should_fix;
    }

    $response = null;
    do {
      /* HHAST_IGNORE_ERROR[DontAwaitInALoop] */
      await $this->terminal
        ->getStdout()
        ->writeAsync(
          "\e[94mWould you like to apply this fix?\e[0m\n".
          "  \e[37m[y]es/[N]o/yes to [a]ll/n[o] to all:\e[0m ",
        );
      $response = await $this->terminal->getStdin()->readLineAsync();
      $response = Str\trim($response);
      switch ($response) {
        case 'a':
          $cache[$cache_key] = true;
          // FALLTHROUGH
        case 'y':
          return true;
        case 'o':
          $cache[$cache_key] = false;
          // FALLTHROUGH
        case 'n':
        case '':
          return false;
        default:
          /* HHAST_IGNORE_ERROR[DontAwaitInALoop] */
          await $this->terminal
            ->getStderr()
            ->writeAsync(
              Str\format("'%s' is not a valid response.\n", $response),
            );
          $response = null;
      }
    } while ($response === null);
    return false;
  }

  private async function renderLintBlameAsync(
    Linters\LintError $error,
  ): Awaitable<void> {
    $blame = $error->getPrettyBlame();
    if ($blame === null) {
      return;
    }

    $colors = $this->terminal->supportsColors();
    await $this->terminal
      ->getStdout()
      ->writeAsync(Str\format(
        "  Code:\n%s%s%s\n",
        $colors ? "\e[33m" : '',
        Str\split($blame, "\n")
          |> Vec\map($$, $line ==> '  >'.$line)
          |> Str\join($$, "\n"),
        $colors ? "\e[0m" : '',
      ));
  }
}
