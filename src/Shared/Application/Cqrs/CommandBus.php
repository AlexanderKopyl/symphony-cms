<?php

namespace App\Shared\Application\Cqrs;

use App\Shared\Application\Cqrs\Command\CommandHandlerInterface;
use App\Shared\Application\Cqrs\Command\CommandInterface;
class CommandBus implements CommandBusInterface
{
    public function __construct(
        private readonly iterable $handlers = []
    ) {}

    /**
     * @throws \ReflectionException
     */
    public function dispatch(CommandInterface $command): void
    {
        foreach ($this->handlers as $handler) {
            if ($handler instanceof CommandHandlerInterface
                && is_a($command, (new \ReflectionClass($handler))
                    ->getMethod('__invoke')->getParameters()[0]->getType()->getName(), true)) {
                $handler($command);
                return;
            }
        }

        throw new \RuntimeException('Handler not found for ' . get_class($command));
    }
}
