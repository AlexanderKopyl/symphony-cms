<?php

namespace App\SharedDomain\Application\Cqrs;

use App\SharedDomain\Application\Cqrs\Attribute\AsCommand;
use App\SharedDomain\Application\Cqrs\Command\CommandHandlerInterface;
use App\SharedDomain\Application\Cqrs\Command\CommandInterface;

class CommandBus implements CommandBusInterface
{
    /**
     * @var array<string, CommandHandlerInterface>
     */
    private array $handlerMap = [];

    public function __construct(
        private readonly iterable $handlers = [],
    ) {
    }

    /**
     * @throws \ReflectionException
     */
    public function dispatch(CommandInterface $command): void
    {
        $commandClass = get_class($command);

        if (!isset($this->handlerMap[$commandClass])) {
            $this->handlerMap[$commandClass] = $this->resolveHandler($commandClass);
        }

        $this->handlerMap[$commandClass]($command);
    }

    private function resolveHandler(string $commandClass): CommandHandlerInterface
    {
        $reflection = new \ReflectionClass($commandClass);
        $attributes = $reflection->getAttributes(AsCommand::class);

        if (empty($attributes)) {
            throw new \RuntimeException("Missing #[AsCommand] attribute on $commandClass");
        }

        /** @var AsCommand $attributeInstance */
        $attributeInstance = $attributes[0]->newInstance();
        $handlerClass = $attributeInstance->commandHandlerClass;

        foreach ($this->handlers as $handler) {
            if ($handler instanceof $handlerClass) {
                return $handler;
            }
        }

        throw new \RuntimeException("Handler $handlerClass not found for $commandClass");
    }
}
