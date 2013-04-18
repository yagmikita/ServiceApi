<?php

namespace PrivatBankTest\Root\Service\Dummy;

use PrivatBank\Root\Service\AbstractServiceXmlRequestUrl as AbstractServiceXmlRequestUrl;

class DummyXmlServiceUrl extends AbstractServiceXmlRequestUrl
{
    public function services()
    {
        return array(
            'prod' => 'http://pekelnakuhnya.promorc.com/privat',
            'dev' => 'http://pekelnakuhnya.promorc.com/privat'
        );
    }

    public function template()
    {
        return '/get{{what}}';
    }

}