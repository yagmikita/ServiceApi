<?php

namespace Psr\Log;

/**
 * Describes a logger-aware instance
 */
interface LoggerAwareInterface
{
    /**
     * Sets a logger instance on the object
     *
     * @param \Psr\Log\LoggerInterface $logger
     * @return null
     */
    public function setLogger(LoggerInterface $logger);

    /**
     * Returns the current instance of logger object
     *
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger();
}
