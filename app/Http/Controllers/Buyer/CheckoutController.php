<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Halaman Checkout
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $cartItems = CartItem::query()
            ->with([
                'product.category',
                'product.user.sellerProfile',
            ])
            ->where('user_id', $request->user()->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return view('buyer.checkout.index', [
                'cartItems' => $cartItems,
                'subtotal' => 0,
            ]);
        }


        $subtotal = $cartItems->sum(function ($item) {

            if (!$item->product) {
                return 0;
            }

            return $item->product->price
                * $item->quantity;
        });


        return view('buyer.checkout.index', compact(
            'cartItems',
            'subtotal'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | Proses Checkout
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
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
        | Ambil Keranjang
        |--------------------------------------------------------------------------
        */

        $cartItems = CartItem::query()
            ->with([
                'product.user',
            ])
            ->where('user_id', $buyer->id)
            ->get();


        if ($cartItems->isEmpty()) {

            return redirect()
                ->route('buyer.cart.index')
                ->withErrors([
                    'cart' => 'Keranjang belanja masih kosong.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Kelompokkan Berdasarkan Seller
        |--------------------------------------------------------------------------
        */

        $itemsBySeller = $cartItems
            ->groupBy(function ($item) {
                return $item->product?->user_id;
            });


        $orders = DB::transaction(function () use (
            $itemsBySeller,
            $buyer,
            $validated
        ) {

            $createdOrders = collect();


            foreach ($itemsBySeller as $sellerId => $items) {

                /*
                |--------------------------------------------------------------------------
                | Validasi Seller
                |--------------------------------------------------------------------------
                */

                $seller = $items
                    ->first()
                    ?->product
                    ?->user;


                if (
                    !$seller ||
                    $seller->role !== 'seller' ||
                    $seller->status !== 'active'
                ) {

                    throw ValidationException::withMessages([
                        'cart' =>
                            'Salah satu seller sudah tidak tersedia.',
                    ]);
                }


                /*
                |--------------------------------------------------------------------------
                | Buat Order
                |--------------------------------------------------------------------------
                */

                $order = Order::create([
                    'order_number' => $this->generateOrderNumber(),

                    'buyer_id' => $buyer->id,

                    'seller_id' => $seller->id,

                    'buyer_name' => $validated['buyer_name'],

                    'buyer_phone' => $validated['buyer_phone'],

                    'subtotal' => 0,

                    'status' => 'pending',

                    'notes' => $validated['notes'] ?? null,
                ]);


                $orderSubtotal = 0;


                foreach ($items as $cartItem) {

                    /*
                    |--------------------------------------------------------------------------
                    | Lock Produk Saat Checkout
                    |--------------------------------------------------------------------------
                    */

                    $product = Product::query()
                        ->whereKey($cartItem->product_id)
                        ->lockForUpdate()
                        ->first();


                    if (!$product) {

                        throw ValidationException::withMessages([
                            'cart' =>
                                'Salah satu produk sudah tidak tersedia.',
                        ]);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Cek Status Produk
                    |--------------------------------------------------------------------------
                    */

                    if ($product->status !== 'active') {

                        throw ValidationException::withMessages([
                            'cart' =>
                                "Produk {$product->name} sudah tidak aktif.",
                        ]);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Cek Stok
                    |--------------------------------------------------------------------------
                    */

                    if ($product->stock < $cartItem->quantity) {

                        throw ValidationException::withMessages([
                            'cart' =>
                                "Stok {$product->name} tidak mencukupi. "
                                . "Stok tersedia: {$product->stock}.",
                        ]);
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Snapshot Harga
                    |--------------------------------------------------------------------------
                    */

                    $itemSubtotal =
                        $product->price *
                        $cartItem->quantity;


                    $order->items()->create([
                        'product_id' => $product->id,

                        'product_name' => $product->name,

                        'price' => $product->price,

                        'quantity' => $cartItem->quantity,

                        'subtotal' => $itemSubtotal,
                    ]);


                    /*
                    |--------------------------------------------------------------------------
                    | Kurangi Stok
                    |--------------------------------------------------------------------------
                    */

                    $product->decrement(
                        'stock',
                        $cartItem->quantity
                    );


                    $orderSubtotal += $itemSubtotal;
                }


                /*
                |--------------------------------------------------------------------------
                | Update Total Order
                |--------------------------------------------------------------------------
                */

                $order->update([
                    'subtotal' => $orderSubtotal,
                ]);


                $createdOrders->push($order);
            }


            /*
            |--------------------------------------------------------------------------
            | Kosongkan Keranjang Setelah Berhasil
            |--------------------------------------------------------------------------
            */

            CartItem::query()
                ->where('user_id', $buyer->id)
                ->delete();


            return $createdOrders;
        });


        return redirect()
            ->route('buyer.orders.index')
            ->with(
                'success',
                $orders->count() > 1
                    ? 'Pesanan berhasil dibuat untuk beberapa penjual.'
                    : 'Pesanan berhasil dibuat.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Generate Nomor Pesanan
    |--------------------------------------------------------------------------
    */

    private function generateOrderNumber(): string
    {
        return 'KM-'
            . now()->format('Ymd')
            . '-'
            . Str::upper(Str::random(8));
    }
}
