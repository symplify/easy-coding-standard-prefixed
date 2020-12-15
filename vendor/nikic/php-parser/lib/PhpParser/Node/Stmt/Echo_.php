<?php

declare (strict_types=1);
namespace _PhpScoper6a1dd9b8a650\PhpParser\Node\Stmt;

use _PhpScoper6a1dd9b8a650\PhpParser\Node;
class Echo_ extends \_PhpScoper6a1dd9b8a650\PhpParser\Node\Stmt
{
    /** @var Node\Expr[] Expressions */
    public $exprs;
    /**
     * Constructs an echo node.
     *
     * @param Node\Expr[] $exprs      Expressions
     * @param array       $attributes Additional attributes
     */
    public function __construct(array $exprs, array $attributes = [])
    {
        $this->attributes = $attributes;
        $this->exprs = $exprs;
    }
    public function getSubNodeNames() : array
    {
        return ['exprs'];
    }
    public function getType() : string
    {
        return 'Stmt_Echo';
    }
}
