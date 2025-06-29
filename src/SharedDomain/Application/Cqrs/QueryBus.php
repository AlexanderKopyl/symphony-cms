<?php

namespace App\SharedDomain\Application\Cqrs;

use App\SharedDomain\Application\Cqrs\Attribute\AsQuery;
use App\SharedDomain\Application\Cqrs\Query\QueryHandlerInterface;
use App\SharedDomain\Application\Cqrs\Query\QueryInterface;

class QueryBus implements QueryBusInterface
{
    /**
     * @var array<string, QueryHandlerInterface>
     */
    private array $handlerMap = [];

    public function __construct(
        private readonly iterable $handlers,
    ) {
    }

    /**
     * @throws \ReflectionException
     */
    public function ask(QueryInterface $query): mixed
    {
        $queryClass = get_class($query);

        if (!isset($this->handlerMap[$queryClass])) {
            $this->handlerMap[$queryClass] = $this->resolveHandler($queryClass);
        }

        return $this->handlerMap[$queryClass]($query);
    }

    private function resolveHandler(string $queryClass): QueryHandlerInterface
    {
        $reflection = new \ReflectionClass($queryClass);
        $attributes = $reflection->getAttributes(AsQuery::class);

        if (empty($attributes)) {
            throw new \RuntimeException("Missing #[AsCommand] attribute on $queryClass");
        }

        /** @var AsQuery $attributeInstance */
        $attributeInstance = $attributes[0]->newInstance();
        $handlerClass = $attributeInstance->queryHandlerClass;

        foreach ($this->handlers as $handler) {
            if ($handler instanceof $handlerClass) {
                return $handler;
            }
        }

        throw new \RuntimeException("Handler $handlerClass not found for $queryClass");
    }
}
