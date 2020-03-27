<?php

namespace App\Helpers;

/**
 * Class WordHelper
 * @package App\Helpers
 */
class WordHelper
{
    /**
     * @param null|string $string
     * @param int $length
     * @return string
     */
    public static function getPartString(?string $string, int $length)
    {
        if ($string === null) {
            return '';
        }

        return mb_substr($string, 0, $length);
    }
}
