<?php

namespace PrivatBankTest\Root\Helper;

use PrivatBank\Root\Helper\Converter\XmlToArray as XmlToArray;

class XmlToArrayTest extends \PHPUnit_Framework_TestCase
{
    protected $_conv;
    protected $_xml;

    public function setUp()
    {
        $fn = realpath(__DIR__ . '/../_meta/data.xml');
        $this->_xml  = new \SimpleXMLIterator(file_get_contents($fn));
        $this->_conv = new XmlToArray($this->_xml);
    }

    public function teardown()
    {
        unset($this->_conv);
    }

    public function correct()
    {
        return array(
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
        );
    }

    public function testCreationIsOk()
    {
        $this->assertTrue(is_object($this->_conv) == true);
        $this->assertTrue(get_class($this->_conv->getData()) == 'SimpleXMLIterator' || is_null($this->_conv->getData()));
    }

    /**
     * @expectedException Exception
     */
    public function testEmptyDataToSimpleXMLIsFalse()
    {
        $this->assertFalse($this->_conv->convert() == $this->correct());
    }

}