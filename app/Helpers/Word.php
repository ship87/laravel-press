<?php

namespace App\Helpers;

/**
 * Class Word
 * @package App\Helpers
 */
class Word
{
    /**
     * @param null|string $string
     * @param int $length
     * @return string
     */
    public static function getPartString(?string $string, int $length, string $lineBreak = ''): string
    {
        if ($string === null) {
            return '';
        }

        return mb_substr($string, 0, $length) . $lineBreak;
    }
}
