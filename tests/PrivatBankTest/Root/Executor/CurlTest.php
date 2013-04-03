<?php

namespace PrivatBankTest\Root\Executor;

use PrivatBank\Root\Executor\Curl as Curl;

class CurlTest extends \PHPUnit_Framework_TestCase
{
    protected $_options = array(
        'URL' => 'http://pekelnakuhnya.promorc.com/privat/getamount',
        'RETURNTRANSFER' => true,
        'FOLLOWLOCATION' => false,
        'POST' => true,
        'CONNECTTIMEOUT' => 30,
        'POSTFIELDS' => 'phone=380957700418',
        'HTTPHEADER' => array(
            'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
            'Content-Length: 18'
        ),
    );
    protected $_curl;

    public function setUp()
    {
        $this->_curl = new Curl;
    }

    public function tearDown()
    {
        unset($this->_curl);
    }

    public function testCurlIsCreatedSuccessfully()
    {
        $this->assertTrue(get_class($this->_curl) == 'PrivatBank\Root\Executor\Curl');
    }

    public function testCurlExecutesSuccessfullyWithConstructInit()
    {
        $curl = new Curl($this->_options);
        $result = $curl->execute();
        $this->assertTrue(is_string($result));
        $this->assertTrue(strlen($result)>0);
    }

    public function testCurlExecutesSuccessfullyWithSetterInit()
    {
        $curl = new Curl();
        $curl->setOptions($this->_options);
        $result = $curl->execute();
        $this->assertTrue(is_string($result));
        $this->assertTrue(strlen($result)>0);
    }

    public function testCurlFailsExecutionWithoutInit()
    {
        $this->assertFalse($this->_curl->execute());
    }

}