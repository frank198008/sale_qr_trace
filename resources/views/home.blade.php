@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div style="padding:1rem;background: white">
            {{--{{dd(request())}}--}}
            {!! QrCode::format('png')->merge(public_path('img/boy.png'), 0.2, true)->errorCorrection('H')->size(200)->backgroundColor(255,55,0)->generate(request()->getBaseUrl().'/'.Auth::user()->salesman->id); !!}
        </div>
    </div>
</div>
@endsection
