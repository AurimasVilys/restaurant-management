<?php

namespace App\Handler;

interface RemovalHandlerInterface
{
    /**
     * @param mixed $object
     * @return mixed
     */
    public function remove($object);
}
