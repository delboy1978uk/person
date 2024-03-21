<?php

declare(strict_types=1);

namespace Del\Person;

use Barnacle\Container;
use Barnacle\EntityRegistrationInterface;
use Barnacle\RegistrationInterface;
use Del\Person\Service\PersonService;
use Doctrine\ORM\EntityManager;

class PersonPackage implements RegistrationInterface, EntityRegistrationInterface
{
    public function addToContainer(Container $c): void
    {
        $function = function(Container $c) {
            $entityManager = $c->get(EntityManager::class);

            return new PersonService($entityManager);
        };

        $c[PersonService::class] = $c->factory($function);
    }

    public function getEntityPath(): string
    {
        return 'vendor/delboy1978uk/person/src/Entity';
    }
}
