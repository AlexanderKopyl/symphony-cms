<?php

namespace App\Shared\Application\Cqrs;

use App\Shared\Application\Cqrs\Query\QueryHandlerInterface;
use App\Shared\Application\Cqrs\Query\QueryInterface;

class QueryBus implements QueryBusInterface
{
    public function __construct(
        private readonly iterable $handlers
    ) {}

    /**
     * @throws \ReflectionException
     */
    public function ask(QueryInterface $query): mixed
    {
        foreach ($this->handlers as $handler) {
            if ($handler instanceof QueryHandlerInterface
                && is_a($query, (new \ReflectionClass($handler))
                    ->getMethod('__invoke')->getParameters()[0]->getType()->getName(), true)) {

                return $handler($query);
            }
        }
        throw new \RuntimeException('Handler not found for ' . get_class($query));
    }
}
