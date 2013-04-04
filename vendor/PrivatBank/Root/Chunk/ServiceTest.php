<?php

namespace PrivatBank\Root\Chunk;

trait ServiceTest
{
    /**
     * Servise itself
     */
    protected $_service;

    /**
     * @dataProvider goodParams
     * @param Array $params
     */
    public function testServiceCreationIsOk($params)
    {
        $this->_service->setParams($params);
        $this->_service->request();
        $res = $this->_service->response();
        $this->assertTrue(get_class($res) == 'SimpleXMLElement');
    }

    /**
     * @dataProvider badParams
     * @param Array $params
     */
    public function testServiceCreationIsOkButEndsWithErrorResponse($params)
    {
        $this->_service->setParams($params);
        $this->_service->request();
        $res = $this->_service->response();
        $this->assertTrue(get_class($res) == 'SimpleXMLElement');
        $this->assertTrue(isset($res->error));
        $this->assertTrue(isset($res->error->attributes()['type']));
        $this->assertTrue(isset($res->error->attributes()['code']));
        $this->assertTrue(isset($res->error->attributes()['msg']));
    }

}