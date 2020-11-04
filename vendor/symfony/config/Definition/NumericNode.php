<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper75713bc3e278\Symfony\Component\Config\Definition;

use _PhpScoper75713bc3e278\Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
/**
 * This node represents a numeric value in the config tree.
 *
 * @author David Jeanmonod <david.jeanmonod@gmail.com>
 */
class NumericNode extends \_PhpScoper75713bc3e278\Symfony\Component\Config\Definition\ScalarNode
{
    protected $min;
    protected $max;
    public function __construct(?string $name, \_PhpScoper75713bc3e278\Symfony\Component\Config\Definition\NodeInterface $parent = null, $min = null, $max = null, string $pathSeparator = \_PhpScoper75713bc3e278\Symfony\Component\Config\Definition\BaseNode::DEFAULT_PATH_SEPARATOR)
    {
        parent::__construct($name, $parent, $pathSeparator);
        $this->min = $min;
        $this->max = $max;
    }
    /**
     * {@inheritdoc}
     */
    protected function finalizeValue($value)
    {
        $value = parent::finalizeValue($value);
        $errorMsg = null;
        if (isset($this->min) && $value < $this->min) {
            $errorMsg = \sprintf('The value %s is too small for path "%s". Should be greater than or equal to %s', $value, $this->getPath(), $this->min);
        }
        if (isset($this->max) && $value > $this->max) {
            $errorMsg = \sprintf('The value %s is too big for path "%s". Should be less than or equal to %s', $value, $this->getPath(), $this->max);
        }
        if (isset($errorMsg)) {
            $ex = new \_PhpScoper75713bc3e278\Symfony\Component\Config\Definition\Exception\InvalidConfigurationException($errorMsg);
            $ex->setPath($this->getPath());
            throw $ex;
        }
        return $value;
    }
    /**
     * {@inheritdoc}
     */
    protected function isValueEmpty($value)
    {
        // a numeric value cannot be empty
        return \false;
    }
}
