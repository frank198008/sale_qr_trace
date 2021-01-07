<?php

namespace App\Admin\Controllers;

use App\Admin\Selectable\SalesmanCanSelect;
use App\Models\Activity;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;

class ActivityController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '活动';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Activity());

        $grid->column('id', __('ID'))->hide();
        $grid->column('link','活动二维码')->qrcode();
        $grid->column('theme', __('主题'));
        $grid->column('title', __('活动名称'));
        $grid->column('address', __('地址'));
        $grid->column('start', __('开始时间'));
        $grid->column('end', __('结束时间'));
        $grid->column('status', __('状态'))->using([-1=>'作废',0=>'未启动',1=>'启动',2=>'进行中',3=>'结束']);
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));

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
        $show = new Show(Activity::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('theme', __('主题'));
        $show->field('title', __('活动名称'));
        $show->field('address', __('地址'));
        $show->field('start', __('开始时间'));
        $show->field('end', __('结束时间'));
        $show->field('status', __('状态'));
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Activity());
        $form->text('theme', __('主题'));
        $form->text('title', __('活动名称'));
        $form->text('address', __('地址'));
        $form->datetime('start', __('开始时间'))->default(date('Y-m-d H:i:s'));
        $form->datetime('end', __('结束时间'))->default(date('Y-m-d H:i:s'));
        $form->select('status','状态')->options([-1=>'作废',0=>'未启动',1=>'启动',2=>'进行中',3=>'结束']);
//        $form->datetimeRange($form->model()->start, $form->model()->end, '活动时间');
        $form->belongsToMany('salesmen',SalesmanCanSelect::class,'推广人');

        $form->saving(function ($form){
            if($form->start>$form->end){
                $error = new MessageBag([
                    'title'   => '起始日期不符合',
                    'message' => $form->start.'开始日期大于结束日期'.$form->end,
                ]);

                return back()->with(compact('error'));
            }
        });
        return $form;
    }
}
