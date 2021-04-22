<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper22e359cd1ab0\Symfony\Component\DependencyInjection\LazyProxy\PhpDumper;

use _PhpScoper22e359cd1ab0\Symfony\Component\DependencyInjection\Definition;
/**
 * Null dumper, negates any proxy code generation for any given service definition.
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 *
 * @final
 */
class NullDumper implements \_PhpScoper22e359cd1ab0\Symfony\Component\DependencyInjection\LazyProxy\PhpDumper\DumperInterface
{
    /**
     * {@inheritdoc}
     */
    public function isProxyCandidate(Definition $definition) : bool
    {
        return \false;
    }
    /**
     * {@inheritdoc}
     */
    public function getProxyFactoryCode(Definition $definition, string $id, string $factoryCode) : string
    {
        return '';
    }
    /**
     * {@inheritdoc}
     */
    public function getProxyCode(Definition $definition) : string
    {
        return '';
    }
}
