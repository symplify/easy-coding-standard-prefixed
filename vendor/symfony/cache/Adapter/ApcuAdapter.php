<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper8a0112f19f39\Symfony\Component\Cache\Adapter;

use _PhpScoper8a0112f19f39\Symfony\Component\Cache\Traits\ApcuTrait;
class ApcuAdapter extends \_PhpScoper8a0112f19f39\Symfony\Component\Cache\Adapter\AbstractAdapter
{
    use ApcuTrait;
    /**
     * @throws CacheException if APCu is not enabled
     */
    public function __construct(string $namespace = '', int $defaultLifetime = 0, string $version = null)
    {
        $this->init($namespace, $defaultLifetime, $version);
    }
}
