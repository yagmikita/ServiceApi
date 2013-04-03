<?php

namespace PrivatBank\Root\Log;

class EchoLogger extends LoggerPrototype
{
    public function log($level, $message, array $context = array())
    {
        print_r(array(
            $level => $this->_prepare($message, $context),
        ));
    }

}