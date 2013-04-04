<?php

namespace PrivatBankTest\Api\Ticket;

use PrivatBank\Api\Ticket\Station as Station,
    PrivatBank\Root\Chunk\ServiceTest as ServiceTest;


class StationTest extends \PHPUnit_Framework_TestCase
{
    use ServiceTest;

    public function setUp()
    {
        $this->_service = new Station;
    }

    public function tearDown()
    {
        unset($this->_service);
    }

    public function goodParams()
    {
        return array(
            array(
                array(
                    'station_type' => 0,
                    'max' => 10,
                    'starts_with' => 'Днепр',
                    'lang' => 2,
                    'transporte_type' => 2,
                ),
            ),
            array(
                array(
                    'station_type' => 1,
                    'max' => 5,
                    'starts_with' => 'Днепр',
                    'lang' => 1,
                    'transporte_type' => 2,
                ),
            ),
        );
    }

    public function badParams()
    {
        return array(
            array(
                array(
                    'station_type' => null,
                    'max' => null,
                    'starts_with' => null,
                    'lang' => null,
                    'transporte_type' => null,
                ),
            ),
            array(
                array(
                ),
            ),
        );
    }

}