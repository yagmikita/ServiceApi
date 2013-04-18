<?php

namespace PrivatBank\Root\Service;

use PrivatBank\Root\Error\ErrorHandlerInterface as ErrorHandlerInterface,
    PrivatBank\Root\Render\TemplaterInterface as TemplaterInterface,
    PrivatBank\Root\Helper\Converter\ConverterInterface as ConverterInterface,
    PrivatBank\Root\Helper\Converter\ArrayToXml as ArrayToXml,
    Psr\Log\LoggerInterface as LoggerInterface;

abstract class AbstractServiceXmlRequestXml extends AbstractServiceXmlRequest
{
    protected $__converter;
    protected $_initiator;

    public function __construct(
        array $params = array(),
        ErrorHandlerInterface $errorHandler = null,
        LoggerInterface $logger = null,
        TemplaterInterface $templater = null,
        ConverterInterface $converter = null,
        $mode = 'prod'
    )
    {
        $this->_converter = is_null($converter) ? new ArrayToXml : $converter;
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

    public function initiate(array $glue = array(), array $params = array())
    {
        $this->_converter->setBaseXmlHeaderParams($params);
        $this->_initiator  = count($glue) ? $this->_converter->convert($glue) : '';
    }

}