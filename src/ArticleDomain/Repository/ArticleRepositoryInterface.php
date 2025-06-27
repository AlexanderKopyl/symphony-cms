<?php

namespace App\ArticleDomain\Repository;

use App\ArticleDomain\Entity\Article;

interface ArticleRepositoryInterface
{
    /**
     * @return Article[]
     */
    public function findAll(): array;
}
