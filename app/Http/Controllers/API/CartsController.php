<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Order;

use Auth;
class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.carts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required'
        ],
        [
            'product_id.required' => 'Please give a product'
        ]);

        if(Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->where('order_id', NULL)
            ->first();
        } else {
            $cart = Cart::where('ip_adress', request()->ip())
            ->where('product_id', $request->product_id)
            ->where('order_id', NULL)
            ->first();
        }

        // $cart = Cart::orWhere('user_id', Auth::id())
        //             ->orWhere('ip_adress', request()->ip())
        //             ->Where('product_id', $request->product_id)
        //             ->first();
        if(!is_null($cart)) {
            // dd($request->product_id);
            $cart->increment('product_quantity');
        } else {
            // dd('test');
            $cart = new Cart();
            if(Auth::check()) {
    
                $cart->user_id = Auth::id();
            } 
            $cart->ip_adress = request()->ip();
            $cart->product_id = $request->product_id;
            $cart->save();
        }
        

        return json_encode(['status' => 'success', 'Message' => 'Item added to cart', 'totalItems' => Cart::totalItems()]);
    }
}
