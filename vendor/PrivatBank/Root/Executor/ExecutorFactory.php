<?php

namespace Privatbank\Root\Executor;

class ExecutorFactory
{
    public static function create($type = 'content')
    {
        switch ($type) {
            case 'curl':
                return new Curl();
            break;
            case 'content':
                return new Content();
            break;
            default:
                return new Content();
            break;
        }
    }
}