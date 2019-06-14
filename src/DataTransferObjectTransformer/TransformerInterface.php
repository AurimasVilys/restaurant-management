<?php

namespace App\DataTransferObjectTransformer;

interface TransformerInterface
{
    /**
     * @param $object mixed
     * @return mixed
     */
    public function transform($object);

    /**
     * @param $object mixed
     * @return mixed
     */
    public function reverseTransform($object);
}
