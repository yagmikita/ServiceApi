<?php

namespace PrivatBank\Root\Service;

use PrivatBank\Root\Error\ErrorHandlerInterface as ErrorHandlerInterface,
    PrivatBank\Root\Render\TemplaterInterface as TemplaterInterface,
    Psr\Log\LoggerInterface as LoggerInterface;

abstract class AbstractServiceXmlRequestUrl extends AbstractServiceXmlRequest
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
            'URL' => $this->services()[$this->_mode] . $this->paramsToRequest(),
            'RETURNTRANSFER' => true,
            'FOLLOWLOCATION' => false,
            'POST' => false,
            'CUSTOMREQUEST' => 'GET',
            'HTTPGET' => true,
            'CONNECTTIMEOUT' => 30,
            'HTTPHEADER' => array(
                'Content-Type: application/x-www-form-urlencoded;charset=UTF-8'
            ),
        );
    }

}