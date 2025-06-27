<?php

namespace App\ArticleDomain\Application\Service;

use App\ArticleDomain\Domain\Repository\ArticleRepositoryInterface;

class GetArticles
{
    public function __construct(private ArticleRepositoryInterface $repository) {}

    public function __invoke(): array
    {
        return $this->repository->findAll();
    }
}
