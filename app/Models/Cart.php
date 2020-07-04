<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;
class Cart extends Model
{
    public $fillable = [
        'user_id', 
        'ip_adress', 
        'product_id', 
        'product_quantity',
        'order_id'
    ];

    public function user () 
    {
        return $this->belongsTo(App\User::class);
    }

    public function order () 
    {
        return $this->belongsTo(Order::class);
    }

    public function product () 
    {
        return $this->belongsTo(Product::class);
    }

    // Total items in the cart Model

    // @return integer Total item
    public static function totalCarts () 
    {
        if(Auth::check()) {
            $carts = Cart::where('user_id', Auth::id())
                        ->orWhere('ip_adress', request()->ip())
                        ->where('order_id', NULL)
                        ->get();
        } else {
            $carts = Cart::where('ip_adress', request()->ip())->where('order_id', NULL)->get();
        }
        
        return $carts;
    }

     public static function totalItems () 
    {
        $carts = Cart::totalCarts();
        
        $total_item = 0;


        foreach ($carts as $cart) {
            $total_item += $cart->product_quantity;
        }
    
        return $total_item;
    }
}
