<?php

namespace PrivatBank\Root\Chunk;

use PrivatBank\Root\Render\TemplaterInterface as TemplaterInterface,
    PrivatBank\Root\Render\Templater as Templater;

trait TemplaterAware
{
    protected $_templater;


    /**
     * Response template, to be filled with params
     *
     * @return String
     */
    abstract public function template();

    /**
     * @param PrivatBank\Root\Render\Template $template
     * @return null;
     */
    public function setTemplater(TemplaterInterface $templater = null)
    {
        $this->_templater = is_null($templater) ? new Templater : $templater;
    }

    /**
     * @return PrivatBank\Root\Render\Template
     */
    public function getTemplater()
    {
        return $this->_templater;
    }

    /**
     * @param Array $context
     * @return null;
     */
    public function setTemplaterContext(array $context = array())
    {
        $this->_templater->setContext($context);
    }

}