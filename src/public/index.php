<?php


use App\Application;
use App\Features\Task\Http\Controllers\HomeController;
use App\Features\Task\Http\Controllers\TasksController;

define('ROOT_PATH', __DIR__.'/../..');

require_once ROOT_PATH.'/vendor/autoload.php';

$app = Application::start(ROOT_PATH);

$app->post('/tasks/{id}', TasksController::class.'::update');
$app->get('/tasks', TasksController::class.'::index');
$app->post('/tasks', TasksController::class.'::store');
$app->get('/', HomeController::class.'::index');

$app->run();
