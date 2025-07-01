<?php

declare(strict_types=1);

namespace App\AdminDomain\Presentation\Controller;

use App\SharedDomain\Application\Cqrs\QueryBusInterface;
use App\UserDomain\Application\Query\GetAllUsers\GetAllUsersQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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
        $users = $this->queryBus->ask(new GetAllUsersQuery());

        return $this->render('@Admin/theme/spike/user/list.html.twig', [
            'users' => $users,
        ]);
    }
}
