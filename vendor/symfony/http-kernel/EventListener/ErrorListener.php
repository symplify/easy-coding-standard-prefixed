<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScopera1a51450b61d\Symfony\Component\HttpKernel\EventListener;

use _PhpScopera1a51450b61d\Psr\Log\LoggerInterface;
use _PhpScopera1a51450b61d\Symfony\Component\ErrorHandler\Exception\FlattenException;
use _PhpScopera1a51450b61d\Symfony\Component\EventDispatcher\EventDispatcherInterface;
use _PhpScopera1a51450b61d\Symfony\Component\EventDispatcher\EventSubscriberInterface;
use _PhpScopera1a51450b61d\Symfony\Component\HttpFoundation\Request;
use _PhpScopera1a51450b61d\Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use _PhpScopera1a51450b61d\Symfony\Component\HttpKernel\Event\ExceptionEvent;
use _PhpScopera1a51450b61d\Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use _PhpScopera1a51450b61d\Symfony\Component\HttpKernel\HttpKernelInterface;
use _PhpScopera1a51450b61d\Symfony\Component\HttpKernel\KernelEvents;
use _PhpScopera1a51450b61d\Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ErrorListener implements \_PhpScopera1a51450b61d\Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    protected $controller;
    protected $logger;
    protected $debug;
    public function __construct($controller, \_PhpScopera1a51450b61d\Psr\Log\LoggerInterface $logger = null, $debug = \false)
    {
        $this->controller = $controller;
        $this->logger = $logger;
        $this->debug = $debug;
    }
    public function logKernelException(\_PhpScopera1a51450b61d\Symfony\Component\HttpKernel\Event\ExceptionEvent $event)
    {
        $e = \_PhpScopera1a51450b61d\Symfony\Component\ErrorHandler\Exception\FlattenException::createFromThrowable($event->getThrowable());
        $this->logException($event->getThrowable(), \sprintf('Uncaught PHP Exception %s: "%s" at %s line %s', $e->getClass(), $e->getMessage(), $e->getFile(), $e->getLine()));
    }
    public function onKernelException(\_PhpScopera1a51450b61d\Symfony\Component\HttpKernel\Event\ExceptionEvent $event, string $eventName = null, \_PhpScopera1a51450b61d\Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher = null)
    {
        if (null === $this->controller) {
            return;
        }
        $exception = $event->getThrowable();
        $request = $this->duplicateRequest($exception, $event->getRequest());
        try {
            $response = $event->getKernel()->handle($request, \_PhpScopera1a51450b61d\Symfony\Component\HttpKernel\HttpKernelInterface::SUB_REQUEST, \false);
        } catch (\Exception $e) {
            $f = \_PhpScopera1a51450b61d\Symfony\Component\ErrorHandler\Exception\FlattenException::createFromThrowable($e);
            $this->logException($e, \sprintf('Exception thrown when handling an exception (%s: %s at %s line %s)', $f->getClass(), $f->getMessage(), $e->getFile(), $e->getLine()));
            $prev = $e;
            do {
                if ($exception === ($wrapper = $prev)) {
                    throw $e;
                }
            } while ($prev = $wrapper->getPrevious());
            $prev = new \ReflectionProperty($wrapper instanceof \Exception ? \Exception::class : \Error::class, 'previous');
            $prev->setAccessible(\true);
            $prev->setValue($wrapper, $exception);
            throw $e;
        }
        $event->setResponse($response);
        if ($this->debug && $eventDispatcher instanceof \_PhpScopera1a51450b61d\Symfony\Component\EventDispatcher\EventDispatcherInterface) {
            $cspRemovalListener = function ($event) use(&$cspRemovalListener, $eventDispatcher) {
                $event->getResponse()->headers->remove('Content-Security-Policy');
                $eventDispatcher->removeListener(\_PhpScopera1a51450b61d\Symfony\Component\HttpKernel\KernelEvents::RESPONSE, $cspRemovalListener);
            };
            $eventDispatcher->addListener(\_PhpScopera1a51450b61d\Symfony\Component\HttpKernel\KernelEvents::RESPONSE, $cspRemovalListener, -128);
        }
    }
    public function onControllerArguments(\_PhpScopera1a51450b61d\Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent $event)
    {
        $e = $event->getRequest()->attributes->get('exception');
        if (!$e instanceof \Throwable || \false === ($k = \array_search($e, $event->getArguments(), \true))) {
            return;
        }
        $r = new \ReflectionFunction(\Closure::fromCallable($event->getController()));
        $r = $r->getParameters()[$k] ?? null;
        if ($r && (!$r->hasType() || \_PhpScopera1a51450b61d\Symfony\Component\ErrorHandler\Exception\FlattenException::class === $r->getType()->getName())) {
            $arguments = $event->getArguments();
            $arguments[$k] = \_PhpScopera1a51450b61d\Symfony\Component\ErrorHandler\Exception\FlattenException::createFromThrowable($e);
            $event->setArguments($arguments);
        }
    }
    public static function getSubscribedEvents() : array
    {
        return [\_PhpScopera1a51450b61d\Symfony\Component\HttpKernel\KernelEvents::CONTROLLER_ARGUMENTS => 'onControllerArguments', \_PhpScopera1a51450b61d\Symfony\Component\HttpKernel\KernelEvents::EXCEPTION => [['logKernelException', 0], ['onKernelException', -128]]];
    }
    /**
     * Logs an exception.
     */
    protected function logException(\Throwable $exception, string $message) : void
    {
        if (null !== $this->logger) {
            if (!$exception instanceof \_PhpScopera1a51450b61d\Symfony\Component\HttpKernel\Exception\HttpExceptionInterface || $exception->getStatusCode() >= 500) {
                $this->logger->critical($message, ['exception' => $exception]);
            } else {
                $this->logger->error($message, ['exception' => $exception]);
            }
        }
    }
    /**
     * Clones the request for the exception.
     */
    protected function duplicateRequest(\Throwable $exception, \_PhpScopera1a51450b61d\Symfony\Component\HttpFoundation\Request $request) : \_PhpScopera1a51450b61d\Symfony\Component\HttpFoundation\Request
    {
        $attributes = ['_controller' => $this->controller, 'exception' => $exception, 'logger' => $this->logger instanceof \_PhpScopera1a51450b61d\Symfony\Component\HttpKernel\Log\DebugLoggerInterface ? $this->logger : null];
        $request = $request->duplicate(null, null, $attributes);
        $request->setMethod('GET');
        return $request;
    }
}
