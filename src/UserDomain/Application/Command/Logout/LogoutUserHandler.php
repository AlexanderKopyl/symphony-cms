<?php

declare(strict_types=1);

namespace App\UserDomain\Application\Command\Logout;

use App\SharedDomain\Application\Cqrs\Command\CommandHandlerInterface;
use App\SharedDomain\Application\Cqrs\Command\CommandInterface;
use App\UserDomain\Domain\Repository\RefreshTokenRepositoryInterface;

class LogoutUserHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly RefreshTokenRepositoryInterface $refreshTokenRepository,
    ) {
    }

    /**
     * @param LogoutUserCommand $command
     */
    public function __invoke(CommandInterface $command): void
    {
        $tokens = $this->refreshTokenRepository->findByUsername($command->username);

        foreach ($tokens as $token) {
            $this->refreshTokenRepository->remove($token, flush: true);
        }
    }
}
