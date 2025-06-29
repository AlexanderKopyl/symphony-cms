<?php

namespace App\UserDomain\Infrastructure\Repository;

use App\UserDomain\Domain\Model\User;
use App\UserDomain\Domain\Repository\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        ManagerRegistry $registry,
    ) {
        parent::__construct($registry, User::class);
    }

    public function findOneByEmail(string $email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function findOneByUsername(string $username): ?User
    {
        return $this->findOneBy(['username' => $username]);
    }

    public function save(User $user, bool $flush = false): void
    {
        $this->em->persist($user);

        if ($flush) {
            $this->em->flush();
        }
    }

    public function remove(User $user, bool $flush = false): void
    {
        $this->em->remove($user);

        if ($flush) {
            $this->em->flush();
        }
    }
}
