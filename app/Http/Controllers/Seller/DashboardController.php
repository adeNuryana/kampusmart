<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $seller = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Statistik Produk
        |--------------------------------------------------------------------------
        */

        $totalProducts = Product::query()
            ->where('seller_id', $seller->id)
            ->count();


        $activeProducts = Product::query()
            ->where('seller_id', $seller->id)
            ->where('status', 'active')
            ->count();


        $lowStockProducts = Product::query()
            ->where('seller_id', $seller->id)
            ->where('stock', '>', 0)
            ->where('stock', '<=', 5)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Statistik Pesanan
        |--------------------------------------------------------------------------
        */

        $pendingOrders = Order::query()
            ->where('seller_id', $seller->id)
            ->where('status', 'pending')
            ->count();


        $processingOrders = Order::query()
            ->where('seller_id', $seller->id)
            ->whereIn('status', [
                'confirmed',
                'processing',
            ])
            ->count();


        $completedOrders = Order::query()
            ->where('seller_id', $seller->id)
            ->where('status', 'completed')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Total Penjualan / Omzet
        |--------------------------------------------------------------------------
        */

        $totalRevenue = Order::query()
            ->where('seller_id', $seller->id)
            ->where('status', 'completed')
            ->sum('subtotal');


        /*
        |--------------------------------------------------------------------------
        | Pesanan Terbaru
        |--------------------------------------------------------------------------
        */

        $recentOrders = Order::query()
            ->with([
                'buyer',
                'items',
            ])
            ->where('seller_id', $seller->id)
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Produk Stok Menipis
        |--------------------------------------------------------------------------
        */

        $lowStockItems = Product::query()
            ->with('category')
            ->where('seller_id', $seller->id)
            ->where('stock', '>', 0)
            ->where('stock', '<=', 5)
            ->orderBy('stock')
            ->take(5)
            ->get();


        return view('seller.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'lowStockProducts',
            'pendingOrders',
            'processingOrders',
            'completedOrders',
            'totalRevenue',
            'recentOrders',
            'lowStockItems'
        ));
    }
}
