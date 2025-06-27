<?php

namespace App\SharedKernel\Service;

interface UuidGeneratorInterface
{
    public function generate(): string;
}
