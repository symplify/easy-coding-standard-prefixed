<?php

declare (strict_types=1);
namespace _PhpScoper2637e9a72c68\PhpParser\Node\Stmt;

use _PhpScoper2637e9a72c68\PhpParser\Node;
class Throw_ extends \_PhpScoper2637e9a72c68\PhpParser\Node\Stmt
{
    /** @var Node\Expr Expression */
    public $expr;
    /**
     * Constructs a legacy throw statement node.
     *
     * @param Node\Expr $expr       Expression
     * @param array     $attributes Additional attributes
     */
    public function __construct(\_PhpScoper2637e9a72c68\PhpParser\Node\Expr $expr, array $attributes = [])
    {
        $this->attributes = $attributes;
        $this->expr = $expr;
    }
    public function getSubNodeNames() : array
    {
        return ['expr'];
    }
    public function getType() : string
    {
        return 'Stmt_Throw';
    }
}
