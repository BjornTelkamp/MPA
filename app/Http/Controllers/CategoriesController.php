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

        return view('categories.index', ['categories'=>$categories],['products'=> $products]
        );
    }

    public function show(Category $category)
    {
//        dd($product);
        $categories = Category::get();
//        dd($product);
//        $category = $request['category'];
//        dd($request['category']);
        return view('categories.show', ['category'=> $category], ['categories'=>$categories]);
    }
}


//$categories = Category::get();
//
//$products = App\Product::leftJoin('category_product', function($join) {$join->on('category_product.product_id', '=', 'products.id');})->where('category_product.category_id', $id)->get();
//
//return view('categories.index', ['products' => $products], ['categories'=>$categories]);
