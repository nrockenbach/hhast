<?hh
/**
 * This file is generated. Do not modify it manually!
 *
 * @generated SignedSource<<baec8bf7d0cabea6906a70ccecc749f0>>
 */
namespace Facebook\HHAST;

final class FloatingLiteralToken extends EditableToken {

  public function __construct(
    EditableSyntax $leading,
    EditableSyntax $trailing,
    string $text,
  ) {
    parent::__construct('floating_literal', $leading, $trailing, $text);
  }

  public function hasLeading(): bool {
    return !$this->getLeading()->isMissing();
  }

  <<__Override>>
  public function withLeading(EditableSyntax $value): this {
    if ($value === $this->getLeading()) {
      return $this;
    }
    return new self($value, $this->getTrailing(), $this->getText());
  }

  public function hasTrailing(): bool {
    return !$this->getTrailing()->isMissing();
  }

  <<__Override>>
  public function withTrailing(EditableSyntax $value): this {
    if ($value === $this->getTrailing()) {
      return $this;
    }
    return new self($this->getLeading(), $value, $this->getText());
  }

  public function withText(string $value): this {
    if ($value === $this->getText()) {
      return $this;
    }
    return new self($this->getLeading(), $this->getTrailing(), $value);
  }

  <<__Override>>
  public function rewriteDescendants(
    self::TRewriter $rewriter,
    ?Traversable<EditableSyntax> $parents = null,
  ): this {
    $parents = $parents === null ? vec[] : vec($parents);
    $parents[] = $this;
    $leading = $this->getLeading()->rewrite($rewriter, $parents);
    $trailing = $this->getTrailing()->rewrite($rewriter, $parents);
    $text = $this->getText();
    if (
      $leading === $this->getLeading() &&
      $trailing === $this->getTrailing() &&
      $text === $this->getText()
    ) {
      return $this;
    }
    return new self($leading, $trailing, $text);
  }
}