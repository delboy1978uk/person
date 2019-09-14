<?php

namespace Del\Person;

use Del\Common\Container\RegistrationInterface;
use Del\Person\Service\PersonService;
use Barnacle\Container;

class PersonPackage implements RegistrationInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        $function = function($c) {
            return new PersonService($c);
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