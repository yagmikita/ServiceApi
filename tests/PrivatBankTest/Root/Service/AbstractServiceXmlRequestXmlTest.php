<?php

namespace PrivatBankTest\Root\Service;

use PrivatBank\Root\Error\ErrorHandler as ErrorHandler,
    Privatbank\Root\Executor\Content as Content,
    PrivatBank\Root\Log\FileLogger as FileLogger,
    PrivatBank\Root\Render\Templater as Templater,
    PrivatBankTest\Root\Service\Dummy\DummyXmlServiceXml as DummyXmlServiceXml;

/**
 * @todo write a moke for self::services() with the help of
 *       PHPUnit :: getMokeForAbstractClass(), like here:
 *       http://stackoverflow.com/questions/190295/testing-abstract-classes#answer-2241159
 */
class AbstractServiceXmlRequestXmlTest extends \PHPUnit_Framework_TestCase
{
    protected $_service;
    protected $_techLogin = array(
        'login' => 'uniorpbua',
        'password' => 'er61%Di5',
    );

    protected $_options;

    /**
     * Interface methods fro testing:
     *  - request
     *  - response
     */

    public function setUp()
    {
        $this->_service = new DummyXmlServiceXml(
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
        $this->assertTrue(get_parent_class($this->_service) == 'PrivatBank\Root\Service\AbstractServiceXmlRequestXml');
    }

    public function testRequestResponseIsOk()
    {
        $this->_service->setParams($this->_techLogin);
        $this->_service->request();
        $response = $this->_service->response();
        $this->assertTrue((bool)$response);
        $this->assertTrue(get_class($response) == 'SimpleXMLElement');
    }

    /**
     * @expectedException Exception
     */
    public function testBadRequestEndsWithException()
    {
        $stubExecutor = $this->getMock('Content');
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