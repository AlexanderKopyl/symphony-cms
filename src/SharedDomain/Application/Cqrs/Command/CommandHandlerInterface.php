<?php

namespace App\SharedDomain\Application\Cqrs\Command;

interface CommandHandlerInterface
{
    public function __invoke(CommandInterface $command): void;
}
