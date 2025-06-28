<?php

namespace App\UserDomain\Application\Command\CreateUser;

use App\Shared\Application\Cqrs\Command\CommandInterface;

readonly class CreateUserCommand implements CommandInterface
{
    public function __construct(
        public string $email,
        public string $password,
        public readonly array $roles = ['ROLE_USER']
    ) {}
}
