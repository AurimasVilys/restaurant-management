<?php

namespace App\Handler;

use App\DataTransferObject\RestaurantDTO;
use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;

class RestaurantUpdateHandler implements UpdateHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * RestaurantUpdateHandler constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Restaurant $object
     * @param RestaurantDTO $state
     * @return void
     * @throws \Exception
     */
    public function update($object, $state)
    {
        $object
            ->setTitle($state->getTitle())
            ->setUploadedPhoto($state->getUploadedPhoto())
            ->setActive($state->isActive())
            ->setUpdatedAt(new \DateTime('now'));
        $this->entityManager->flush();
    }
}
