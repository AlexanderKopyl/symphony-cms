<?php

namespace App\SharedKernel\Service;

interface SlugGeneratorInterface
{
    public function generate(string $text): string;
}
