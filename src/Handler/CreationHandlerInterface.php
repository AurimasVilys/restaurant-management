<?php

namespace App\Handler;

interface CreationHandlerInterface
{
    /**
     * @param mixed $object
     * @return mixed
     */
    public function create($object);
}
