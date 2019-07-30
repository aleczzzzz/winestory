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
                            <div class="btn-group">
                                <form action="{{ route('order.landing.remove-from-cart', $key) }}" method="post" class="remove-form">
                                    @csrf()
                                    <a href="#" class="btn btn-primary edit-quantity" data-product-quantity="{{$product['quantity']}}" data-product-id="{{$key}}">Edit Quantity</a>
                                    <button type="submit" class="btn btn-danger remove">Remove</button>
                                </form>
                            </div>
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

@push('scripts')
    <script>
        $(function() {
            $('.remove').click(function(event){
                event.preventDefault();
                var x = false;
                $.confirm({
                    title: 'Are you sure?',
                    content: 'Are you sure you want to remove this from your cart?',
                    buttons: {
                        confirm: {
                                btnClass: 'btn-danger',
                                action: function () {
                                    $('.remove-form').submit();
                                }
                        },
                        cancel: function () {
                            
                        }
                    }
                });
            });
            $('.edit-quantity').click(function(){
                btn = this;
                $.confirm({
                    title: 'Edit Quantity',
                    content: '' +
                    '<form action="" class="edit-quantity-form">' +
                    '<div class="form-group">' +
                    '<label>Quantity</label>' +
                    '<input type="number" name="quantity" value="' + $(btn).data('product-quantity') + '" class="quantity form-control" min=1 required autofocus />' +
                    '</div>' +
                    '</form>',
                    buttons: {
                        formSubmit: {
                            text: 'Submit',
                            btnClass: 'btn-blue',
                            action: function() {
                                var q = this.$content.find('.quantity').val();

                                $.post("{{url('order/edit-cart')}}/" + $(btn).data('product-id'), {
                                    _token: "{{ csrf_token() }}",
                                    quantity: q
                                }).done(function(data) {
                                    location.reload();
                                });
                            }
                        },
                        cancel: function () {
                            //close
                        },
                    }
                });
            });
        });
    </script>
@endpush
