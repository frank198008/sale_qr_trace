<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Customer;
use App\Models\Salesman;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\InfoBox;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('首页')
            ->description('Description...')
            ->row(function (Row $row) {
                $row->column(4, function (Column $column) {
                    $cnt = Activity::recently()->count();
                    $column->append(new InfoBox('最近活动', 'list', 'aqua', '/admin/activities', $cnt));
                });

                $row->column(4, function (Column $column) {
                    $cnt = Salesman::recently()->count();
                    $column->append(new InfoBox('新的推广人员', 'cloud-upload', 'red', '/admin/salesmen', $cnt));
                });

                $row->column(4, function (Column $column) {
                    $cnt = Customer::recently()->count();
                    $column->append(new InfoBox('新的客户', 'dollar', 'green', '/admin/customers', $cnt));
                });
            })
            ->row(new Box("使用说明",view('help')));
    }
}
