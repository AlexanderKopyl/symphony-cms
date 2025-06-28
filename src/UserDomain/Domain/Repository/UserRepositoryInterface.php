<?php

namespace App\UserDomain\Domain\Repository;

use App\UserDomain\Domain\Model\User;

interface UserRepositoryInterface
{
    public function findOneByEmail(string $email): ?User;

    public function findOneByUsername(string $username): ?User;

    public function save(User $user, bool $flush = false): void;

    public function remove(User $user, bool $flush = false): void;
}
