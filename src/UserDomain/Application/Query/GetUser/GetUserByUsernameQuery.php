<?php

namespace App\UserDomain\Application\Query\GetUser;

use App\SharedDomain\Application\Cqrs\Attribute\AsQuery;
use App\SharedDomain\Application\Cqrs\Query\QueryInterface;

#[AsQuery(queryHandlerClass: GetUserByUsernameHandler::class)]
readonly class GetUserByUsernameQuery implements QueryInterface
{
    public function __construct(public string $id)
    {
    }
}
