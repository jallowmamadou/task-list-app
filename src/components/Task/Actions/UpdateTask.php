<?php

namespace App\Features\Task\Actions;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface as Request;

class UpdateTask
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

    public function execute(int $id)
    {
        $body = json_decode($this->request->getBody(), true);

        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder->update('TaskModel', 'u')
            ->set('u.status', $queryBuilder->expr()->literal($body['status']))
            ->where('u.id = ?1')
            ->setParameter(1, $id)
            ->getQuery()
            ->execute();

        return $this->entityManager->find('TaskModel', $id)->toArray();
    }
}
