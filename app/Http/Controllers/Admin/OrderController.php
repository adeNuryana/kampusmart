<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
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
                        'pending',
                        'confirmed',
                        'processing',
                        'completed',
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

        $pendingOrders = Order::where(
            'status',
            'pending'
        )->count();

        $processingOrders = Order::whereIn(
            'status',
            [
                'confirmed',
                'processing',
            ]
        )->count();

        $completedOrders = Order::where(
            'status',
            'completed'
        )->count();


        return view(
            'admin.orders.index',
            compact(
                'orders',
                'totalOrders',
                'pendingOrders',
                'processingOrders',
                'completedOrders'
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
}
