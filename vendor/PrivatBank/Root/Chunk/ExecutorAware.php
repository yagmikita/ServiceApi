<?php

namespace PrivatBank\Root\Chunk;

use PrivatBank\Root\Executor\ExecutorInterface as ExecutorInterface,
    PrivatBank\Root\Executor\ExecutorFactory as ExecutorFactory;

/**
 * ExecutorAwareInterface implementation
 */
trait ExecutorAware
{
    protected $_executor;


    /**
     * @inherit
     */
    public function setExecutor(ExecutorInterface $exec = null)
    {
        $this->_executor = is_null($exec) ? ExecutorFactory::create() : $exec;
    }

    /**
     * @return \PrivatBank\Root\ExecutorInteface
     */
    public function getExecutor()
    {
        return $this->_executor;
    }

    /**
     * Executes the request
     *
     * @param Array $prams
     * @return String | Boolean
     */
    protected function execute(array $options = array())
    {
        $this->_executor->setOptions(count($options) ? $options : $this->options());
        $this->_response = $this->_executor->execute();
        return (bool)$this->_response;
    }

}