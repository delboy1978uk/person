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
        $array = require_once
        $creds = new DbCredentials();

        return ContainerService::getInstance()
        ->setDbCredentials($creds)
        ->addEntityPath('src/Entity')
        ->getContainer();
    }
}
