@extends('layout')

@section('content')
    <div class="container">
    <h1 class="my-4"><b><a href="/categories" style="color: #636b6f; text-decoration: none" title="All categories">Webshop</a></b></h1>
    <div class="col-lg-12" style="margin-top: 95px;">
        <div class="row">
            <div class="col-lg-12 col-md-8 mb-8">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="{{ $product->img }}" alt="" style="width: 50%; margin: auto;display: block"></a>
                    <div class="card-body">
                        <h6 class="card-title">
                            <p href="/product/{{ $product->id }}" style="font-weight: bold">{{ $product->name }}</p>
                        </h6>
                        <p class="card-text" style="font-size: 12px">{{ $product->description }}</p>
                        <hr>
                        <h6 style="font-weight: bold">${{ $product->price }}</h6>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('product.addToCart', ['id' => $product->id]) }}" class="btn btn-primary pull-left">Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
