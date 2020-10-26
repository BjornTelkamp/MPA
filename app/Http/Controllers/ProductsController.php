<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\response;

class ProductsController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $product = Product::where('id', $id)->first();

        return view('products.index',['product'=> $product]);
    }
}
