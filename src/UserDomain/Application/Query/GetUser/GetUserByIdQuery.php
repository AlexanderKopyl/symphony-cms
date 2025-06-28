<?php

namespace App\UserDomain\Application\Query\GetUser;

use App\Shared\Application\Cqrs\Query\QueryInterface;

readonly class GetUserByIdQuery implements QueryInterface
{
    public function __construct(public string $id) {}
}
