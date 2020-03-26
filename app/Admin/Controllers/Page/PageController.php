<?php

namespace App\Admin\Controllers\Page;

use App\Admin\Controllers\BaseController;
use App\Common\Seo\Models\MetaTag as MetaTagModel;
use App\Helpers\AdminHelper;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Common\Page\Models\Page as PageModel;

/**
 * Class PageController
 * @package App\Admin\Controllers\Seo
 */
class PageController extends BaseController
{
    /**
     * PageController constructor.
     */
    public function __construct()
    {
        $this->title = __('admin.Pages');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PageModel());

        $grid->column('id', __('admin.Id'));
        $grid->column('title', __('admin.Title'));
        $grid->column('slug', __('admin.Slug'));
        $grid->column('parent_id', __('admin.Parent page'))->display(function () {

            if (empty($this->parent_id)) {
                return null;
            }

            $url = route('admin.pages.edit', ['page' => $this->parent_id]);
            return '<a href="' . $url . '">' . $this->parent_id . '</a>';
        });
        $grid->column('published', __('admin.Published'))->switch(AdminHelper::getSwitchOnOff());
        $grid->column('allow_comments', __('admin.Allow comments'))->switch(AdminHelper::getSwitchOnOff());
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
        $show = new Show(PageModel::findOrFail($id));

        $show->field('id', __('admin.Id'));
        $show->field('title', __('admin.Title'));
        $show->field('slug', __('admin.Slug'));
        $show->field('published', __('admin.Published'));
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
        if ($this->editId > 0) {
            $pages = PageModel::where('id', '!=', $this->editId)->pluck('title', 'id');
        } else {
            $pages = PageModel::pluck('title', 'id');
        }

        $form = new Form(new PageModel());

        $form->tab(__('admin.Main'), function ($form) use ($pages) {

            $form->text('title', __('admin.Title'))->required();
            $form->text('slug', __('admin.Slug'))
                ->rules('nullable|regex:/^[a-z0-9-]+$/i|unique:pages');
            $form->select('parent_id', __('admin.Parent page'))->options($pages);
            $form->summernote('content', __('admin.Content'));
            $form->switch('published', __('admin.Published'));
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
