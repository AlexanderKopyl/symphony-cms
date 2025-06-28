<?php

namespace App\UserDomain\Application\Query\GetUser;


use App\Shared\Application\Cqrs\Query\QueryHandlerInterface;
use App\Shared\Application\Cqrs\Query\QueryInterface;
use App\UserDomain\Domain\Model\User;
use App\UserDomain\Domain\Repository\UserRepositoryInterface;

class GetUserByIdHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository) {}

    public function __invoke(QueryInterface $query): ?User
    {
        return $this->userRepository->find($query->id);
    }
}
