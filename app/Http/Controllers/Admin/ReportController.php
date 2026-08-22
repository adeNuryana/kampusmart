<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REPORT INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        [$startDate, $endDate, $periodLabel] = $this->resolvePeriod($request);

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

        $totalTransactionValue = $orders->sum('subtotal');

        $totalItems = $orders->sum(function ($order) {
            return $order->items->sum('quantity');
        });

        /*
        | Selesai
        |
        | "sold" tetap dimasukkan karena pada implementasi
        | pesanan KampusMart sebelumnya status ini juga digunakan.
        */

        $completedOrders = $orders->whereIn('status', ['completed', 'sold'])->count();

        $cancelledOrders = $orders->where('status', 'cancelled')->count();

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
            'pending' => 0,
            'confirmed' => 0,
            'processing' => 0,
            'completed' => 0,
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

        [$chartLabels, $chartValues] = $this->buildChart($orders, $startDate, $endDate, $request);

        /*
        |--------------------------------------------------------------------------
        | TOP SELLERS
        |--------------------------------------------------------------------------
        */

        $topSellers = $orders
            ->filter(fn($order) => $order->seller)
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

        $topProducts = $orders
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
                'cancelledOrders',
                'totalBuyers',
                'totalSellers',

                'statusSummary',

                'chartLabels',
                'chartValues',

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

        $totalTransactionValue = $orders->sum('subtotal');

        $totalItems = $orders->sum(function ($order) {
            return $order->items->sum('quantity');
        });

        $completedOrders = $orders->whereIn('status', ['completed', 'sold'])->count();

        $cancelledOrders = $orders->where('status', 'cancelled')->count();

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

        $statusCounts = $orders->groupBy('status')->map(fn($items) => $items->count());

        $statusSummary = collect([
            'pending' => $statusCounts->get('pending', 0),
            'confirmed' => $statusCounts->get('confirmed', 0),
            'processing' => $statusCounts->get('processing', 0),
            'completed' => $statusCounts->get('completed', 0),
            'sold' => $statusCounts->get('sold', 0),
            'cancelled' => $statusCounts->get('cancelled', 0),
        ]);

        /*
    |--------------------------------------------------------------------------
    | TOP SELLERS
    |--------------------------------------------------------------------------
    */

        $topSellers = $orders
            ->filter(fn($order) => $order->seller)
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

        $topProducts = $orders
            ->flatMap(fn($order) => $order->items)
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
                'cancelledOrders',
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

        $filename = 'laporan-kampusmart-' . $startDate->format('Y-m-d') . '-' . $endDate->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }

    /*
    |--------------------------------------------------------------------------
    | RESOLVE PERIOD
    |--------------------------------------------------------------------------
    */

    private function resolvePeriod(Request $request): array
    {
        $period = $request->query('period', 'month');

        /*
        |--------------------------------------------------------------------------
        | MONTH
        |--------------------------------------------------------------------------
        */

        if ($period === 'month') {
            $month = $request->query('month', now()->format('Y-m'));

            try {
                $date = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
            } catch (\Throwable $e) {
                $date = now()->startOfMonth();
            }

            return [$date->copy()->startOfMonth(), $date->copy()->endOfMonth(), $date->locale('id')->translatedFormat('F Y')];
        }

        /*
        |--------------------------------------------------------------------------
        | YEAR
        |--------------------------------------------------------------------------
        */

        if ($period === 'year') {
            $year = (int) $request->query('year', now()->year);

            $date = Carbon::create($year, 1, 1);

            return [$date->copy()->startOfYear(), $date->copy()->endOfYear(), 'Tahun ' . $year];
        }

        /*
        |--------------------------------------------------------------------------
        | CUSTOM RANGE
        |--------------------------------------------------------------------------
        */

        try {
            $startDate = Carbon::parse($request->query('start_date', now()->startOfMonth()->format('Y-m-d')))->startOfDay();

            $endDate = Carbon::parse($request->query('end_date', now()->format('Y-m-d')))->endOfDay();
        } catch (\Throwable $e) {
            $startDate = now()->startOfMonth();

            $endDate = now()->endOfDay();
        }

        if ($startDate->gt($endDate)) {
            [$startDate, $endDate] = [$endDate, $startDate];
        }

        return [$startDate, $endDate, $startDate->format('d M Y') . ' - ' . $endDate->format('d M Y')];
    }

    /*
    |--------------------------------------------------------------------------
    | CHART
    |--------------------------------------------------------------------------
    */

    private function buildChart($orders, Carbon $startDate, Carbon $endDate, Request $request): array
    {
        $period = $request->query('period', 'month');

        /*
        |--------------------------------------------------------------------------
        | YEAR = JAN - DEC
        |--------------------------------------------------------------------------
        */

        if ($period === 'year') {
            $labels = [];

            $values = [];

            for ($month = 1; $month <= 12; $month++) {
                $monthDate = Carbon::create(null, $month, 1);

                $labels[] = $monthDate->locale('id')->translatedFormat('M');

                $values[] = $orders->filter(fn($order) => $order->created_at->month === $month)->count();
            }

            return [$labels, $values];
        }

        /*
        |--------------------------------------------------------------------------
        | MONTH / CUSTOM = PER DAY
        |--------------------------------------------------------------------------
        */

        $ordersByDate = $orders->groupBy(fn($order) => $order->created_at->format('Y-m-d'));

        $labels = [];

        $values = [];

        $date = $startDate->copy();

        while ($date->lte($endDate)) {
            /*
            | Jika custom sangat panjang,
            | nanti bisa kita ubah menjadi
            | grouping per bulan.
            */

            $key = $date->format('Y-m-d');

            $labels[] = $date->format('j');

            $values[] = isset($ordersByDate[$key]) ? $ordersByDate[$key]->count() : 0;

            $date->addDay();
        }

        return [$labels, $values];
    }
}
