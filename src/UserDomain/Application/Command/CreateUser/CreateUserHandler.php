<?php

declare(strict_types=1);

namespace App\UserDomain\Application\Command\CreateUser;


use App\Shared\Application\Cqrs\Command\CommandHandlerInterface;
use App\Shared\Application\Cqrs\Command\CommandInterface;
use App\UserDomain\Domain\Model\User;
use App\UserDomain\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {}

    public function __invoke(CommandInterface $command): void
    {
        $user = new User();
        $user->setEmail($command->email);
        $user->setUsername(strstr($command->email, '@', true));
        $user->setRoles($command->roles);
        $user->setPassword($this->passwordHasher->hashPassword($user, $command->password));

        $this->userRepository->save($user, flush: true);
    }
}
