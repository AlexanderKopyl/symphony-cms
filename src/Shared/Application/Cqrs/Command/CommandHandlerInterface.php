<?php

namespace App\Shared\Application\Cqrs\Command;

interface CommandHandlerInterface
{
    public function __invoke(CommandInterface $command): void;
}
