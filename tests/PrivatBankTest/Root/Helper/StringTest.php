<?php

namespace PrivatBankTest\Root\Helper;

use PrivatBank\Root\Helper\String as String;

class StringTest extends \PHPUnit_Framework_TestCase
{
    public function good()
    {
        return array(
            array(
                'phone={{phone}}',
                array(
                    'phone' => '380957700418'
                ),
                'phone=380957700418',
            ),
            array(
                'age={{age}}&weight={{weight}}&finalize={{finalize}}',
                array(
                    'age' => 23,
                    'weight' => 75,
                    'finalize' => 'false',
                ),
                'age=23&weight=75&finalize=false',
            ),
            array(
                'test',
                array(),
                'test',
            ),
        );
    }

    public function bad()
    {
        return array(
            array(
                'phone={phone}',
                array(
                    'phone' => '380957700418'
                ),
                'phone=380957700418',
            ),
            array(
                'age=age&weight={weight}}&finalize=finalize',
                array(
                    'age' => 23,
                    'weight' => 75,
                    'finalize' => 'false',
                ),
                'age=23&weight=75&finalize=false',
            ),
            array(
                '{{test}',
                array(),
                'test'
            ),
        );
    }

    /**
     * @dataProvider good
     */
    public function testSubstituteWorksAsItHasTo($text, $context, $sample)
    {
        $res = String::substitute($text, $context);
        $this->assertTrue($sample == $res);
    }

    /**
     * @dataProvider bad
     */
    public function testSubstitutionFails($text, $context, $sample)
    {
        $res = String::substitute($text, $context);
        $this->assertFalse($sample == $res);
        $this->assertTrue($text == $res);
    }

    public function good2()
    {
        return array(
            array(
                array(
                    'phone' => '380957700418',
                    'age' => '26',
                ),
                'phone=380957700418&age=26',
            ),
            array(
                array(),
                ''
            ),
        );
    }

    /**
     * @dataProvider good2
     */
    public function testUrlConcatContextWorksAsItHasTo($context, $sample)
    {
        $res = String::urlConcatContext($context);
        $this->assertTrue($res == $sample);
    }

    /*public function bad2()
    {
        return array(
            array(
                array(
                    'phone' => '380957700418',
                    'age' => '26',
                ),
                'phone=380957700418&age=26',
            ),
            array(
                array(),
                ''
            ),
        );
    }
    **
     * @dataProvider bad2
     *
    public function testUrlConcatContextWorksWrong($context, $sample)
    {

    }*/

}