<?php

declare (strict_types=1);
namespace _PhpScoperf65af7a6d9a0\PhpParser\Builder;

use _PhpScoperf65af7a6d9a0\PhpParser\BuilderHelpers;
use _PhpScoperf65af7a6d9a0\PhpParser\Node;
abstract class FunctionLike extends \_PhpScoperf65af7a6d9a0\PhpParser\Builder\Declaration
{
    protected $returnByRef = \false;
    protected $params = [];
    /** @var string|Node\Name|Node\NullableType|null */
    protected $returnType = null;
    /**
     * Make the function return by reference.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makeReturnByRef()
    {
        $this->returnByRef = \true;
        return $this;
    }
    /**
     * Adds a parameter.
     *
     * @param Node\Param|Param $param The parameter to add
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function addParam($param)
    {
        $param = \_PhpScoperf65af7a6d9a0\PhpParser\BuilderHelpers::normalizeNode($param);
        if (!$param instanceof \_PhpScoperf65af7a6d9a0\PhpParser\Node\Param) {
            throw new \LogicException(\sprintf('Expected parameter node, got "%s"', $param->getType()));
        }
        $this->params[] = $param;
        return $this;
    }
    /**
     * Adds multiple parameters.
     *
     * @param array $params The parameters to add
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function addParams(array $params)
    {
        foreach ($params as $param) {
            $this->addParam($param);
        }
        return $this;
    }
    /**
     * Sets the return type for PHP 7.
     *
     * @param string|Node\Name|Node\NullableType $type One of array, callable, string, int, float,
     *                                                 bool, iterable, or a class/interface name.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function setReturnType($type)
    {
        $this->returnType = \_PhpScoperf65af7a6d9a0\PhpParser\BuilderHelpers::normalizeType($type);
        return $this;
    }
}
