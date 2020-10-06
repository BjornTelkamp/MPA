<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $products = Product::all();

//        dd($category);

        return view('categories.index', ['categories'=>$categories],['products'=> $products]
        );
    }

    public function show()
    {

    }
}


//        $categories = Category::get();
//
//        $products = Product::select('products.*', 'category_product.*', 'categories.*')
//                    ->LeftJoin('categories', 'products.id', '=','categories.id')
//                    ->LeftJoin('category_product', 'category_product.category_id', '=','product_id')
//                    ->where('category_product.category_id', $id)->get();
//
//        return view('categories.show', ['categories' => $categories],['products'=> $products]
//        );
