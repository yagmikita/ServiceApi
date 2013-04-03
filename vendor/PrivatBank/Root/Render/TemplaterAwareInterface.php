<?php

namespace PrivatBank\Root\Render;

interface TemplaterAwareInterface
{
    /**
     * Response template, to be filled with params
     *
     * @return String
     */
    public function template();

    /**
     * @param PrivatBank\Root\Render\Template $template
     * @return null;
     */
    public function setTemplater(TemplaterInterface $templater);

    /**
     * @return PrivatBank\Root\Render\Template
     */
    public function getTemplater();

    /**
     * @param Array $context
     * @return null;
     */
    public function setTemplaterContext(array $context = array());
}
