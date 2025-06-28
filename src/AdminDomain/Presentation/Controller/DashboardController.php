<?php

declare(strict_types=1);

namespace App\AdminDomain\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route(path: '/', name: 'admin_dashboard')]
    public function index(): Response
    {
        return $this->render('@Admin/main/dashboard.html.twig');
    }
}
