<?php

namespace App\Utils;

class PaginationUtils implements PaginationUtilsInterface
{
    public function getPageInput($value)
    {
        $page = $value !== null ?  $value : 1;
        $page = ctype_digit($page) ? $page : 1;
        $page = $page > 0 ? $page : 1;

        return $page;
    }
}
