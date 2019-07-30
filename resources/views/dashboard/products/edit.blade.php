@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Product
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.products.update', $product->id) }}" method="post">
                        @csrf()
                        @method('patch')
                        @include('dashboard.products.fields')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection