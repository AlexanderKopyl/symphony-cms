<?php

namespace App\ArticleDomain\Domain\Repository;

use App\ArticleDomain\Domain\Model\Article;

interface ArticleRepositoryInterface
{
    /**
     * @return Article[]
     */
    public function findAll(): array;
}
