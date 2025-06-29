<?php

namespace App\UserDomain\Application\Query\GetUser;

use App\SharedDomain\Application\Cqrs\Query\QueryHandlerInterface;
use App\SharedDomain\Application\Cqrs\Query\QueryInterface;
use App\UserDomain\Domain\Model\User;
use App\UserDomain\Domain\Repository\UserRepositoryInterface;

class GetUserByUsernameHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @param GetUserByUsernameQuery $query
     */
    public function __invoke(QueryInterface $query): ?User
    {
        return $this->userRepository->findOneByUsername($query->id);
    }
}
