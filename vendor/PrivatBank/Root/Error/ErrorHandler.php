<?php

namespace PrivatBank\Root\Error;

class ErrorHandler implements ErrorHandlerInterface
{
    protected $_errors;

    public function __construct()
    {
        $this->_errors = array();
    }

    public function hasErrors()
    {
        if (count($this->_errors))
            return true;
        return false;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function __invoke()
    {
        return $this->errors();
    }

    public function add($errorMessage)
    {
        if ($this->isValidError($errorMessage))
            $this->_errors[] = $errorMessage;
    }

    protected function isValidError($errorMessage)
    {
        return strlen($errorMessage)?true:false;
    }

}
