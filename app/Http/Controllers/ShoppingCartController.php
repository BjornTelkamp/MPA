<?php

namespace App\Http\Controllers;

use App\ShoppingCart;
use Illuminate\Http\Request;
use App\Category;
use App\Order;
use App\Product;
use Egulias\EmailValidator\Warning\ObsoleteDTEXT;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShoppingCart  $shoppingCart
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingCart $shoppingCart)
    {
        return view('cart.show');
    }

    /**
     * @param Request $request
     * @param $id
     * @param $qty
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getAddToCart(Request $request, $id, $qty = null)
    {
        $product = Product::find($id);
        $cart = new ShoppingCart();
        $product->qty = $request->input('qty');
        $cart->add($product, $product->id, $product->qty);

        $request->session()->put('cart', $cart);

             return redirect()->back();
    }

    // Remove one item from the cart in the session

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
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

    // Remove all items from the cart in the session

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
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

    // Increase item by one from the cart in the session

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getIncreaseByOne(Request $request, $id, $qty=1)
    {
        // Finds item
        $product = Product::find($id);
        $product->qty = $qty;
        // Make new Cart class from existing cart ----------
        $cart = new ShoppingCart();
        // Add item with item id to the existing cart
        $cart->add($product, $product->id, $product->qty);

        // If no cart exists make and or update existing cart in session
        $request->session()->put('cart', $cart);

        // Returns to page
        return redirect()->back();
    }

    // Get data from the current cart in the session

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCart()
    {
        // If cart exists, return it to te view
        if (!Session::has('cart')) {
            return view('cart.index', ['products' => null]);
        }
        // Make class form existing cart
        $cart = new ShoppingCart();
        return view('cart.index', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    // Return to view with data form the cart in the session, otherwise return to the shopping cart.

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
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

    // Return to view if al required input fields are filled, otherwise return to view (and try again)

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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



