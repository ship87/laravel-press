<?php

namespace App\Admin\Controllers\Post;

use App\Admin\Controllers\BaseController;
use App\Helpers\Admin;
use App\Common\Blog\Models\Tag as TagModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

/**
 * Class TagController
 * @package App\Admin\Controllers\Seo
 */
class TagController extends BaseController
{
    /**
     * TagController constructor.
     */
    public function __construct()
    {
        $this->title = __('admin.Tags');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TagModel());

        $grid->column('id', __('admin.Id'));
        $grid->column('title', __('admin.Title'));
        $grid->column('slug', __('admin.Slug'));

        $grid->filter(function ($filter) {
            $filter->like('title', __('admin.Title'));
            $filter->like('slug', __('admin.Slug'));
        });

        $grid = Admin::addSortable($grid);

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
        $show = new Show(TagModel::findOrFail($id));

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
        $form = new Form(new TagModel());

        $form->text('title', __('admin.Title'))->rules('required|unique:tags,title,{{id}}');
        $form->text('slug', __('admin.Slug'))
            ->rules('nullable|regex:/^[a-z0-9-]+$/i|unique:tags,slug,{{id}}');

        return $form;
    }
}
