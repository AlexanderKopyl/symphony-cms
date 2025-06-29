<?php

namespace App\UserDomain\Domain\Repository;

use App\UserDomain\Domain\Model\RefreshToken;
use Gesdinet\JWTRefreshTokenBundle\Doctrine\RefreshTokenRepositoryInterface as JWTRefreshTokenRepositoryInterface;

interface RefreshTokenRepositoryInterface extends JWTRefreshTokenRepositoryInterface
{
    /**
     * @return RefreshToken[]
     */
    public function findByUsername(string $username): array;

    public function remove(RefreshToken $token, bool $flush = false): void;
}
