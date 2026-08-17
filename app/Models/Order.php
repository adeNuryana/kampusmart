<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'buyer_id',
        'seller_id',
        'buyer_name',
        'buyer_phone',
        'subtotal',
        'status',
        'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
    ];


    public function buyer()
    {
        return $this->belongsTo(
            User::class,
            'buyer_id'
        );
    }


    public function seller()
    {
        return $this->belongsTo(
            User::class,
            'seller_id'
        );
    }


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
