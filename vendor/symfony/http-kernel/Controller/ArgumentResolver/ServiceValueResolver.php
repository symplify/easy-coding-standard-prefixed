<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper1103e00fb46b\Symfony\Component\HttpKernel\Controller\ArgumentResolver;

use _PhpScoper1103e00fb46b\Psr\Container\ContainerInterface;
use _PhpScoper1103e00fb46b\Symfony\Component\DependencyInjection\Exception\RuntimeException;
use _PhpScoper1103e00fb46b\Symfony\Component\HttpFoundation\Request;
use _PhpScoper1103e00fb46b\Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use _PhpScoper1103e00fb46b\Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
/**
 * Yields a service keyed by _controller and argument name.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
final class ServiceValueResolver implements \_PhpScoper1103e00fb46b\Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface
{
    private $container;
    public function __construct(\_PhpScoper1103e00fb46b\Psr\Container\ContainerInterface $container)
    {
        $this->container = $container;
    }
    /**
     * {@inheritdoc}
     */
    public function supports(\_PhpScoper1103e00fb46b\Symfony\Component\HttpFoundation\Request $request, \_PhpScoper1103e00fb46b\Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata $argument) : bool
    {
        $controller = $request->attributes->get('_controller');
        if (\is_array($controller) && \is_callable($controller, \true) && \is_string($controller[0])) {
            $controller = $controller[0] . '::' . $controller[1];
        } elseif (!\is_string($controller) || '' === $controller) {
            return \false;
        }
        if ('\\' === $controller[0]) {
            $controller = \ltrim($controller, '\\');
        }
        if (!$this->container->has($controller) && \false !== ($i = \strrpos($controller, ':'))) {
            $controller = \substr($controller, 0, $i) . \strtolower(\substr($controller, $i));
        }
        return $this->container->has($controller) && $this->container->get($controller)->has($argument->getName());
    }
    /**
     * {@inheritdoc}
     */
    public function resolve(\_PhpScoper1103e00fb46b\Symfony\Component\HttpFoundation\Request $request, \_PhpScoper1103e00fb46b\Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata $argument) : iterable
    {
        if (\is_array($controller = $request->attributes->get('_controller'))) {
            $controller = $controller[0] . '::' . $controller[1];
        }
        if ('\\' === $controller[0]) {
            $controller = \ltrim($controller, '\\');
        }
        if (!$this->container->has($controller)) {
            $i = \strrpos($controller, ':');
            $controller = \substr($controller, 0, $i) . \strtolower(\substr($controller, $i));
        }
        try {
            (yield $this->container->get($controller)->get($argument->getName()));
        } catch (\_PhpScoper1103e00fb46b\Symfony\Component\DependencyInjection\Exception\RuntimeException $e) {
            $what = \sprintf('argument $%s of "%s()"', $argument->getName(), $controller);
            $message = \preg_replace('/service "\\.service_locator\\.[^"]++"/', $what, $e->getMessage());
            if ($e->getMessage() === $message) {
                $message = \sprintf('Cannot resolve %s: %s', $what, $message);
            }
            $r = new \ReflectionProperty($e, 'message');
            $r->setAccessible(\true);
            $r->setValue($e, $message);
            throw $e;
        }
    }
}
