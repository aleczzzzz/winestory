@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">&#xE894;</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">
                        Products
                    </h4>
                    <a class="btn btn-primary btn-sm" href="{{route('dashboard.products.create')}}">
                        <i class="material-icons">add</i> 
                        Add Product
                        <div class="ripple-container"></div>
                    </a>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td class="td-actions">
                                            <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post" class="delete-form">
                                                @csrf()
                                                @method('delete')
                                                    <a href="{{ route('dashboard.products.edit', $product->id) }}" class='btn btn-primary'>
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <button type="submit" class="btn btn-danger delete">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No Records Yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection