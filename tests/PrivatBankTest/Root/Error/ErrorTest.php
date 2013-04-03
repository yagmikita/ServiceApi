<?php

namespace PrivatBankTest\Root\Error;

use PrivatBank\Root\Error\ErrorHandler as ErrorHandler;

class ErrorTest extends \PHPUnit_Framework_TestCase
{
    protected $_s = 'test';
    protected $_errorHandler;

    public function setUp()
    {        //var_dump(__CLASS__);
        $this->_errorHandler = new ErrorHandler;
    }

    public function tearDown()
    {
        unset($this->_errorHandler);
    }

    public function testErrorHandlerIsCreatedSuccessfully()
    {
        $this->assertTrue(get_class($this->_errorHandler) == 'PrivatBank\Root\Error\ErrorHandler');
        $this->assertTrue(!$this->_errorHandler->hasErrors());
        $this->assertTrue(!count($this->_errorHandler->errors()));
    }

    public function testErrorIsAddedSuccessfully()
    {
        $this->_errorHandler->add($this->_s);
        $this->assertTrue($this->_errorHandler->hasErrors());
        $this->assertTrue(count($this->_errorHandler->errors())>0);
        //$this->assertTrue(count($this->_errorHandler())>0);
        $m = $this->_errorHandler->errors();
        $this->assertTrue($m[0] == $this->_s);
    }

}