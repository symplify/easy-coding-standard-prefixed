<?php

declare (strict_types=1);
namespace _PhpScoper8de082cbb8c7\PhpParser\Node\Stmt;

use _PhpScoper8de082cbb8c7\PhpParser\Node;
use _PhpScoper8de082cbb8c7\PhpParser\Node\Expr;
class Catch_ extends \_PhpScoper8de082cbb8c7\PhpParser\Node\Stmt
{
    /** @var Node\Name[] Types of exceptions to catch */
    public $types;
    /** @var Expr\Variable|null Variable for exception */
    public $var;
    /** @var Node\Stmt[] Statements */
    public $stmts;
    /**
     * Constructs a catch node.
     *
     * @param Node\Name[]           $types      Types of exceptions to catch
     * @param Expr\Variable|null    $var        Variable for exception
     * @param Node\Stmt[]           $stmts      Statements
     * @param array                 $attributes Additional attributes
     */
    public function __construct(array $types, \_PhpScoper8de082cbb8c7\PhpParser\Node\Expr\Variable $var = null, array $stmts = [], array $attributes = [])
    {
        $this->attributes = $attributes;
        $this->types = $types;
        $this->var = $var;
        $this->stmts = $stmts;
    }
    public function getSubNodeNames() : array
    {
        return ['types', 'var', 'stmts'];
    }
    public function getType() : string
    {
        return 'Stmt_Catch';
    }
}