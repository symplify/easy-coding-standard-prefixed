<?php

declare (strict_types=1);
namespace _PhpScopera189153e1f79\PhpParser;

interface ErrorHandler
{
    /**
     * Handle an error generated during lexing, parsing or some other operation.
     *
     * @param Error $error The error that needs to be handled
     */
    public function handleError(\_PhpScopera189153e1f79\PhpParser\Error $error);
}
