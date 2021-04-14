<?php

declare (strict_types=1);
namespace Symplify\Skipper\DependencyInjection\Extension;

use _PhpScoperd8b0b9452568\Symfony\Component\Config\FileLocator;
use _PhpScoperd8b0b9452568\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoperd8b0b9452568\Symfony\Component\DependencyInjection\Extension\Extension;
use _PhpScoperd8b0b9452568\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
final class SkipperExtension extends \_PhpScoperd8b0b9452568\Symfony\Component\DependencyInjection\Extension\Extension
{
    /**
     * @param string[] $configs
     */
    public function load(array $configs, \_PhpScoperd8b0b9452568\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        // needed for parameter shifting of sniff/fixer params
        $phpFileLoader = new \_PhpScoperd8b0b9452568\Symfony\Component\DependencyInjection\Loader\PhpFileLoader($containerBuilder, new \_PhpScoperd8b0b9452568\Symfony\Component\Config\FileLocator(__DIR__ . '/../../../config'));
        $phpFileLoader->load('config.php');
    }
}
