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
            $svc = new PersonService($c);
            return $svc;
        };

        $c['service.person'] = $c->factory($function);
    }

    /**
     * @return string
     */
    public function getEntityPath()
    {
        return 'vendor/delboy1978uk/person/src/Entity';
    }

    /**
     * @return bool
     */
    public function hasEntityPath()
    {
        return true;
    }


}