@extends('app')

@section('content')
    <div class="content">
        <div class="title m-b-md">
            Wine Story
        </div>

        <div class="links">
            <a href="{{ route('order.landing.index') }}">Order</a>
        </div>
    </div>
@endsection
