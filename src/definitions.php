<?php

use Pimple\Container;
use Doctrine\DBAL\DriverManager;
use Del\Service\Person as PersonService;
use Del\Repository\Person as PersonRepository;

$container = new Container();

$container['db.connection'] = $container->factory(function ($c) {
    return DriverManager::getConnection($c['db.credentials']);
});

// Repositories
$container['repository.person'] = $container->factory(function ($c) {
    return new PersonRepository($c['db.connection']);
});
