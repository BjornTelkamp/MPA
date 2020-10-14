@extends('layout')


@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <h1 class="my-4"><b><a href="/categories" style="color: #636b6f; text-decoration: none" title="All categories">Webshop</a></b></h1>
            <h1>User Account</h1>
            <hr>
            <h2>My orders</h2>

            @foreach($orders as $order)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($order->cart->items as $item)
                                <li class="list-group-item">

{{--                                    @dd($item)--}}
                                     {{$item['item']['name']}} <span style="float: right"> Quantity: {{ $item['qty'] }}</span><br>
                                    <span class="badge" style="padding-left: 0px">Price ${{ $item['price'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <strong style="font-weight: bold">Total price: ${{ $order->cart->totalPrice }}</strong>
                    </div>
                </div>
                <br>
            @endforeach
            <a href="{{ route('product.shoppingCart') }}">Shopping Cart</a><br>
            <a href="{{ route('auth.logout') }}" style="padding-bottom: 50px">Logout</a>

        </div>
    </div>
    </div>
@endsection
