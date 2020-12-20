<?php

declare (strict_types=1);
namespace _PhpScopere205696a9dd6\PhpParser\Node\Expr\BinaryOp;

use _PhpScopere205696a9dd6\PhpParser\Node\Expr\BinaryOp;
class LogicalAnd extends \_PhpScopere205696a9dd6\PhpParser\Node\Expr\BinaryOp
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
