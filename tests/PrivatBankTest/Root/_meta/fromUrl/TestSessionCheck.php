<?php

$options = array(
    CURLOPT_URL => 'https://promin.privatbank.ua:8072/ChameleonServer/sessions/get/130410CSaz0nmobvrlca',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,
);

$ch = curl_init();
curl_setopt_array($ch, $options);

var_dump(curl_exec($ch));

curl_close($ch);