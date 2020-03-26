<?php

namespace App\Admin\Controllers\Post;

use App\Admin\Controllers\BaseController;
use App\Common\Page\Models\Category as CategoryModel;
use App\Common\Seo\Models\MetaTag as MetaTagModel;
use App\Helpers\AdminHelper;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Common\Page\Models\Post as PostModel;
use App\Common\Page\Models\Tag as TagModel;

/**
 * Class PostController
 * @package App\Admin\Controllers\Seo
 */
class PostController extends BaseController
{
    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->title = __('admin.Posts');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PostModel());

        $grid->column('id', __('admin.Id'));
        $grid->column('title', __('admin.Title'));
        $grid->column('slug', __('admin.Slug'));
        $grid->column('published', __('admin.Published'))->switch(AdminHelper::getSwitchOnOff());
        $grid->column('allow_comments', __('admin.Allow comments'))->switch(AdminHelper::getSwitchOnOff());
        $grid->column('published_at', __('admin.Published At'));
        $grid->column('created_at', __('admin.Created At'))->date('Y-m-d H:i:s');
        $grid->column('updated_at', __('admin.Updated At'))->date('Y-m-d H:i:s');

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
        $show = new Show(PostModel::findOrFail($id));

        $show->field('id', __('admin.Id'));
        $show->field('title', __('admin.Title'));
        $show->field('slug', __('admin.Slug'));
        $show->field('published', __('admin.Published'));
        $show->field('published_at', __('admin.Published At'));
        $show->field('created_at', __('admin.Created At'));
        $show->field('updated_at', __('admin.Updated At'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $categories = CategoryModel::pluck('title', 'id');
        $tags = TagModel::pluck('title', 'id');

        $form = new Form(new PostModel());

        $form->tab(__('admin.Main'), function ($form) use ($categories,$tags) {

            $form->text('title', __('admin.Title'))->required();
            $form->text('slug', __('admin.Slug'))
                ->rules('nullable|regex:/^[a-z0-9-]+$/i|unique:posts');
            $form->datetime('published_at', __('admin.Published At'));
            $form->summernote('content', __('admin.Content'));
            $form->switch('published', __('admin.Published'));
            $form->multipleSelect('categories', __('admin.Categories'))->options($categories);
            $form->multipleSelect('tags', __('admin.Tags'))->options($tags);
            $form->switch('allow_comments', __('admin.Allow comments'));

        })->tab(__('admin.SEO'), function ($form) {

            $form->text('meta_title', __('admin.Meta Title'))
                ->default(null)
                ->rules(MetaTagModel::getRulesValidationTitle());
            $form->text('meta_description', __('admin.Meta Description'))
                ->default(null)
                ->rules(MetaTagModel::getRulesValidationDescription());
            $form->text('meta_keywords', __('admin.Meta Keywords'))
                ->default(null)
                ->rules(MetaTagModel::getRulesValidationKeywords());
        });

        return $form;
    }
}
