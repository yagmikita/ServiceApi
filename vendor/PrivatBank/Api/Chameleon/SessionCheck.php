<?php

namespace PrivatBank\Api\Chameleon;

use PrivatBank\Root\Service\AbstractServiceXmlRequestUrl as AbstractServiceXmlRequestUrl;

class SessionCheck extends AbstractServiceXmlRequestUrl
{
    use SetServices;

    public function template($glue = null)
    {
        return "/sessions/get/{{sid}}";
    }

    public function options()
    {
        return array_merge(parent::options(), array(
            'SSL_VERIFYPEER' => false,
            'SSL_VERIFYHOST' => false,
        ));
    }

}