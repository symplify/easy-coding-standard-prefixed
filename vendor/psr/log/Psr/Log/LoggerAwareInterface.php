<?php

namespace _PhpScoper833c56a97273\Psr\Log;

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
    public function setLogger(\_PhpScoper833c56a97273\Psr\Log\LoggerInterface $logger);
}
