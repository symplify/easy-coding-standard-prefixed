<?php

declare (strict_types=1);
namespace _PhpScoper224ae0b86670\PhpParser\Node\Expr\BinaryOp;

use _PhpScoper224ae0b86670\PhpParser\Node\Expr\BinaryOp;
class BitwiseXor extends \_PhpScoper224ae0b86670\PhpParser\Node\Expr\BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '^';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_BitwiseXor';
    }
}
