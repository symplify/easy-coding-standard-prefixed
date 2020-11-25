<?php

declare (strict_types=1);
namespace _PhpScoper833c56a97273\PhpParser\Node\Stmt;

use _PhpScoper833c56a97273\PhpParser\Node;
/** Nop/empty statement (;). */
class Nop extends \_PhpScoper833c56a97273\PhpParser\Node\Stmt
{
    public function getSubNodeNames() : array
    {
        return [];
    }
    public function getType() : string
    {
        return 'Stmt_Nop';
    }
}
