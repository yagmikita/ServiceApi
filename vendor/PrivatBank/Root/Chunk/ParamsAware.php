<?php

namespace PrivatBank\Root\Chunk;

trait ParamsAware
{
    /**
     * Params, needed to compile request-template
     *
     * @var Array
     */
    protected $_params;

    public function setParams(array $params = array())
    {
        $this->_params = $params;
    }

    /**
     * @return Array
     */
    public function getParams()
    {
        return $this->_params;
    }

}