<?php

namespace PrivatBankTest\Root\Log;

use PrivatBank\Root\Log\FileLogger as FileLogger;

class FileLoggerTest extends \PHPUnit_Framework_TestCase
{
    protected $_type = 'info';
    protected $_filename = 'testLog.log';
    protected $_logger;

    public function setUp()
    {
        $this->_logger = new FileLogger($this->filename());
    }

    public function tearDown()
    {
        unset($this->_logger);
        $this->cleanFile();
    }

    public function testFileLoggerIsCreatedSuccessfully()
    {
        $this->assertTrue(get_class($this->_logger) == 'PrivatBank\Root\Log\FileLogger');
    }

    public function testFileLoggerPrintsMessageToFile()
    {
        $this->_logger->log($this->_type, 'My name is {{name}}! My second name is {{surname}}.', array(
            'name' => 'John',
            'surname' => 'Smith',
        ));
        $content = file_get_contents($this->filename());
        $this->assertRegExp("/\'info\'\s=>\s\'My name is John! My second name is Smith.\'/", $content);
    }

    public function testProxyAndDirectMethodsDoTheSame()
    {
        $this->_logger->log($this->_type, 'My name is {{name}}! My second name is {{surname}}.', array(
            'name' => 'John',
            'surname' => 'Smith',
        ));
        $content = file_get_contents($this->filename());
        $this->cleanFile();
        $this->_logger->info('My name is {{name}}! My second name is {{surname}}.', array(
            'name' => 'John',
            'surname' => 'Smith',
        ));
        $content2 = file_get_contents($this->filename());
        $this->assertTrue($content == $content2);
    }

    protected function filename()
    {
        return __DIR__ . '/../_meta/' . $this->_filename;
    }

    protected function cleanFile()
    {
        file_put_contents($this->filename(), '');
    }

}