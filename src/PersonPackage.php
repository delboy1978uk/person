<?php

namespace Del\Person;

use Barnacle\Container;
use Barnacle\EntityRegistrationInterface;
use Barnacle\RegistrationInterface;
use Del\Person\Service\PersonService;
use Doctrine\ORM\EntityManager;

class PersonPackage implements RegistrationInterface, EntityRegistrationInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        $function = function(Container $c) {
            $entityManager = $c->get(EntityManager::class);

            return new PersonService($entityManager);
        };

        $c[PersonService::class] = $c->factory($function);
    }

    /**
     * @return string
     */
    public function getEntityPath(): string
    {
        return 'vendor/delboy1978uk/person/src/Entity';
    }

    /**
     * @return bool
     */
    public function hasEntityPath(): bool
    {
        return true;
    }


}