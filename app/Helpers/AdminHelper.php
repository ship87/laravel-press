<?php

namespace App\Helpers;

use Encore\Admin\Grid;

/**
 * Class AdminHelper
 * @package App\Helpers
 */
class AdminHelper
{
    /**
     * @return array
     */
    public static function getSwitchOnOff()
    {
        return [
            'on' => ['value' => true, 'text' => __('admin.Yes')],
            'off' => ['value' => false, 'text' => __('admin.No')],
        ];
    }

    /**
     * @param Grid $grid
     * @return Grid
     */
    public static function addSortable(Grid $grid): Grid
    {
        foreach ($grid->columns() as $column) {
            $column->sortable();
        }

        return $grid;
    }
}
