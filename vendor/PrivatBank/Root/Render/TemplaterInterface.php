<?php

namespace PrivatBank\Root\Render;

interface TemplaterInterface extends RendererInterface
{
    /**
     * @param String $template
     * @return null
     */
    public function setTemplate($template);

    /**
     * @return String
     */
    public function getTemplate();

    /**
     * @param Array $context
     * @return null
     */
    public function setContext($context = array());

    /**
     * @return Array
     */
    public function getContext();
}