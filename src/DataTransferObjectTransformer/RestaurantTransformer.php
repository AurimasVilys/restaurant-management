<?php

namespace App\DataTransferObjectTransformer;

use App\DataTransferObject\RestaurantDTO;
use App\Entity\Restaurant;

class RestaurantTransformer implements TransformerInterface
{
    /**
     * @param $object Restaurant
     * @return RestaurantDTO
     */
    public function transform($object)
    {
        $restaurant = new RestaurantDTO();
        $restaurant
            ->setTitle($object->getTitle())
            ->setActive($object->getActive())
            ->setUploadedPhoto($object->getUploadedPhoto());
        return $restaurant;
    }

    /**
     * @param $object RestaurantDTO
     * @return Restaurant
     */
    public function reverseTransform($object)
    {
        $restaurant = new Restaurant();
        $restaurant
            ->setTitle($object->getTitle())
            ->setActive($object->isActive())
            ->setUploadedPhoto($object->getUploadedPhoto());
        return $restaurant;
    }
}
