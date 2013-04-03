<?php

namespace PrivatBank\Root\Log;

use Psr\Log\AbstractLogger as AbstractLogger,
 PrivatBank\Root\Helper\String as String;

abstract class LoggerPrototype extends AbstractLogger
{
    protected function _prepare($message, array $context = array())
    {
        return String::substitute($message, $context);
    }

}