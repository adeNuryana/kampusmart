<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        $products = Product::query()
            ->with([
                'category',
                'user.sellerProfile',
            ])
            ->where('status', 'active')
            ->where('stock', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        return view('buyer.dashboard', compact(
            'categories',
            'products'
        ));
    }
}
