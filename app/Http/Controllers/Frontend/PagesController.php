<?php

namespace App\Http\Controllers\Frontend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;

class PagesController extends Controller
{
    public function index()
    {
      $products = Product::orderBy('id', 'desc')->paginate(10);

      return view('frontend.pages.index', compact('products'));
    }

    public function contact()
    {
      return view('frontend.pages.contact');
    }

    public function products()
    {
      $products = Product::orderBy('id', 'desc')->paginate(10);

      return view('frontend.pages.product.index')->with('products', $products);
    }
}
