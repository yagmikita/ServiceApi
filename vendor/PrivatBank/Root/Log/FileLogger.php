<?php

namespace PrivatBank\Root\Log;

use Psr\Log\InvalidArgumentException as InvalidArgumentException;

class FileLogger extends LoggerPrototype
{
    protected $_filename;

    public function __construct($filename)
    {
        if (strlen($filename))
            $this->_filename = $filename;
        else
            throw new InvalidArgumentException();
    }

    public function log($level, $message, array $context = array())
    {
        file_put_contents(
            $this->_filename,
            var_export(array(
                $level => $this->_prepare($message, $context),
            ), true) . "\n\n",
            FILE_APPEND
        );
    }

}