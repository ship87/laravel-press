<?php

namespace App\Helpers;

/**
 * Class App
 * @package App\Helpers
 */
class App
{
    /**
     * @return string
     */
    public static function getLocale()
    {
        return str_replace('_', '-', app()->getLocale());
    }
}
