<?php
namespace DelTesting;

use Del\Common\ContainerService;
use Del\Common\Config\DbCredentials;
use Barnacle\Container as PimpleContainer;

class DelTesting
{
    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public static function getContainer()
    {
        $creds = new DbCredentials();

        $containerSvc =  ContainerService::getInstance();
        $containerSvc->setDbCredentials($creds)
        ->addEntityPath('src/Entity')
        ->getContainer();
    }
}
