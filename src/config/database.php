<?php

declare(strict_types=1);

use DI\Container;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

return [
    EntityManager::class => function (Container $container): EntityManager {
        $config = Setup::createAnnotationMetadataConfiguration(
            [ROOT_PATH.'/src/database/models/'],
            true
        );

        $config->setMetadataDriverImpl(
            new AnnotationDriver(
                new AnnotationReader,
                [ROOT_PATH.'/src/database/models/']
            )
        );

        $config->setMetadataCacheImpl(
            new FilesystemCache(
                ROOT_PATH.'/cache'
            )
        );

        return EntityManager::create(
            [
                'driver' => 'pdo_sqlite',
                'path'   => __DIR__.'/../../database.sqlite',
            ],
            $config
        );
    }
];
