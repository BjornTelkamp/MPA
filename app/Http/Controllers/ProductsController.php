<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\response;

class ProductsController extends Controller
{

    public function index($id)
    {
        $product = Product::where('id', $id)->first();

        return view('products.index',['product'=> $product]);
    }


}
