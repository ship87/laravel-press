<?php

namespace App\Common\Setting\Services;

use App\Common\Setting\Models\Setting as SettingModel;

/**
 * Class Setting
 * @package App\Common\Setting\Services
 */
class Setting
{
    /**
     * @param string $name
     * @return SettingModel|null
     */
    public function getByName(string $name): ?SettingModel
    {

        return SettingModel::whereName($name)->first();
    }
}