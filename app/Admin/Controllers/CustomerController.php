<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CustomerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '参与者';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Customer());

        $grid->column('id', __('ID'));
        $grid->column('name', __('姓名'));
        $grid->column('phone', __('手机'));
        $grid->column('id_number', __('身份证号'));
        $grid->column('occupation', __('职业'));
        $grid->column('sex', __('性别'));
        $grid->column('age', __('年龄'));
        $grid->column('register.name', __('登记人'));
//        $grid->column('status', __('状态'));

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
        $show = new Show(Customer::findOrFail($id));
        $show->field('id', __('ID'));
        $show->field('name', __('姓名'));
        $show->field('phone', __('手机'));
        $show->field('id_number', __('身份证号'));
        $show->field('occupation', __('职业'));
        $show->field('sex', __('性别'));
        $show->field('age', __('年龄'));
        $show->field('register.name', __('登记人'));
//        $show->field('status', __('状态'));
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
        $form = new Form(new Customer());

        $form->number('salesman_id', __('登记人ID'));
        $form->text('name', __('姓名'));
        $form->mobile('phone', __('手机'));
        $form->text('id_number', __('身份证'));
        $form->text('occupation', __('职业'));
        $form->radio('sex', __('性别'))->options([0 => '女', 1=> '男',2=>'?'])->default(2);
        $form->number('age', __('年龄'));
//        $form->switch('status', __('状态'))->states(['on'  => ['value' => 1],'off' => ['value' => 0]])->default(1);
        return $form;
    }
}
