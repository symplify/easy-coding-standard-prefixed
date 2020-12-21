<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperb730595bc9f4\Symfony\Component\DependencyInjection\Argument;

use _PhpScoperb730595bc9f4\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use _PhpScoperb730595bc9f4\Symfony\Component\DependencyInjection\Reference;
/**
 * Represents a service wrapped in a memoizing closure.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class ServiceClosureArgument implements \_PhpScoperb730595bc9f4\Symfony\Component\DependencyInjection\Argument\ArgumentInterface
{
    private $values;
    public function __construct(\_PhpScoperb730595bc9f4\Symfony\Component\DependencyInjection\Reference $reference)
    {
        $this->values = [$reference];
    }
    /**
     * {@inheritdoc}
     */
    public function getValues()
    {
        return $this->values;
    }
    /**
     * {@inheritdoc}
     */
    public function setValues(array $values)
    {
        if ([0] !== \array_keys($values) || !($values[0] instanceof \_PhpScoperb730595bc9f4\Symfony\Component\DependencyInjection\Reference || null === $values[0])) {
            throw new \_PhpScoperb730595bc9f4\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException('A ServiceClosureArgument must hold one and only one Reference.');
        }
        $this->values = $values;
    }
}
