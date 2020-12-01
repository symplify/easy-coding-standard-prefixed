<?php

declare (strict_types=1);
namespace _PhpScoper96382aaac118;

use _PhpScoper96382aaac118\Psr\Cache\CacheItemPoolInterface;
use _PhpScoper96382aaac118\Psr\SimpleCache\CacheInterface;
use _PhpScoper96382aaac118\Symfony\Component\Cache\Adapter\FilesystemAdapter;
use _PhpScoper96382aaac118\Symfony\Component\Cache\Adapter\TagAwareAdapter;
use _PhpScoper96382aaac118\Symfony\Component\Cache\Adapter\TagAwareAdapterInterface;
use _PhpScoper96382aaac118\Symfony\Component\Cache\Psr16Cache;
use _PhpScoper96382aaac118\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoper96382aaac118\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->autowire()->autoconfigure()->public();
    $services->set(\_PhpScoper96382aaac118\Symfony\Component\Cache\Psr16Cache::class);
    $services->alias(\_PhpScoper96382aaac118\Psr\SimpleCache\CacheInterface::class, \_PhpScoper96382aaac118\Symfony\Component\Cache\Psr16Cache::class);
    $services->set(\_PhpScoper96382aaac118\Symfony\Component\Cache\Adapter\FilesystemAdapter::class)->args(['$namespace' => '%cache_namespace%', '$defaultLifetime' => 0, '$directory' => '%cache_directory%']);
    $services->alias(\_PhpScoper96382aaac118\Psr\Cache\CacheItemPoolInterface::class, \_PhpScoper96382aaac118\Symfony\Component\Cache\Adapter\FilesystemAdapter::class);
    $services->alias(\_PhpScoper96382aaac118\Symfony\Component\Cache\Adapter\TagAwareAdapterInterface::class, \_PhpScoper96382aaac118\Symfony\Component\Cache\Adapter\TagAwareAdapter::class);
};
