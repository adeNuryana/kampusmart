<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Services\ActivityLogger;
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
                Rule::in(['sold', 'cancelled']),
            ],
        ]);

        $newStatus = $validated['status'];

        $updatedOrder = DB::transaction(function () use (
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
                ->with('items')
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedOrder->status !== 'processing') {
                throw ValidationException::withMessages([
                    'status' => 'Pesanan ini sudah memiliki keputusan akhir dan tidak dapat diubah lagi.',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Kembalikan Stok Jika Pesanan Ditolak / Dibatalkan
            |--------------------------------------------------------------------------
            */

            if ($newStatus === 'cancelled') {
                foreach ($lockedOrder->items->sortBy('product_id') as $item) {
                    if (! $item->product_id) {
                        continue;
                    }

                    $product = Product::query()
                        ->whereKey($item->product_id)
                        ->lockForUpdate()
                        ->first();

                    $product?->increment('stock', $item->quantity);
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

            return $lockedOrder;
        });

        $isCancelled = $updatedOrder->status === 'cancelled';

        ActivityLogger::log(
            $isCancelled ? 'order_cancelled' : 'order_sold',
            $isCancelled
                ? 'menolak atau membatalkan pesanan #'.$updatedOrder->id
                : 'menandai pesanan #'.$updatedOrder->id.' sebagai selesai',
            $updatedOrder
        );

        return back()->with(
            'success',
            $isCancelled
                ? 'Pesanan berhasil ditolak/dibatalkan dan stok telah dikembalikan.'
                : 'Pesanan berhasil ditandai selesai.'
        );
    }
}
