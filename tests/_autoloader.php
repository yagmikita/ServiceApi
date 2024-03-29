<?php

/**
 * Setup autoloading
 */
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    include_once __DIR__ . '/../vendor/autoload.php';
} else {
    require_once __DIR__ . '/../vendor/Zend/Loader/StandardAutoloader.php';
    $loader = new Zend\Loader\StandardAutoloader(
        array(
             Zend\Loader\StandardAutoloader::LOAD_NS => array(
                 'Psr'      => __DIR__ . '/../vendor/Psr',
                 'Zend'     => __DIR__ . '/../vendor/Zend',
                 'PrivatBank'       => __DIR__ . '/../vendor/PrivatBank',
                 'PrivatBankTest'   => __DIR__ . '/PrivatBankTest'
             ),
        ));
    $loader->register();
}