<?php

namespace App\UserDomain\Infrastructure\Repository;

use App\UserDomain\Domain\Model\RefreshToken;
use App\UserDomain\Domain\Repository\RefreshTokenRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class RefreshTokenRepository extends ServiceEntityRepository implements RefreshTokenRepositoryInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        ManagerRegistry $registry,
    ) {
        parent::__construct($registry, RefreshToken::class);
    }

    public function findInvalid($datetime = null)
    {
        $datetime ??= new \DateTimeImmutable();

        return $this->createQueryBuilder('t')
            ->where('t.valid < :now')
            ->setParameter('now', $datetime)
            ->getQuery()
            ->getResult();
    }

    public function remove(RefreshToken $token, bool $flush = false): void
    {
        $this->em->remove($token);
        if ($flush) {
            $this->em->flush();
        }
    }

    public function findByUsername(string $username): array
    {
        return $this->findBy(['username' => $username]);
    }
}
