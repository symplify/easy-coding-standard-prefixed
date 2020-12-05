<?php

declare (strict_types=1);
namespace _PhpScoper02b5d1bf8fec\PhpParser\Node\Expr\BinaryOp;

use _PhpScoper02b5d1bf8fec\PhpParser\Node\Expr\BinaryOp;
class Pow extends \_PhpScoper02b5d1bf8fec\PhpParser\Node\Expr\BinaryOp
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
