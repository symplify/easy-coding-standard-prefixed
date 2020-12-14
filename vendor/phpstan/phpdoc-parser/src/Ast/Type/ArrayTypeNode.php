<?php

declare (strict_types=1);
namespace _PhpScoper8a0112f19f39\PHPStan\PhpDocParser\Ast\Type;

class ArrayTypeNode implements \_PhpScoper8a0112f19f39\PHPStan\PhpDocParser\Ast\Type\TypeNode
{
    /** @var TypeNode */
    public $type;
    public function __construct(\_PhpScoper8a0112f19f39\PHPStan\PhpDocParser\Ast\Type\TypeNode $type)
    {
        $this->type = $type;
    }
    public function __toString() : string
    {
        return $this->type . '[]';
    }
}
