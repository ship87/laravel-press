<?php

namespace App\Admin\Controllers\Post;

use App\Admin\Controllers\BaseController;
use App\Common\Page\Models\Post as PostModel;
use App\Helpers\AdminHelper;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Common\Comment\Models\Comment as CommentModel;

/**
 * Class PostCommentController
 * @package App\Admin\Controllers\Seo
 */
class PostCommentController extends BaseController
{
    /**
     * PostCommentController constructor.
     */
    public function __construct()
    {
        $this->title = __('admin.Posts comments');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CommentModel());
        $grid->model()->where('entity_type', (new PostModel())->getMorphClass());

        $grid->column('id', __('admin.Id'));
        $grid->column('author_name', __('admin.Author name'));
        $grid->column('author_email', __('admin.Author email'));
        $grid->column('content', __('admin.Content'));
        $grid->column('published', __('admin.Published'))->switch(AdminHelper::getSwitchOnOff());
        $grid->column('created_at', __('admin.Created At'))->date('Y-m-d H:i:s');
        $grid->column('updated_at', __('admin.Updated At'))->date('Y-m-d H:i:s');

        $grid->filter(function ($filter) {
            $filter->ilike('author_name', __('admin.Author name'));
            $filter->ilike('author_email', __('admin.Author email'));
            $filter->ilike('content', __('admin.Content'));
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
        $show = new Show(CommentModel::findOrFail($id));

        $show->field('id', __('admin.Id'));
        $show->field('author_name', __('admin.Author name'));
        $show->field('author_email', __('admin.Author email'));
        $show->field('content', __('admin.Content'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CommentModel());

        $form->textarea('content', __('admin.Content'));
        $form->switch('published', __('admin.Published'));
        $form->datetime('created_at', __('admin.Created At'));
        $form->datetime('updated_at', __('admin.Updated At'));

        return $form;
    }
}
