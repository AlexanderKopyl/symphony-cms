<?php

namespace App\UserDomain\Application\Query\GetUser;

use App\Shared\Application\Cqrs\Query\QueryHandlerInterface;
use App\Shared\Application\Cqrs\Query\QueryInterface;
use App\UserDomain\Domain\Repository\UserRepositoryInterface;

class GetAllUsersQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {}

    public function __invoke(QueryInterface $query): array
    {
        return $this->userRepository->findAll();
    }
}
