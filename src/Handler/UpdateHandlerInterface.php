<?php

namespace App\Handler;

interface UpdateHandlerInterface
{
    /**
     * @param $object mixed
     * @param $state
     */
    public function update($object, $state);
}
