<?php

namespace App\Handler;

use App\DataTransferObject\RestaurantDTO;
use App\DataTransferObjectTransformer\TransformerInterface;
use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;

class RestaurantCreationHandler implements CreationHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var TransformerInterface
     */
    private $restaurantTransformer;

    /**
     * RestaurantCreationHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param TransformerInterface $restaurantTransformer
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        TransformerInterface $restaurantTransformer
    ) {
        $this->entityManager = $entityManager;
        $this->restaurantTransformer = $restaurantTransformer;
    }

    /**
     * @param RestaurantDTO $object
     * @return Restaurant
     */
    public function create($object)
    {
        /** @var Restaurant $restaurant */
        $restaurant = $this->restaurantTransformer->reverseTransform($object);
        $this->entityManager->persist($restaurant);
        $this->entityManager->flush();
        return $restaurant;
    }
}
