<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5c006f5f032f\Symfony\Component\DependencyInjection\Loader\Configurator\Traits;

use _PhpScoper5c006f5f032f\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
trait AutoconfigureTrait
{
    /**
     * Sets whether or not instanceof conditionals should be prepended with a global set.
     *
     * @return $this
     *
     * @throws InvalidArgumentException when a parent is already set
     */
    public final function autoconfigure(bool $autoconfigured = \true) : self
    {
        $this->definition->setAutoconfigured($autoconfigured);
        return $this;
    }
}
