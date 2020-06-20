<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = [
        'user_id', 
        'ip_adress', 
        'name', 
        'phone_no', 
        'shipping_adress',
        'email', 
        'message', 
        'is_paid', 
        'is_completed', 
        'is_seen_by_admin' 
    ];

    public function user () 
    {
        return $this->belongsTo(App\User::class);
    }

    public function carts () 
    {
        return $this->belongsTo(Cart::class);
    }
}
