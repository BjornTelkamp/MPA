<?php

namespace App\Http\Controllers;

use App\ShoppingCart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ShoppingCartController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param ShoppingCart $shoppingCart
     * @return Application|Factory|Response|View
     * @return Response
     */
    public function show(ShoppingCart $shoppingCart)
    {
        return view('cart.show');
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $cart = new ShoppingCart();
        $product->qty = $request->input('qty');
        $cart->add($product, $product->id, $product->qty);

        $request->session()->put('cart', $cart);

             return redirect('/');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function getReduceByOne($id)
    {
        $cart = new ShoppingCart();
        $cart->reduceOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function getRemoveItem($id)
    {
        $cart = new ShoppingCart();
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function getIncreaseByOne(Request $request, $id, $qty=1)
    {
        $product = Product::find($id);
        $product->qty = $qty;
        $cart = new ShoppingCart();
        $cart->add($product, $product->id, $product->qty);

        $request->session()->put('cart', $cart);

        return redirect()->back();
    }


    /**
     * @return Application|Factory|View
     */
    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('cart.index', ['products' => null]);
        }
        $cart = new ShoppingCart();
        return view('cart.index', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    /**
     * @return Application|Factory|View
     */
    public function getCheckout()
    {
        if (!Session::has('cart')) {
            return view('cart.index');
        }
        $cart = new ShoppingCart();
        $total = $cart->totalPrice;
        return view('cart.show', ['total' => $total]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('cart.index');
        }
        $cart = new ShoppingCart();

        $order = new Order();
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        $order->name = $request->input('firstName');

        Auth::user()->orders()->save($order);

        Session::forget('cart');
        return redirect()->route('categories.index')->with('success', 'Successfully purchased products!');
    }
}



