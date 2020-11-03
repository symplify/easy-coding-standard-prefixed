<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper8de082cbb8c7\Symfony\Component\Cache\Simple;

use _PhpScoper8de082cbb8c7\Doctrine\Common\Cache\CacheProvider;
use _PhpScoper8de082cbb8c7\Symfony\Component\Cache\Adapter\DoctrineAdapter;
use _PhpScoper8de082cbb8c7\Symfony\Component\Cache\Traits\DoctrineTrait;
use _PhpScoper8de082cbb8c7\Symfony\Contracts\Cache\CacheInterface;
@\trigger_error(\sprintf('The "%s" class is deprecated since Symfony 4.3, use "%s" and type-hint for "%s" instead.', \_PhpScoper8de082cbb8c7\Symfony\Component\Cache\Simple\DoctrineCache::class, \_PhpScoper8de082cbb8c7\Symfony\Component\Cache\Adapter\DoctrineAdapter::class, \_PhpScoper8de082cbb8c7\Symfony\Contracts\Cache\CacheInterface::class), \E_USER_DEPRECATED);
/**
 * @deprecated since Symfony 4.3, use DoctrineAdapter and type-hint for CacheInterface instead.
 */
class DoctrineCache extends \_PhpScoper8de082cbb8c7\Symfony\Component\Cache\Simple\AbstractCache
{
    use DoctrineTrait;
    public function __construct(\_PhpScoper8de082cbb8c7\Doctrine\Common\Cache\CacheProvider $provider, string $namespace = '', int $defaultLifetime = 0)
    {
        parent::__construct('', $defaultLifetime);
        $this->provider = $provider;
        $provider->setNamespace($namespace);
    }
}