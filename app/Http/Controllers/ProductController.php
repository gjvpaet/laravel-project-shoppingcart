<?php

namespace ShoppingCart\Http\Controllers;

use Auth;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;

use ShoppingCart\Cart;
use ShoppingCart\Order;
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

    public function getReduceByOne(Request $request, $id)
    {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            $request->session()->put('cart', $cart);
        } else {
            $request->session()->forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    public function getRemoveItem(Request $request, $id)
    {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            $request->session()->put('cart', $cart);   
        } else {
            $request->session()->forget('cart');
        }

        return redirect()->route('product.shoppingCart');
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

    public function getCheckout(Request $request)
    {
        if (!$request->session()->has('cart')) {
            return view('shop.shoppingCart');
        }

        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;

        return view('shop.checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request)
    {
        if (!$request->session()->has('cart')) {
            return redirect()->route('product.shoppingCart');
        }

        $oldCart = $request->session()->get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_jCRYJQzEw8BYy9urATVuIVq7');
        try {
            $charge = Charge::create([
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'),
                "description" => "Test Charge"
            ]);

            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;

            Auth::user()->orders()->save($order);
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }

        $request->session()->forget('cart');
        return redirect()->route('product.index')->with('success', 'Successfully purchased products!');
    }
}
