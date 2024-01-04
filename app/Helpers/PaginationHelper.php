<?php

namespace App\Helpers;

class PaginationHelper
{
    public static function calculatePaginationRange($currentPage, $lastPage, $range = 3)
    {
        $start = max($currentPage - $range, 1);
        $end = min($currentPage + $range, $lastPage);

        return [
            'start' => $start,
            'end' => $end,
        ];
    }
}
