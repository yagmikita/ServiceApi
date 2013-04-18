<?php

namespace PrivatBank\Api\Chameleon;

trait SetServices
{
    public function services()
    {
        return array(
            'prod' => 'https://promin.privatbank.ua:8072/ChameleonServer',
            'dev' => 'https://10.1.108.22:8072/ChameleonServer',
        );
    }
    
}