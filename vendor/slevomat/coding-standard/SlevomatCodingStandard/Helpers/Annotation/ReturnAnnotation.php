<?php

declare (strict_types=1);
namespace SlevomatCodingStandard\Helpers\Annotation;

use InvalidArgumentException;
use _PhpScoperaa402dd1b1f1\PHPStan\PhpDocParser\Ast\PhpDoc\ReturnTagValueNode;
use _PhpScoperaa402dd1b1f1\PHPStan\PhpDocParser\Ast\Type\ArrayShapeNode;
use _PhpScoperaa402dd1b1f1\PHPStan\PhpDocParser\Ast\Type\ArrayTypeNode;
use _PhpScoperaa402dd1b1f1\PHPStan\PhpDocParser\Ast\Type\CallableTypeNode;
use _PhpScoperaa402dd1b1f1\PHPStan\PhpDocParser\Ast\Type\ConstTypeNode;
use _PhpScoperaa402dd1b1f1\PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use _PhpScoperaa402dd1b1f1\PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use _PhpScoperaa402dd1b1f1\PHPStan\PhpDocParser\Ast\Type\IntersectionTypeNode;
use _PhpScoperaa402dd1b1f1\PHPStan\PhpDocParser\Ast\Type\NullableTypeNode;
use _PhpScoperaa402dd1b1f1\PHPStan\PhpDocParser\Ast\Type\ThisTypeNode;
use _PhpScoperaa402dd1b1f1\PHPStan\PhpDocParser\Ast\Type\TypeNode;
use _PhpScoperaa402dd1b1f1\PHPStan\PhpDocParser\Ast\Type\UnionTypeNode;
use SlevomatCodingStandard\Helpers\AnnotationTypeHelper;
use function in_array;
use function sprintf;
/**
 * @internal
 */
class ReturnAnnotation extends \SlevomatCodingStandard\Helpers\Annotation\Annotation
{
    /** @var ReturnTagValueNode|null */
    private $contentNode;
    public function __construct(string $name, int $startPointer, int $endPointer, ?string $content, ?\_PhpScoperaa402dd1b1f1\PHPStan\PhpDocParser\Ast\PhpDoc\ReturnTagValueNode $contentNode)
    {
        if (!\in_array($name, ['@return', '@psalm-return', '@phpstan-return'], \true)) {
            throw new \InvalidArgumentException(\sprintf('Unsupported annotation %s.', $name));
        }
        parent::__construct($name, $startPointer, $endPointer, $content);
        $this->contentNode = $contentNode;
    }
    public function isInvalid() : bool
    {
        return $this->contentNode === null;
    }
    public function getContentNode() : \_PhpScoperaa402dd1b1f1\PHPStan\PhpDocParser\Ast\PhpDoc\ReturnTagValueNode
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
    /**
     * @return GenericTypeNode|CallableTypeNode|IntersectionTypeNode|UnionTypeNode|ArrayTypeNode|ArrayShapeNode|IdentifierTypeNode|ThisTypeNode|NullableTypeNode|ConstTypeNode
     */
    public function getType() : \_PhpScoperaa402dd1b1f1\PHPStan\PhpDocParser\Ast\Type\TypeNode
    {
        $this->errorWhenInvalid();
        /** @var GenericTypeNode|CallableTypeNode|IntersectionTypeNode|UnionTypeNode|ArrayTypeNode|ArrayShapeNode|IdentifierTypeNode|ThisTypeNode|NullableTypeNode|ConstTypeNode $type */
        $type = $this->contentNode->type;
        return $type;
    }
    public function export() : string
    {
        $exported = \sprintf('%s %s', $this->name, \SlevomatCodingStandard\Helpers\AnnotationTypeHelper::export($this->getType()));
        $description = $this->getDescription();
        if ($description !== null) {
            $exported .= \sprintf(' %s', $this->fixDescription($description));
        }
        return $exported;
    }
}
