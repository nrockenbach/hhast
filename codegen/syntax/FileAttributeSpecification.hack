/**
 * This file is generated. Do not modify it manually!
 *
 * @generated SignedSource<<f8bac00febed72d82432666273c9a0d9>>
 */
namespace Facebook\HHAST;
use namespace Facebook\TypeAssert;
use namespace HH\Lib\Dict;

<<__ConsistentConstruct>>
final class FileAttributeSpecification extends Node {

  const string SYNTAX_KIND = 'file_attribute_specification';

  private LessThanLessThanToken $_left_double_angle;
  private FileToken $_keyword;
  private ColonToken $_colon;
  private NodeList<ListItem<ConstructorCall>> $_attributes;
  private GreaterThanGreaterThanToken $_right_double_angle;

  public function __construct(
    LessThanLessThanToken $left_double_angle,
    FileToken $keyword,
    ColonToken $colon,
    NodeList<ListItem<ConstructorCall>> $attributes,
    GreaterThanGreaterThanToken $right_double_angle,
    ?__Private\SourceRef $source_ref = null,
  ) {
    $this->_left_double_angle = $left_double_angle;
    $this->_keyword = $keyword;
    $this->_colon = $colon;
    $this->_attributes = $attributes;
    $this->_right_double_angle = $right_double_angle;
    parent::__construct($source_ref);
  }

  <<__Override>>
  public static function fromJSON(
    dict<arraykey, mixed> $json,
    string $file,
    int $initial_offset,
    string $source,
    string $_type_hint,
  ): this {
    $offset = $initial_offset;
    $left_double_angle = Node::fromJSON(
      ($json['file_attribute_specification_left_double_angle']) as dict<_, _>,
      $file,
      $offset,
      $source,
      'LessThanLessThanToken',
    );
    $left_double_angle = $left_double_angle as nonnull;
    $offset += $left_double_angle->getWidth();
    $keyword = Node::fromJSON(
      ($json['file_attribute_specification_keyword']) as dict<_, _>,
      $file,
      $offset,
      $source,
      'FileToken',
    );
    $keyword = $keyword as nonnull;
    $offset += $keyword->getWidth();
    $colon = Node::fromJSON(
      ($json['file_attribute_specification_colon']) as dict<_, _>,
      $file,
      $offset,
      $source,
      'ColonToken',
    );
    $colon = $colon as nonnull;
    $offset += $colon->getWidth();
    $attributes = Node::fromJSON(
      ($json['file_attribute_specification_attributes']) as dict<_, _>,
      $file,
      $offset,
      $source,
      'NodeList<ListItem<ConstructorCall>>',
    );
    $attributes = $attributes as nonnull;
    $offset += $attributes->getWidth();
    $right_double_angle = Node::fromJSON(
      ($json['file_attribute_specification_right_double_angle']) as dict<_, _>,
      $file,
      $offset,
      $source,
      'GreaterThanGreaterThanToken',
    );
    $right_double_angle = $right_double_angle as nonnull;
    $offset += $right_double_angle->getWidth();
    $source_ref = shape(
      'file' => $file,
      'source' => $source,
      'offset' => $initial_offset,
      'width' => $offset - $initial_offset,
    );
    return new static(
      /* HH_IGNORE_ERROR[4110] */ $left_double_angle,
      /* HH_IGNORE_ERROR[4110] */ $keyword,
      /* HH_IGNORE_ERROR[4110] */ $colon,
      /* HH_IGNORE_ERROR[4110] */ $attributes,
      /* HH_IGNORE_ERROR[4110] */ $right_double_angle,
      $source_ref,
    );
  }

  <<__Override>>
  public function getChildren(): dict<string, Node> {
    return dict[
      'left_double_angle' => $this->_left_double_angle,
      'keyword' => $this->_keyword,
      'colon' => $this->_colon,
      'attributes' => $this->_attributes,
      'right_double_angle' => $this->_right_double_angle,
    ]
      |> Dict\filter_nulls($$);
  }

  <<__Override>>
  public function rewriteChildren<Tret as ?Node>(
    (function(Node, vec<Node>): Tret) $rewriter,
    vec<Node> $parents = vec[],
  ): this {
    $parents[] = $this;
    $left_double_angle = $rewriter($this->_left_double_angle, $parents);
    $keyword = $rewriter($this->_keyword, $parents);
    $colon = $rewriter($this->_colon, $parents);
    $attributes = $rewriter($this->_attributes, $parents);
    $right_double_angle = $rewriter($this->_right_double_angle, $parents);
    if (
      $left_double_angle === $this->_left_double_angle &&
      $keyword === $this->_keyword &&
      $colon === $this->_colon &&
      $attributes === $this->_attributes &&
      $right_double_angle === $this->_right_double_angle
    ) {
      return $this;
    }
    return new static(
      $left_double_angle as LessThanLessThanToken,
      $keyword as FileToken,
      $colon as ColonToken,
      /* HH_FIXME[4110] NodeList<ListItem<ConstructorCall>> may not be enforceable */ $attributes,
      $right_double_angle as GreaterThanGreaterThanToken,
    );
  }

  public function getLeftDoubleAngleUNTYPED(): ?Node {
    return $this->_left_double_angle;
  }

  public function withLeftDoubleAngle(LessThanLessThanToken $value): this {
    if ($value === $this->_left_double_angle) {
      return $this;
    }
    return new static(
      $value,
      $this->_keyword,
      $this->_colon,
      $this->_attributes,
      $this->_right_double_angle,
    );
  }

  public function hasLeftDoubleAngle(): bool {
    return $this->_left_double_angle !== null;
  }

  /**
   * @return LessThanLessThanToken
   */
  public function getLeftDoubleAngle(): LessThanLessThanToken {
    return TypeAssert\instance_of(
      LessThanLessThanToken::class,
      $this->_left_double_angle,
    );
  }

  /**
   * @return LessThanLessThanToken
   */
  public function getLeftDoubleAnglex(): LessThanLessThanToken {
    return $this->getLeftDoubleAngle();
  }

  public function getKeywordUNTYPED(): ?Node {
    return $this->_keyword;
  }

  public function withKeyword(FileToken $value): this {
    if ($value === $this->_keyword) {
      return $this;
    }
    return new static(
      $this->_left_double_angle,
      $value,
      $this->_colon,
      $this->_attributes,
      $this->_right_double_angle,
    );
  }

  public function hasKeyword(): bool {
    return $this->_keyword !== null;
  }

  /**
   * @return FileToken
   */
  public function getKeyword(): FileToken {
    return TypeAssert\instance_of(FileToken::class, $this->_keyword);
  }

  /**
   * @return FileToken
   */
  public function getKeywordx(): FileToken {
    return $this->getKeyword();
  }

  public function getColonUNTYPED(): ?Node {
    return $this->_colon;
  }

  public function withColon(ColonToken $value): this {
    if ($value === $this->_colon) {
      return $this;
    }
    return new static(
      $this->_left_double_angle,
      $this->_keyword,
      $value,
      $this->_attributes,
      $this->_right_double_angle,
    );
  }

  public function hasColon(): bool {
    return $this->_colon !== null;
  }

  /**
   * @return ColonToken
   */
  public function getColon(): ColonToken {
    return TypeAssert\instance_of(ColonToken::class, $this->_colon);
  }

  /**
   * @return ColonToken
   */
  public function getColonx(): ColonToken {
    return $this->getColon();
  }

  public function getAttributesUNTYPED(): ?Node {
    return $this->_attributes;
  }

  public function withAttributes(
    NodeList<ListItem<ConstructorCall>> $value,
  ): this {
    if ($value === $this->_attributes) {
      return $this;
    }
    return new static(
      $this->_left_double_angle,
      $this->_keyword,
      $this->_colon,
      $value,
      $this->_right_double_angle,
    );
  }

  public function hasAttributes(): bool {
    return $this->_attributes !== null;
  }

  /**
   * @return NodeList<ListItem<ConstructorCall>>
   */
  public function getAttributes(): NodeList<ListItem<ConstructorCall>> {
    return TypeAssert\instance_of(NodeList::class, $this->_attributes);
  }

  /**
   * @return NodeList<ListItem<ConstructorCall>>
   */
  public function getAttributesx(): NodeList<ListItem<ConstructorCall>> {
    return $this->getAttributes();
  }

  public function getRightDoubleAngleUNTYPED(): ?Node {
    return $this->_right_double_angle;
  }

  public function withRightDoubleAngle(
    GreaterThanGreaterThanToken $value,
  ): this {
    if ($value === $this->_right_double_angle) {
      return $this;
    }
    return new static(
      $this->_left_double_angle,
      $this->_keyword,
      $this->_colon,
      $this->_attributes,
      $value,
    );
  }

  public function hasRightDoubleAngle(): bool {
    return $this->_right_double_angle !== null;
  }

  /**
   * @return GreaterThanGreaterThanToken
   */
  public function getRightDoubleAngle(): GreaterThanGreaterThanToken {
    return TypeAssert\instance_of(
      GreaterThanGreaterThanToken::class,
      $this->_right_double_angle,
    );
  }

  /**
   * @return GreaterThanGreaterThanToken
   */
  public function getRightDoubleAnglex(): GreaterThanGreaterThanToken {
    return $this->getRightDoubleAngle();
  }
}
