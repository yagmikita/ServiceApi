<?php

namespace PrivatBank\Root\Service;

use Psr\Log\LoggerInterface as LoggerInterface,
    PrivatBank\Root\Error\ErrorHandlerInterface as ErrorHandlerInterface,
    PrivatBank\Root\Render\TemplaterInterface as TemplaterInterface,
    PrivatBank\Root\Executor\ExecutorFactory as ExecutorFactory;

abstract class AbstractServiceXmlRequest extends AbstractService
{
    const XML_HEADER_PRIVAT = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';

    public function __construct(
        array $params = array(),
        ErrorHandlerInterface $errorHandler = null,
        LoggerInterface $logger = null,
        TemplaterInterface $templater = null,
        $mode = 'prod',
        $executorType = 'content'
    )
    {
        parent::__construct($params, $errorHandler, $logger, $templater, $mode);
        $this->setExecutor(ExecutorFactory::create($executorType));
    }

    /**
     * Performs the request and receives the response
     * with the provided set of options
     *
     * @inherit
     */
    protected function _request()
    {
        if ($this->execute($this->options()) === false) {
            $this->_errorHandler->add(static::ERROR_REQUEST_RUNTIME);
            $this->_logger->log('error', static::ERROR_REQUEST_RUNTIME);
            return false;
        }

        $this->_logger->log('success', (string)$this->_response);
        return true;
    }

    /**
     * @inherit
     * @return \SimpleXMLIterator
     * @expectedException Exception
     */
    protected function _response()
    {
        return new \SimpleXMLElement($this->_response);
    }

}