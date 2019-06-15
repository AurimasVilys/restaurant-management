<?php

namespace App\DataTransferObjectTransformer;

use App\DataTransferObject\TableDTO;
use App\Entity\Table;

class TableTransformer implements TransformerInterface
{
    /**
     * @param Table $object
     * @return TableDTO
     */
    public function transform($object)
    {
        $tableDTO = new TableDTO();
        $tableDTO
            ->setNumber($object->getNumber())
            ->setCapacity($object->getCapacity())
            ->setActive($object->getActive())
            ->setRestaurant($object->getRestaurant());

        return $tableDTO;
    }

    /**
     * @param TableDTO $object
     * @return Table
     */
    public function reverseTransform($object)
    {
        $table = new Table();
        $table
            ->setNumber($object->getNumber())
            ->setCapacity($object->getCapacity())
            ->setActive($object->isActive())
            ->setRestaurant($object->getRestaurant());

        return $table;
    }
}
