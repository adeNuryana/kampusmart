<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

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

        $completedOrdersQuery = Order::query()->where('seller_id', $seller->id)->where('status', 'completed');

        /*
        |--------------------------------------------------------------------------
        | Filter Tanggal
        |--------------------------------------------------------------------------
        */

        if ($dateFrom) {
            $completedOrdersQuery->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            $completedOrdersQuery->whereDate('created_at', '<=', $dateTo);
        }

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalRevenue = (clone $completedOrdersQuery)->sum('subtotal');

        $totalCompletedOrders = (clone $completedOrdersQuery)->count();

        /*
        |--------------------------------------------------------------------------
        | ID Order Yang Masuk Filter
        |--------------------------------------------------------------------------
        */

        $completedOrderIds = (clone $completedOrdersQuery)->pluck('id');

        /*
        |--------------------------------------------------------------------------
        | Total Produk Terjual
        |--------------------------------------------------------------------------
        */

        $totalItemsSold = OrderItem::query()->whereIn('order_id', $completedOrderIds)->sum('quantity');

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
                ',
            )
            ->whereIn('order_id', $completedOrderIds)
            ->groupBy('product_id', 'product_name')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Riwayat Penjualan
        |--------------------------------------------------------------------------
        */

        $sales = (clone $completedOrdersQuery)
            ->with(['buyer', 'items'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('seller.sales.index', compact('totalRevenue', 'totalCompletedOrders', 'totalItemsSold', 'bestSellingProducts', 'sales'));
    }
    public function exportPdf(Request $request)
    {
        $validated = $request->validate([
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date'],
        ]);

        $seller = $request->user();

        /*
    |--------------------------------------------------------------------------
    | QUERY PENJUALAN
    |--------------------------------------------------------------------------
    */

        $query = Order::query()
            ->with(['items.product'])
            ->whereBelongsTo($seller, 'seller')
            ->whereIn('status', ['completed', 'sold']);

        /*
    |--------------------------------------------------------------------------
    | FILTER TANGGAL
    |--------------------------------------------------------------------------
    */

        if (!empty($validated['date_from'])) {
            $query->whereDate('created_at', '>=', $validated['date_from']);
        }

        if (!empty($validated['date_to'])) {
            $query->whereDate('created_at', '<=', $validated['date_to']);
        }

        /*
    |--------------------------------------------------------------------------
    | DATA PENJUALAN
    |--------------------------------------------------------------------------
    */

        $sales = $query->oldest('created_at')->get();

        /*
    |--------------------------------------------------------------------------
    | SUMMARY
    |--------------------------------------------------------------------------
    */

        $totalRevenue = $sales->sum('subtotal');

        $totalCompletedOrders = $sales->count();

        $totalItemsSold = $sales->sum(fn($sale) => $sale->items->sum('quantity'));

        /*
    |--------------------------------------------------------------------------
    | PRODUK TERLARIS
    |--------------------------------------------------------------------------
    */

        $bestSellingProducts = $sales
            ->flatMap(fn($sale) => $sale->items)
            ->groupBy('product_name')
            ->map(function ($items, $productName) {
                return [
                    'product_name' => $productName,

                    'total_sold' => $items->sum('quantity'),

                    'total_revenue' => $items->sum('subtotal'),
                ];
            })
            ->sortByDesc('total_sold')
            ->take(5)
            ->values();

        /*
    |--------------------------------------------------------------------------
    | LABEL PERIODE
    |--------------------------------------------------------------------------
    */

        $dateFrom = !empty($validated['date_from']) ? Carbon::parse($validated['date_from']) : null;

        $dateTo = !empty($validated['date_to']) ? Carbon::parse($validated['date_to']) : null;

        if ($dateFrom && $dateTo) {
            $periodLabel = $dateFrom->locale('id')->translatedFormat('d F Y') . ' - ' . $dateTo->locale('id')->translatedFormat('d F Y');
        } elseif ($dateFrom) {
            $periodLabel = 'Mulai ' . $dateFrom->locale('id')->translatedFormat('d F Y');
        } elseif ($dateTo) {
            $periodLabel = 'Sampai ' . $dateTo->locale('id')->translatedFormat('d F Y');
        } else {
            $periodLabel = 'Semua Periode';
        }

        /*
    |--------------------------------------------------------------------------
    | GENERATE PDF
    |--------------------------------------------------------------------------
    */

        $pdf = Pdf::loadView('seller.sales.pdf', compact('seller', 'sales', 'totalRevenue', 'totalCompletedOrders', 'totalItemsSold', 'bestSellingProducts', 'periodLabel', 'dateFrom', 'dateTo'));

        $pdf->setPaper('a4', 'landscape');

        $filename = 'laporan-penjualan-' . now('Asia/Jakarta')->format('Y-m-d-His') . '.pdf';

        return $pdf->download($filename);
    }
}
