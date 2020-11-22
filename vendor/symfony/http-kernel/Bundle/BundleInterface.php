<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperbc5235eb86f3\Symfony\Component\HttpKernel\Bundle;

use _PhpScoperbc5235eb86f3\Symfony\Component\DependencyInjection\ContainerAwareInterface;
use _PhpScoperbc5235eb86f3\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoperbc5235eb86f3\Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
/**
 * BundleInterface.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface BundleInterface extends \_PhpScoperbc5235eb86f3\Symfony\Component\DependencyInjection\ContainerAwareInterface
{
    /**
     * Boots the Bundle.
     */
    public function boot();
    /**
     * Shutdowns the Bundle.
     */
    public function shutdown();
    /**
     * Builds the bundle.
     *
     * It is only ever called once when the cache is empty.
     */
    public function build(\_PhpScoperbc5235eb86f3\Symfony\Component\DependencyInjection\ContainerBuilder $container);
    /**
     * Returns the container extension that should be implicitly loaded.
     *
     * @return ExtensionInterface|null The default extension or null if there is none
     */
    public function getContainerExtension();
    /**
     * Returns the bundle name (the class short name).
     *
     * @return string The Bundle name
     */
    public function getName();
    /**
     * Gets the Bundle namespace.
     *
     * @return string The Bundle namespace
     */
    public function getNamespace();
    /**
     * Gets the Bundle directory path.
     *
     * The path should always be returned as a Unix path (with /).
     *
     * @return string The Bundle absolute path
     */
    public function getPath();
}
