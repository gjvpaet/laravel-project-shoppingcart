<?php

namespace ShoppingCart\Http\Controllers;

use ShoppingCart\Product;
use Illuminate\Http\Request;

use ShoppingCart\Http\Requests;

class ProductController extends Controller
{
    public function getIndex()
    {
        $products = Product::all();

        return view('shop.index', ['products' => $products]);
    }
}
