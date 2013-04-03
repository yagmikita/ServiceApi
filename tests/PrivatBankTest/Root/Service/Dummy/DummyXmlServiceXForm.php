<?php

namespace PrivatBankTest\Root\Service\Dummy;

use PrivatBank\Root\Service\AbstractServiceXmlRequestXForm as AbstractServiceXmlRequestXForm;

class DummyXmlServiceXForm extends AbstractServiceXmlRequestXForm
{
    public function services()
    {
        return array(
            'prod' => 'http://pekelnakuhnya.promorc.com/privat/getamount',
            'dev' => 'http://promo.nikita.dev/service/'
        );
    }

    public function template()
    {
        return 'phone={{phone}}';
    }

}