<?php

namespace DelTesting\Person;

use Del\Common\ContainerService;
use Del\Common\Config\DbCredentials;
use Del\Person\PersonPackage;

class PersonPackageTest extends \Codeception\TestCase\Test
{
    private $container;

    protected function _before()
    {
        $db = new DbCredentials();
        $package = new PersonPackage();
        $containerService = ContainerService::getInstance();
        $containerService->registerToContainer($db);
        $containerService->registerToContainer($package);
        $this->container = $containerService->getContainer();
    }

    protected function _after()
    {

    }

    public function testPersonServiceHasRegistered()
    {
        $svc = $this->container['service.person'];
        $this->assertInstanceOf('Del\Person\Service\PersonService', $svc);
    }

}
