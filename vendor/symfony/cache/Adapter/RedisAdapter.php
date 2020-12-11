<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper1e80a2e03314\Symfony\Component\Cache\Adapter;

use _PhpScoper1e80a2e03314\Symfony\Component\Cache\Marshaller\MarshallerInterface;
use _PhpScoper1e80a2e03314\Symfony\Component\Cache\Traits\RedisTrait;
class RedisAdapter extends \_PhpScoper1e80a2e03314\Symfony\Component\Cache\Adapter\AbstractAdapter
{
    use RedisTrait;
    /**
     * @param \Redis|\RedisArray|\RedisCluster|\Predis\ClientInterface $redisClient     The redis client
     * @param string                                                   $namespace       The default namespace
     * @param int                                                      $defaultLifetime The default lifetime
     */
    public function __construct($redisClient, string $namespace = '', int $defaultLifetime = 0, \_PhpScoper1e80a2e03314\Symfony\Component\Cache\Marshaller\MarshallerInterface $marshaller = null)
    {
        $this->init($redisClient, $namespace, $defaultLifetime, $marshaller);
    }
}
