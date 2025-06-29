<?php

namespace App\SharedDomain\Application\Cqrs\Query;

interface QueryHandlerInterface
{
    public function __invoke(QueryInterface $query): mixed;
}
