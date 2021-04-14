<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperd8b0b9452568\Symfony\Component\DependencyInjection\Config;

use _PhpScoperd8b0b9452568\Symfony\Component\Config\Resource\ResourceInterface;
/**
 * Tracks container parameters.
 *
 * @author Maxime Steinhausser <maxime.steinhausser@gmail.com>
 *
 * @final
 */
class ContainerParametersResource implements \_PhpScoperd8b0b9452568\Symfony\Component\Config\Resource\ResourceInterface
{
    private $parameters;
    /**
     * @param array $parameters The container parameters to track
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }
    /**
     * {@inheritdoc}
     */
    public function __toString() : string
    {
        return 'container_parameters_' . \md5(\serialize($this->parameters));
    }
    /**
     * @return array Tracked parameters
     */
    public function getParameters() : array
    {
        return $this->parameters;
    }
}
