<?php

namespace _PhpScoper4cd05b62e9f1\Psr\Log;

/**
 * Describes a logger-aware instance
 */
interface LoggerAwareInterface
{
    /**
     * Sets a logger instance on the object
     *
     * @param LoggerInterface $logger
     * @return null
     */
    public function setLogger(\_PhpScoper4cd05b62e9f1\Psr\Log\LoggerInterface $logger);
}
