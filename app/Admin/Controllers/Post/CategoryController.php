<?php

namespace App\Admin\Controllers\Post;

use App\Admin\Controllers\BaseController;
use App\Helpers\AdminHelper;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Common\Page\Models\Category as CategoryModel;

/**
 * Class CategoryController
 * @package App\Admin\Controllers\Seo
 */
class CategoryController extends BaseController
{
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->title = __('admin.Categories');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CategoryModel());

        $grid->column('id', __('admin.Id'));
        $grid->column('title', __('admin.Title'));
        $grid->column('slug', __('admin.Slug'));

        $grid->filter(function ($filter) {
            $filter->ilike('title', __('admin.Title'));
            $filter->ilike('slug', __('admin.Slug'));
        });

        $grid = AdminHelper::addSortable($grid);

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
        $show = new Show(CategoryModel::findOrFail($id));

        $show->field('id', __('admin.Id'));
        $show->field('title', __('admin.Title'));
        $show->field('slug', __('admin.Slug'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CategoryModel());

        $form->text('title', __('admin.Title'))->required();
        $form->text('slug', __('admin.Slug'))
            ->rules('nullable|regex:/^[a-z0-9-]+$/i|unique:categories');

        return $form;
    }
}
