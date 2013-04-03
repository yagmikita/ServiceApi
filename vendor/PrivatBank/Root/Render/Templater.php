<?php

namespace PrivatBank\Root\Render;

use PrivatBank\Root\Helper\String as String;

class Templater implements TemplaterInterface
{
    protected $_template;
    protected $_context;

    public function __construct($template = null, $context = null)
    {
        $this->setContext($context);
        $this->setTemplate($template);
    }

    public function setTemplate($template)
    {
        $this->_template = is_string($template) || is_array($template) ? $template : "";
    }

    public function getTemplate()
    {
        return $this->_template;
    }

    public function setContext($context = array())
    {
        $this->_context = is_array($context) ? $context : array();
    }

    public function getContext()
    {
        return $this->_context;
    }

    public function render($justReturn = true)
    {
        $prepared = $this->_prepareTemplate();
        if (!$justReturn)
            echo $prepared;
        return $prepared;
    }

    protected function _prepareTemplate()
    {
        if (is_string($this->_template) && count($this->_context))
            return String::substitute($this->_template, $this->_context);
        if (is_string($this->_template) && !count($this->_context))
            return $this->_template;
        elseif (is_array($this->_template))
            return String::urlConcatContext($this->_template);
        else
            return "";
    }

}