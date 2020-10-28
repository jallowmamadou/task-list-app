<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration([__DIR__."/../src/database/models/"], $isDevMode, $proxyDir,
    $cache,
    $useSimpleAnnotationReader);

$conn = [
    'driver' => 'pdo_sqlite',
    'path'   => __DIR__.'/../database.sqlite',
];

$entityManager = EntityManager::create($conn, $config);

return ConsoleRunner::createHelperSet($entityManager);
