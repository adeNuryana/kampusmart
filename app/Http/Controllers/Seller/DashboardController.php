<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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

        $processingOrders = Order::query()
            ->where('seller_id', $seller->id)
            ->where('status', 'processing')
            ->count();

        $completedOrders = Order::query()
            ->where('seller_id', $seller->id)
            ->where('status', 'sold')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Total Penjualan / Omzet
        |--------------------------------------------------------------------------
        */

        $totalRevenue = Order::query()
            ->where('seller_id', $seller->id)
            ->where('status', 'sold')
            ->sum('subtotal');

        /*
        |--------------------------------------------------------------------------
        | Diagram Penjualan
        |--------------------------------------------------------------------------
        */

        $chartEnd = now(config('app.timezone', 'Asia/Jakarta'))->endOfDay();
        $chartStart = $chartEnd->copy()->subMonthsNoOverflow(11)->startOfMonth();

        $chartOrders = Order::query()
            ->where('seller_id', $seller->id)
            ->where('status', 'sold')
            ->whereBetween('created_at', [$chartStart, $chartEnd])
            ->oldest('created_at')
            ->get(['created_at', 'subtotal']);

        $salesChartData = $this->buildSalesChartData($chartOrders, $chartEnd);

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
            'processingOrders',
            'completedOrders',
            'totalRevenue',
            'salesChartData',
            'recentOrders',
            'lowStockItems'
        ));
    }

    private function buildSalesChartData(Collection $orders, Carbon $chartEnd): array
    {
        return [
            'month' => $this->dailySalesChart(
                $orders,
                $chartEnd->copy()->subDays(29)->startOfDay(),
                $chartEnd,
                '1 Bulan Terakhir',
            ),
            'six_months' => $this->monthlySalesChart(
                $orders,
                $chartEnd->copy()->subMonthsNoOverflow(5)->startOfMonth(),
                $chartEnd,
                '6 Bulan Terakhir',
            ),
            'year' => $this->monthlySalesChart(
                $orders,
                $chartEnd->copy()->subMonthsNoOverflow(11)->startOfMonth(),
                $chartEnd,
                '1 Tahun Terakhir',
            ),
        ];
    }

    private function dailySalesChart(
        Collection $orders,
        Carbon $start,
        Carbon $end,
        string $title,
    ): array {
        $timezone = config('app.timezone', 'Asia/Jakarta');
        $periodOrders = $this->ordersWithinPeriod($orders, $start, $end);
        $grouped = $periodOrders->groupBy(
            fn (Order $order) => $order->created_at->copy()->timezone($timezone)->format('Y-m-d')
        );

        $labels = [];
        $revenue = [];
        $transactions = [];

        for ($date = $start->copy()->startOfDay(); $date->lte($end); $date->addDay()) {
            $items = $grouped->get($date->format('Y-m-d'), collect());

            $labels[] = $date->copy()->locale('id')->translatedFormat('d M');
            $revenue[] = (float) $items->sum('subtotal');
            $transactions[] = $items->count();
        }

        return $this->chartPayload($periodOrders, $labels, $revenue, $transactions, $title, $start, $end);
    }

    private function monthlySalesChart(
        Collection $orders,
        Carbon $start,
        Carbon $end,
        string $title,
    ): array {
        $timezone = config('app.timezone', 'Asia/Jakarta');
        $periodOrders = $this->ordersWithinPeriod($orders, $start, $end);
        $grouped = $periodOrders->groupBy(
            fn (Order $order) => $order->created_at->copy()->timezone($timezone)->format('Y-m')
        );

        $labels = [];
        $revenue = [];
        $transactions = [];

        for ($date = $start->copy()->startOfMonth(); $date->lte($end); $date->addMonth()) {
            $items = $grouped->get($date->format('Y-m'), collect());

            $labels[] = $date->copy()->locale('id')->translatedFormat('M Y');
            $revenue[] = (float) $items->sum('subtotal');
            $transactions[] = $items->count();
        }

        return $this->chartPayload($periodOrders, $labels, $revenue, $transactions, $title, $start, $end);
    }

    private function ordersWithinPeriod(Collection $orders, Carbon $start, Carbon $end): Collection
    {
        return $orders->filter(
            fn (Order $order) => $order->created_at->betweenIncluded($start, $end)
        );
    }

    private function chartPayload(
        Collection $orders,
        array $labels,
        array $revenue,
        array $transactions,
        string $title,
        Carbon $start,
        Carbon $end,
    ): array {
        return [
            'title' => $title,
            'period' => $start->copy()->locale('id')->translatedFormat('d M Y')
                .' - '
                .$end->copy()->locale('id')->translatedFormat('d M Y'),
            'labels' => $labels,
            'revenue' => $revenue,
            'transactions' => $transactions,
            'total_revenue' => (float) $orders->sum('subtotal'),
            'total_transactions' => $orders->count(),
        ];
    }
}
