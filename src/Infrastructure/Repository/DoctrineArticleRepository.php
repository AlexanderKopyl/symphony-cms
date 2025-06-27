<?php

namespace App\Infrastructure\Repository;

use App\ArticleDomain\Entity\Article;
use App\ArticleDomain\Repository\ArticleRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineArticleRepository implements ArticleRepositoryInterface
{
    public function __construct(private EntityManagerInterface $em) {}

    public function findAll(): array
    {
        return $this->em->getRepository(Article::class)->findAll();
    }
}
