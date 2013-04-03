<?php

namespace PrivatBank\Root\Service;

use PrivatBank\Root\Chunk\ParamsAware as ParamsAware,
    PrivatBank\Root\Chunk\ServiceMode as ServiceMode,
    PrivatBank\Root\Chunk\LoggerAware as LoggerAware,
    PrivatBank\Root\Chunk\ErrorAware as ErrorAware,
    PrivatBank\Root\Chunk\ExecutorAware as ExecutorAware,
    PrivatBank\Root\Chunk\TemplaterAware as TemplaterAware,
    PrivatBank\Root\Render\TemplaterInterface as TemplaterInterface,
    PrivatBank\Root\Error\ErrorHandlerInterface as ErrorHandlerInterface,
    Psr\Log\LoggerInterface as LoggerInterface;

abstract class AbstractService implements ServiceInterface
{
    use LoggerAware,
        ErrorAware,
        ParamsAware,
        ServiceMode,
        ExecutorAware,
        TemplaterAware;

    const ERROR_INVALID_PARAMS  = 'Invalid paramters provided';
    const ERROR_REQUEST_RUNTIME = 'Failed to perform request';
    const ERROR_REQUEST_COMPILE = 'Failed to compile request';


    /**
     * Holds the service response
     *
     * @var String
     */
    protected $_request;
    /**
     * Holds the request data
     *
     * @var String
     */
    protected $_response;


    public function __construct(
        array $params = array(),
        ErrorHandlerInterface $errorHandler = null,
        LoggerInterface $logger = null,
        TemplaterInterface $templater = null,
        $mode = 'prod'
    )
    {
        $this->serErrorHandler($errorHandler);
        $this->setMode($mode);
        $this->setLogger($logger);
        $this->setTemplater($templater);
        $this->setParams($params);
    }

    /**
     * @return Boolean
     */
    public function request()
    {
        return $this->_request();
    }

    /**
     * @return Mixed
     */
    public function response()
    {
        return $this->_response();
    }

    /**
     * Specific request call
     *
     * @return Array = ['status', 'message']
     */
    abstract protected function _request();

    /**
     * Retrieving this._response if possible
     * and in an appropriate format
     *
     * @return Object <= Object::__toString()
     */
    abstract protected function _response();

    /**
     * Contains specific options to perform request
     *
     * @return Array
     */
    abstract public function options();

    /**
     * Compiles the Request from template and params
     *
     * @return String
     */
    protected function _paramsToRequest()
    {
        $this->_templater->setTemplate($this->template());
        $this->_templater->setContext($this->getParams());
        $this->_request = $this->_templater->render();
        //var_dump($this->_request);
        return $this->_request;
    }

    /**
     * Renders params with the templeter or somehow else
     * Adviced implementation: return parent::_paramsToRequest();
     *
     * @return String
     */
    protected function paramsToRequest()
    {
        return $this->_paramsToRequest();
    }

}