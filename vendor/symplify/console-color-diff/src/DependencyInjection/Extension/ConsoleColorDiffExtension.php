<?php

declare (strict_types=1);
namespace Symplify\ConsoleColorDiff\DependencyInjection\Extension;

use _PhpScoperdf6a0b341030\Symfony\Component\Config\FileLocator;
use _PhpScoperdf6a0b341030\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoperdf6a0b341030\Symfony\Component\DependencyInjection\Extension\Extension;
use _PhpScoperdf6a0b341030\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
final class ConsoleColorDiffExtension extends \_PhpScoperdf6a0b341030\Symfony\Component\DependencyInjection\Extension\Extension
{
    public function load(array $configs, \_PhpScoperdf6a0b341030\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        $phpFileLoader = new \_PhpScoperdf6a0b341030\Symfony\Component\DependencyInjection\Loader\PhpFileLoader($containerBuilder, new \_PhpScoperdf6a0b341030\Symfony\Component\Config\FileLocator(__DIR__ . '/../../../config'));
        $phpFileLoader->load('config.php');
    }
}
