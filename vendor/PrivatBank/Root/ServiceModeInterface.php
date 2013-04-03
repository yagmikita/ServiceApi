<?php

namespace PrivatBank\Root;

/**
 * Describes production and development modes of the class it's applied to
 */
interface ServiceModeInterface
{
    /**
     * Sets the working mode for an Object
     *
     * @param Enum['prod', 'dev'] $mode
     * @return null
     */
    public function setMode($mode = 'dev');

    /**
     * Gets the current working mode
     *
     * @return Enum['prod', 'dev']
     */
    public function getMode();

    /**
     * The list of available services
     *
     * @type Array {"prod": "", "dev": ""}
     */
    public function services();

    /**
     * Retrieves the current working URL string
     *
     * @return String
     */
    public function service();
}