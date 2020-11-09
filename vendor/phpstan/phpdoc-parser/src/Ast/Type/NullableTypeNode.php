<?php

declare (strict_types=1);
namespace _PhpScoperae959d396e95\PHPStan\PhpDocParser\Ast\Type;

class NullableTypeNode implements \_PhpScoperae959d396e95\PHPStan\PhpDocParser\Ast\Type\TypeNode
{
    /** @var TypeNode */
    public $type;
    public function __construct(\_PhpScoperae959d396e95\PHPStan\PhpDocParser\Ast\Type\TypeNode $type)
    {
        $this->type = $type;
    }
    public function __toString() : string
    {
        return '?' . $this->type;
    }
}
