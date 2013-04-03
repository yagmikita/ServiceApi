<?php

namespace PrivatBank\Root\Executor;

/**
 * Curl wrapper class
 */
class Curl extends AbstractExecutor
{
    protected $_curl;

    public function __destruct()
    {
        curl_close($this->_curl);
    }

    /**
     * @param array $params
     * @return null;
     */
    public function setOptions(array $options)
    {
        parent::setOptions($options);
        $this->init();
    }

    /**
     * @return Boolean | String
     */
    public function execute()
    {
        $ret = curl_exec($this->_curl);
        return $ret;
    }

    /**
     * @return null;
     */
    protected function init()
    {
        $this->_curl = curl_init();
        foreach ($this->_options as $key => $value) {
            curl_setopt($this->_curl, constant("CURLOPT_{$key}"), $value);
        }
    }

}