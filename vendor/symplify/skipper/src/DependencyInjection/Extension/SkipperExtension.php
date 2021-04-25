<?php

declare (strict_types=1);
namespace Symplify\Skipper\DependencyInjection\Extension;

use _PhpScoper5686a261d89c\Symfony\Component\Config\FileLocator;
use _PhpScoper5686a261d89c\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper5686a261d89c\Symfony\Component\DependencyInjection\Extension\Extension;
use _PhpScoper5686a261d89c\Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
final class SkipperExtension extends Extension
{
    /**
     * @param string[] $configs
     */
    public function load(array $configs, ContainerBuilder $containerBuilder) : void
    {
        // needed for parameter shifting of sniff/fixer params
        $phpFileLoader = new PhpFileLoader($containerBuilder, new FileLocator(__DIR__ . '/../../../config'));
        $phpFileLoader->load('config.php');
    }
}
