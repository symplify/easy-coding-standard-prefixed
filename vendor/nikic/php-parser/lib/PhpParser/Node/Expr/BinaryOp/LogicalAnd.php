<?php

declare (strict_types=1);
namespace _PhpScoper592524ba34f0\PhpParser\Node\Expr\BinaryOp;

use _PhpScoper592524ba34f0\PhpParser\Node\Expr\BinaryOp;
class LogicalAnd extends \_PhpScoper592524ba34f0\PhpParser\Node\Expr\BinaryOp
{
    public function getOperatorSigil() : string
    {
        return 'and';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_LogicalAnd';
    }
}
