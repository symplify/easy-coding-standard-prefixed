<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperb6d4bd368bd9\Symfony\Component\DependencyInjection\LazyProxy\Instantiator;

use _PhpScoperb6d4bd368bd9\Symfony\Component\DependencyInjection\ContainerInterface;
use _PhpScoperb6d4bd368bd9\Symfony\Component\DependencyInjection\Definition;
/**
 * {@inheritdoc}
 *
 * Noop proxy instantiator - produces the real service instead of a proxy instance.
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 */
class RealServiceInstantiator implements \_PhpScoperb6d4bd368bd9\Symfony\Component\DependencyInjection\LazyProxy\Instantiator\InstantiatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function instantiateProxy(\_PhpScoperb6d4bd368bd9\Symfony\Component\DependencyInjection\ContainerInterface $container, \_PhpScoperb6d4bd368bd9\Symfony\Component\DependencyInjection\Definition $definition, $id, $realInstantiator)
    {
        return $realInstantiator();
    }
}
