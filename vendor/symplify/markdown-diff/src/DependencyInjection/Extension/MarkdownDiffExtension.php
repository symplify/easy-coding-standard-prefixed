<?php

declare (strict_types=1);
namespace Symplify\MarkdownDiff\DependencyInjection\Extension;

use _PhpScoper68a3a2539032\Symfony\Component\Config\FileLocator;
use _PhpScoper68a3a2539032\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper68a3a2539032\Symfony\Component\DependencyInjection\Extension\Extension;
use _PhpScoper68a3a2539032\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
final class MarkdownDiffExtension extends \_PhpScoper68a3a2539032\Symfony\Component\DependencyInjection\Extension\Extension
{
    public function load(array $configs, \_PhpScoper68a3a2539032\Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder) : void
    {
        $phpFileLoader = new \_PhpScoper68a3a2539032\Symfony\Component\DependencyInjection\Loader\PhpFileLoader($containerBuilder, new \_PhpScoper68a3a2539032\Symfony\Component\Config\FileLocator(__DIR__ . '/../../../config'));
        $phpFileLoader->load('config.php');
    }
}
