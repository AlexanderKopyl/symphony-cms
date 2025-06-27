<?php

namespace App\SharedKernel\Service;

class SlugGenerator implements SlugGeneratorInterface
{
    public function generate(string $text): string
    {
        $slug = preg_replace('/[^a-z0-9]+/i', '-', $text);
        $slug = trim($slug, '-');
        return strtolower($slug);
    }
}
