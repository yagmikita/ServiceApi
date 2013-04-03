<?php

namespace PrivatBank\Root\Executor;

interface ExecutorInterface
{
    public function setOptions(array $options);
    public function getOptions();
    public function execute();
}