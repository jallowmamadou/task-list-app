<?php

use App\Application;
use App\Features\Task\Actions\CreateTask;
use App\Features\Task\Actions\TaskList;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Slim\Psr7\Factory\ServerRequestFactory;

final class TodoListTest extends TestCase
{
    /***
     * @var \Psr\Container\ContainerInterface|null
     */
    protected $container;

    /**
     * @var \Slim\App
     */
    protected $app;

    /**
     * @test
     * @dataProvider
     */
    public function it_can_create_a_new_tasks()
    {
        $task = createFake();

        $request = $this->createJsonRequest('POST', 'http://localhost:8080/tasks', [
            'title'       => $task['title'],
            'description' => $task['description'],
        ]);

        $createTask = new CreateTask($request, $this->container->get(EntityManager::class));

        $newTask = $createTask->execute();

        $this->assertNotNull($newTask['id']);
        $this->assertEquals($task['title'], $newTask['title']);

        return $newTask;
    }

    /**
     * Create a JSON request.
     *
     * @param  string  $method  The HTTP method
     * @param  string|UriInterface  $uri  The URI
     * @param  array|null  $data  The json data
     *
     * @return ServerRequestInterface
     */
    protected function createJsonRequest(
        string $method,
        $uri,
        array $data = []
    ): ServerRequestInterface {
        $request = (new ServerRequestFactory())
            ->createServerRequest($method, $uri, []);

        if ($data !== null) {
            $request->getBody()->write(json_encode($data));
        }

        return $request->withHeader('Content-Type', 'application/json');
    }

    /**
     * @test
     * @depends it_can_create_a_new_tasks
     */
    public function it_can_list_todo_tasks()
    {
        $request = $this->createJsonRequest('GET', 'http://localhost:8080/tasks');

        $taskList = new TaskList($request, $this->container->get(EntityManager::class));

        $list = $taskList->execute();

        $this->assertGreaterThan(1, count($list));
    }

    /**
     * Bootstrap app.
     *
     * @return void
     * @throws UnexpectedValueException|Exception
     *
     */
    protected function setUp(): void
    {
        parent::setup();

        define('ROOT_PATH', __DIR__.'/..');

        $this->app = Application::start(__DIR__.'/..');

        $container = $this->app->getContainer();

        $this->container = $container;
    }

}
