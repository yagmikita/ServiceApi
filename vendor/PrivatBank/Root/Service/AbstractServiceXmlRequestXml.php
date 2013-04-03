<?php

namespace PrivatBank\Root\Service;

use PrivatBank\Root\Error\ErrorHandlerInterface as ErrorHandlerInterface,
    PrivatBank\Root\Render\TemplaterInterface as TemplaterInterface,
    Psr\Log\LoggerInterface as LoggerInterface;

abstract class AbstractServiceXmlRequestXml extends AbstractServiceXmlRequest
{
    public function __construct(
        array $params = array(),
        ErrorHandlerInterface $errorHandler = null,
        LoggerInterface $logger = null,
        TemplaterInterface $templater = null,
        $mode = 'prod'
    )
    {
        parent::__construct($params, $errorHandler, $logger, $templater, $mode, 'content');
    }

    public function options()
    {
        return array(
            'url' => $this->services()[$this->_mode],
            'method' => 'POST',
            'request' => $this->paramsToRequest(),
        );
    }

}