<?php

namespace PrivatBankTest\Api\Chameleon;

use PrivatBank\Api\Chameleon\SessionCheck as SessionCheck;

class SessionCheckTest extends \PHPUnit_Framework_TestCase
{
    protected $_className = 'PrivatBank\Root\Service\AbstractServiceXmlRequestUrl';

    public function setUp()
    {
        $this->_service = new SessionCheck;
    }

    public function tearDown()
    {
        unset($this->_service);
    }

    public function testServiceHasAProperParent()
    {
        $this->assertTrue(get_parent_class($this->_service) == $this->_className);
    }

    public function testRequestResponseIsOk()
    {
        $this->_service->setParams(array(
            'sid' => '130410CSaz0nmobvrlca',
        ));
        $this->_service->request();
        $response = $this->_service->response();
        $this->assertTrue((bool)$response);
        $this->assertTrue(get_class($response) == 'SimpleXMLElement');
    }

    /**
     * @expectedException Exception
     */
    public function testResponseIsNotAValidXml()
    {
        $stubExecutor = $this->getMock('Curl');
        $stubExecutor->expects($this->any())
                     ->method('execute')
                     ->will($this->returnValue('foo'));

        $this->_service->setExecutor($stubExecutor);

        $this->_service->request();
        $this->_service->response();
    }

}
