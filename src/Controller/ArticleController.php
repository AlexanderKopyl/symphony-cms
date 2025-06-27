<?php

namespace App\Controller;

use App\Application\GetArticles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'article_index')]
    public function __invoke(GetArticles $getArticles): JsonResponse
    {
        $articles = $getArticles();
        $titles = array_map(fn($article) => $article->getTitle(), $articles);

        return new JsonResponse($titles);
    }
}
