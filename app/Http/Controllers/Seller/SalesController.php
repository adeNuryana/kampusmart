<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SalesController extends Controller
{
    public function index(Request $request): View
    {
        $seller = $request->user();

        $validated = $request->validate([
            'date_from' => ['nullable', 'date'],
            'date_to' => [
                'nullable',
                'date',
                Rule::when($request->filled('date_from'), ['after_or_equal:date_from']),
            ],
        ]);

        $dateFrom = ! empty($validated['date_from'])
            ? Carbon::parse($validated['date_from'])->startOfDay()
            : null;

        $dateTo = ! empty($validated['date_to'])
            ? Carbon::parse($validated['date_to'])->endOfDay()
            : null;

        /*
        |--------------------------------------------------------------------------
        | Query Dasar Order Selesai
        |--------------------------------------------------------------------------
        */

        $completedOrdersQuery = Order::query()->where('seller_id', $seller->id)->where('status', 'sold');

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
        | Diagram Penjualan
        |--------------------------------------------------------------------------
        */

        $chartSales = (clone $completedOrdersQuery)
            ->oldest('created_at')
            ->get(['created_at', 'subtotal']);

        [$chartLabels, $chartRevenue, $chartOrders, $chartTitle] = $this->buildSalesChart(
            $chartSales,
            $dateFrom,
            $dateTo,
        );

        $periodLabel = $this->periodLabel($dateFrom, $dateTo);
        $filterActive = $dateFrom !== null || $dateTo !== null;

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

        return view('seller.sales.index', compact(
            'totalRevenue',
            'totalCompletedOrders',
            'totalItemsSold',
            'bestSellingProducts',
            'sales',
            'chartLabels',
            'chartRevenue',
            'chartOrders',
            'chartTitle',
            'periodLabel',
            'filterActive',
        ));
    }

    public function exportPdf(Request $request)
    {
        $validated = $request->validate([
            'date_from' => ['nullable', 'date'],
            'date_to' => [
                'nullable',
                'date',
                Rule::when($request->filled('date_from'), ['after_or_equal:date_from']),
            ],
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
            ->where('status', 'sold');

        /*
    |--------------------------------------------------------------------------
    | FILTER TANGGAL
    |--------------------------------------------------------------------------
    */

        if (! empty($validated['date_from'])) {
            $query->whereDate('created_at', '>=', $validated['date_from']);
        }

        if (! empty($validated['date_to'])) {
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

        $totalItemsSold = $sales->sum(fn ($sale) => $sale->items->sum('quantity'));

        /*
    |--------------------------------------------------------------------------
    | PRODUK TERLARIS
    |--------------------------------------------------------------------------
    */

        $bestSellingProducts = $sales
            ->flatMap(fn ($sale) => $sale->items)
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

        $dateFrom = ! empty($validated['date_from']) ? Carbon::parse($validated['date_from']) : null;

        $dateTo = ! empty($validated['date_to']) ? Carbon::parse($validated['date_to']) : null;

        $periodLabel = $this->periodLabel($dateFrom, $dateTo);

        /*
    |--------------------------------------------------------------------------
    | GENERATE PDF
    |--------------------------------------------------------------------------
    */

        $pdf = Pdf::loadView('seller.sales.pdf', compact('seller', 'sales', 'totalRevenue', 'totalCompletedOrders', 'totalItemsSold', 'bestSellingProducts', 'periodLabel', 'dateFrom', 'dateTo'));

        $pdf->setPaper('a4', 'landscape');

        $filename = 'laporan-penjualan-'.now('Asia/Jakarta')->format('Y-m-d-His').'.pdf';

        return $pdf->download($filename);
    }

    private function periodLabel(?Carbon $dateFrom, ?Carbon $dateTo): string
    {
        if ($dateFrom && $dateTo) {
            return $dateFrom->copy()->locale('id')->translatedFormat('d F Y')
                .' - '
                .$dateTo->copy()->locale('id')->translatedFormat('d F Y');
        }

        if ($dateFrom) {
            return 'Mulai '.$dateFrom->copy()->locale('id')->translatedFormat('d F Y');
        }

        if ($dateTo) {
            return 'Sampai '.$dateTo->copy()->locale('id')->translatedFormat('d F Y');
        }

        return 'Semua Periode';
    }

    private function buildSalesChart(
        Collection $sales,
        ?Carbon $dateFrom,
        ?Carbon $dateTo,
    ): array {
        $timezone = config('app.timezone', 'Asia/Jakarta');
        $now = now($timezone);

        $firstSaleDate = $sales->first()?->created_at?->copy()->timezone($timezone);
        $lastSaleDate = $sales->last()?->created_at?->copy()->timezone($timezone);

        $start = $dateFrom?->copy()->startOfDay()
            ?? $firstSaleDate?->copy()->startOfDay()
            ?? ($dateTo?->copy()->startOfMonth() ?? $now->copy()->startOfMonth());

        $end = $dateTo?->copy()->endOfDay()
            ?? $lastSaleDate?->copy()->endOfDay()
            ?? ($dateFrom?->copy()->endOfDay() ?? $now->copy()->endOfDay());

        $daySpan = (int) $start->diffInDays($end);

        if ($daySpan <= 45) {
            return $this->dailyChart($sales, $start, $end, $timezone);
        }

        if ($daySpan <= 730) {
            return $this->monthlyChart($sales, $start, $end, $timezone);
        }

        return $this->yearlyChart($sales, $start, $end, $timezone);
    }

    private function dailyChart(Collection $sales, Carbon $start, Carbon $end, string $timezone): array
    {
        $grouped = $sales->groupBy(
            fn (Order $order) => $order->created_at->copy()->timezone($timezone)->format('Y-m-d')
        );

        $labels = [];
        $revenue = [];
        $orders = [];

        for ($date = $start->copy()->startOfDay(); $date->lte($end); $date->addDay()) {
            $key = $date->format('Y-m-d');
            $items = $grouped->get($key, collect());

            $labels[] = $date->copy()->locale('id')->translatedFormat('d M');
            $revenue[] = (float) $items->sum('subtotal');
            $orders[] = $items->count();
        }

        return [$labels, $revenue, $orders, 'Tren Penjualan Harian'];
    }

    private function monthlyChart(Collection $sales, Carbon $start, Carbon $end, string $timezone): array
    {
        $grouped = $sales->groupBy(
            fn (Order $order) => $order->created_at->copy()->timezone($timezone)->format('Y-m')
        );

        $labels = [];
        $revenue = [];
        $orders = [];

        for ($date = $start->copy()->startOfMonth(); $date->lte($end); $date->addMonth()) {
            $key = $date->format('Y-m');
            $items = $grouped->get($key, collect());

            $labels[] = $date->copy()->locale('id')->translatedFormat('M Y');
            $revenue[] = (float) $items->sum('subtotal');
            $orders[] = $items->count();
        }

        return [$labels, $revenue, $orders, 'Tren Penjualan Bulanan'];
    }

    private function yearlyChart(Collection $sales, Carbon $start, Carbon $end, string $timezone): array
    {
        $grouped = $sales->groupBy(
            fn (Order $order) => $order->created_at->copy()->timezone($timezone)->format('Y')
        );

        $labels = [];
        $revenue = [];
        $orders = [];

        for ($year = $start->year; $year <= $end->year; $year++) {
            $items = $grouped->get((string) $year, collect());

            $labels[] = (string) $year;
            $revenue[] = (float) $items->sum('subtotal');
            $orders[] = $items->count();
        }

        return [$labels, $revenue, $orders, 'Tren Penjualan Tahunan'];
    }
}
