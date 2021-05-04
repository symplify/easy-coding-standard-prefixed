<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperc2b2a9bb0e13\Symfony\Component\Cache\Adapter;

use _PhpScoperc2b2a9bb0e13\Psr\SimpleCache\CacheInterface;
use _PhpScoperc2b2a9bb0e13\Symfony\Component\Cache\PruneableInterface;
use _PhpScoperc2b2a9bb0e13\Symfony\Component\Cache\ResettableInterface;
use _PhpScoperc2b2a9bb0e13\Symfony\Component\Cache\Traits\ProxyTrait;
/**
 * Turns a PSR-16 cache into a PSR-6 one.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class Psr16Adapter extends \_PhpScoperc2b2a9bb0e13\Symfony\Component\Cache\Adapter\AbstractAdapter implements PruneableInterface, ResettableInterface
{
    /**
     * @internal
     */
    protected const NS_SEPARATOR = '_';
    use ProxyTrait;
    private $miss;
    public function __construct(CacheInterface $pool, string $namespace = '', int $defaultLifetime = 0)
    {
        parent::__construct($namespace, $defaultLifetime);
        $this->pool = $pool;
        $this->miss = new \stdClass();
    }
    /**
     * {@inheritdoc}
     */
    protected function doFetch(array $ids)
    {
        foreach ($this->pool->getMultiple($ids, $this->miss) as $key => $value) {
            if ($this->miss !== $value) {
                (yield $key => $value);
            }
        }
    }
    /**
     * {@inheritdoc}
     */
    protected function doHave(string $id)
    {
        return $this->pool->has($id);
    }
    /**
     * {@inheritdoc}
     */
    protected function doClear(string $namespace)
    {
        return $this->pool->clear();
    }
    /**
     * {@inheritdoc}
     */
    protected function doDelete(array $ids)
    {
        return $this->pool->deleteMultiple($ids);
    }
    /**
     * {@inheritdoc}
     */
    protected function doSave(array $values, int $lifetime)
    {
        return $this->pool->setMultiple($values, 0 === $lifetime ? null : $lifetime);
    }
}
