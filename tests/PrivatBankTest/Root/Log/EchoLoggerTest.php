<?php

namespace PrivatBankTest\Root\Log;

use PrivatBank\Root\Log\EchoLogger as EchoLogger;

class EchoLoggerTest extends \PHPUnit_Framework_TestCase
{
    protected $_type = 'info';
    protected $_logger;

    public function setUp()
    {
        $this->_logger = new EchoLogger;
    }

    public function tearDown()
    {
        unset($this->_logger);
    }

    public function testEchoLoggerIsCreatedSuccessfully()
    {
        $this->assertTrue(get_class($this->_logger) == 'PrivatBank\Root\Log\EchoLogger');
    }

    public function testEchoLoggerPrintsMessageToScreen()
    {
        ob_start();
            $this->_logger->log($this->_type, 'My name is {{name}}! My second name is {{surname}}.', array(
                'name' => 'John',
                'surname' => 'Smith',
            ));
        $content = ob_get_clean();
        $this->assertRegExp("/\[info\]\s=>\sMy name is John! My second name is Smith./", $content);
    }

    public function testProxyAndDirectMethodsDoTheSame()
    {
        ob_start();
            $this->_logger->log($this->_type, 'My name is {{name}}! My second name is {{surname}}.', array(
                'name' => 'John',
                'surname' => 'Smith',
            ));
        $content = ob_get_clean();
        ob_start();
            $this->_logger->info('My name is {{name}}! My second name is {{surname}}.', array(
                'name' => 'John',
                'surname' => 'Smith',
            ));
        $content2 = ob_get_clean();
        $this->assertTrue($content == $content2);
    }

}