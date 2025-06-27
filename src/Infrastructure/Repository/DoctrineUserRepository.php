<?php

namespace App\Infrastructure\Repository;

use App\UserDomain\Entity\User;
use App\UserDomain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUserRepository implements UserRepositoryInterface
{
    public function __construct(private EntityManagerInterface $em) {}

    public function findAll(): array
    {
        return $this->em->getRepository(User::class)->findAll();
    }
}
