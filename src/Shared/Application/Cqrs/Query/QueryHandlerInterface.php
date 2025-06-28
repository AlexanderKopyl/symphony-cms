<?php

namespace App\Shared\Application\Cqrs\Query;

interface QueryHandlerInterface
{
    public function __invoke(QueryInterface $query): mixed;
}
