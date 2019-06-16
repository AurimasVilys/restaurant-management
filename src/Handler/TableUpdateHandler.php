<?php

namespace App\Handler;

use App\DataTransferObject\TableDTO;
use App\Entity\Table;
use Doctrine\ORM\EntityManagerInterface;

class TableUpdateHandler implements UpdateHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * TableUpdateHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Table $object
     * @param TableDTO $state
     * @return void
     */
    public function update($object, $state)
    {
        $object
            ->setNumber($state->getNumber())
            ->setCapacity($state->getCapacity())
            ->setActive($state->isActive())
            ->setRestaurant($state->getRestaurant());
        $this->entityManager->flush();
    }
}
