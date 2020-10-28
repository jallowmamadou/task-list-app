<?php

namespace App\Features\Task\Http\Controllers;

use App\Features\Task\Actions\CreateTask;
use App\Features\Task\Actions\TaskList;
use App\Features\Task\Actions\UpdateTask;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Throwable;

class TasksController
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Home page.
     *
     * @param  Request  $request
     * @param  Response  $response
     * @return Response
     * @throws Throwable
     */
    public function index(Request $request, Response $response)
    {
        $taskList = new TaskList($request, $this->entityManager);

        $response->getBody()->write(json_encode($taskList->execute()));

        return $response;
    }

    /**
     * Creates a new task.
     *
     * @param  Request  $request
     * @param  Response  $response
     * @param  array  $data
     * @return array|false|string
     */
    public function store(Request $request, Response $response)
    {
        $taskCreation = new CreateTask($request, $this->entityManager);

        $task = $taskCreation->execute();

        $response->getBody()->write(json_encode($task));

        return $response;
    }

    /**
     * Updates a task.
     *
     * @param $id
     * @param  Request  $request
     * @param  Response  $response
     * @return Response
     */
    public function update($id, Request $request, Response $response)
    {
        $taskCreation = new UpdateTask($request, $this->entityManager);

        $task = $taskCreation->execute($id);

        $response->getBody()->write(json_encode($task));

        return $response;
    }
}
