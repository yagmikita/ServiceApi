<?php

namespace PrivatBank\Root\Error;

use PrivatBank\Root\Error\ErrorHandlerInterface as ErrorHandlerInterface;

/**
 * Describes an error-handler aware class behavior
 */
interface ErrorHandlerAwareInterface
{
    /**
     * Sets an error-handler instance on the object
     *
     * @param ErrorHandlerInterface $errorHandler
     * @return null
     */
    public function serErrorHandler(ErrorHandlerInterface $erroHandler = null);

    /**
     * Returns the current instance of the error handler
     */
    public function getErrorHandler();
}