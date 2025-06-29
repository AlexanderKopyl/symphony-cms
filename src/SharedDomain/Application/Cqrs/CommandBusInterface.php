<?php

namespace App\SharedDomain\Application\Cqrs;

use App\SharedDomain\Application\Cqrs\Command\CommandInterface;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
