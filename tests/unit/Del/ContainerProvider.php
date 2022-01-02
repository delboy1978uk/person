<?php

namespace DelTesting;

use Barnacle\Container;

class ContainerProvider
{
    private function __construct(){}
    private function __clone(){}

    public static function getContainer()
    {
        static $inst = null;

        if ($inst === null) {
            $inst = new Container();
        }

        return $inst;
    }
}
