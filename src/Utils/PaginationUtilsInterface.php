<?php

namespace App\Utils;

interface PaginationUtilsInterface
{
    public const PAGE_SIZE = 5;

    public function getPageInput($value);
}
