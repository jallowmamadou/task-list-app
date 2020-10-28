<?php

namespace App;

use DI\Bridge\Slim\Bridge;
use DI\Container;
use DI\ContainerBuilder;
use Exception;
use Slim\App;

class Application
{
    /**
     * Starts the application.
     *
     * @param $rootPath
     * @return App
     * @throws Exception
     */
    public static function start($rootPath)
    {
        $container = self::setupContainer($rootPath);

        $app = Bridge::create($container);

        $app->addErrorMiddleware(true, true, false);

        return $app;
    }

    /**
     * @param $rootPath
     * @return Container
     * @throws Exception
     */
    public static function setupContainer($rootPath): Container
    {
        $containerBuilder = new ContainerBuilder();

        $containerBuilder->addDefinitions($rootPath.'/src/config/http.php');
        $containerBuilder->addDefinitions($rootPath.'/src/config/database.php');

        return $containerBuilder->build();
    }
}


