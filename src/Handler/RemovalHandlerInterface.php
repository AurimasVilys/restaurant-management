<?php

namespace App\Handler;

interface RemovalHandlerInterface
{
    /**
     * @param mixed $object
     * @return void
     */
    public function remove($object);
}
