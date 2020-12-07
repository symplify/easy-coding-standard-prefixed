<?php

declare (strict_types=1);
namespace _PhpScopereb8678af2407\PHPStan\PhpDocParser\Ast\PhpDoc;

use _PhpScopereb8678af2407\PHPStan\PhpDocParser\Ast\Type\TypeNode;
class MixinTagValueNode implements \_PhpScopereb8678af2407\PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagValueNode
{
    /** @var TypeNode */
    public $type;
    /** @var string (may be empty) */
    public $description;
    public function __construct(\_PhpScopereb8678af2407\PHPStan\PhpDocParser\Ast\Type\TypeNode $type, string $description)
    {
        $this->type = $type;
        $this->description = $description;
    }
    public function __toString() : string
    {
        return \trim("{$this->type} {$this->description}");
    }
}
