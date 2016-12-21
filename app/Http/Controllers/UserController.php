<?php

namespace ShoppingCart\Http\Controllers;

use Illuminate\Http\Request;

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

        return redirect()->route('product.index');
    }
}
