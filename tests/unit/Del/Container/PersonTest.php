<?php

namespace Del\Container;

use Del\Common\ContainerService;

class PersonTest extends \Codeception\TestCase\Test
{
    private $container;

    protected function _before()
    {
        // Repository was registered into container in test bootstrap file
        $this->container = ContainerService::getInstance()->getContainer();
    }

    protected function _after()
    {

    }

    public function testPersonRepositoryHasRegistered()
    {
        $repo = $this->container['repository.person'];
        $this->assertInstanceOf('Del\Repository\Person', $repo);
    }

}
