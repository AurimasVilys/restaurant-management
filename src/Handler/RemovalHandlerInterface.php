<?php

namespace App\Handler;

interface RemovalHandlerInterface
{
    /**
     * @param $object mixed
     * @return mixed
     */
    public function remove($object);
}
