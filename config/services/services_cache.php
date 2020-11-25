<?php

declare (strict_types=1);
namespace _PhpScoperca8ca183ac38;

use _PhpScoperca8ca183ac38\Psr\Cache\CacheItemPoolInterface;
use _PhpScoperca8ca183ac38\Psr\SimpleCache\CacheInterface;
use _PhpScoperca8ca183ac38\Symfony\Component\Cache\Adapter\FilesystemAdapter;
use _PhpScoperca8ca183ac38\Symfony\Component\Cache\Adapter\TagAwareAdapter;
use _PhpScoperca8ca183ac38\Symfony\Component\Cache\Adapter\TagAwareAdapterInterface;
use _PhpScoperca8ca183ac38\Symfony\Component\Cache\Psr16Cache;
use _PhpScoperca8ca183ac38\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (\_PhpScoperca8ca183ac38\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->autowire()->autoconfigure()->public();
    $services->set(\_PhpScoperca8ca183ac38\Symfony\Component\Cache\Psr16Cache::class);
    $services->alias(\_PhpScoperca8ca183ac38\Psr\SimpleCache\CacheInterface::class, \_PhpScoperca8ca183ac38\Symfony\Component\Cache\Psr16Cache::class);
    $services->set(\_PhpScoperca8ca183ac38\Symfony\Component\Cache\Adapter\FilesystemAdapter::class)->args(['$namespace' => '%cache_namespace%', '$defaultLifetime' => 0, '$directory' => '%cache_directory%']);
    $services->alias(\_PhpScoperca8ca183ac38\Psr\Cache\CacheItemPoolInterface::class, \_PhpScoperca8ca183ac38\Symfony\Component\Cache\Adapter\FilesystemAdapter::class);
    $services->alias(\_PhpScoperca8ca183ac38\Symfony\Component\Cache\Adapter\TagAwareAdapterInterface::class, \_PhpScoperca8ca183ac38\Symfony\Component\Cache\Adapter\TagAwareAdapter::class);
};
