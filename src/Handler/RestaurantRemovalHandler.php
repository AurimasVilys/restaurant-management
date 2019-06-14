<?php

namespace App\Handler;

use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;

class RestaurantRemovalHandler implements RemovalHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * RestaurantRemovalHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Restaurant $object
     */
    public function remove($object)
    {
        $this->entityManager->remove($object);
        $this->entityManager->flush();
    }
}
