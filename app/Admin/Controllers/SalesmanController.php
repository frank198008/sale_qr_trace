<?php

namespace App\Admin\Controllers;

use App\Models\Salesman;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SalesmanController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '销售员';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Salesman());

        $grid->column('id', __('ID'))->hide();
        $grid->column('name', __('姓名'));
        $grid->column('id_number', __('身份证'));
        $grid->column('work_id', __('工号'));
        $grid->column('nickname', __('昵称'));
        $grid->column('sex', __('性别'))->using([
            0 => '女',
            1 => '男',
            2 => '?',
        ]);
        $grid->column('phone', __('手机号'));
        $grid->column('status', __('状态'))->using([
            0 => '离职',
            1 => '在职'
        ]);;
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
        $show = new Show(Salesman::findOrFail($id));
        $show->field('id', __('ID'));
        $show->field('id_number', __('身份证'));
        $show->field('work_id', __('工号'));
        $show->field('name', __('姓名'));
        $show->field('nickname', __('昵称'));
        $show->field('sex', __('性别'));
        $show->field('phone', __('手机号'));
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
        $states = [
            'on' => ['value' => 1],
            'off' => ['value' => 0],
        ];
        $form = new Form(new Salesman());
        $form->text('name', __('姓名'))->rules('required|min:2');
        $form->text('nickname', __('昵称'));
        $form->text('work_id', __('工号'));
        $form->text('id_number', __('身份证'))->rules(['required', 'regex:/^\d{17}([0-9]|x|X)$/'], ['regex' => '必须符合身份证格式']);
        $form->mobile('phone', __('手机号'))->rules(
            [
                'required',
                'regex:/^1[34578]\d{9}$/',
                'unique:salesmen'
            ],
            [
                'required' => '请输入手机号',
                'regex' => '手机号格式不正确',
                'unique' => '手机号已存在'
            ]);
        $form->radio('sex', __('性别'))->options([0 => '女', 1 => '男', 2 => '?'])->default(2);
        $form->switch('status', __('状态'))->states(['on' => ['value' => 1], 'off' => ['value' => 0]])->default(1);

        return $form;
    }
}
