<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function show(User $seller): View
    {
        $seller->load('sellerProfile');

        $products = Product::query()->with('category')->where('seller_id', $seller->id)->where('status', 'active')->latest()->paginate(12);

        return view('buyer.stores.show', compact('seller', 'products'));
    }
}
