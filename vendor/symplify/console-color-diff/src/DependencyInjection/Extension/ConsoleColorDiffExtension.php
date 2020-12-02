<?php

declare (strict_types=1);
namespace Symplify\ConsoleColorDiff\DependencyInjection\Extension;

use _PhpScoper6a0a7eb6e565\Symfony\Component\Config\FileLocator;
use _PhpScoper6a0a7eb6e565\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper6a0a7eb6e565\Symfony\Component\DependencyInjection\Extension\Extension;
use _PhpScoper6a0a7eb6e565\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
final class ConsoleColorDiffExtension extends \_PhpScoper6a0a7eb6e565\Symfony\Component\DependencyInjection\Extension\Extension
{
    public function load(array $configs, \_PhpScoper6a0a7eb6e565\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        $phpFileLoader = new \_PhpScoper6a0a7eb6e565\Symfony\Component\DependencyInjection\Loader\PhpFileLoader($containerBuilder, new \_PhpScoper6a0a7eb6e565\Symfony\Component\Config\FileLocator(__DIR__ . '/../../../config'));
        $phpFileLoader->load('config.php');
    }
}
