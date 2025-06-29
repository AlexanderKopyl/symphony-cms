<?php

namespace App\UserDomain\Application\Command\CreateUser;

use App\SharedDomain\Application\Cqrs\Attribute\AsCommand;
use App\SharedDomain\Application\Cqrs\Command\CommandInterface;

#[AsCommand(commandHandlerClass: CreateUserHandler::class)]
readonly class CreateUserCommand implements CommandInterface
{
    public function __construct(
        public string $email,
        public string $password,
        public readonly array $roles = ['ROLE_USER'],
    ) {
    }
}
