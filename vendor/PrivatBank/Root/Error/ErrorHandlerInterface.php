<?php

namespace PrivatBank\Root\Error;

interface ErrorHandlerInterface
{
    public function add($errorMessage);
    public function errors();
    public function hasErrors();
    public function __invoke();
}