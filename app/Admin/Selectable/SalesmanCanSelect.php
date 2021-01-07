<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2021-01-06
 * Time: 22:05
 */

namespace App\Admin\Selectable;

use App\Models\Salesman;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class SalesmanCanSelect extends  Selectable
{
    public $model=Salesman::class;
    /**
     * @return Grid
     */
    public function make()
    {
        $this->model()->orderBy('created_at','desc');
        $this->column('name','姓名');
        $this->column('phone','手机号');
        $this->column('sex','性别')->using([0=>'女',1=>'男']);
        $this->column('created_at','创建时间');
        $this->filter(function (Filter $filter){
            $filter->like('name');
        });
    }
}