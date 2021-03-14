<?php

namespace _PhpScopere050faf861e6\Psr\Log;

/**
 * Describes a logger-aware instance.
 */
interface LoggerAwareInterface
{
    /**
     * Sets a logger instance on the object.
     *
     * @param LoggerInterface $logger
     *
     * @return void
     */
    public function setLogger(\_PhpScopere050faf861e6\Psr\Log\LoggerInterface $logger);
}
