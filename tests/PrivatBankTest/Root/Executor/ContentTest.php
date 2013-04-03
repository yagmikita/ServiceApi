<?php

namespace PrivatBankTest\Root\Executor;

use PrivatBank\Root\Executor\Content as Content;

class ContentTest extends \PHPUnit_Framework_TestCase
{
    protected $_executor;

    public function setUp()
    {
        $this->_executor = new Content;
    }

    public function tearDown()
    {
        unset($this->_executor);
    }

    public function goodOptions()
    {
        return array(
            array(
                'http://privatbank.ua/',
                'POST',
                array()
            ),
            array(
                'https://10.1.108.22:8072/ChameleonServer/sessions/open',
                'POST',
                '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
                '<session>' .
                '<user auth="LDAP" login="dn101186gnv2" password="" />' .
                '</session>',
            ),
            array(
                'https://10.1.108.22:8072/ChameleonServer/sessions/open',
                'POST',
                '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
                '<session>' .
                '<user auth="EXCL" login="uniorpbua" password="er61%Di5" />' .
                '</session>',
            ),
        );
    }

    public function badOptions()
    {
        return array(
            array(
                'https://10.1.108.22:8072/ChameleonServer/sessions/open',
                'GET',
                '',
            ),
            array(
                'https://10.1.108.229:8071/ChameleonServer/sessions/open',
                'POST',
                'q=test',
            ),
        );
    }

    /**
     * @dataProvider goodOptions
     */
    public function testContentExecutorWorksFine($url, $method, $request)
    {
        $this->_executor->setOptions(array(
            'method' => $method,
            'request' => $request,
            'url' => $url
        ));
        $res = $this->_executor->execute();
        $this->assertTrue(count($res)>0);
    }

    /**
     * @dataProvider badOptions
     */
    public function testContentExecutorFails($url, $method, $request)
    {
        $this->_executor->setOptions(array(
            'method' => $method,
            'request' => $request,
            'url' => $url
        ));
        $this->assertFalse($this->_executor->execute());
    }

}