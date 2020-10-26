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
                        <form action="{{ route('product.addToCart', ['id' => $product->id, 'qty' => $product->qty]) }}" method="get" class="form-inline">
                                <div class="form-group mb-2">
                                   <label style="float:left;">Quantity: &nbsp;&nbsp;&nbsp;
                                       <input type="number" min="1" max="99" value="1" name="qty" class="form-control" maxlength="2" style="float: right">
                                   </label>
                                </div>
                                <div class="col col-lg-10" style="float: right">
                                    <input type="submit" value="Add to Cart" class="btn btn-primary" style="float: right">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
