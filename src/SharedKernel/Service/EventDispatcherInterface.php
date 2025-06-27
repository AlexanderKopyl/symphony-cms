<?php

namespace App\SharedKernel\Service;

interface EventDispatcherInterface
{
    public function dispatch(object $event): void;
}
