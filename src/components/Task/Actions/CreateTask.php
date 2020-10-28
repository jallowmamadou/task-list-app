<?php

namespace App\Features\Task\Actions;

use Carbon\Carbon;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface as Request;
use TaskModel;

class CreateTask
{
    private $request;
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * CreateTask constructor.
     * @param  Request  $request
     * @param  EntityManager  $entityManager
     */
    public function __construct(Request $request, EntityManager $entityManager)
    {
        $this->request = $request;
        $this->entityManager = $entityManager;
    }

    public function execute()
    {
        $body = json_decode($this->request->getBody(), true);

        $created = TaskModel::create([
            'title'       => $body['title'],
            'description' => $body['description'],
            'status'      => 'PENDING',
            'due_date'    => $body['due_date'] ? Carbon::parse($body['due_date']) : null,
        ]);

        $this->entityManager->persist($created);

        $this->entityManager->flush();

        return $this->entityManager->find('TaskModel', $created->getId())->toArray();
    }
}
