<?php

namespace App\Handler;

interface CreationHandlerInterface
{
    /**
     * @param $object
     * @return mixed
     */
    public function create($object);
}
