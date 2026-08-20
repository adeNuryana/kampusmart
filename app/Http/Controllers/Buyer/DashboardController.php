<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        /*
        |--------------------------------------------------------------------------
        | Buyer Login
        |--------------------------------------------------------------------------
        */

        $buyer = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Jumlah Keranjang Asli
        |--------------------------------------------------------------------------
        |
        | Menggunakan sum quantity.
        |
        | Contoh:
        | Produk A x 2
        | Produk B x 3
        |
        | Maka cartCount = 5
        |
        */

        $cartCount = CartItem::query()->where('user_id', $buyer->id)->sum('quantity');

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categories = Category::query()->withCount('products')->orderBy('name')->get();

        /*
        |--------------------------------------------------------------------------
        | Produk Terbaru
        |--------------------------------------------------------------------------
        */

        $latestProducts = Product::query()
            ->with(['category', 'user.sellerProfile'])
            ->where('status', 'active')
            ->where('stock', '>', 0)
            ->latest()
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Produk Rekomendasi
        |--------------------------------------------------------------------------
        */

        $recommendedProducts = Product::query()
            ->with(['category', 'user.sellerProfile'])
            ->where('status', 'active')
            ->where('stock', '>', 0)
            ->inRandomOrder()
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view('buyer.dashboard', compact('cartCount', 'categories', 'latestProducts', 'recommendedProducts'));
    }
}
