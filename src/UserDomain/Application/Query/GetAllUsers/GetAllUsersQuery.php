<?php

namespace App\UserDomain\Application\Query\GetAllUsers;

use App\SharedDomain\Application\Cqrs\Attribute\AsQuery;
use App\SharedDomain\Application\Cqrs\Query\QueryInterface;

#[AsQuery(queryHandlerClass: GetAllUsersQueryHandler::class)]
class GetAllUsersQuery implements QueryInterface
{
}
