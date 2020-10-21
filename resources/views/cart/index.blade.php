@extends('layout')

@section('content')
    @if (Session::has('cart'))
        <div class="container">
            <h1 class="my-4"><b><a href="/categories" style="color: #636b6f; text-decoration: none" title="All categories">Webshop</a></b></h1>
            <h2 class="">Products</h2>
            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <ul class="list-group">
                        @foreach ($products as $product)
                            <li class="list-group-item">
                                <strong style="color:black!important;font-weight: bold">{{ $product['item']['name'] }}</strong> <br>
                                <span class="label label-success">${{ $product['price'] }}</span><br>
                                <span class="badge">Amount: {{ $product['qty'] }}</span>

                                <div class="btn-group" style="float: right;margin-top: -50px;">
                                    <ul class="">
                                        <li style="float: left;list-style-type: none">
                                            <a href="{{ route('product.increaseByOne', ['id' => $product['item']['id']]) }}" style="float:right; margin-left: 5px " class="btn btn-primary">+</a>
                                            <a href="{{ route('product.reduceByOne', ['id' => $product['item']['id']]) }}" style="float: left" class="btn btn-primary">-</a>
                                        </li>
                                        <li style="float: right; list-style-type: none">
                                            <a href="{{ route('product.remove', ['id' => $product['item']['id']]) }}" style="float:right; margin-left: 10px" class="btn btn-danger">
                                                Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <strong>Total: ${{ $totalPrice }}</strong>
                </div>
            </div>
            <hr>
            <div class="row justify-content-md-center">
                <div class="col-md-1">
                    <a href="{{ route('checkout') }}" type="button" class="btn btn-succes"><strong style="border: 1px solid black;padding: 5px; border-radius: 5px">Checkout</strong></a>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <h1 class="my-4"><b><a href="/categories" style="color: #636b6f; text-decoration: none" title="All categories">Webshop</a></b></h1>
                    <h2 class="">Products</h2>
                    <h4 style="text-align: center">No items in cart!</h4>
                </div>
            </div>
        </div>
    @endif
@endsection
