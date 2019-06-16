<?php

namespace App\Handler;

interface UpdateHandlerInterface
{
    /**
     * @param mixed $object
     * @param mixed $state
     * @return void
     */
    public function update($object, $state);
}
