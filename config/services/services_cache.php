<?php

declare (strict_types=1);
namespace _PhpScoper8de082cbb8c7;

use _PhpScoper8de082cbb8c7\Psr\Cache\CacheItemPoolInterface;
use _PhpScoper8de082cbb8c7\Psr\SimpleCache\CacheInterface;
use _PhpScoper8de082cbb8c7\Symfony\Component\Cache\Adapter\FilesystemAdapter;
use _PhpScoper8de082cbb8c7\Symfony\Component\Cache\Adapter\TagAwareAdapter;
use _PhpScoper8de082cbb8c7\Symfony\Component\Cache\Adapter\TagAwareAdapterInterface;
use _PhpScoper8de082cbb8c7\Symfony\Component\Cache\Psr16Cache;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->autowire()->autoconfigure()->public();
    $services->set(\_PhpScoper8de082cbb8c7\Symfony\Component\Cache\Psr16Cache::class);
    $services->alias(\_PhpScoper8de082cbb8c7\Psr\SimpleCache\CacheInterface::class, \_PhpScoper8de082cbb8c7\Symfony\Component\Cache\Psr16Cache::class);
    $services->set(\_PhpScoper8de082cbb8c7\Symfony\Component\Cache\Adapter\FilesystemAdapter::class)->args(['$namespace' => '%cache_namespace%', '$defaultLifetime' => 0, '$directory' => '%cache_directory%']);
    $services->alias(\_PhpScoper8de082cbb8c7\Psr\Cache\CacheItemPoolInterface::class, \_PhpScoper8de082cbb8c7\Symfony\Component\Cache\Adapter\FilesystemAdapter::class);
    $services->alias(\_PhpScoper8de082cbb8c7\Symfony\Component\Cache\Adapter\TagAwareAdapterInterface::class, \_PhpScoper8de082cbb8c7\Symfony\Component\Cache\Adapter\TagAwareAdapter::class);
};