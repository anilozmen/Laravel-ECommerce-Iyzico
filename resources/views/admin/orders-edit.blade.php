@extends('layouts.main')

@section('content')

    <div class="container product_section_container" style="padding: 30px;">
        <div class="row">
            <div class="col-md-12">
                {!!Form::model($orders, ['route' => ['admin-orders.update', $orders->id], "method" =>  "put","files" => true])!!}
                {!! Form::bsSelect("status","Status",null,$status,"Please select a status") !!}
                {!! Form::bsSubmit("Update") !!}
                {!! Form::close() !!}

                <h3>User Information</h3>
                <table class="table table-bordererd table-hover">
                    <tr>
                        <th>Iyzico Conversation ID</th>
                        <th>Name Surname</th>
                        <th>E-Mail</th>
                        <th>Phone</th>
                        <th>Mobile Phone</th>
                        <th>Address</th>
                        <th>Status</th>
                    </tr>
                    @foreach($orders->baskets->basket_products as $basket_product)
                        <tr>
                            <td>{{ $orders->order_no }}</td>
                            <td>{{ $orders->name }}</td>
                            <td>{{ $orders->baskets->user->email }}</td>
                            <td>{{ $orders->phone }}</td>
                            <td>{{ $orders->m_phone }}</td>
                            <td>{{ $orders->address }}</td>
                            <td>{{ $orders->status }}</td>
                        </tr>
                    @endforeach


                </table>

                <h3>Order(s) - (PN-{{$orders->id}})</h3>
                <table class="table table-bordererd table-hover">
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                        <th>Status</th>
                    </tr>
                    @foreach($orders->baskets->basket_products as $basket_product)
                        <tr>
                            <td style="width: 120px;">
                                <a href="{{ route('product', $basket_product->product->slug) }}">
                                    @foreach($basket_product->product->images as $image)
                                        <img src="/uploads/{{ $image->name }}" width="100">
                                    @endforeach
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('product', $basket_product->product->slug) }}">
                                    {{$basket_product->product->product_name}}
                                </a>
                            </td>
                            <td>{{number_format($basket_product->price,2)}} ₺</td>
                            <td>{{ $basket_product->quantity }}</td>
                            <td>{{number_format($basket_product->price * $basket_product->quantity,2)}} ₺</td>
                            <td>{{ $orders->status }}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <th colspan="4" class="text-right">Total Price (VAT included)</th>
                        <td colspan="2">{{$orders->order_price}} ₺</td>
                    </tr>

                    <tr>
                        <th colspan="4" class="text-right">Status</th>
                        <td colspan="2">{{$orders->status}}</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
@endsection
