<?php

namespace App\Application;

use App\UserDomain\Repository\UserRepositoryInterface;

class GetUsers
{
    public function __construct(private UserRepositoryInterface $repository) {}

    public function __invoke(): array
    {
        return $this->repository->findAll();
    }
}
