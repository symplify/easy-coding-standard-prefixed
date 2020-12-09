<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperf65af7a6d9a0\Symfony\Component\Cache\Simple;

use _PhpScoperf65af7a6d9a0\Symfony\Component\Cache\Adapter\FilesystemAdapter;
use _PhpScoperf65af7a6d9a0\Symfony\Component\Cache\Marshaller\DefaultMarshaller;
use _PhpScoperf65af7a6d9a0\Symfony\Component\Cache\Marshaller\MarshallerInterface;
use _PhpScoperf65af7a6d9a0\Symfony\Component\Cache\PruneableInterface;
use _PhpScoperf65af7a6d9a0\Symfony\Component\Cache\Traits\FilesystemTrait;
use _PhpScoperf65af7a6d9a0\Symfony\Contracts\Cache\CacheInterface;
@\trigger_error(\sprintf('The "%s" class is deprecated since Symfony 4.3, use "%s" and type-hint for "%s" instead.', \_PhpScoperf65af7a6d9a0\Symfony\Component\Cache\Simple\FilesystemCache::class, \_PhpScoperf65af7a6d9a0\Symfony\Component\Cache\Adapter\FilesystemAdapter::class, \_PhpScoperf65af7a6d9a0\Symfony\Contracts\Cache\CacheInterface::class), \E_USER_DEPRECATED);
/**
 * @deprecated since Symfony 4.3, use FilesystemAdapter and type-hint for CacheInterface instead.
 */
class FilesystemCache extends \_PhpScoperf65af7a6d9a0\Symfony\Component\Cache\Simple\AbstractCache implements \_PhpScoperf65af7a6d9a0\Symfony\Component\Cache\PruneableInterface
{
    use FilesystemTrait;
    public function __construct(string $namespace = '', int $defaultLifetime = 0, string $directory = null, \_PhpScoperf65af7a6d9a0\Symfony\Component\Cache\Marshaller\MarshallerInterface $marshaller = null)
    {
        $this->marshaller = $marshaller ?? new \_PhpScoperf65af7a6d9a0\Symfony\Component\Cache\Marshaller\DefaultMarshaller();
        parent::__construct('', $defaultLifetime);
        $this->init($namespace, $directory);
    }
}
