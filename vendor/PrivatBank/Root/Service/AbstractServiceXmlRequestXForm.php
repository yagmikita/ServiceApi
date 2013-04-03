<?php

namespace PrivatBank\Root\Service;

use PrivatBank\Root\Error\ErrorHandlerInterface as ErrorHandlerInterface,
    PrivatBank\Root\Render\TemplaterInterface as TemplaterInterface,
    Psr\Log\LoggerInterface as LoggerInterface;

abstract class AbstractServiceXmlRequestXForm extends AbstractServiceXmlRequest
{
    public function __construct(
        array $params = array(),
        ErrorHandlerInterface $errorHandler = null,
        LoggerInterface $logger = null,
        TemplaterInterface $templater = null,
        $mode = 'prod'
    )
    {
        parent::__construct($params, $errorHandler, $logger, $templater, $mode, 'curl');
    }

    public function options()
    {
        return array(
            'URL' => $this->services()[$this->_mode],
            'RETURNTRANSFER' => true,
            'FOLLOWLOCATION' => false,
            'POST' => true,
            'CONNECTTIMEOUT' => 30,
            'POSTFIELDS' => $this->paramsToRequest(),
            'HTTPHEADER' => array(
                'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
                'Content-Length: ' . strlen($this->paramsToRequest())
            ),
        );
    }

}