<?php

namespace App\Infrastructure\Repository;

use App\UserDomain\Entity\User;
use App\UserDomain\Repository\UserRepositoryInterface;

class InMemoryUserRepository implements UserRepositoryInterface
{
    /**
     * @var User[]
     */
    private array $users;

    public function __construct()
    {
        $this->users = [
            new User('alice'),
            new User('bob'),
        ];
    }

    public function findAll(): array
    {
        return $this->users;
    }
}
