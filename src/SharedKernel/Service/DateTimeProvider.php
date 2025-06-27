<?php

namespace App\SharedKernel\Service;

class DateTimeProvider implements DateTimeProviderInterface
{
    public function now(): \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}
