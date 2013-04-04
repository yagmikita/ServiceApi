<?php

namespace PrivatBankTest\Api\Ticket;

use PrivatBank\Api\Ticket\Route as Route,
    PrivatBank\Root\Chunk\ServiceTest as ServiceTest;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    use ServiceTest;

    public function setUp()
    {
        $this->_service = new Route;
    }

    public function tearDown()
    {
        unset($this->_service);
    }

    public function goodParams()
    {
        /**
         * user_id -- идентификатор
         * point_a_code - код станции отправления
         * point_b_code - код станции прибытия
         * trip_date - дата отправления
         * transporte_type - вид транспорта
         * lang - язык на котором будет возвращена текстовая информация
         * arr_date - дата прибытия (третья очередь реализации)
         * show_blocked -- 1/0 - возвращать ли в ответе заблокированные рейсы (1- возвращать)
         */
        return array(
            array(
                array(
                    'user_id' => 23,
                    'point_a_code' => 'ODMAIN',
                    'point_b_code' => 'DNMAIN',
                    'trip_date' => '19-04-2013',
                    'transporte_type' => 2,
                    'lang' => 1,
                    'arr_date' => '20-04-2013',
                    'show_blocked' => 0,
                ),
            ),
            array(
                array(
                    'user_id' => 267,
                    'point_a_code' => 'DDMAIN',
                    'point_b_code' => 'KHMAIN',
                    'trip_date' => '14-04-2013',
                    'transporte_type' => 2,
                    'lang' => 3,
                    'arr_date' => '14-04-2013',
                    'show_blocked' => 1,
                ),
            ),
        );
    }

    public function badParams()
    {
        return array(
            array(
                array(
                    'user_id' => null,
                    'point_a_code' => null,
                    'point_b_code' => null,
                    'trip_date' => null,
                    'transporte_type' => null,
                    'lang' => null,
                    'arr_date' => null,
                    'show_blocked' => null,
                ),
            ),
            array(
                array(
                ),
            ),
        );
    }

}