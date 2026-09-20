<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ReportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REPORT INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        [$startDate, $endDate, $periodLabel, $period] = $this->resolvePeriod($request);

        /*
        |--------------------------------------------------------------------------
        | ORDERS
        |--------------------------------------------------------------------------
        */

        $orders = Order::query()
            ->with(['buyer', 'seller.sellerProfile', 'items.product'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        $totalOrders = $orders->count();

        $validOrders = $orders->where('status', '!=', 'cancelled');

        $totalTransactionValue = $validOrders->sum('subtotal');

        $totalItems = $validOrders->sum(function ($order) {
            return $order->items->sum('quantity');
        });

        $completedOrders = $orders->where('status', 'sold')->count();

        $soldOrders = $orders->where('status', 'sold');

        /*
        |--------------------------------------------------------------------------
        | UNIQUE BUYER & SELLER
        |--------------------------------------------------------------------------
        */

        $totalBuyers = $orders->pluck('buyer_id')->filter()->unique()->count();

        $totalSellers = $orders->pluck('seller_id')->filter()->unique()->count();

        /*
        |--------------------------------------------------------------------------
        | STATUS SUMMARY
        |--------------------------------------------------------------------------
        */

        $statusSummary = collect([
            'processing' => 0,
            'sold' => 0,
            'cancelled' => 0,
        ]);

        foreach ($orders as $order) {
            if ($statusSummary->has($order->status)) {
                $statusSummary->put($order->status, $statusSummary->get($order->status) + 1);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CHART
        |--------------------------------------------------------------------------
        */

        [$chartLabels, $chartRevenue, $chartTransactions, $chartTitle] = $this->buildSalesChart(
            $soldOrders,
            $startDate,
            $endDate,
            $period,
        );

        $filterActive = $request->hasAny(['period', 'month', 'year', 'start_date', 'end_date']);

        /*
        |--------------------------------------------------------------------------
        | TOP SELLERS
        |--------------------------------------------------------------------------
        */

        $topSellers = $validOrders
            ->filter(fn ($order) => $order->seller)
            ->groupBy('seller_id')
            ->map(function ($sellerOrders) {
                $firstOrder = $sellerOrders->first();

                return [
                    'name' => $firstOrder->seller?->name ?? '-',

                    'store_name' => $firstOrder->seller?->sellerProfile?->store_name ?? '-',

                    'orders' => $sellerOrders->count(),

                    'transaction_value' => $sellerOrders->sum('subtotal'),
                ];
            })
            ->sortByDesc('transaction_value')
            ->take(5)
            ->values();

        /*
        |--------------------------------------------------------------------------
        | TOP PRODUCTS
        |--------------------------------------------------------------------------
        */

        $topProducts = $validOrders
            ->flatMap(function ($order) {
                return $order->items;
            })
            ->groupBy('product_name')
            ->map(function ($items, $productName) {
                return [
                    'name' => $productName,

                    'quantity' => $items->sum('quantity'),

                    'transaction_value' => $items->sum('subtotal'),
                ];
            })
            ->sortByDesc('quantity')
            ->take(5)
            ->values();

        return view(
            'admin.reports.index',
            compact(
                'orders',
                'startDate',
                'endDate',
                'periodLabel',

                'totalOrders',
                'totalTransactionValue',
                'totalItems',
                'completedOrders',
                'totalBuyers',
                'totalSellers',

                'statusSummary',

                'chartLabels',
                'chartRevenue',
                'chartTransactions',
                'chartTitle',
                'filterActive',

                'topSellers',
                'topProducts',
            ),
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORT CSV
    |--------------------------------------------------------------------------
    */

    public function export(Request $request)
    {
        [$startDate, $endDate, $periodLabel] = $this->resolvePeriod($request);

        /*
    |--------------------------------------------------------------------------
    | DATA PESANAN
    |--------------------------------------------------------------------------
    */

        $orders = Order::query()
            ->with(['buyer', 'seller.sellerProfile', 'items.product'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        /*
    |--------------------------------------------------------------------------
    | SUMMARY
    |--------------------------------------------------------------------------
    */

        $totalOrders = $orders->count();

        $validOrders = $orders->where('status', '!=', 'cancelled');

        $totalTransactionValue = $validOrders->sum('subtotal');

        $totalItems = $validOrders->sum(function ($order) {
            return $order->items->sum('quantity');
        });

        $completedOrders = $orders->where('status', 'sold')->count();

        /*
    |--------------------------------------------------------------------------
    | BUYER & SELLER
    |--------------------------------------------------------------------------
    */

        $totalBuyers = $orders->pluck('buyer_id')->filter()->unique()->count();

        $totalSellers = $orders->pluck('seller_id')->filter()->unique()->count();

        /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

        $statusCounts = $orders->groupBy('status')->map(fn ($items) => $items->count());

        $statusSummary = collect([
            'processing' => $statusCounts->get('processing', 0),
            'sold' => $statusCounts->get('sold', 0),
            'cancelled' => $statusCounts->get('cancelled', 0),
        ]);

        /*
    |--------------------------------------------------------------------------
    | TOP SELLERS
    |--------------------------------------------------------------------------
    */

        $topSellers = $validOrders
            ->filter(fn ($order) => $order->seller)
            ->groupBy('seller_id')
            ->map(function ($sellerOrders) {
                $firstOrder = $sellerOrders->first();

                return [
                    'name' => $firstOrder->seller?->name ?? '-',

                    'store_name' => $firstOrder->seller?->sellerProfile?->store_name ?? '-',

                    'orders' => $sellerOrders->count(),

                    'transaction_value' => $sellerOrders->sum('subtotal'),
                ];
            })
            ->sortByDesc('transaction_value')
            ->take(5)
            ->values();

        /*
    |--------------------------------------------------------------------------
    | TOP PRODUCTS
    |--------------------------------------------------------------------------
    */

        $topProducts = $validOrders
            ->flatMap(fn ($order) => $order->items)
            ->groupBy('product_name')
            ->map(function ($items, $productName) {
                return [
                    'name' => $productName,

                    'quantity' => $items->sum('quantity'),

                    'transaction_value' => $items->sum('subtotal'),
                ];
            })
            ->sortByDesc('quantity')
            ->take(5)
            ->values();

        /*
    |--------------------------------------------------------------------------
    | GENERATE PDF
    |--------------------------------------------------------------------------
    */

        $pdf = Pdf::loadView(
            'admin.reports.pdf',
            compact(
                'orders',
                'startDate',
                'endDate',
                'periodLabel',

                'totalOrders',
                'totalTransactionValue',
                'totalItems',
                'completedOrders',
                'totalBuyers',
                'totalSellers',

                'statusSummary',

                'topSellers',
                'topProducts',
            ),
        );

        /*
    |--------------------------------------------------------------------------
    | LANDSCAPE
    |--------------------------------------------------------------------------
    */

        $pdf->setPaper('a4', 'landscape');

        $filename = 'laporan-kampusmart-'.$startDate->format('Y-m-d').'-'.$endDate->format('Y-m-d').'.pdf';

        return $pdf->download($filename);
    }

    /*
    |--------------------------------------------------------------------------
    | RESOLVE PERIOD
    |--------------------------------------------------------------------------
    */

    private function resolvePeriod(Request $request): array
    {
        $requestedPeriod = $request->query('period', 'month');

        $validated = $request->validate([
            'period' => ['nullable', Rule::in(['month', 'year', 'custom'])],
            'month' => ['nullable', 'date_format:Y-m'],
            'year' => ['nullable', 'integer', 'min:2000', 'max:'.now()->year],
            'start_date' => ['nullable', 'date'],
            'end_date' => [
                'nullable',
                'date',
                Rule::when(
                    $requestedPeriod === 'custom' && $request->filled('start_date'),
                    ['after_or_equal:start_date'],
                ),
            ],
        ]);

        $period = $validated['period'] ?? 'month';
        $timezone = config('app.timezone', 'Asia/Jakarta');

        if ($period === 'month') {
            $month = $validated['month'] ?? now($timezone)->format('Y-m');
            $date = Carbon::createFromFormat('!Y-m', $month, $timezone)->startOfMonth();

            return [
                $date->copy()->startOfMonth(),
                $date->copy()->endOfMonth(),
                $date->copy()->locale('id')->translatedFormat('F Y'),
                $period,
            ];
        }

        if ($period === 'year') {
            $year = (int) ($validated['year'] ?? now($timezone)->year);
            $date = Carbon::create($year, 1, 1, 0, 0, 0, $timezone);

            return [
                $date->copy()->startOfYear(),
                $date->copy()->endOfYear(),
                'Tahun '.$year,
                $period,
            ];
        }

        $startDate = Carbon::parse(
            $validated['start_date'] ?? now($timezone)->startOfMonth()->format('Y-m-d'),
            $timezone,
        )->startOfDay();

        $endDate = Carbon::parse(
            $validated['end_date'] ?? now($timezone)->format('Y-m-d'),
            $timezone,
        )->endOfDay();

        return [
            $startDate,
            $endDate,
            $startDate->copy()->locale('id')->translatedFormat('d M Y')
                .' - '
                .$endDate->copy()->locale('id')->translatedFormat('d M Y'),
            $period,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | CHART
    |--------------------------------------------------------------------------
    */

    private function buildSalesChart(
        Collection $orders,
        Carbon $startDate,
        Carbon $endDate,
        string $period,
    ): array {
        if ($period === 'year' || $startDate->diffInDays($endDate) > 62) {
            return $this->monthlySalesChart($orders, $startDate, $endDate, $period === 'year');
        }

        return $this->dailySalesChart($orders, $startDate, $endDate);
    }

    private function dailySalesChart(Collection $orders, Carbon $startDate, Carbon $endDate): array
    {
        $ordersByDate = $orders->groupBy(fn ($order) => $order->created_at->format('Y-m-d'));

        $labels = [];
        $revenue = [];
        $transactions = [];

        for ($date = $startDate->copy()->startOfDay(); $date->lte($endDate); $date->addDay()) {
            $items = $ordersByDate->get($date->format('Y-m-d'), collect());

            $labels[] = $date->copy()->locale('id')->translatedFormat('d M');
            $revenue[] = (float) $items->sum('subtotal');
            $transactions[] = $items->count();
        }

        return [$labels, $revenue, $transactions, 'Tren Penjualan Harian'];
    }

    private function monthlySalesChart(
        Collection $orders,
        Carbon $startDate,
        Carbon $endDate,
        bool $singleYear,
    ): array {
        $ordersByMonth = $orders->groupBy(fn ($order) => $order->created_at->format('Y-m'));

        $labels = [];
        $revenue = [];
        $transactions = [];

        for ($date = $startDate->copy()->startOfMonth(); $date->lte($endDate); $date->addMonth()) {
            $items = $ordersByMonth->get($date->format('Y-m'), collect());

            $labels[] = $date->copy()->locale('id')->translatedFormat($singleYear ? 'M' : 'M Y');
            $revenue[] = (float) $items->sum('subtotal');
            $transactions[] = $items->count();
        }

        return [$labels, $revenue, $transactions, 'Tren Penjualan Bulanan'];
    }
}
