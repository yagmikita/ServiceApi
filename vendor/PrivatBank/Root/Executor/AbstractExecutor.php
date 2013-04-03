<?php

namespace Privatbank\Root\Executor;

use PrivatBank\Root\Executor\ExecutorInterface as ExecutorInterface;

/**
 * Curl wrapper class
 */
abstract class AbstractExecutor implements ExecutorInterface
{
    protected $_options;

    public function __construct(array $options = array())
    {
        $this->setOptions($options);
    }

    /**
     * @param array $params
     * @return null;
     */
    public function setOptions(array $options)
    {
        $this->_options = $options;
    }

    /**
     * @return Array
     */
    public function getOptions()
    {
        return $this->_options;
    }

}