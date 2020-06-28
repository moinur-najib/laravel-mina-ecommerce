<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = [
        'user_id', 
        'ip_adress', 
        'payment_id', 
        'name', 
        'phone_no', 
        'shipping_adress',
        'email', 
        'message', 
        'is_paid', 
        'is_completed', 
        'is_seen_by_admin',
        'transaction_id'
    ];

    public function user () 
    {
        return $this->belongsTo(App\User::class);
    }

    public function carts () 
    {
        return $this->hasMany(Cart::class);
    }

    public function payment () 
    {
        return $this->belongsTo(Payment::class);
    }
}
