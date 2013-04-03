<?php

namespace PrivatBank\Root\Chunk;

trait ServiceMode
{
    /**
     * Service mode, defines, whether to use development
     * or production settings
     * @var Enum('prod', 'dev')
     */
    protected $_mode;

    /**
     *
     *
     * @return Array :: filterAssoc(["prod", "dev"])
     */
    abstract public function services();

    /**
     * @param String :: filterEnum(['dev', 'prod'])
     * @return null
     */
    public function setMode($mode = 'dev')
    {
        $modes = array_keys($this->services());
        $this->_mode = in_array($mode, $modes) ? $mode : 'dev';
    }

    /**
     * @return String :: filterEnum(['dev', 'prod'])
     */
    public function getMode()
    {
        return $this->_mode;
    }

    /**
     * @return String :: filterURL();
     */
    public function service()
    {
        return $this->services()[$this->_mode];
    }

}