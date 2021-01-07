@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">更新客户信息</div>

                <div class="card-body">
                    {!!Form::errors("提交的数据没有通过检查")!!}
                    {!!Form::open()->route('customer.update',['customer'=>$id])->method('put')->errorBag("updateCusErrorBag")!!}
                    {!!Form::hidden('salesman_id',$salesman_id)!!}
                    {!!Form::text('name', '姓名',$name)!!}
                    {!!Form::tel('phone', '手机号码',$phone)!!}
                    {!!Form::text('id_number', '身份证',$id_number)!!}
                    {!!Form::text('occupation', '职业',$occupation)!!}

                    <label for="sex">性别</label>
                    {!!Form::radio('sex', '女',$sex==0)!!}
                    {!!Form::radio('sex', '男',$sex==1)!!}
                    <div style="margin-top: 2rem">
                    {!!Form::submit("更新")!!}
                    {!!Form::reset("重置")->warning()!!}
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
