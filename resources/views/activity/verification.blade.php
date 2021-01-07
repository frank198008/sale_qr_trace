@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    @if($activity)
                        <div class="card-header">活动信息</div>
                        <div class="card-body">
                            <p>活动名称：{{$activity->title}}</p>
                            <p>活动主题：{{$activity->theme}}</p>
                            <p>活动地点：{{$activity->address}}</p>
                            <p>开始时间：{{$activity->start}}</p>
                            <p>结束时间：{{$activity->end}}</p>
                        </div>
                        <div class="card-header">核销</div>
                        <div class="card-body">
                            {!!Form::open()->method('post')->route('activity.verify',$activity->id)->errorBag("actVerifyErrorBag")!!}
                            {!!Form::errors("你提交的手机号码没有通过检查")!!}
                            {!!Form::tel('phone', '所登记的手机号')->required()!!}
                            {!!Form::submit("核销")!!}
                            {!!Form::close()!!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
