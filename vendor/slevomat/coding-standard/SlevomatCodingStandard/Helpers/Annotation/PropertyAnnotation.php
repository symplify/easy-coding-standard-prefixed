<?php

declare (strict_types=1);
namespace SlevomatCodingStandard\Helpers\Annotation;

use InvalidArgumentException;
use _PhpScoper1e80a2e03314\PHPStan\PhpDocParser\Ast\PhpDoc\PropertyTagValueNode;
use _PhpScoper1e80a2e03314\PHPStan\PhpDocParser\Ast\Type\ArrayTypeNode;
use _PhpScoper1e80a2e03314\PHPStan\PhpDocParser\Ast\Type\CallableTypeNode;
use _PhpScoper1e80a2e03314\PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use _PhpScoper1e80a2e03314\PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use _PhpScoper1e80a2e03314\PHPStan\PhpDocParser\Ast\Type\IntersectionTypeNode;
use _PhpScoper1e80a2e03314\PHPStan\PhpDocParser\Ast\Type\NullableTypeNode;
use _PhpScoper1e80a2e03314\PHPStan\PhpDocParser\Ast\Type\ThisTypeNode;
use _PhpScoper1e80a2e03314\PHPStan\PhpDocParser\Ast\Type\TypeNode;
use _PhpScoper1e80a2e03314\PHPStan\PhpDocParser\Ast\Type\UnionTypeNode;
use SlevomatCodingStandard\Helpers\AnnotationTypeHelper;
use function in_array;
use function sprintf;
/**
 * @internal
 */
class PropertyAnnotation extends \SlevomatCodingStandard\Helpers\Annotation\Annotation
{
    /** @var PropertyTagValueNode|null */
    private $contentNode;
    public function __construct(string $name, int $startPointer, int $endPointer, ?string $content, ?\_PhpScoper1e80a2e03314\PHPStan\PhpDocParser\Ast\PhpDoc\PropertyTagValueNode $contentNode)
    {
        if (!\in_array($name, ['@property', '@property-read', '@property-write', '@psalm-property', '@psalm-property-read', '@psalm-property-write', '@phpstan-property', '@phpstan-property-read', '@phpstan-property-write'], \true)) {
            throw new \InvalidArgumentException(\sprintf('Unsupported annotation %s.', $name));
        }
        parent::__construct($name, $startPointer, $endPointer, $content);
        $this->contentNode = $contentNode;
    }
    public function isInvalid() : bool
    {
        return $this->contentNode === null;
    }
    public function getContentNode() : \_PhpScoper1e80a2e03314\PHPStan\PhpDocParser\Ast\PhpDoc\PropertyTagValueNode
    {
        $this->errorWhenInvalid();
        return $this->contentNode;
    }
    public function hasDescription() : bool
    {
        return $this->getDescription() !== null;
    }
    public function getDescription() : ?string
    {
        $this->errorWhenInvalid();
        return $this->contentNode->description !== '' ? $this->contentNode->description : null;
    }
    public function getPropertyName() : string
    {
        $this->errorWhenInvalid();
        return $this->contentNode->propertyName;
    }
    /**
     * @return GenericTypeNode|CallableTypeNode|IntersectionTypeNode|UnionTypeNode|ArrayTypeNode|IdentifierTypeNode|ThisTypeNode|NullableTypeNode
     */
    public function getType() : \_PhpScoper1e80a2e03314\PHPStan\PhpDocParser\Ast\Type\TypeNode
    {
        $this->errorWhenInvalid();
        /** @var GenericTypeNode|CallableTypeNode|IntersectionTypeNode|UnionTypeNode|ArrayTypeNode|IdentifierTypeNode|ThisTypeNode|NullableTypeNode $type */
        $type = $this->contentNode->type;
        return $type;
    }
    public function export() : string
    {
        $exported = \sprintf('%s %s %s', $this->name, \SlevomatCodingStandard\Helpers\AnnotationTypeHelper::export($this->getType()), $this->getPropertyName());
        $description = $this->getDescription();
        if ($description !== null) {
            $exported .= \sprintf(' %s', $this->fixDescription($description));
        }
        return $exported;
    }
}
