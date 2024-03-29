<?php

namespace PrivatBankTest\Root\Service;

use PrivatBank\Root\Error\ErrorHandler as ErrorHandler,
    PrivatBank\Root\Render\Templater as Templater,
    PrivatBank\Root\Log\FileLogger as FileLogger,
    Privatbank\Root\Executor\Curl as Curl,
    PrivatBankTest\Root\Service\Dummy\DummyXmlServiceUrl as DummyXmlServiceUrl;

class AbstractServiceXmlRequestUrlTest extends \PHPUnit_Framework_TestCase
{
    protected $_service;
    protected $_className = 'PrivatBank\Root\Service\AbstractServiceXmlRequestUrl';
    protected $_options;

    /**
     * Interface methods for testing:
     *  - request
     *  - response
     */

    public function setUp()
    {
        $this->_service = new DummyXmlServiceUrl(
            $this->_options()['params'],
            $this->_options()['errorHandler'],
            $this->_options()['logger'],
            $this->_options()['templater'],
            $this->_options()['mode']
        );
    }

    public function tearDown()
    {
        unset($this->_service);
        unset($this->_options);
    }

    public function testServiceHasAProperParent()
    {
        $this->assertTrue(get_parent_class($this->_service) == $this->_className);
    }

    public function testRequestResponseIsOk()
    {
        $this->_service->setParams(array(
            'what' => 'Amount',
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


    protected function _filename()
    {
        return __DIR__ . '/../_meta/testLog.log';
    }

    protected function _options()
    {
        $this->_options = array(
            'params' => array(),
            'errorHandler' => new ErrorHandler,
            'logger' => new FileLogger($this->_filename()),
            'templater' => new Templater,
            'mode' => 'dev',
        );
        return $this->_options;
    }

}