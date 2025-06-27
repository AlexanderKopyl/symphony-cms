<?php

namespace App\UserDomain\Repository;

use App\UserDomain\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @return User[]
     */
    public function findAll(): array;
}
