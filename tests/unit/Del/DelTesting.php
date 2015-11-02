<?php
namespace DelTesting;

use Del\Container;
use Pimple\Container as PimpleContainer;

class DelTesting
{
    /**
     * @return PimpleContainer
     */
    public static function getContainer()
    {
        $container = Container::getContainer();
        $container = include __DIR__ . '/../_bootstrap.php';
        return $container;
    }
}
