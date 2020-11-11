<?php

declare (strict_types=1);
namespace _PhpScoper4f985154d5a0\PhpParser\Node\Expr;

use _PhpScoper4f985154d5a0\PhpParser\Node\Expr;
class Print_ extends \_PhpScoper4f985154d5a0\PhpParser\Node\Expr
{
    /** @var Expr Expression */
    public $expr;
    /**
     * Constructs an print() node.
     *
     * @param Expr  $expr       Expression
     * @param array $attributes Additional attributes
     */
    public function __construct(\_PhpScoper4f985154d5a0\PhpParser\Node\Expr $expr, array $attributes = [])
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
        return 'Expr_Print';
    }
}
