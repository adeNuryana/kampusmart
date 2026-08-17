<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SalesController extends Controller
{
    public function index(Request $request): View
    {
        $seller = $request->user();

        $dateFrom = $request->date('date_from');
        $dateTo = $request->date('date_to');


        /*
        |--------------------------------------------------------------------------
        | Query Dasar Order Selesai
        |--------------------------------------------------------------------------
        */

        $completedOrdersQuery = Order::query()
            ->where('seller_id', $seller->id)
            ->where('status', 'completed');


        /*
        |--------------------------------------------------------------------------
        | Filter Tanggal
        |--------------------------------------------------------------------------
        */

        if ($dateFrom) {
            $completedOrdersQuery
                ->whereDate(
                    'created_at',
                    '>=',
                    $dateFrom
                );
        }


        if ($dateTo) {
            $completedOrdersQuery
                ->whereDate(
                    'created_at',
                    '<=',
                    $dateTo
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalRevenue = (clone $completedOrdersQuery)
            ->sum('subtotal');


        $totalCompletedOrders = (clone $completedOrdersQuery)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | ID Order Yang Masuk Filter
        |--------------------------------------------------------------------------
        */

        $completedOrderIds = (clone $completedOrdersQuery)
            ->pluck('id');


        /*
        |--------------------------------------------------------------------------
        | Total Produk Terjual
        |--------------------------------------------------------------------------
        */

        $totalItemsSold = OrderItem::query()
            ->whereIn(
                'order_id',
                $completedOrderIds
            )
            ->sum('quantity');


        /*
        |--------------------------------------------------------------------------
        | Produk Terlaris
        |--------------------------------------------------------------------------
        */

        $bestSellingProducts = OrderItem::query()
            ->selectRaw(
                '
                product_id,
                product_name,
                SUM(quantity) as total_sold,
                SUM(subtotal) as total_revenue
                '
            )
            ->whereIn(
                'order_id',
                $completedOrderIds
            )
            ->groupBy(
                'product_id',
                'product_name'
            )
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Riwayat Penjualan
        |--------------------------------------------------------------------------
        */

        $sales = (clone $completedOrdersQuery)
            ->with([
                'buyer',
                'items',
            ])
            ->latest()
            ->paginate(10)
            ->withQueryString();


        return view(
            'seller.sales.index',
            compact(
                'totalRevenue',
                'totalCompletedOrders',
                'totalItemsSold',
                'bestSellingProducts',
                'sales'
            )
        );
    }
}
