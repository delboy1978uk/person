<?php

ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

use Del\Common\ContainerService;
use Del\Common\Config\DbCredentials;

$array = require_once 'migrant-cfg.php';
$creds = new DbCredentials($array['db']);

return ContainerService::getInstance()
    ->setDbCredentials($creds)
    ->addEntityPath('src/Entity')
    ->getContainer();



