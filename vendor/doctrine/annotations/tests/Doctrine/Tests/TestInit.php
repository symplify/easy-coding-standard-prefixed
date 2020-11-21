<?php

/*
 * This file bootstraps the test environment.
 */
namespace _PhpScoper224ae0b86670\Doctrine\Tests;

\error_reporting(\E_ALL | \E_STRICT);
// register silently failing autoloader
\spl_autoload_register(function ($class) {
    if (0 === \strpos($class, 'Doctrine\\Tests\\')) {
        $path = __DIR__ . '/../../' . \strtr($class, '\\', '/') . '.php';
        if (\is_file($path) && \is_readable($path)) {
            require_once $path;
            return \true;
        }
    }
});
require_once __DIR__ . "/../../../vendor/autoload.php";
\_PhpScoper224ae0b86670\Doctrine\Common\Annotations\AnnotationRegistry::registerAutoloadNamespace('_PhpScoper224ae0b86670\\Doctrine\\Tests\\Common\\Annotations\\Fixtures', __DIR__ . '/../../');
