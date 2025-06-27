<?php

namespace App\SharedKernel\Service;

interface DateTimeProviderInterface
{
    public function now(): \DateTimeImmutable;
}
