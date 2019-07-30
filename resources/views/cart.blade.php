@extends('app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>SubTotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $key => $product)
                    <tr>
                        <td>{{$product['name']}}</td>
                        <td>{{$product['price']}}</td>
                        <td>{{$product['quantity']}}</td>
                        <td>{{number_format($product['price'] * $product['quantity'], 2)}}</td>
                        <td>
                            <a href="{{ route('order.landing.remove-from-cart', $key) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Remove</a>
                        </td>
                    </tr>
                @empty

                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right">Total :</td>
                    <td>{{number_format($subtotal, 2)}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td>
                        <form action="{{ route('order.landing.checkout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary {{count(session()->get('cart.products', [])) < 1 ? 'disabled' : ''}}">Checkout</button>
                        </form>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
