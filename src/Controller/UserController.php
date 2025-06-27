<?php

namespace App\Controller;

use App\Application\GetUsers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/users', name: 'user_index')]
    public function __invoke(GetUsers $getUsers): JsonResponse
    {
        $users = $getUsers();
        $names = array_map(fn($user) => $user->getUsername(), $users);

        return new JsonResponse($names);
    }
}
