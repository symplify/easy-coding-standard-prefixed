<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper589e8c04a9ef\Symfony\Component\HttpKernel\Controller;

use _PhpScoper589e8c04a9ef\Symfony\Component\HttpFoundation\Request;
use _PhpScoper589e8c04a9ef\Symfony\Component\Stopwatch\Stopwatch;
/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class TraceableControllerResolver implements \_PhpScoper589e8c04a9ef\Symfony\Component\HttpKernel\Controller\ControllerResolverInterface
{
    private $resolver;
    private $stopwatch;
    public function __construct(\_PhpScoper589e8c04a9ef\Symfony\Component\HttpKernel\Controller\ControllerResolverInterface $resolver, \_PhpScoper589e8c04a9ef\Symfony\Component\Stopwatch\Stopwatch $stopwatch)
    {
        $this->resolver = $resolver;
        $this->stopwatch = $stopwatch;
    }
    /**
     * {@inheritdoc}
     */
    public function getController(\_PhpScoper589e8c04a9ef\Symfony\Component\HttpFoundation\Request $request)
    {
        $e = $this->stopwatch->start('controller.get_callable');
        $ret = $this->resolver->getController($request);
        $e->stop();
        return $ret;
    }
}
