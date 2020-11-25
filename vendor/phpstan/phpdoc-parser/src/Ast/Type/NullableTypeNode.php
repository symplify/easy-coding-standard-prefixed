<?php

declare (strict_types=1);
namespace _PhpScoper544eb478a6f6\PHPStan\PhpDocParser\Ast\Type;

class NullableTypeNode implements \_PhpScoper544eb478a6f6\PHPStan\PhpDocParser\Ast\Type\TypeNode
{
    /** @var TypeNode */
    public $type;
    public function __construct(\_PhpScoper544eb478a6f6\PHPStan\PhpDocParser\Ast\Type\TypeNode $type)
    {
        $this->type = $type;
    }
    public function __toString() : string
    {
        return '?' . $this->type;
    }
}
