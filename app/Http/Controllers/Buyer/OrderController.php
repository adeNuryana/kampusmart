<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function storeDirect(Request $request, Product $product): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $buyer = $request->user();

        $quantity = (int) $validated['quantity'];

        /*
        |--------------------------------------------------------------------------
        | PRODUK
        |--------------------------------------------------------------------------
        */

        if ($product->status !== 'active') {
            return back()->withErrors([
                'quantity' => 'Produk sedang tidak tersedia.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | SELLER
        |--------------------------------------------------------------------------
        */

        $seller = $product->user?->load('sellerProfile');

        if (!$seller) {
            return back()->withErrors([
                'quantity' => 'Seller produk tidak ditemukan.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | WHATSAPP SELLER
        |--------------------------------------------------------------------------
        */

        $whatsapp = $seller->sellerProfile?->whatsapp ?? $seller->phone;

        if (!$whatsapp) {
            return back()->withErrors([
                'quantity' => 'Nomor WhatsApp seller belum tersedia.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | BUAT PESANAN
        |--------------------------------------------------------------------------
        */

        $order = DB::transaction(function () use ($buyer, $seller, $product, $quantity) {
            /*
                |--------------------------------------------------------------------------
                | LOCK PRODUK
                |--------------------------------------------------------------------------
                */

            $lockedProduct = Product::query()->lockForUpdate()->findOrFail($product->id);

            /*
                |--------------------------------------------------------------------------
                | CEK STOK
                |--------------------------------------------------------------------------
                */

            if ($lockedProduct->stock < $quantity) {
                abort(422, 'Stok produk tidak mencukupi.');
            }

            /*
                |--------------------------------------------------------------------------
                | TOTAL
                |--------------------------------------------------------------------------
                */

            $subtotal = $lockedProduct->price * $quantity;

            /*
                |--------------------------------------------------------------------------
                | CREATE ORDER
                |--------------------------------------------------------------------------
                */

            $order = Order::create([
                'order_number' => 'ORD-' . now('Asia/Jakarta')->format('Ymd') . '-' . strtoupper(Str::random(6)),

                'buyer_id' => $buyer->id,

                'seller_id' => $seller->id,

                'buyer_name' => $buyer->name,

                'buyer_phone' => $buyer->phone,

                'subtotal' => $subtotal,

                'status' => 'pending',
            ]);

            /*
                |--------------------------------------------------------------------------
                | ORDER ITEM
                |--------------------------------------------------------------------------
                */

            OrderItem::create([
                'order_id' => $order->id,

                'product_id' => $lockedProduct->id,

                'product_name' => $lockedProduct->name,

                'price' => $lockedProduct->price,

                'quantity' => $quantity,

                'subtotal' => $subtotal,
            ]);

            /*
                |--------------------------------------------------------------------------
                | KURANGI STOK
                |--------------------------------------------------------------------------
                */

            $lockedProduct->decrement('stock', $quantity);

            return $order;
        });

        /*
        |--------------------------------------------------------------------------
        | FORMAT NOMOR WHATSAPP
        |--------------------------------------------------------------------------
        */

        $whatsapp = preg_replace('/\D+/', '', $whatsapp);

        /*
        | 08123456789
        | menjadi
        | 628123456789
        */

        if (str_starts_with($whatsapp, '0')) {
            $whatsapp = '62' . substr($whatsapp, 1);
        }

        /*
        |--------------------------------------------------------------------------
        | PESAN WHATSAPP
        |--------------------------------------------------------------------------
        */

        $message = "Halo, saya {$buyer->name}.\n\n" . "Saya ingin membeli produk dari KampusMart.\n\n" . "Nomor Pesanan: {$order->order_number}\n" . "Produk: {$product->name}\n" . "Jumlah: {$quantity}\n" . 'Harga: Rp' . number_format($product->price, 0, ',', '.') . "\n" . 'Total: Rp' . number_format($order->subtotal, 0, ',', '.') . "\n\n" . 'Apakah pesanan saya bisa diproses?';

        /*
        |--------------------------------------------------------------------------
        | WHATSAPP URL
        |--------------------------------------------------------------------------
        */

        $waUrl = 'https://wa.me/' . $whatsapp . '?text=' . urlencode($message);

        /*
        |--------------------------------------------------------------------------
        | LANGSUNG KE WHATSAPP
        |--------------------------------------------------------------------------
        */

        return redirect()->away($waUrl);
    }
}
