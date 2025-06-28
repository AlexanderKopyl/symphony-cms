<?php

namespace App\UserDomain\Presentation\Controller;

use App\UserDomain\Domain\Model\User;
use App\UserDomain\Infrastructure\Repository\RefreshTokenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/user', name: 'user_')]
class UserController extends AbstractController
{
    #[Route('/me', name: 'me', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function me(): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

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
        RefreshTokenRepository $refreshTokenRepository,
        UserInterface $user
    ): JsonResponse {
        $refreshTokens = $refreshTokenRepository->findBy(['username' => $user->getUserIdentifier()]);

        foreach ($refreshTokens as $token) {
            $refreshTokenRepository->remove($token, true);
        }

        return new JsonResponse(['message' => 'Successfully logged out'], 200);
    }
}
