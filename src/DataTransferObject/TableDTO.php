<?php

namespace App\DataTransferObject;

use App\Entity\Restaurant;
use Symfony\Component\Validator\Constraints as Assert;

class TableDTO
{
    /**
     * @var int
     * @Assert\NotNull()
     * @Assert\Positive(message="Capacity must be a positive number")
     */
    private $capacity;

    /**
     * @var int
     * @Assert\NotNull()
     * @Assert\Positive(message="Table must have a positive number")
     */
    private $number;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var Restaurant
     */
    private $restaurant;

    /**
     * @return int
     */
    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    /**
     * @param int $capacity
     * @return TableDTO
     */
    public function setCapacity(?int $capacity): self
    {
        $this->capacity = $capacity;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return TableDTO
     */
    public function setNumber(?int $number): self
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return TableDTO
     */
    public function setActive(?bool $active): self
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return Restaurant
     */
    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    /**
     * @param Restaurant $restaurant
     * @return TableDTO
     */
    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;
        return $this;
    }
}
