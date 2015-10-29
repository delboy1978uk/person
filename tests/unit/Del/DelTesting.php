<?php
namespace Del;

use Pimple\Container as PimpleContainer;
use Del\Container;

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
