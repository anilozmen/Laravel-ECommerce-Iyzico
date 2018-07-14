@extends('layouts/main')

@section('content')

    <!-- Checkout Content -->
    <div class="container-fluid no-padding checkout-content" style="margin-top: 40px;">
        <!-- Container -->
        <div class="container">
            <div class="row">
                <!-- Order Summary -->
                <div class="col-md-12 order-summary">
                    <div class="section-padding"></div>
                    <!-- Section Header -->
                    <div class="section-header">
                        <h3>BASKET</h3>
                    </div><!-- Section Header /- -->
                    <div class="order-summary-content">
                        @if(count(Cart::content())>0)
                            <table class="shop_cart">
                                <thead>
                                <tr>
                                    <th class="product-name">PRODUCT NAME</th>
                                    <th class="product-quantity">PRODUCT QUANTITY</th>
                                    <th class="product-price">UNIT PRICE</th>
                                    <th class="product-remove">TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Cart::content() as $productCartItem)
                                    <tr class="cart_item">


                                        <td data-title="{{$productCartItem->name}}" class="product-name">
                                            <a title="{{$productCartItem->name}}" href="{{ route('product', $productCartItem->options->slug) }}">
                                                {{$productCartItem->name}}
                                            </a>
                                        </td>
                                        <td data-title="Quantity" class="product-quantity">
                                            <div class="quantity">

                                                <input type="text" class="quantityf" data-id="{{ $productCartItem->rowId }}" value=" {{ $productCartItem->qty  }}">

                                             </div>
                                        </td>

                                        <td data-title="Total" class="product-subtotal">
                                            <span>{{$productCartItem->price}} ₺</span>
                                        </td>
                                        <td data-title="Total" class="product-remove">
                                            <span>{{($productCartItem->price) * ($productCartItem->qty) }} ₺</span>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <form action="{{route('basket.destroy')}}" method="POST">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <input type="submit" class="btn pull-left" value="CLEAR ALL">
                                        </form>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>

                            <!-- Proceed To Checkout -->
                            <div class="col-md-12 col-sm-12 text-right">
                                <div class="wc-proceed-to-checkout">
                                    <p>SUBTOTAL <span>{{ Cart::subtotal() }} + VAT</span></p>
                                    <p>TOTAL <span>{{ Cart::total() }} ₺ </span></p>

                                    <a href="{{route('payment')}}" class="red_button" title="CHECKOUT">CHECKOUT</a>
                                </div>
                            </div><!-- Proceed To Checkout /- -->

                        @else
                            <div class="container-fluid no-padding checkout-content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 order-summary">
                                            <div class="alert alert-danger text-center">
                                                <h2>No items in your basket !</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div><!-- Order Summary /- -->



            </div>

        </div><!-- Container /- -->
        <div class="section-padding"></div>
    </div><!-- Checkout Content /- -->
@endsection


@section('js')
    <script>
        $(function(){
            $('.quantityf').on('change', function() {
                var id = $(this).attr('data-id');
                toastr.options.timeOut = 4500;
                $.ajax({
                    type: "PATCH",
                    url: '{{ url('basket/update') }}' + '/' + id,
                    data: {
                        'quantity': this.value,
                    },
                    success: function(data) {
                        console.log(data);

                        toastr.success('Updated successfully!');
                        window.location.href = '{{ route('basket') }}';
                    }
                });
            });
        });
    </script>
@endsection

