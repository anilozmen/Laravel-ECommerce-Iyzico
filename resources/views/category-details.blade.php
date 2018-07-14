@extends('layouts.main')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/categories_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/categories_responsive.css')}}">

@endsection

@section('content')


    <div class="container product_section_container">
        <div class="row">
            <div class="col product_section clearfix">

                <!-- Breadcrumbs -->

                <div class="breadcrumbs d-flex flex-row align-items-center">
                    <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active"><a href="{{route('category', $category->slug)}}"><i class="fa fa-angle-right" aria-hidden="true"></i>{{ $category->category_name }}</a></li>
                    </ul>
                </div>

                <!-- Sidebar -->



                <!-- Main Content -->

                <div class="main_content">

                    <!-- Products -->

                    <div class="products_iso">
                        <div class="row">
                            <div class="col">
                                <div class="product-grid"
                                     data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>


                                    @foreach($products as $product)
                                        <a href="/product/{{$product->slug}}">
                                            <div class="product-item {{$product->id}} ">
                                            <div class="product discount product_filter">
                                                <div class="product_image">
                                                    {!! $product->thumbs !!}
                                                </div>

                                                <div class="product_info">
                                                    <h6 class="product_name"><a
                                                                href="/product/{{$product->slug}}">{{ $product->product_name }}</a>
                                                    </h6>

                                                    <div class="product_price">{{ number_format($product->product_price) }} ₺<span>{{ number_format($product->original_price ) }}
                                                            ₺</span></div>

                                                    <input type="number" class="quantity" id="quantity" name="quantity" value="1" style="width: 50px; margin-right: 10px;">
                                                </div>
                                            </div>
                                            <div class="add_to_cart_button red_button" style="margin-top: 40px;"><a href="{{ route('basket.create', ['id' => $product->id]) }}">add to cart</a></div>
                                        </div>
                                        </a>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefit -->

    <div class="benefit">
        <div class="container">
            <div class="row benefit_row">
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>free shipping</h6>
                            <p>Suffered Alteration in Some Form</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>cash on delivery</h6>
                            <p>The Internet Tend To Repeat</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>45 days return</h6>
                            <p>Making it Look Like Readable</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 benefit_col">
                    <div class="benefit_item d-flex flex-row align-items-center">
                        <div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                        <div class="benefit_content">
                            <h6>opening all week</h6>
                            <p>8AM - 09PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('js')
    <script>
        $('.add_to_cart_button').find('a').click(function (event) {
            event.preventDefault();
            var quantity = $(this).parent().prev().find('input').val();
            $.ajax({
                type: "POST",
                url: $(this).attr('href'),
                data: {quantity: quantity}
                , success: function (data) {
                    console.log(data);
                    $('#checkout_items').html(data.cartCount);
                }
            });
            return false; //for good measure
        });
    </script>
    <script src="{{asset('assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.js')}}"></script>
    <script src="{{asset('assets/js/categories_custom.js')}}"></script>
@endsection