<?php

namespace PrivatBank\Api\Chameleon;

class SessionOpen extends AbstractChameleon
{
    private $_URI = '/sessions/open';

    public function services()
    {
        return array(
            'prod' => parent::services()['prod'] . $this->_URI,
            'dev' => parent::services()['dev'] . $this->_URI,
        );
    }

    /**
     * {{code}} => ENUM(LDAP, EXCL)
     * {{login}} => String
     * {{password}} => String
     */
    public function template()
    {
        return  static::XML_HEADER_PRIVAT .
                '<session>' .
                    '<user auth="{{code}}" login="{{login}}" password="{{password}}"/>' .
                '</session>';
    }

}