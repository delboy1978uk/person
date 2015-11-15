<?php

use Pimple\Container;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Del\Repository\Person as PersonRepository;

$container = new Container();

$container['doctrine.entity_manager'] = $container->factory(function ($c) {

    $paths = [__DIR__ . "/Entity"];

    $isDevMode = false;

    $dbParams = $c['db.credentials'];

    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
    $entityManager = EntityManager::create($dbParams, $config);

    return $entityManager;
});

// Repositories
$container['repository.person'] = $container->factory(function ($c) {
    /** @var EntityManager $em */
    $em = $c['doctrine.entity_manager'];
    /** @var PersonRepository $repo */
    $repo = $em->getRepository('Del\Entity\Person');
    return $repo;
});

return $container;
