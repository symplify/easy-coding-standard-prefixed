<?php

declare (strict_types=1);
namespace _PhpScoper224ae0b86670\PhpParser\Node\Stmt;

use _PhpScoper224ae0b86670\PhpParser\Node;
use _PhpScoper224ae0b86670\PhpParser\Node\FunctionLike;
/**
 * @property Node\Name $namespacedName Namespaced name (if using NameResolver)
 */
class Function_ extends \_PhpScoper224ae0b86670\PhpParser\Node\Stmt implements \_PhpScoper224ae0b86670\PhpParser\Node\FunctionLike
{
    /** @var bool Whether function returns by reference */
    public $byRef;
    /** @var Node\Identifier Name */
    public $name;
    /** @var Node\Param[] Parameters */
    public $params;
    /** @var null|Node\Identifier|Node\Name|Node\NullableType|Node\UnionType Return type */
    public $returnType;
    /** @var Node\Stmt[] Statements */
    public $stmts;
    /**
     * Constructs a function node.
     *
     * @param string|Node\Identifier $name Name
     * @param array  $subNodes   Array of the following optional subnodes:
     *                           'byRef'      => false  : Whether to return by reference
     *                           'params'     => array(): Parameters
     *                           'returnType' => null   : Return type
     *                           'stmts'      => array(): Statements
     * @param array  $attributes Additional attributes
     */
    public function __construct($name, array $subNodes = [], array $attributes = [])
    {
        $this->attributes = $attributes;
        $this->byRef = $subNodes['byRef'] ?? \false;
        $this->name = \is_string($name) ? new \_PhpScoper224ae0b86670\PhpParser\Node\Identifier($name) : $name;
        $this->params = $subNodes['params'] ?? [];
        $returnType = $subNodes['returnType'] ?? null;
        $this->returnType = \is_string($returnType) ? new \_PhpScoper224ae0b86670\PhpParser\Node\Identifier($returnType) : $returnType;
        $this->stmts = $subNodes['stmts'] ?? [];
    }
    public function getSubNodeNames() : array
    {
        return ['byRef', 'name', 'params', 'returnType', 'stmts'];
    }
    public function returnsByRef() : bool
    {
        return $this->byRef;
    }
    public function getParams() : array
    {
        return $this->params;
    }
    public function getReturnType()
    {
        return $this->returnType;
    }
    /** @return Node\Stmt[] */
    public function getStmts() : array
    {
        return $this->stmts;
    }
    public function getType() : string
    {
        return 'Stmt_Function';
    }
}
