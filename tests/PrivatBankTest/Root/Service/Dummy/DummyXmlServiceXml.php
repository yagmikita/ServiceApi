<?php

namespace PrivatBankTest\Root\Service\Dummy;

use PrivatBank\Root\Service\AbstractServiceXmlRequestXml as AbstractServiceXmlRequestXml;

class DummyXmlServiceXml extends AbstractServiceXmlRequestXml
{
    public function services()
    {
        return array(
            'prod' => 'https://promin.privatbank.ua:8072/ChameleonServer/sessions/open',
            'dev' => 'https://10.1.108.22:8072/ChameleonServer/sessions/open',
        );
    }


    public function template()
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
               '<session>' .
               '<user auth="EXCL" login="{{login}}" password="{{password}}"/> '.
               '</session>';
    }

}