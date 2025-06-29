<?php

declare(strict_types=1);

namespace App\SharedDomain\Application\Cqrs\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
class AsQuery
{
    public function __construct(
        public readonly string $queryHandlerClass,
    ) {
    }
}
