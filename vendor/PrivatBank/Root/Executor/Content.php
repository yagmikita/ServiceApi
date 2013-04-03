<?php

namespace PrivatBank\Root\Executor;

/**
 * File_get_contents wrapper class
 */
class Content extends AbstractExecutor
{
    /**
     * @return Boolean | String
     */
    public function execute()
    {
        $url = $this->_options['url'];
        return @file_get_contents($url, false, $this->getContext());
    }

    protected function trim($str)
    {
        return preg_replace("~\r|\n~", '', preg_replace('~>\s+<~', '><', $str));
    }

    protected function getContext()
    {
        return stream_context_create(array(
            'http' => array(
                'method' => $this->_options['method'],
                'header' => 'Content-Type: text/xml;charset=UTF-8' . PHP_EOL,
                'content' => $this->trim($this->_options['request']),
            ),
        ));
    }

}