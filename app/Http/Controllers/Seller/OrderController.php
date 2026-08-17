<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OrderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Daftar Pesanan Seller
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $status = $request->string('status')->trim();
        $search = $request->string('search')->trim();

        $orders = Order::query()
            ->with([
                'buyer',
                'items',
            ])

            // HANYA ORDER MILIK SELLER LOGIN
            ->where('seller_id', $request->user()->id)

            // Search
            ->when($search->isNotEmpty(), function ($query) use ($search) {

                $query->where(function ($query) use ($search) {

                    $query
                        ->where('order_number', 'like', "%{$search}%")
                        ->orWhere('buyer_name', 'like', "%{$search}%")
                        ->orWhere('buyer_phone', 'like', "%{$search}%");
                });

            })

            // Status
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


        return view(
            'seller.orders.index',
            compact('orders')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Detail Pesanan
    |--------------------------------------------------------------------------
    */

    public function show(
        Request $request,
        Order $order
    ): View {

        // Jangan izinkan seller melihat order seller lain
        abort_if(
            $order->seller_id !== $request->user()->id,
            403
        );


        $order->load([
            'buyer',
            'items.product',
        ]);


        return view(
            'seller.orders.show',
            compact('order')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Status
    |--------------------------------------------------------------------------
    */

    public function updateStatus(
        Request $request,
        Order $order
    ) {

        abort_if(
            $order->seller_id !== $request->user()->id,
            403
        );


        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'confirmed',
                    'processing',
                    'completed',
                    'cancelled',
                ]),
            ],
        ]);


        $newStatus = $validated['status'];


        /*
        |--------------------------------------------------------------------------
        | Tentukan Perubahan Status Yang Diperbolehkan
        |--------------------------------------------------------------------------
        */

        $allowedTransitions = [

            'pending' => [
                'confirmed',
                'cancelled',
            ],

            'confirmed' => [
                'processing',
                'cancelled',
            ],

            'processing' => [
                'completed',
                'cancelled',
            ],

            'completed' => [],

            'cancelled' => [],

        ];


        if (
            !in_array(
                $newStatus,
                $allowedTransitions[$order->status] ?? [],
                true
            )
        ) {

            throw ValidationException::withMessages([
                'status' =>
                    'Perubahan status pesanan tidak diperbolehkan.',
            ]);
        }


        DB::transaction(function () use (
            $order,
            $newStatus
        ) {

            /*
            |--------------------------------------------------------------------------
            | Lock Order
            |--------------------------------------------------------------------------
            */

            $lockedOrder = Order::query()
                ->whereKey($order->id)
                ->lockForUpdate()
                ->firstOrFail();


            /*
            |--------------------------------------------------------------------------
            | Kalau Dibatalkan, Kembalikan Stok
            |--------------------------------------------------------------------------
            */

            if (
                $newStatus === 'cancelled' &&
                $lockedOrder->status !== 'cancelled'
            ) {

                $lockedOrder->load('items');

                foreach ($lockedOrder->items as $item) {

                    if (!$item->product_id) {
                        continue;
                    }


                    $product = Product::query()
                        ->whereKey($item->product_id)
                        ->lockForUpdate()
                        ->first();


                    if ($product) {

                        $product->increment(
                            'stock',
                            $item->quantity
                        );

                    }
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Update Status
            |--------------------------------------------------------------------------
            */

            $lockedOrder->update([
                'status' => $newStatus,
            ]);
        });


        return back()->with(
            'success',
            'Status pesanan berhasil diperbarui.'
        );
    }
}
