<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

/**
 * Class Date
 * @package App\Helpers
 */
class Date
{
    /**
     * @param Carbon|null $date
     * @param string $format
     * @return null|string
     */
    public static function getFormatted(?Carbon $date, string $format): ?string
    {
        return $date instanceof Carbon ? $date->format($format) : null;
    }
}
