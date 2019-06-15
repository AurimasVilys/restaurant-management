<?php

namespace App\Handler;

interface UpdateHandlerInterface
{
    /**
     * @param mixed $object
     * @param mixed $state
     */
    public function update($object, $state);
}
