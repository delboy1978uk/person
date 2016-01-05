<?php

use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Del\Container;

$container = Container::getContainer();

$container['db.credentials'] = [
    'driver' => 'pdo_mysql',
    'dbname' => 'delboy1978uk',
    'user' => 'dbuser',
    'password' => '[123456]',
];

// Fetch the entity Manager
$em = $container['doctrine.entity_manager'];

// Create the helperset
$helperSet = ConsoleRunner::createHelperSet($em);
$helperSet->set(new \Symfony\Component\Console\Helper\DialogHelper(),'dialog');



/** Migrations setup */

$configuration = new Configuration($em->getConnection());
$configuration->setMigrationsDirectory('migrations');
$configuration->setMigrationsNamespace('migrations');


$diff = new DiffCommand();
$exec = new ExecuteCommand();
$gen = new GenerateCommand();
$migrate = new MigrateCommand();
$status = new StatusCommand();
$ver = new VersionCommand();

$diff->setMigrationConfiguration($configuration);
$exec->setMigrationConfiguration($configuration);
$gen->setMigrationConfiguration($configuration);
$migrate->setMigrationConfiguration($configuration);
$status->setMigrationConfiguration($configuration);
$ver->setMigrationConfiguration($configuration);

$cli = ConsoleRunner::createApplication($helperSet,[
    $diff, $exec, $gen, $migrate, $status, $ver
]);

return $cli->run();

