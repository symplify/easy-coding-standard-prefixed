<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperd8b0b9452568\Symfony\Component\HttpKernel\DataCollector;

use _PhpScoperd8b0b9452568\Symfony\Component\HttpFoundation\Request;
use _PhpScoperd8b0b9452568\Symfony\Component\HttpFoundation\Response;
/**
 * AjaxDataCollector.
 *
 * @author Bart van den Burg <bart@burgov.nl>
 *
 * @final
 */
class AjaxDataCollector extends \_PhpScoperd8b0b9452568\Symfony\Component\HttpKernel\DataCollector\DataCollector
{
    public function collect(\_PhpScoperd8b0b9452568\Symfony\Component\HttpFoundation\Request $request, \_PhpScoperd8b0b9452568\Symfony\Component\HttpFoundation\Response $response, \Throwable $exception = null)
    {
        // all collecting is done client side
    }
    public function reset()
    {
        // all collecting is done client side
    }
    public function getName()
    {
        return 'ajax';
    }
}
