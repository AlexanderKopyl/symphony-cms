<?php

namespace App\UserDomain\Application\Query\GetAllUsers;

use App\SharedDomain\Application\Cqrs\Query\QueryHandlerInterface;
use App\SharedDomain\Application\Cqrs\Query\QueryInterface;
use App\UserDomain\Domain\Repository\UserRepositoryInterface;

class GetAllUsersQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    public function __invoke(QueryInterface $query): array
    {
        return $this->userRepository->findAll();
    }
}
