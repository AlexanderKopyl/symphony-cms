<?php

namespace App\UserDomain\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use Gesdinet\JWTRefreshTokenBundle\Entity\RefreshToken as BaseRefreshToken;

#[ORM\Entity]
#[ORM\Table(name: 'refresh_tokens')]
class RefreshToken extends BaseRefreshToken
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    protected $id;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'string', nullable: false)]
    protected $refreshToken;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'string', nullable: false)]
    protected $username;

    /**
     * @var \DateTimeInterface|null
     */
    #[ORM\Column(type: 'datetime', nullable: false)]
    protected $valid;
}
