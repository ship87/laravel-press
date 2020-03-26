<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;

/**
 * Class BaseController
 * @package App\Admin\Controllers
 */
class BaseController extends AdminController
{
    /**
     * @var int
     */
    protected $editId = 0;

    /**
     * @inheritdoc
     */
    public function edit($id, Content $content)
    {
        $this->editId = $id;

        return parent::edit($id, $content);
    }
}
