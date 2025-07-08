<?php

declare(strict_types=1);

namespace App\AdminDomain\Presentation\Controller;

use App\SharedDomain\Application\Cqrs\QueryBusInterface;
use App\UserDomain\Application\Query\GetAllUsers\GetAllUsersQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/users', name: 'admin_user_')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    #[Route('/', name: 'index')]
    public function list(): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin_login');
        }

        $users = $this->queryBus->ask(new GetAllUsersQuery());

        return $this->render('@Admin/user/index.html.twig', [
            'users' => $users,
        ]);
    }
}
