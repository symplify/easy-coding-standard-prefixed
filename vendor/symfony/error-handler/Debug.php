<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoperdf6a0b341030\Symfony\Component\ErrorHandler;

/**
 * Registers all the debug tools.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Debug
{
    public static function enable() : \_PhpScoperdf6a0b341030\Symfony\Component\ErrorHandler\ErrorHandler
    {
        \error_reporting(-1);
        if (!\in_array(\PHP_SAPI, ['cli', 'phpdbg'], \true)) {
            \ini_set('display_errors', 0);
        } elseif (!\filter_var(\ini_get('log_errors'), \FILTER_VALIDATE_BOOLEAN) || \ini_get('error_log')) {
            // CLI - display errors only if they're not already logged to STDERR
            \ini_set('display_errors', 1);
        }
        \_PhpScoperdf6a0b341030\Symfony\Component\ErrorHandler\DebugClassLoader::enable();
        return \_PhpScoperdf6a0b341030\Symfony\Component\ErrorHandler\ErrorHandler::register(new \_PhpScoperdf6a0b341030\Symfony\Component\ErrorHandler\ErrorHandler(new \_PhpScoperdf6a0b341030\Symfony\Component\ErrorHandler\BufferingLogger()));
    }
}
