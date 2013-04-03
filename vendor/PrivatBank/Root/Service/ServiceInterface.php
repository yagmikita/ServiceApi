<?php

namespace PrivatBank\Root\Service;

use PrivatBank\Root\Error\ErrorHandlerAwareInterface as ErrorHandlerAwareInterface,
    PrivatBank\Root\ParamsAwareInterface as ParamsAwareInterface,
    PrivatBank\Root\ServiceModeInterface as ServiceModeInterface,
    PrivatBank\Root\Executor\ExecutorAwareInterface as ExecutorAwareInterface,
    PrivatBank\Root\Render\TemplaterAwareInterface as TemplaterAwareInterface,
    Psr\Log\LoggerAwareInterface as LoggerAwareInterface;

interface ServiceInterface extends  ErrorHandlerAwareInterface,
                                    LoggerAwareInterface,
                                    ParamsAwareInterface,
                                    ExecutorAwareInterface,
                                    TemplaterAwareInterface,
                                    ServiceModeInterface
{
    public function request();
    public function response();
}