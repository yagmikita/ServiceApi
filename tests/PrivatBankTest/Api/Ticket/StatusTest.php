<?php

namespace PrivatBankTest\Api\Ticket;

use PrivatBank\Api\Ticket\Status as Status,
    PrivatBank\Root\Chunk\ServiceTest as ServiceTest;

class StatusTest extends \PHPUnit_Framework_TestCase
{
    use ServiceTest;

    public function setUp()
    {
        $this->_service = new Status;
    }

    public function tearDown()
    {
        unset($this->_service);
    }

    public function goodParams()
    {
    /**
     * body/@order_code -- код заказа
     */
        return array(
            array(
                array(
                    'order_code' => 256793,
                ),
            ),
            array(
                array(
                    'order_code' => 231912,
                ),
            ),
        );
    }

    public function badParams()
    {
        return array(
            array(
                array(
                    'order_code' => null,
                ),
            ),
            array(
                array(
                ),
            ),
        );
    }

}