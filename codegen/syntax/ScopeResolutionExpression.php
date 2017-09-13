<?hh
/**
 * This file is generated. Do not modify it manually!
 *
 * @generated SignedSource<<0f4269c7183dbaa9af5f5c43ec53e9ba>>
 */
namespace Facebook\HHAST;
use type Facebook\TypeAssert\TypeAssert;

final class ScopeResolutionExpression extends EditableSyntax {

  private EditableSyntax $_qualifier;
  private EditableSyntax $_operator;
  private EditableSyntax $_name;

  public function __construct(
    EditableSyntax $qualifier,
    EditableSyntax $operator,
    EditableSyntax $name,
  ) {
    parent::__construct('scope_resolution_expression');
    $this->_qualifier = $qualifier;
    $this->_operator = $operator;
    $this->_name = $name;
  }

  <<__Override>>
  public static function fromJSON(
    dict<string, mixed> $json,
    int $position,
    string $source,
  ): this {
    $qualifier = EditableSyntax::fromJSON(
      /* UNSAFE_EXPR */ $json['scope_resolution_qualifier'],
      $position,
      $source,
    );
    $position += $qualifier->getWidth();
    $operator = EditableSyntax::fromJSON(
      /* UNSAFE_EXPR */ $json['scope_resolution_operator'],
      $position,
      $source,
    );
    $position += $operator->getWidth();
    $name = EditableSyntax::fromJSON(
      /* UNSAFE_EXPR */ $json['scope_resolution_name'],
      $position,
      $source,
    );
    $position += $name->getWidth();
    return new self($qualifier, $operator, $name);
  }

  <<__Override>>
  public function getChildren(): KeyedTraversable<string, EditableSyntax> {
    yield 'qualifier' => $this->_qualifier;
    yield 'operator' => $this->_operator;
    yield 'name' => $this->_name;
  }

  <<__Override>>
  public function rewriteDescendants(
    self::TRewriter $rewriter,
    ?Traversable<EditableSyntax> $parents = null,
  ): this {
    $parents = $parents === null ? vec[] : vec($parents);
    $parents[] = $this;
    $qualifier = $this->_qualifier->rewrite($rewriter, $parents);
    $operator = $this->_operator->rewrite($rewriter, $parents);
    $name = $this->_name->rewrite($rewriter, $parents);
    if (
      $qualifier === $this->_qualifier &&
      $operator === $this->_operator &&
      $name === $this->_name
    ) {
      return $this;
    }
    return new self($qualifier, $operator, $name);
  }

  public function getQualifierUNTYPED(): EditableSyntax {
    return $this->_qualifier;
  }

  public function withQualifier(EditableSyntax $value): this {
    if ($value === $this->_qualifier) {
      return $this;
    }
    return new self($value, $this->_operator, $this->_name);
  }

  public function hasQualifier(): bool {
    return !$this->_qualifier->isMissing();
  }

  public function getQualifier(): EditableSyntax {
    return TypeAssert::isInstanceOf(EditableSyntax::class, $this->_qualifier);
  }

  public function getOperatorUNTYPED(): EditableSyntax {
    return $this->_operator;
  }

  public function withOperator(EditableSyntax $value): this {
    if ($value === $this->_operator) {
      return $this;
    }
    return new self($this->_qualifier, $value, $this->_name);
  }

  public function hasOperator(): bool {
    return !$this->_operator->isMissing();
  }

  public function getOperator(): ColonColonToken {
    return TypeAssert::isInstanceOf(ColonColonToken::class, $this->_operator);
  }

  public function getNameUNTYPED(): EditableSyntax {
    return $this->_name;
  }

  public function withName(EditableSyntax $value): this {
    if ($value === $this->_name) {
      return $this;
    }
    return new self($this->_qualifier, $this->_operator, $value);
  }

  public function hasName(): bool {
    return !$this->_name->isMissing();
  }

  public function getName(): EditableSyntax {
    return TypeAssert::isInstanceOf(EditableSyntax::class, $this->_name);
  }
}