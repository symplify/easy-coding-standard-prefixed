<?php

declare (strict_types=1);
namespace _PhpScoperaa402dd1b1f1\PhpParser\Node;

use _PhpScoperaa402dd1b1f1\PhpParser\Node;
interface FunctionLike extends \_PhpScoperaa402dd1b1f1\PhpParser\Node
{
    /**
     * Whether to return by reference
     *
     * @return bool
     */
    public function returnsByRef() : bool;
    /**
     * List of parameters
     *
     * @return Param[]
     */
    public function getParams() : array;
    /**
     * Get the declared return type or null
     *
     * @return null|Identifier|Name|NullableType|UnionType
     */
    public function getReturnType();
    /**
     * The function body
     *
     * @return Stmt[]|null
     */
    public function getStmts();
    /**
     * Get PHP attribute groups.
     *
     * @return AttributeGroup[]
     */
    public function getAttrGroups() : array;
}
