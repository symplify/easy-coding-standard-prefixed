<?php

declare (strict_types=1);
namespace _PhpScoper4cd05b62e9f1\PhpParser\ErrorHandler;

use _PhpScoper4cd05b62e9f1\PhpParser\Error;
use _PhpScoper4cd05b62e9f1\PhpParser\ErrorHandler;
/**
 * Error handler that handles all errors by throwing them.
 *
 * This is the default strategy used by all components.
 */
class Throwing implements \_PhpScoper4cd05b62e9f1\PhpParser\ErrorHandler
{
    public function handleError(\_PhpScoper4cd05b62e9f1\PhpParser\Error $error)
    {
        throw $error;
    }
}
