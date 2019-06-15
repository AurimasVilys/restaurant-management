<?php

namespace App\DataTransferObjectTransformer;

interface TransformerInterface
{
    /**
     * @param mixed $object
     * @return mixed
     */
    public function transform($object);

    /**
     * @param mixed $object
     * @return mixed
     */
    public function reverseTransform($object);
}
