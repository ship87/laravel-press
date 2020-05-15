<?php

namespace App\Admin\Controllers\Post;

use App\Admin\Controllers\BaseController;
use App\Helpers\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Common\Blog\Models\Category as CategoryModel;

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
        $grid->column('parent_id', __('admin.Parent page'))->display(function () {

            if (empty($this->parent_id)) {
                return null;
            }

            $url = route('admin.categories.edit', ['category' => $this->parent_id]);
            return '<a href="' . $url . '">' . $this->parent_id . '</a>';
        });

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
        if ($this->editId > 0) {
            $categories = CategoryModel::where('id', '!=', $this->editId)->pluck('title', 'id');
        } else {
            $categories = CategoryModel::pluck('title', 'id');
        }

        $form = new Form(new CategoryModel());

        $form->text('title', __('admin.Title'))->required();
        $form->text('slug', __('admin.Slug'))
            ->rules('nullable|regex:/^[a-z0-9-]+$/i|unique:categories,slug,{{id}}');
        $form->select('parent_id', __('admin.Parent page'))->options($categories);

        return $form;
    }
}
