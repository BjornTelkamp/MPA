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
                                    <span class="badge">${{ $item['price'] }}</span>
                                    {{ $item['item']['title'] }} | {{ $item['qty'] }} Units
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <strong>Total price: ${{ $order->cart->totalPrice }}</strong>
                    </div>
                </div>
                <br>
            @endforeach
            <a href="{{ route('auth.logout') }}">Logout</a>
            <a href="{{ route('product.shoppingCart') }}">Shopping Cart</a>
        </div>
    </div>
    </div>
@endsection
