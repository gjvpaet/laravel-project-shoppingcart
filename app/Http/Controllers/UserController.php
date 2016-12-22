<?php

namespace ShoppingCart\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use ShoppingCart\Order;
use ShoppingCart\User;
use ShoppingCart\Http\Requests;

class UserController extends Controller
{
    public function getSignUp()
    {
        return view('user.signup');
    }

    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'password' => 'required|min:4'
        ]);

        $user = new User([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        $user->save();

        Auth::login($user);

        if ($request->session()->has('oldUrl')) {
            $oldUrl = $request->session()->get('oldUrl');
            $request->session()->forget('oldUrl');
            return redirect($oldUrl);
        }

        return redirect()->route('user.profile');
    }

    public function getSignIn()
    {
        return view('user.signin');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required|min:4'
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            if ($request->session()->has('oldUrl')) {
                $oldUrl = $request->session()->get('oldUrl');
                $request->session()->forget('oldUrl');
                return redirect($oldUrl);
            }
            return redirect()->route('user.profile');
        } else {
            return redirect()->back();
        }
    }
    
    public function getProfile()
    {
        $orders = Auth::user()->orders;
        $orders->transform(function($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });

        return view('user.profile', ['orders' => $orders]);
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect()->route('user.signin');
    }
}
