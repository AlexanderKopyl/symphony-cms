<?php

namespace App\UserDomain\Infrastructure\Persistence;

use App\UserDomain\Domain\Model\User;
use App\UserDomain\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUserRepository implements UserRepositoryInterface
{
    public function __construct(private EntityManagerInterface $em) {}

    public function findAll(): array
    {
        return $this->em->getRepository(User::class)->findAll();
    }
}
