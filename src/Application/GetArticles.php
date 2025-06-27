<?php

namespace App\Application;

use App\ArticleDomain\Repository\ArticleRepositoryInterface;

class GetArticles
{
    public function __construct(private ArticleRepositoryInterface $repository) {}

    public function __invoke(): array
    {
        return $this->repository->findAll();
    }
}
