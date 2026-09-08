<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        /*
        |--------------------------------------------------------------------------
        | BUYER LOGIN
        |--------------------------------------------------------------------------
        */

        $buyer = $request->user();

        /*
        |--------------------------------------------------------------------------
        | KERANJANG
        |--------------------------------------------------------------------------
        */

        $cartCount = CartItem::query()->where('user_id', $buyer->id)->count();

        /*
        |--------------------------------------------------------------------------
        | PESANAN AKTIF
        |--------------------------------------------------------------------------
        */

        $activeOrderCount = Order::query()
            ->where('buyer_id', $buyer->id)
            ->whereIn('status', ['pending', 'processing'])
            ->count();

        /*
        |--------------------------------------------------------------------------
        | PESANAN SELESAI
        |--------------------------------------------------------------------------
        */

        $completedOrderCount = Order::query()->where('buyer_id', $buyer->id)->where('status', 'completed')->count();

        /*
        |--------------------------------------------------------------------------
        | TOTAL TRANSAKSI
        |--------------------------------------------------------------------------
        */

        $totalTransactionCount = Order::query()->where('buyer_id', $buyer->id)->count();

        $totalTransaction = Order::query()->where('buyer_id', $buyer->id)->sum('subtotal');

        /*
        |--------------------------------------------------------------------------
        | 3 PESANAN TERBARU
        |--------------------------------------------------------------------------
        */

        $recentOrders = Order::query()
            ->with(['items.product', 'seller.sellerProfile'])
            ->where('buyer_id', $buyer->id)
            ->latest('created_at')
            ->take(3)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | CATEGORIES
        |--------------------------------------------------------------------------
        */

        $categories = Category::query()->withCount('products')->orderBy('name')->get();

        /*
        |--------------------------------------------------------------------------
        | PRODUK TERBARU
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
        | PRODUK REKOMENDASI
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
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('buyer.dashboard', compact('cartCount', 'activeOrderCount', 'completedOrderCount', 'totalTransactionCount', 'totalTransaction', 'recentOrders', 'categories', 'latestProducts', 'recommendedProducts'));
    }
}
