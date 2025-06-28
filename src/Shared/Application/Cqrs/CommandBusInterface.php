<?php

namespace App\Shared\Application\Cqrs;

use App\Shared\Application\Cqrs\Command\CommandInterface;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
