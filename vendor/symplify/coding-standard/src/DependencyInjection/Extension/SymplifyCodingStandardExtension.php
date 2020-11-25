<?php

declare (strict_types=1);
namespace Symplify\CodingStandard\DependencyInjection\Extension;

use _PhpScoperaa402dd1b1f1\Symfony\Component\Config\FileLocator;
use _PhpScoperaa402dd1b1f1\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoperaa402dd1b1f1\Symfony\Component\DependencyInjection\Extension\Extension;
use _PhpScoperaa402dd1b1f1\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
final class SymplifyCodingStandardExtension extends \_PhpScoperaa402dd1b1f1\Symfony\Component\DependencyInjection\Extension\Extension
{
    public function load(array $configs, \_PhpScoperaa402dd1b1f1\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        // needed for parameter shifting of sniff/fixer params
        $phpFileLoader = new \_PhpScoperaa402dd1b1f1\Symfony\Component\DependencyInjection\Loader\PhpFileLoader($containerBuilder, new \_PhpScoperaa402dd1b1f1\Symfony\Component\Config\FileLocator(__DIR__ . '/../../../config'));
        $phpFileLoader->load('config.php');
    }
}
