<?php

declare (strict_types=1);
namespace SlevomatCodingStandard\Helpers\Annotation;

use InvalidArgumentException;
use _PhpScoper8de082cbb8c7\PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode;
use _PhpScoper8de082cbb8c7\PHPStan\PhpDocParser\Ast\Type\TypeNode;
use SlevomatCodingStandard\Helpers\AnnotationTypeHelper;
use function in_array;
use function sprintf;
/**
 * @internal
 */
class TemplateAnnotation extends \SlevomatCodingStandard\Helpers\Annotation\Annotation
{
    /** @var TemplateTagValueNode|null */
    private $contentNode;
    public function __construct(string $name, int $startPointer, int $endPointer, ?string $content, ?\_PhpScoper8de082cbb8c7\PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode $contentNode)
    {
        if (!\in_array($name, ['@template', '@psalm-template', '@phpstan-template', '@template-covariant', '@psalm-template-covariant', '@phpstan-template-covariant'], \true)) {
            throw new \InvalidArgumentException(\sprintf('Unsupported annotation %s.', $name));
        }
        parent::__construct($name, $startPointer, $endPointer, $content);
        $this->contentNode = $contentNode;
    }
    public function isInvalid() : bool
    {
        return $this->contentNode === null;
    }
    public function getContentNode() : \_PhpScoper8de082cbb8c7\PHPStan\PhpDocParser\Ast\PhpDoc\TemplateTagValueNode
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
    public function getTemplateName() : string
    {
        $this->errorWhenInvalid();
        return $this->contentNode->name;
    }
    public function getBound() : ?\_PhpScoper8de082cbb8c7\PHPStan\PhpDocParser\Ast\Type\TypeNode
    {
        $this->errorWhenInvalid();
        return $this->contentNode->bound;
    }
    public function export() : string
    {
        $exported = \sprintf('%s %s', $this->name, $this->contentNode->name);
        if ($this->contentNode->bound !== null) {
            $exported .= \sprintf(' of %s', \SlevomatCodingStandard\Helpers\AnnotationTypeHelper::export($this->contentNode->bound));
        }
        $description = $this->getDescription();
        if ($description !== null) {
            $exported .= \sprintf(' %s', $this->fixDescription($description));
        }
        return $exported;
    }
}