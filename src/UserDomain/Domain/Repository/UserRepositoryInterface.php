<?php

namespace App\UserDomain\Domain\Repository;

use App\UserDomain\Domain\Model\User;

interface UserRepositoryInterface
{
    /**
     * @return User[]
     */
    public function findAll(): array;
}
