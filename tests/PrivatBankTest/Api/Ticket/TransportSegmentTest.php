<?php

namespace PrivatBankTest\Api\Ticket;

use PrivatBank\Api\Ticket\TransportSegment as TransportSegment,
    PrivatBank\Root\Chunk\ServiceTest as ServiceTest;

class TransportSegmentTest extends \PHPUnit_Framework_TestCase
{
    use ServiceTest;

    public function setUp()
    {
        $this->_service = new TransportSegment;
    }

    public function tearDown()
    {
        unset($this->_service);
    }

    public function goodParams()
    {
    /**
     * trip_segment_id - номер сегмента
     * trip_variant_guididx - идентификатор рейса
     */
        return array(
            array(
                array(
                    'trip_segment_id' => 2,
                    'trip_variant_guididx' => 1,
                ),
            ),
            array(
                array(
                    'trip_segment_id' => 3,
                    'trip_variant_guididx' => 1,
                ),
            ),
        );
    }

    public function badParams()
    {
        return array(
            array(
                array(
                    'trip_segment_id' => null,
                    'trip_variant_guididx' => null,
                ),
            ),
            array(
                array(
                ),
            ),
        );
    }

}