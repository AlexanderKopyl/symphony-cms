<?php

namespace App\ArticleDomain\Infrastructure\Persistence;

use App\ArticleDomain\Domain\Model\Article;
use App\ArticleDomain\Domain\Repository\ArticleRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineArticleRepository implements ArticleRepositoryInterface
{
    public function __construct(private EntityManagerInterface $em) {}

    public function findAll(): array
    {
        return $this->em->getRepository(Article::class)->findAll();
    }
}
