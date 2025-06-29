<?php

namespace App\UserDomain\Presentation\Controller;

use App\SharedDomain\Application\Cqrs\CommandBusInterface;
use App\SharedDomain\Application\Cqrs\QueryBusInterface;
use App\UserDomain\Application\Command\Logout\LogoutUserCommand;
use App\UserDomain\Application\Query\GetUser\GetUserByUsernameQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/user', name: 'user_')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    #[Route('/me', name: 'me', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function me(UserInterface $user): JsonResponse
    {
        $user = $this->queryBus->ask(
            new GetUserByUsernameQuery(
                $user->getUserIdentifier()
            )
        );

        return $this->json([
            'id' => $user->getId(),
            'email' => $user->getUserIdentifier(),
            'roles' => $user->getRoles(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'phone' => $user->getPhone(),
            'birthDate' => $user->getBirthday()?->format('Y-m-d'),
        ]);
    }

    #[Route('/logout', name: 'api_logout', methods: ['POST'])]
    public function logout(
        UserInterface $user,
    ): JsonResponse {
        $this->commandBus->dispatch(new LogoutUserCommand(
            username: $user->getUserIdentifier()
        ));

        return new JsonResponse(['message' => 'Successfully logged out']);
    }
}
