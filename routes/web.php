<?php

use Illuminate\Support\Facades\Route;
use App\Category;
use App\Product;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'CategoriesController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/categories/{category}', 'CategoriesController@show');

Route::get('/product/{product}', 'ProductsController@index');

Route::get('/cart', 'ShoppingCartController@index');

Route::get('/checkout', 'ShoppingCartController@show');

Route::post('/checkout', [
    'uses' => 'ShoppingCartController@postCheckout',
    'as' => 'checkout'
]);

Route::get('/add-to-cart/{id}', [
    'uses' => 'ShoppingCartController@getAddToCart',
    'as' => 'product.addToCart'
]);

//Route::get('/add-to-cart/{id}', [
//    'uses' => 'ShoppingCartController@AddRedirectBack',
//    'as' => 'product.AddRedirectBack'
//]);

Route::get('/increase-by-one/{id}', [
    'uses' => 'ShoppingCartController@getIncreaseByOne',
    'as' => 'product.increaseByOne'
]);

Route::get('/reduce/{id}', [
    'uses' => 'ShoppingCartController@getReduceByOne',
    'as' => 'product.reduceByOne'
]);

Route::get('/remove/{id}', [
    'uses' => 'ShoppingCartController@getRemoveItem',
    'as' => 'product.remove'
]);

Route::get('/shopping-cart', [
    'uses' => 'ShoppingCartController@getCart',
    'as' => 'product.shoppingCart'
]);


Route::get('/checkout', [
    'uses' => 'ShoppingCartController@getCheckout',
    'as' => 'checkout'
]);

Route::post('/checkout', [
    'uses' => 'ShoppingCartController@postCheckout',
    'as' => 'checkout'
]);

Route::get('/register', [
    'uses' => 'UserController@getRegister',
    'as' => 'auth.register'
]);

Route::post('/register', [
    'uses' => 'UserController@postRegister',
    'as' => 'auth.register'
]);

Route::get('/login', [
    'uses' => 'UserController@getLogin',
    'as' => 'auth.login'
]);

Route::post('/login', [
    'uses' => 'UserController@postLogin',
    'as' => 'auth.login'
]);

Route::get('/profile', [
    'uses' => 'UserController@getProfile',
    'as' => 'auth.profile'
]);

Route::get('/logout', [
    'uses' => 'UserController@getLogout',
    'as' => 'auth.logout'
]);

Route::get('/categories', [
    'uses' => 'CategoriesController@index',
    'as' => 'categories.index'
]);

Route::get('/welcome', function(){
    return view('welcome');
});
