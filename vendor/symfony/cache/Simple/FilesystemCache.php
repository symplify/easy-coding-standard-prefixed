<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperc233426b15e0\Symfony\Component\Cache\Simple;

use _PhpScoperc233426b15e0\Symfony\Component\Cache\Adapter\FilesystemAdapter;
use _PhpScoperc233426b15e0\Symfony\Component\Cache\Marshaller\DefaultMarshaller;
use _PhpScoperc233426b15e0\Symfony\Component\Cache\Marshaller\MarshallerInterface;
use _PhpScoperc233426b15e0\Symfony\Component\Cache\PruneableInterface;
use _PhpScoperc233426b15e0\Symfony\Component\Cache\Traits\FilesystemTrait;
use _PhpScoperc233426b15e0\Symfony\Contracts\Cache\CacheInterface;
@\trigger_error(\sprintf('The "%s" class is deprecated since Symfony 4.3, use "%s" and type-hint for "%s" instead.', \_PhpScoperc233426b15e0\Symfony\Component\Cache\Simple\FilesystemCache::class, \_PhpScoperc233426b15e0\Symfony\Component\Cache\Adapter\FilesystemAdapter::class, \_PhpScoperc233426b15e0\Symfony\Contracts\Cache\CacheInterface::class), \E_USER_DEPRECATED);
/**
 * @deprecated since Symfony 4.3, use FilesystemAdapter and type-hint for CacheInterface instead.
 */
class FilesystemCache extends \_PhpScoperc233426b15e0\Symfony\Component\Cache\Simple\AbstractCache implements \_PhpScoperc233426b15e0\Symfony\Component\Cache\PruneableInterface
{
    use FilesystemTrait;
    public function __construct(string $namespace = '', int $defaultLifetime = 0, string $directory = null, \_PhpScoperc233426b15e0\Symfony\Component\Cache\Marshaller\MarshallerInterface $marshaller = null)
    {
        $this->marshaller = $marshaller ?? new \_PhpScoperc233426b15e0\Symfony\Component\Cache\Marshaller\DefaultMarshaller();
        parent::__construct('', $defaultLifetime);
        $this->init($namespace, $directory);
    }
}
