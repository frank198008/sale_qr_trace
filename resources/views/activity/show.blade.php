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
                        <div class="card-header">核销二维码</div>
                        <div class="card-body">
                            {!! QrCode::size(300)->backgroundColor(255,55,0)->generate($activity->link.'/verification'); !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
