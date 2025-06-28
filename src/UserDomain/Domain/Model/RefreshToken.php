<?php

namespace App\UserDomain\Domain\Model;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Gesdinet\JWTRefreshTokenBundle\Entity\RefreshToken as BaseRefreshToken;
use App\UserDomain\Infrastructure\Repository\RefreshTokenRepository;

#[ORM\Entity(repositoryClass: RefreshTokenRepository::class)]
#[ORM\Table(name: 'refresh_tokens')]
class RefreshToken extends BaseRefreshToken
{
    /**
     * @inheritdoc
     */
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    protected $id;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'string', nullable: true)]
    protected $refreshToken;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'string', nullable: true)]
    protected $username;

    /**
     * @var DateTimeInterface|null
     */
    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $valid;
}
