<?php

namespace _PhpScoperc233426b15e0\Psr\Log;

/**
 * Basic Implementation of LoggerAwareInterface.
 */
trait LoggerAwareTrait
{
    /** @var LoggerInterface */
    protected $logger;
    /**
     * Sets a logger.
     * 
     * @param LoggerInterface $logger
     */
    public function setLogger(\_PhpScoperc233426b15e0\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
