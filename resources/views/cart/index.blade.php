@extends('layout')

@section('content')
    @if (Session::has('cart'))
        <div class="container">
            <div class="title">Products</div>
            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <ul class="list-group">
                        @foreach ($products as $product)
                            <li class="list-group-item">
                                <strong style="color:black!important;font-weight: bold">{{ $product['item']['name'] }}</strong> <br>
                                <span class="label label-success">${{ $product['price'] }}</span><br>
                                <span class="badge">Amount: {{ $product['qty'] }}</span>

                                <div class="btn-group" style="float: right;margin-top: -50px;">
{{--                                    @dd($product)--}}

                                    <ul class="">
                                        <li>
                                            <a href="{{ route('product.increaseByOne', ['id' => $product['item']['id']]) }}">
                                                Increase by 1</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('product.reduceByOne', ['id' => $product['item']['id']]) }}">
                                                Reduce by 1</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('product.remove', ['id' => $product['item']['id']]) }}">
                                                Delete all</a>
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
                <div class="col-md-6">
                    <h2>No items in cart!</h2>
                </div>
            </div>
        </div>
    @endif
@endsection
