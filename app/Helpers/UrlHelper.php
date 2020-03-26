<?php

namespace App\Helpers;

use Illuminate\Support\Str as StrSupport;

/**
 * Class UrlHelper
 * @package App\Helpers
 */
class UrlHelper
{
    /**
     * @param array $models
     * @param string $nameCode
     * @param string $code
     * @param string $separator
     * @return string
     */
    public static function getUniqueSlugForModelCode(
        array $models,
        string $nameCode,
        string $code,
        $separator = '-'
    ): string {
        $slug = $checkCode = StrSupport::slug($code, $separator);

        for ($addNumber = 2; 1; $addNumber++) {

            foreach ($models as $model) {
                $check = $model::where($nameCode, $checkCode)->first();

                if ($check !== null) {
                    break;
                }
            }

            if (empty($check)) {
                break;
            }

            $checkCode = $slug . $separator . $addNumber;
            $addNumber++;
        }

        return $checkCode;
    }
}
