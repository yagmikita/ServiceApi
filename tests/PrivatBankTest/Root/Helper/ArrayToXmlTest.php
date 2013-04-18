<?php

namespace PrivatBankTest\Root\Helper;

use PrivatBank\Root\Helper\Converter\ArrayToXml as ArrayToXml;

class ArrayToXmlTest extends \PHPUnit_Framework_TestCase
{
    protected $_conv;

    public function setUp()
    {
        $this->_conv = new ArrayToXml();
    }

    public function teardown()
    {
        unset($this->_conv);
    }

    public function good()
    {
        return array(
            array(
                array(
                    'body' => array(
                        'items' => array(
                            'dataset' => array(
                                'attributes' => array(
                                    'id' => 'id001',
                                    'remote_addr' => 'http://goo.gl/SrAF02'
                                ),
                            ),
                            array(
                                'name' => 'table'
                            ),
                            array(
                                'name' => 'division'
                            ),
                            array(
                                'name' => 'navigation'
                            )
                        )
                    )
                ),
                array(
                    'request' => array(
                        'body' => array(
                            'attributes' => array(
                                'test2' => 321,
                                'test3' => 987,
                            ),
                            'rows' => array(
                                array(
                                    'attributes' => array(
                                        'test4' => 564,
                                    ),
                                    'name' => 'my-row',
                                    'types' => array(
                                        array(
                                            'name' => 'bold',
                                        ),
                                        array(
                                            'name' => 'italic',
                                        ),
                                        array(
                                            'name' => 'underlined',
                                        ),
                                    ),
                                ),
                                array(
                                    'attributes' => array(
                                        'test5' => 565,
                                    ),
                                    'name' => 'my-row',
                                ),
                                'test' => array(
                                    'attributes' => array(
                                        'hidden' => 'false',
                                        'ready' => 'true',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );
    }

    public function testCreationIsOk()
    {
        $this->assertTrue(is_object($this->_conv) == true);
        $this->assertTrue(is_array($this->_conv->getBaseXmlHeaderParams()));
        $this->assertTrue(is_bool($this->_conv->getMode()));
        $this->assertTrue(is_array($this->_conv->getData()));
    }

    public function testWithEmptyParamsWeGetOnlyXMLHeader()
    {
        $this->assertTrue((bool)preg_match('/^\<\?xml\s(.*)\?\>/i', $this->_conv->applyBaseXmlHeader()->getXML()));
        $this->assertTrue((bool)preg_match('/^\<\?xml\s(.*)\?\>/i', $this->_conv->convert()));
    }

    /**
     * @expectedException Exception
     */
    public function testEmptyDataToSimpleXMLIsFalse()
    {
        $this->_conv->setMode(true);
        $this->assertFalse($this->_conv->convert());
    }

    /**
     * @dataProvider good
     */
    public function testSettingParams($r)
    {
        $this->_conv->setBaseXmlHeaderParams(array(
            'test' => 123
        ));
        $this->_conv->setData($r);
        $this->assertTrue(is_string($this->_conv->convert()));
        $this->assertTrue((bool)preg_match('/^\<\?xml\s(.*)\?\>(.*)/i', $this->_conv->convert()));
    }

}