<?php

namespace App\Admin\Controllers\Page;

use App\Admin\Controllers\BaseController;
use App\Common\Page\Models\Page as PageModel;
use App\Helpers\Admin;
use App\Helpers\Word;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Common\Comment\Models\Comment as CommentModel;

/**
 * Class PageCommentController
 * @package App\Admin\Controllers\Seo
 */
class PageCommentController extends BaseController
{
    /**
     * @var int
     */
    public const MAX_LENGTH_COMMENT = 100;

    /**
     * PageCommentController constructor.
     */
    public function __construct()
    {
        $this->title = __('admin.Pages comments');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CommentModel());
        $grid->model()->where('entity_type', (new PageModel())->getMorphClass());

        $grid->column('id', __('admin.Id'));
        $grid->column('author_name', __('admin.Author name'));
        $grid->column('author_email', __('admin.Author email'));
        $grid->column('content', __('admin.Content'))->display(function () {
            return strip_tags(Word::getPartString($this->content, self::MAX_LENGTH_COMMENT));
        });
        $grid->column('published', __('admin.Published'))->switch(Admin::getSwitchOnOff());
        $grid->column('created_at', __('admin.Created At'))->date('Y-m-d H:i:s');
        $grid->column('updated_at', __('admin.Updated At'))->date('Y-m-d H:i:s');

        $grid->filter(function ($filter) {
            $filter->like('author_name', __('admin.Author name'));
            $filter->like('author_email', __('admin.Author email'));
            $filter->like('content', __('admin.Content'));
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
