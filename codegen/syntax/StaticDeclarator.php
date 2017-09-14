<?hh
/**
 * This file is generated. Do not modify it manually!
 *
 * @generated SignedSource<<719af7e04ace105d0c17d2492723daff>>
 */
namespace Facebook\HHAST;
use type Facebook\TypeAssert\TypeAssert;

final class StaticDeclarator extends EditableSyntax {

  private EditableSyntax $_name;
  private EditableSyntax $_initializer;

  public function __construct(
    EditableSyntax $name,
    EditableSyntax $initializer,
  ) {
    parent::__construct('static_declarator');
    $this->_name = $name;
    $this->_initializer = $initializer;
  }

  <<__Override>>
  public static function fromJSON(
    dict<string, mixed> $json,
    int $position,
    string $source,
  ): this {
    $name = EditableSyntax::fromJSON(
      /* UNSAFE_EXPR */ $json['static_name'],
      $position,
      $source,
    );
    $position += $name->getWidth();
    $initializer = EditableSyntax::fromJSON(
      /* UNSAFE_EXPR */ $json['static_initializer'],
      $position,
      $source,
    );
    $position += $initializer->getWidth();
    return new self($name, $initializer);
  }

  <<__Override>>
  public function getChildren(): KeyedTraversable<string, EditableSyntax> {
    yield 'name' => $this->_name;
    yield 'initializer' => $this->_initializer;
  }

  <<__Override>>
  public function rewriteDescendants(
    self::TRewriter $rewriter,
    ?Traversable<EditableSyntax> $parents = null,
  ): this {
    $parents = $parents === null ? vec[] : vec($parents);
    $parents[] = $this;
    $name = $this->_name->rewrite($rewriter, $parents);
    $initializer = $this->_initializer->rewrite($rewriter, $parents);
    if (
      $name === $this->_name &&
      $initializer === $this->_initializer
    ) {
      return $this;
    }
    return new self($name, $initializer);
  }

  public function getNameUNTYPED(): EditableSyntax {
    return $this->_name;
  }

  public function withName(EditableSyntax $value): this {
    if ($value === $this->_name) {
      return $this;
    }
    return new self($value, $this->_initializer);
  }

  public function hasName(): bool {
    return !$this->_name->isMissing();
  }

  /**
   * @returns VariableToken | Missing
   */
  public function getName(): ?VariableToken {
    if ($this->_name->isMissing()) {
      return null;
    }
    return TypeAssert::isInstanceOf(VariableToken::class, $this->_name);
  }

  /**
   * @returns VariableToken
   */
  public function getNamex(): VariableToken {
    return TypeAssert::isInstanceOf(VariableToken::class, $this->_name);
  }

  public function getInitializerUNTYPED(): EditableSyntax {
    return $this->_initializer;
  }

  public function withInitializer(EditableSyntax $value): this {
    if ($value === $this->_initializer) {
      return $this;
    }
    return new self($this->_name, $value);
  }

  public function hasInitializer(): bool {
    return !$this->_initializer->isMissing();
  }

  /**
   * @returns Missing | SimpleInitializer
   */
  public function getInitializer(): ?SimpleInitializer {
    if ($this->_initializer->isMissing()) {
      return null;
    }
    return TypeAssert::isInstanceOf(SimpleInitializer::class, $this->_initializer);
  }

  /**
   * @returns SimpleInitializer
   */
  public function getInitializerx(): SimpleInitializer {
    return TypeAssert::isInstanceOf(SimpleInitializer::class, $this->_initializer);
  }
}
