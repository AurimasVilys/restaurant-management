<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RestaurantRepository")
 * @Vich\Uploadable
 */
class Restaurant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $photo;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $active;

    /**
     * @Vich\UploadableField(mapping="restaurant_image", fileNameProperty="photo")
     * @var File
     */
    private $uploadedPhoto;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Restaurant
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string|null $photo
     * @return Restaurant
     */
    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return Restaurant
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getUploadedPhoto(): ?File
    {
        return $this->uploadedPhoto;
    }

    /**
     * @param File $uploadedPhoto
     * @return Restaurant|null
     */
    public function setUploadedPhoto(?File $uploadedPhoto): self
    {
        $this->uploadedPhoto = $uploadedPhoto;
        return $this;
    }
}
