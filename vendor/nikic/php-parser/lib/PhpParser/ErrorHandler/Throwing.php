<?php

declare (strict_types=1);
namespace _PhpScoper3b1d73f28e67\PhpParser\ErrorHandler;

use _PhpScoper3b1d73f28e67\PhpParser\Error;
use _PhpScoper3b1d73f28e67\PhpParser\ErrorHandler;
/**
 * Error handler that handles all errors by throwing them.
 *
 * This is the default strategy used by all components.
 */
class Throwing implements \_PhpScoper3b1d73f28e67\PhpParser\ErrorHandler
{
    public function handleError(\_PhpScoper3b1d73f28e67\PhpParser\Error $error)
    {
        throw $error;
    }
}
