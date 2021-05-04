<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper08fb1f8a2f44\Symfony\Component\HttpKernel\DependencyInjection;

use _PhpScoper08fb1f8a2f44\Psr\Log\LoggerInterface;
use _PhpScoper08fb1f8a2f44\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use _PhpScoper08fb1f8a2f44\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper08fb1f8a2f44\Symfony\Component\HttpKernel\Log\Logger;
/**
 * Registers the default logger if necessary.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class LoggerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $container->setAlias(LoggerInterface::class, 'logger')->setPublic(\false);
        if ($container->has('logger')) {
            return;
        }
        $container->register('logger', Logger::class)->setPublic(\false);
    }
}
