<?php

declare (strict_types=1);
namespace Symplify\CodingStandard\DependencyInjection\Extension;

use _PhpScoper7b319b4d8e1c\Symfony\Component\Config\FileLocator;
use _PhpScoper7b319b4d8e1c\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper7b319b4d8e1c\Symfony\Component\DependencyInjection\Extension\Extension;
use _PhpScoper7b319b4d8e1c\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
final class SymplifyCodingStandardExtension extends \_PhpScoper7b319b4d8e1c\Symfony\Component\DependencyInjection\Extension\Extension
{
    /**
     * @param string[] $configs
     */
    public function load(array $configs, \_PhpScoper7b319b4d8e1c\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        // needed for parameter shifting of sniff/fixer params
        $phpFileLoader = new \_PhpScoper7b319b4d8e1c\Symfony\Component\DependencyInjection\Loader\PhpFileLoader($containerBuilder, new \_PhpScoper7b319b4d8e1c\Symfony\Component\Config\FileLocator(__DIR__ . '/../../../config'));
        $phpFileLoader->load('config.php');
    }
}
