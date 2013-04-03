<?php

namespace PrivatBank\Root\Chunk;

use Psr\Log\LoggerInterface as LoggerInterface,
    Psr\Log\NullLogger as NullLogger;

trait LoggerAware
{
    /**
     * Logger entity performs log operation if needed
     * @var \PrivatBank\LoggerInterface
     */
    protected $_logger;

    /**
     * Sets the logger delegate object
     *
     * @param \Psr\Log\LoggerInterface $logger
     * @return null;
     */
    public function setLogger(LoggerInterface $logger = null)
    {
        $this->_logger = is_null($logger) ? new NullLogger() : $logger;
    }

    /**
     * Returns the current instance of logger composition
     *
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->_logger;
    }

    /**
     * @param String $message
     * @param Array $context
     * @return null;
     */
    protected function log($message, array $context = array())
    {
        $this->_logger->info($message, $context);
    }

}