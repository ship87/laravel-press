<?php

namespace App\Admin\Controllers\Seo;

use App\Admin\Controllers\BaseController;
use Encore\Admin\Form;
use Encore\Admin\Form\Tools;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Common\Setting\Models\Setting;

/**
 * Class RobotsController
 * @package App\Admin\Controllers\Seo
 */
class RobotsController extends BaseController
{
    /**
     * RobotsController constructor.
     */
    public function __construct()
    {
        $this->title = __('admin.Edit robots.txt');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Setting());
        $grid->model()->where('name', 'robots');

        $grid->column('value', __('admin.Value'));
        $grid->column('updated_at', __('admin.Updated At'));

        $grid->disablePagination();
        $grid->disableCreateButton();
        $grid->disableFilter();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableDelete();
            $actions->disableView();
            $actions->disableView();
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Setting::findOrFail($id));

        $show->field('id', __('admin.Id'));
        $show->field('name', __('admin.Name'));
        $show->field('value', __('admin.Value'));
        $show->field('created_at', __('admin.Created At'));
        $show->field('updated_at', __('admin.Updated At'));

        $show->panel()->tools(function (Show\Tools $tools) {
            $tools->disableDelete();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Setting());

        $form->textarea('value', __('admin.Value'));

        $form->tools(function (Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });

        return $form;
    }
}
