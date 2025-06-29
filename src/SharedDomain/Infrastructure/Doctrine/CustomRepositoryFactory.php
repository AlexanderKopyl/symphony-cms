<?php

declare(strict_types=1);

namespace App\SharedDomain\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Repository\RepositoryFactory;
use Psr\Container\ContainerInterface;

class CustomRepositoryFactory implements RepositoryFactory
{
    private array $repositories = [];

    public function __construct(
        private readonly ContainerInterface $container,
        private readonly array $repositoryServiceMap = [],
    ) {
    }

    public function getRepository(EntityManagerInterface $entityManager, string $entityName): EntityRepository
    {
        $repositoryHash = $entityManager->getClassMetadata($entityName)->getName().spl_object_id($entityManager);

        if (!isset($this->repositories[$repositoryHash])) {
            if (isset($this->repositoryServiceMap[$entityName])) {
                $repositoryService = $this->container->get($this->repositoryServiceMap[$entityName]);
                $this->repositories[$repositoryHash] = $repositoryService;
            } else {
                $metadata = $entityManager->getClassMetadata($entityName);
                $repositoryClassName = $metadata->customRepositoryClassName
                    ?: $entityManager->getConfiguration()->getDefaultRepositoryClassName();
                $this->repositories[$repositoryHash] = new $repositoryClassName($entityManager, $metadata);
            }
        }

        return $this->repositories[$repositoryHash];
    }
}
