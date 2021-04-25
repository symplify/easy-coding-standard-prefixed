<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5f836821822a\Symfony\Component\HttpKernel\EventListener;

use _PhpScoper5f836821822a\Symfony\Component\EventDispatcher\EventSubscriberInterface;
use _PhpScoper5f836821822a\Symfony\Component\HttpFoundation\Request;
use _PhpScoper5f836821822a\Symfony\Component\HttpFoundation\RequestStack;
use _PhpScoper5f836821822a\Symfony\Component\HttpKernel\Event\FinishRequestEvent;
use _PhpScoper5f836821822a\Symfony\Component\HttpKernel\Event\KernelEvent;
use _PhpScoper5f836821822a\Symfony\Component\HttpKernel\Event\RequestEvent;
use _PhpScoper5f836821822a\Symfony\Component\HttpKernel\KernelEvents;
use _PhpScoper5f836821822a\Symfony\Component\Routing\RequestContextAwareInterface;
/**
 * Initializes the locale based on the current request.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @final
 */
class LocaleListener implements EventSubscriberInterface
{
    private $router;
    private $defaultLocale;
    private $requestStack;
    public function __construct(RequestStack $requestStack, string $defaultLocale = 'en', RequestContextAwareInterface $router = null)
    {
        $this->defaultLocale = $defaultLocale;
        $this->requestStack = $requestStack;
        $this->router = $router;
    }
    public function setDefaultLocale(KernelEvent $event)
    {
        $event->getRequest()->setDefaultLocale($this->defaultLocale);
    }
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $this->setLocale($request);
        $this->setRouterContext($request);
    }
    public function onKernelFinishRequest(FinishRequestEvent $event)
    {
        if (null !== ($parentRequest = $this->requestStack->getParentRequest())) {
            $this->setRouterContext($parentRequest);
        }
    }
    private function setLocale(Request $request)
    {
        if ($locale = $request->attributes->get('_locale')) {
            $request->setLocale($locale);
        }
    }
    private function setRouterContext(Request $request)
    {
        if (null !== $this->router) {
            $this->router->getContext()->setParameter('_locale', $request->getLocale());
        }
    }
    public static function getSubscribedEvents() : array
    {
        return [KernelEvents::REQUEST => [
            ['setDefaultLocale', 100],
            // must be registered after the Router to have access to the _locale
            ['onKernelRequest', 16],
        ], KernelEvents::FINISH_REQUEST => [['onKernelFinishRequest', 0]]];
    }
}
