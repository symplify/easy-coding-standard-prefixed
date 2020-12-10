<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper9ef667a5e42c\Symfony\Component\Cache\Exception;

use _PhpScoper9ef667a5e42c\Psr\Cache\CacheException as Psr6CacheInterface;
use _PhpScoper9ef667a5e42c\Psr\SimpleCache\CacheException as SimpleCacheInterface;
if (\interface_exists(\_PhpScoper9ef667a5e42c\Psr\SimpleCache\CacheException::class)) {
    class CacheException extends \Exception implements \_PhpScoper9ef667a5e42c\Psr\Cache\CacheException, \_PhpScoper9ef667a5e42c\Psr\SimpleCache\CacheException
    {
    }
} else {
    class CacheException extends \Exception implements \_PhpScoper9ef667a5e42c\Psr\Cache\CacheException
    {
    }
}
