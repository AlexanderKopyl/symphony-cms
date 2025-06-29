<?php

namespace App\UserDomain\Application\Command\Logout;

use App\SharedDomain\Application\Cqrs\Attribute\AsCommand;
use App\SharedDomain\Application\Cqrs\Command\CommandInterface;

#[AsCommand(commandHandlerClass: LogoutUserHandler::class)]
class LogoutUserCommand implements CommandInterface
{
    public function __construct(
        public readonly string $username,
    ) {
    }
}
