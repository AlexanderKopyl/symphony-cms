<?php

namespace App\Shared\Application\Cqrs;

use App\Shared\Application\Cqrs\Query\QueryInterface;

interface QueryBusInterface
{
    public function ask(QueryInterface $query): mixed;
}
