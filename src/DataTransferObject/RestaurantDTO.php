<?php

namespace App\DataTransferObject;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

class RestaurantDTO
{
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(max="255", maxMessage="Title can only contain up to {{ limit }} characters")
     */
    private $title;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var UploadedFile
     * @Assert\Image(
     *     maxSize="1024k",
     *     maxSizeMessage="File size exceeds limits. Limits - ({{ size }} {{ suffix }}).",
     *     mimeTypes="image/*",
     *     mimeTypesMessage="You can only upload images")
     *     )
     */
    private $uploadedPhoto;

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return RestaurantDTO
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;
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
     * @return RestaurantDTO
     */
    public function setActive(?bool $active): self
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getUploadedPhoto(): ?UploadedFile
    {
        return $this->uploadedPhoto;
    }

    /**
     * @param UploadedFile $uploadedPhoto
     * @return RestaurantDTO
     */
    public function setUploadedPhoto(?UploadedFile $uploadedPhoto): self
    {
        $this->uploadedPhoto = $uploadedPhoto;
        return $this;
    }
}
