<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderDeletionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(private readonly OrderDeletionService $orderDeletionService) {}

    /*
    |--------------------------------------------------------------------------
    | Daftar Semua Pesanan
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $search = $request->string('search')->trim();
        $status = $request->string('status')->trim();

        $orders = Order::query()
            ->with([
                'buyer',
                'seller.sellerProfile',
                'items',
            ])

            /*
            |--------------------------------------------------------------------------
            | Search
            |--------------------------------------------------------------------------
            */

            ->when($search->isNotEmpty(), function ($query) use ($search) {

                $query->where(function ($query) use ($search) {

                    $query
                        ->where(
                            'order_number',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhere(
                            'buyer_name',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhere(
                            'buyer_phone',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhereHas(
                            'seller',
                            function ($query) use ($search) {

                                $query->where(
                                    'name',
                                    'like',
                                    "%{$search}%"
                                );

                            }
                        )

                        ->orWhereHas(
                            'seller.sellerProfile',
                            function ($query) use ($search) {

                                $query->where(
                                    'store_name',
                                    'like',
                                    "%{$search}%"
                                );

                            }
                        );
                });
            })

            /*
            |--------------------------------------------------------------------------
            | Filter Status
            |--------------------------------------------------------------------------
            */

            ->when(
                in_array(
                    $status->value(),
                    [
                        'processing',
                        'sold',
                        'cancelled',
                    ],
                    true
                ),
                function ($query) use ($status) {

                    $query->where(
                        'status',
                        $status->value()
                    );

                }
            )

            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalOrders = Order::count();

        $processingOrders = Order::where('status', 'processing')->count();

        $completedOrders = Order::where(
            'status',
            'sold'
        )->count();

        $cancelledOrders = Order::where('status', 'cancelled')->count();

        return view(
            'admin.orders.index',
            compact(
                'orders',
                'totalOrders',
                'processingOrders',
                'completedOrders',
                'cancelledOrders'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Detail Pesanan
    |--------------------------------------------------------------------------
    */

    public function show(Order $order): View
    {
        $order->load([
            'buyer',
            'seller.sellerProfile',
            'items.product',
        ]);

        return view(
            'admin.orders.show',
            compact('order')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus Pesanan dan Kembalikan Stok
    |--------------------------------------------------------------------------
    */

    public function destroy(Order $order): RedirectResponse
    {
        $result = $this->orderDeletionService->delete($order);

        $message = 'Pesanan '.$result['orderNumber'].' berhasil dihapus.';

        if ($result['stockWasAlreadyRestored']) {
            $message .= ' Stok tidak ditambahkan lagi karena sudah dikembalikan saat pesanan dibatalkan.';
        } elseif ($result['restoredQuantity'] > 0) {
            $message .= ' Sebanyak '.$result['restoredQuantity'].' stok produk telah dikembalikan.';
        }

        $response = redirect()
            ->route('admin.orders.index')
            ->with('success', $message);

        if ($result['missingProductQuantity'] > 0) {
            $response->with(
                'warning',
                $result['missingProductQuantity'].' stok tidak dapat dikembalikan karena produknya sudah dihapus.'
            );
        }

        return $response;
    }
}
