<?php

ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

$container['db.credentials'] = array(
    'host' => '127.0.0.1',
    'port' => 3306,
    'dbname' => 'delboy1978uk',
    'user' => 'dbuser',
    'password' => '[123456]',
    'unix_socket' => '/var/run/mysqld/mysqld.sock',
    'driver' => 'pdo_mysql',
    'driverClass' => 'Del\Driver\MySql',
);

return $container;

