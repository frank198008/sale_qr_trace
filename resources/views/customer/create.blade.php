@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    {!!Form::open()->route('customer.store')->errorBag("createCusErrorBag")!!}
                    {!!Form::errors("提交的数据没有通过检查")!!}
                    {!!Form::hidden('salesman_id',$salesman_id)!!}
                    {!!Form::hidden('activity_id',$activity_id)!!}
                    {!!Form::text('name', '姓名')->required()!!}
                    {!!Form::tel('phone', '手机号码')->required()!!}
                    {!!Form::text('id_number', '身份证')!!}
                    {!!Form::text('occupation', '职业')!!}
                    <label for="sex">性别</label>
                    {!!Form::radio('sex', '男','1',true)!!}
                    {!!Form::radio('sex', '女','0',false)!!}
                    <div style="margin-top: 2rem">
                        {!!Form::submit("提交")!!}
                        {!!Form::reset("重置")->warning()!!}
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
