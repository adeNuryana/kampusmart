<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'condition',
        'image',
        'status',
    ];


    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock' => 'integer',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Seller
    |--------------------------------------------------------------------------
    */

    public function seller(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'seller_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Category
    |--------------------------------------------------------------------------
    */

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            Category::class
        );
    }
}
