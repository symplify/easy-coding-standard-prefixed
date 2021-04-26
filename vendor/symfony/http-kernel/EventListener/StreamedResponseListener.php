<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper0261263ca84f\Symfony\Component\HttpKernel\EventListener;

use _PhpScoper0261263ca84f\Symfony\Component\EventDispatcher\EventSubscriberInterface;
use _PhpScoper0261263ca84f\Symfony\Component\HttpFoundation\StreamedResponse;
use _PhpScoper0261263ca84f\Symfony\Component\HttpKernel\Event\ResponseEvent;
use _PhpScoper0261263ca84f\Symfony\Component\HttpKernel\KernelEvents;
/**
 * StreamedResponseListener is responsible for sending the Response
 * to the client.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @final
 */
class StreamedResponseListener implements EventSubscriberInterface
{
    /**
     * Filters the Response.
     */
    public function onKernelResponse(ResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }
        $response = $event->getResponse();
        if ($response instanceof StreamedResponse) {
            $response->send();
        }
    }
    public static function getSubscribedEvents() : array
    {
        return [KernelEvents::RESPONSE => ['onKernelResponse', -1024]];
    }
}
