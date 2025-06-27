<?php

namespace App\Infrastructure\Repository;

use App\ArticleDomain\Entity\Article;
use App\ArticleDomain\Repository\ArticleRepositoryInterface;

class InMemoryArticleRepository implements ArticleRepositoryInterface
{
    /**
     * @var Article[]
     */
    private array $articles;

    public function __construct()
    {
        $this->articles = [
            new Article('First article'),
            new Article('Second article'),
        ];
    }

    public function findAll(): array
    {
        return $this->articles;
    }
}
