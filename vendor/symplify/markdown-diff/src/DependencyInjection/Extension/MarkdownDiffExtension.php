<?php

declare (strict_types=1);
namespace Symplify\MarkdownDiff\DependencyInjection\Extension;

use _PhpScoperb83706991c7f\Symfony\Component\Config\FileLocator;
use _PhpScoperb83706991c7f\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoperb83706991c7f\Symfony\Component\DependencyInjection\Extension\Extension;
use _PhpScoperb83706991c7f\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
final class MarkdownDiffExtension extends \_PhpScoperb83706991c7f\Symfony\Component\DependencyInjection\Extension\Extension
{
    public function load(array $configs, \_PhpScoperb83706991c7f\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        $phpFileLoader = new \_PhpScoperb83706991c7f\Symfony\Component\DependencyInjection\Loader\PhpFileLoader($containerBuilder, new \_PhpScoperb83706991c7f\Symfony\Component\Config\FileLocator(__DIR__ . '/../../../config'));
        $phpFileLoader->load('config.php');
    }
}
