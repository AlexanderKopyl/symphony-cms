<?php

namespace App\UserDomain\Application\Service;

use App\UserDomain\Domain\Repository\UserRepositoryInterface;

class GetUsers
{
    public function __construct(private UserRepositoryInterface $repository) {}

    public function __invoke(): array
    {
        return $this->repository->findAll();
    }
}
