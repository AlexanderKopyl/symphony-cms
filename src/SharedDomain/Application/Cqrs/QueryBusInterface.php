<?php

namespace App\SharedDomain\Application\Cqrs;

use App\SharedDomain\Application\Cqrs\Query\QueryInterface;

interface QueryBusInterface
{
    public function ask(QueryInterface $query): mixed;
}
