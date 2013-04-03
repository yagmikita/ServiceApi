<?php

namespace PrivatBank\Root\Executor;

interface ExecutorAwareInterface
{
    /**
     * @param Array $params
     * @return null
     */
    public function setExecutor(ExecutorInterface $exec = null);

    /**
     * @return ExecutorInterface
     */
    public function getExecutor();
}