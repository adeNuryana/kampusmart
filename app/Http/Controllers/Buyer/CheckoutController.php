<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Halaman Checkout Per Seller
    |--------------------------------------------------------------------------
    */

    public function index(
        Request $request,
        User $seller
    ): View {

        /*
        |--------------------------------------------------------------------------
        | Pastikan Seller Valid
        |--------------------------------------------------------------------------
        */

        abort_if(
            $seller->role !== 'seller' ||
                $seller->status !== 'active',
            404
        );


        $buyer = $request->user();


        /*
        |--------------------------------------------------------------------------
        | Ambil Cart Hanya Dari Seller Yang Dipilih
        |--------------------------------------------------------------------------
        */

        $cartItems = CartItem::query()
            ->with([
                'product.category',
                'product.user.sellerProfile',
            ])
            ->where('user_id', $buyer->id)
            ->whereHas(
                'product',
                function ($query) use ($seller) {

                    $query->where(
                        'seller_id',
                        $seller->id
                    );
                }
            )
            ->get();


        if ($cartItems->isEmpty()) {

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Seller Profile
        |--------------------------------------------------------------------------
        */

        $seller->load('sellerProfile');


        /*
        |--------------------------------------------------------------------------
        | Subtotal
        |--------------------------------------------------------------------------
        */

        $subtotal = $cartItems->sum(
            function ($item) {

                if (!$item->product) {
                    return 0;
                }

                return
                    $item->product->price *
                    $item->quantity;
            }
        );


        return view(
            'buyer.checkout.index',
            compact(
                'cartItems',
                'subtotal',
                'seller'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Buat Pesanan
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'seller_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],

            'buyer_name' => [
                'required',
                'string',
                'max:255',
            ],

            'buyer_phone' => [
                'required',
                'string',
                'max:20',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        $buyer = $request->user();


        /*
        |--------------------------------------------------------------------------
        | Ambil Seller
        |--------------------------------------------------------------------------
        */

        $seller = User::query()
            ->with('sellerProfile')
            ->where(
                'id',
                $validated['seller_id']
            )
            ->where(
                'role',
                'seller'
            )
            ->where(
                'status',
                'active'
            )
            ->first();


        if (!$seller) {

            return redirect()
                ->route('buyer.cart.index')
                ->with(
                    'error',
                    'Penjual sudah tidak tersedia.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Ambil Cart Seller Yang Dipilih
        |--------------------------------------------------------------------------
        |
        | INI $cartItems yang tadi kita bahas.
        |
        */

        $cartItems = CartItem::query()
            ->with('product')
            ->where(
                'user_id',
                $buyer->id
            )
            ->whereHas(
                'product',
                function ($query) use ($seller) {

                    $query->where(
                        'seller_id',
                        $seller->id
                    );
                }
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Tidak Ada Cart Seller
        |--------------------------------------------------------------------------
        */

        if ($cartItems->isEmpty()) {

            return redirect()
                ->route('buyer.cart.index')
                ->with(
                    'error',
                    'Produk dari penjual tersebut tidak ditemukan di keranjang.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Transaction
        |--------------------------------------------------------------------------
        */

        $order = DB::transaction(
            function () use (
                $buyer,
                $seller,
                $cartItems,
                $validated
            ) {

                /*
                |--------------------------------------------------------------------------
                | Create Order
                |--------------------------------------------------------------------------
                */

                $order = Order::create([
                    'order_number' =>
                    $this->generateOrderNumber(),

                    'buyer_id' =>
                    $buyer->id,

                    'seller_id' =>
                    $seller->id,

                    'buyer_name' =>
                    $validated['buyer_name'],

                    'buyer_phone' =>
                    $validated['buyer_phone'],

                    'subtotal' =>
                    0,

                    'status' =>
                    'processing',

                    'notes' =>
                    $validated['notes'] ?? null,
                ]);

                ActivityLogger::log(
                    'order_created',
                    'membuat pesanan #' . $order->id,
                    $order,
                    [
                        'total' => $order->total_amount,
                        'seller_id' => $order->seller_id,
                    ]
                );

                $total = 0;


                /*
                |--------------------------------------------------------------------------
                | Loop Cart Seller
                |--------------------------------------------------------------------------
                */

                foreach ($cartItems as $cartItem) {

                    /*
                    |--------------------------------------------------------------------------
                    | Lock Produk
                    |--------------------------------------------------------------------------
                    */

                    $product = Product::query()
                        ->lockForUpdate()
                        ->find(
                            $cartItem->product_id
                        );


                    if (!$product) {

                        throw ValidationException::withMessages([
                            'cart' =>
                            'Salah satu produk sudah tidak tersedia.',
                        ]);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Pastikan Seller Produk Sesuai
                    |--------------------------------------------------------------------------
                    */

                    if (
                        (int) $product->seller_id
                        !==
                        (int) $seller->id
                    ) {

                        throw ValidationException::withMessages([
                            'cart' =>
                            'Produk tidak sesuai dengan penjual.',
                        ]);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Produk Harus Aktif
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $product->status !== 'active'
                    ) {

                        throw ValidationException::withMessages([
                            'cart' =>
                            "Produk {$product->name} sudah tidak aktif.",
                        ]);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Cek Stock
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $product->stock <
                        $cartItem->quantity
                    ) {

                        throw ValidationException::withMessages([
                            'cart' =>
                            "Stok {$product->name} tidak mencukupi.",
                        ]);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Hitung Subtotal
                    |--------------------------------------------------------------------------
                    */

                    $itemSubtotal =
                        $product->price *
                        $cartItem->quantity;


                    /*
                    |--------------------------------------------------------------------------
                    | Simpan Snapshot Order Item
                    |--------------------------------------------------------------------------
                    */

                    $order
                        ->items()
                        ->create([
                            'product_id' =>
                            $product->id,

                            'product_name' =>
                            $product->name,

                            'price' =>
                            $product->price,

                            'quantity' =>
                            $cartItem->quantity,

                            'subtotal' =>
                            $itemSubtotal,
                        ]);


                    /*
                    |--------------------------------------------------------------------------
                    | Kurangi Stock
                    |--------------------------------------------------------------------------
                    */

                    $product->decrement(
                        'stock',
                        $cartItem->quantity
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Tambahkan Total
                    |--------------------------------------------------------------------------
                    */

                    $total += $itemSubtotal;
                }


                /*
                |--------------------------------------------------------------------------
                | Update Total Order
                |--------------------------------------------------------------------------
                */

                $order->update([
                    'subtotal' => $total,
                ]);


                /*
                |--------------------------------------------------------------------------
                | Hapus HANYA Cart Seller Ini
                |--------------------------------------------------------------------------
                */

                CartItem::query()
                    ->where(
                        'user_id',
                        $buyer->id
                    )
                    ->whereIn(
                        'id',
                        $cartItems->pluck('id')
                    )
                    ->delete();


                /*
                |--------------------------------------------------------------------------
                | Return Satu Order
                |--------------------------------------------------------------------------
                */

                return $order;
            }
        );

        ActivityLogger::log(
            'order_sold',
            'menandai pesanan #' . $order->id . ' sebagai sudah terjual',
            $order
        );
        /*
        |--------------------------------------------------------------------------
        | Redirect Langsung Ke WhatsApp Seller
        |--------------------------------------------------------------------------
        */

        return redirect()->route(
            'buyer.orders.whatsapp',
            $order
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Generate Order Number
    |--------------------------------------------------------------------------
    */

    private function generateOrderNumber(): string
    {
        return
            'KM-' .
            now()->format('Ymd') .
            '-' .
            Str::upper(
                Str::random(8)
            );
    }
}
