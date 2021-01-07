@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($activities as $act)
                <div class="row">{{$act->name}}</div>
                <div style="padding:1rem;background: white">
                    {!! QrCode::size(200)->backgroundColor(255,55,0)->generate(URL::to('/')."/customer/create?salesman_id=$salesman_id&activity_id=$act->id"); !!}
                </div>
            @endforeach
        </div>
    </div>
@endsection
