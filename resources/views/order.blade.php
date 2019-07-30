@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            @forelse($products as $product)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Price: {{ $product->price }}</p>
                            <label for="quantity">Quantity :</label>
                            <input type="text" name="quantity" class="quantity form-control" value="1" min="1">
                            <a class="btn btn-primary add-to-cart mt-2 text-light" data-product-id="{{ $product->id }}">Add to Cart</a>
                        </div>
                    </div>
                </div>
            @empty

            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $( document ).ready(function() {
            $('.add-to-cart').click(function(){
                $.ajax({
                    type: 'POST',
                    url: "{{ route('order.landing.add-to-cart') }}",
                    data: {
                        '_token' : "{{ csrf_token() }}",
                        'product_id' : $(this).data('product-id'),
                        'quantity' : $(this).prev('.quantity').val()
                    },
                    success: function (data) {
                        toastr.success('Product added to cart successfully.');
                        console.log(data.cart_total);
                        $('#cart-total').text(data.cart_total);
                    },
                    error: function (jqXhr, textStatus, errorMessage) {
                            console.log('asd');
                    }
                });
            });
        });
    </script>
@endpush