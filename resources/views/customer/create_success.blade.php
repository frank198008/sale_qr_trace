@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">登记信息 [<a href="{{route('customer.edit',['customer'=>$customer->id])}}">更新</a>]</div>
                    <div class="card-body">
                        <p>姓名：{{$customer->name}}</p>
                        <p>电话：{{$customer->phone}}</p>
                        <p>身份证：{{$customer->id_number}}</p>
                        <p>职业：{{$customer->occupation}}</p>
                        <p>性别：{{$customer->sex?'男':'女'}}</p>
                    </div>
                    @if($activity)
                        <div class="card-header">活动信息</div>
                        <div class="card-body">
                            <p>活动名称：{{$activity->title}}</p>
                            <p>活动主题：{{$activity->theme}}</p>
                            <p>活动地点：{{$activity->address}}</p>
                            <p>开始时间：{{$activity->start}}</p>
                            <p>结束时间：{{$activity->end}}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
