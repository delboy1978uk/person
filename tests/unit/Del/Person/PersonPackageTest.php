<?php

namespace DelTesting\Person;

use Codeception\Test\Unit;
use Del\Person\PersonPackage;
use Del\Person\Service\PersonService;
use DelTesting\ContainerProvider;
use Doctrine\ORM\EntityManager;

class PersonPackageTest extends Unit
{
    private $container;

    protected function _before()
    {
        $this->container =  ContainerProvider::getContainer();
        $this->container[EntityManager::class] =  $this->makeEmpty(EntityManager::class);
        $package = new PersonPackage();
        $package->addToContainer($this->container);
    }

    public function testPersonServiceHasRegistered()
    {
        $svc = $this->container[PersonService::class];
        $this->assertInstanceOf(PersonService::class, $svc);
    }
}
