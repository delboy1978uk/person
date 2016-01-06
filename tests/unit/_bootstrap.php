<?php

ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

use Del\Config\Container\Person as PersonConfig;
use Del\Common\ContainerService;
use Del\Common\Config\DbCredentials;


$containerService = ContainerService::getInstance();

$db = new DbCredentials();
$config = new PersonConfig();
$containerService->registerToContainer($db);
$containerService->registerToContainer($config);



