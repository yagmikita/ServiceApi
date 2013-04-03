<?php

namespace PrivatBank\Root;

interface ParamsAwareInterface
{
    public function setParams(array $params = array());
    public function getParams();
}