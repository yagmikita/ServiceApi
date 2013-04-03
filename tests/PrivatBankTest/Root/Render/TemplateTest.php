<?php

namespace PrivatBankTest\Root\Render;

use PrivatBank\Root\Render\Templater as Templater;

class TemplateTest extends \PHPUnit_Framework_TestCase
{
    protected $_template;

    public function setUp()
    {
        $this->_template = new Templater;
    }

    public function tearDown()
    {
        unset($this->_template);
    }

    public function goodData()
    {
        return array(
            array(
                '{{test}}',
                array('test' => 123),
                '123',
            ),
            array(
                '{{test}} is not just a {{type}} test',
                array('test' => 123, 'type' => 'regular'),
                '123 is not just a regular test',
            ),
            array(
                '',
                array('test' => 321),
                ''
            ),
            array(
                'test',
                array(),
                'test'
            ),
        );
    }

    public function badData()
    {
        return array(
            array(
                123,
                array('test' => 123),
            ),
            array(
                true,
                array('test' => 123, 'type' => 'regular'),
            ),
            array(
                array(),
                array('test' => 321),
            ),
            array(
                new \stdClass,
                array(),
            ),
        );
    }

    /**
     * @dataProvider goodData
     */
    public function testTemplateingJustReturnsFine($text, $context, $sample)
    {
        $this->_template->setTemplate($text);
        $this->_template->setContext($context);
        $this->assertTrue($this->_template->render(true) == $sample);
    }

    /**
     * @dataProvider goodData
     */
    public function testTemplateingReturnsAndOutputsFine($text, $context, $sample)
    {
        $this->_template->setTemplate($text);
        $this->_template->setContext($context);
        ob_start();
            $res = $this->_template->render(false);
            $buffer = ob_get_contents();
        ob_end_clean();
        $this->assertTrue($sample == $res);
        $this->assertTrue($sample == $buffer);
    }

    /**
     * @dataProvider badData
     */
    public function testTemplateingReturnsEmptyStringWithBadData($text, $context)
    {
        $this->_template->setTemplate($text);
        $this->_template->setContext($context);
        $res = $this->_template->render();
        $this->assertTrue($res == "");
    }

}