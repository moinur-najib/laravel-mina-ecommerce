<?php

namespace App\Http\Controllers\Frontend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('frontend.pages.product.index')->with('products', $products);
    }

    public function show($slug)
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('frontend.pages.product.index')->with('products', $products);
    }
}
