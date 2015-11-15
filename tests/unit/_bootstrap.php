<?php

ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

$container['db.credentials'] = [
    'driver' => 'pdo_mysql',
    'dbname' => 'delboy1978uk',
    'user' => 'dbuser',
    'password' => '[123456]',
];

return $container;

