<?php

use Del\Common\ContainerService;
use Del\Common\Config\DbCredentials;

$array = require_once '.migrant';
$creds = new DbCredentials($array['db']);

return ContainerService::getInstance()
    ->setDbCredentials($creds)
    ->addEntityPath('src/Entity')
    ->getContainer();



