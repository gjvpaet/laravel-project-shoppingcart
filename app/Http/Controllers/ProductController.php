<?php

namespace ShoppingCart\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use ShoppingCart\Cart;
use ShoppingCart\Product;
use ShoppingCart\Http\Requests;

class ProductController extends Controller
{
    public function getIndex()
    {
        $products = Product::all();

        return view('shop.index', ['products' => $products]);
    }

    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);

        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);

        return redirect()->route('product.index');
    }

    public function getCart(Request $request)
    {
        if (!$request->session()->has('cart')) {
            return view('shop.shoppingCart');
        }

        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);

        return view('shop.shoppingCart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }
}
