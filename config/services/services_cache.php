<?php

declare (strict_types=1);
namespace _PhpScopera22bb3f4d7b7;

use _PhpScopera22bb3f4d7b7\Psr\Cache\CacheItemPoolInterface;
use _PhpScopera22bb3f4d7b7\Psr\SimpleCache\CacheInterface;
use _PhpScopera22bb3f4d7b7\Symfony\Component\Cache\Adapter\FilesystemAdapter;
use _PhpScopera22bb3f4d7b7\Symfony\Component\Cache\Adapter\TagAwareAdapter;
use _PhpScopera22bb3f4d7b7\Symfony\Component\Cache\Adapter\TagAwareAdapterInterface;
use _PhpScopera22bb3f4d7b7\Symfony\Component\Cache\Psr16Cache;
use _PhpScopera22bb3f4d7b7\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
return static function (ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->autowire()->autoconfigure()->public();
    $services->set(Psr16Cache::class);
    $services->alias(CacheInterface::class, Psr16Cache::class);
    $services->set(FilesystemAdapter::class)->args(['$namespace' => '%cache_namespace%', '$defaultLifetime' => 0, '$directory' => '%cache_directory%']);
    $services->alias(CacheItemPoolInterface::class, FilesystemAdapter::class);
    $services->alias(TagAwareAdapterInterface::class, TagAwareAdapter::class);
};
