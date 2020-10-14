@extends('layout')
{{--@extends('navigation')--}}

    @section('content')

        <div class="container">

            <div class="row">

                <div class="col-lg-3">

                    <h1 class="my-4"><b><a href="/categories" style="color: #636b6f; text-decoration: none" title="All categories">Webshop</a></b></h1>

                    @if (Session::has('success'))
                        <div class="row">
                            <div class="col-md-12 col-md-offset-4">
                                <div id="charge-message" class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(Auth::check())
                        <li><a href="{{ route('auth.profile') }}">Profile</a></li>
                        <li><a href="{{ route('auth.logout') }}">Logout</a></li>
                        <li><a href="{{ route('product.shoppingCart') }}">Cart</a><span class="badge"> <small>Items: </small>{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span></li>
                    @else
                        <li><a href="{{ route('auth.login') }}">Login</a></li>
                        <li><a href="{{ route('auth.register') }}">Register</a></li>
                    @endif

                    <div class="list-group">
                            <h6 class="list-group-item"><b>Categories</b></h6>
                        @foreach($categories as $category)
                            <a href="/categories/{{ $category->id }}" class="list-group-item">{{ $category->name}}</a>
                        @endforeach
                    </div>

                </div>
                <!-- /.col-lg-3 -->

                <div class="col-lg-9" style="margin-top: 95px;">

                    <div class="row">

                        @foreach($products as $product)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <a href="/product/{{ $product->id }}"><img class="card-img-top" src="{{ $product->img }}" alt="img" style="height:200px"></a>
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <a href="/product/{{ $product->id }}">{{ $product->name }}</a>
                                        </h6>
                                        <p class="card-text" style="font-size: 12px">{{ $product->description }}</p>
                                        <hr>
                                        <h6 style="font-weight: bold">${{ $product->price }}</h6>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('product.addToCart', ['id' => $product->id]) }}"
                                           class="btn btn-primary pull-left" role="button">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.col-lg-9 -->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    @endsection
