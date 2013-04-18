<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(realpath(__DIR__.'/../../../../_autoloader.php'));

use PrivatBank\Api\Chameleon\SessionOpen as SessionOpen;

$service = new SessionOpen(array(
    'code' => 'LDAP',
    'login' => 'dn101186gnv2',
    'password' => 'witness86',
));

$service->request();

var_dump($service->response(), "====================", (string)$service->response()->attributes()->value);