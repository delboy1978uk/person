<?php
namespace DelTesting;

use Del\Common\ContainerService;
use Del\Common\Config\DbCredentials;
use Pimple\Container as PimpleContainer;

class DelTesting
{
    /**
     * @return PimpleContainer
     */
    public static function getContainer()
    {
        return ContainerService::getInstance()
        ->setDbCredentials(new DbCredentials())
        ->addEntityPath('src/Entity')
        ->getContainer();
    }
}
