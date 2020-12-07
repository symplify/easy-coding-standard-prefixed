<?php

declare (strict_types=1);
namespace _PhpScoperb83706991c7f\PhpParser\Node\Expr\BinaryOp;

use _PhpScoperb83706991c7f\PhpParser\Node\Expr\BinaryOp;
class Pow extends \_PhpScoperb83706991c7f\PhpParser\Node\Expr\BinaryOp
{
    public function getOperatorSigil() : string
    {
        return '**';
    }
    public function getType() : string
    {
        return 'Expr_BinaryOp_Pow';
    }
}
