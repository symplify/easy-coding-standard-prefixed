<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperb730595bc9f4\Symfony\Component\Cache\Adapter;

use _PhpScoperb730595bc9f4\Symfony\Component\Cache\Marshaller\DefaultMarshaller;
use _PhpScoperb730595bc9f4\Symfony\Component\Cache\Marshaller\MarshallerInterface;
use _PhpScoperb730595bc9f4\Symfony\Component\Cache\PruneableInterface;
use _PhpScoperb730595bc9f4\Symfony\Component\Cache\Traits\FilesystemTrait;
class FilesystemAdapter extends \_PhpScoperb730595bc9f4\Symfony\Component\Cache\Adapter\AbstractAdapter implements \_PhpScoperb730595bc9f4\Symfony\Component\Cache\PruneableInterface
{
    use FilesystemTrait;
    public function __construct(string $namespace = '', int $defaultLifetime = 0, string $directory = null, \_PhpScoperb730595bc9f4\Symfony\Component\Cache\Marshaller\MarshallerInterface $marshaller = null)
    {
        $this->marshaller = $marshaller ?? new \_PhpScoperb730595bc9f4\Symfony\Component\Cache\Marshaller\DefaultMarshaller();
        parent::__construct('', $defaultLifetime);
        $this->init($namespace, $directory);
    }
}
