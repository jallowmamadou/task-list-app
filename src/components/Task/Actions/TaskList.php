<?php

namespace App\Features\Task\Actions;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Psr\Http\Message\ServerRequestInterface as Request;

class TaskList
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
        $status = $this->request->getQueryParams()['status'] ?? 'IN-PROGRESS';

        $query = $this->entityManager->createQuery('SELECT u FROM TaskModel u where u.status = :status order by u.created_at desc');

        $query->setParameter('status', $status);

        return $query->getResult(Query::HYDRATE_ARRAY); // array of CmsUser ids
    }
}
