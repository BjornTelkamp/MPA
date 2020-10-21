<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
// Returns view to register page
    public function getRegister()
    {
        return view('auth.register');
    }

// Handles the registration to the database
// Then it will return you to the homepage
    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'password' => 'required|min:4'
        ]);

        $user = new User([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->save();

        Auth::login($user);

        if (Session::has('oldUrl')) {
            $oldUrl = Session::get('oldUrl');
            Session::forget('oldUrl');
            return redirect()->to($oldUrl);
        }

        return redirect()->route('categories.index');
    }

// Returns view to login page
    public function getLogin()
    {
        return view('auth.login');
    }

// Handles the registration to the database
// Then it will return you to the homepage
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required|min:4'
        ]);

        $user = new User([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            if (Session::has('oldUrl')) {
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldUrl);
            }
            return redirect()->route('categories.index');
        }
        return redirect()->back();
    }

// Returns view to profile page
    public function getProfile()
    {
        $orders = Auth::user()->orders;
        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('auth.profile', ['orders' => $orders]);
    }

// Logs the user out
    public function getLogout()
    {
        $user = Auth::guard()->user();

        $user->last_seen_at = null;
        $user->save();

        Auth::logout();
        return redirect()->route('auth.login');
    }
}
