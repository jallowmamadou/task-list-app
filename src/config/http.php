<?php

declare(strict_types=1);

use App\Features\Task\Http\Controllers\HomeController;
use App\Features\Task\Http\Controllers\TasksController;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

return [
    TasksController::class => function (ContainerInterface $container) {
        return new TasksController($container->get(EntityManager::class));
    },
    HomeController::class  => function (ContainerInterface $container) {
        return new HomeController;
    }
];
