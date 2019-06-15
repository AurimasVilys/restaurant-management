<?php

namespace App\Handler;

use App\Entity\Table;
use Doctrine\ORM\EntityManagerInterface;

class TableRemovalHandler implements RemovalHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * TableRemovalHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Table $object
     * @return void
     */
    public function remove($object)
    {
        $this->entityManager->remove($object);
        $this->entityManager->flush();
    }
}
