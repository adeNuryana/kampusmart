<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OrderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR PESANAN BUYER
    |--------------------------------------------------------------------------
    */
    public function index(Request $request): View
    {
        $buyer = $request->user();

        $orders = Order::query()
            ->with(['items.product', 'seller.sellerProfile'])
            ->where('buyer_id', $buyer->id)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $cartCount = CartItem::query()->where('user_id', $buyer->id)->sum('quantity');

        $activeOrderCount = Order::query()
            ->where('buyer_id', $buyer->id)
            ->whereIn('status', ['pending', 'processing'])
            ->count();

        $totalTransactionCount = Order::query()->where('buyer_id', $buyer->id)->count();

        $totalTransactionAmount = Order::query()->where('buyer_id', $buyer->id)->sum('subtotal');

        return view('buyer.orders.index', compact('orders', 'cartCount', 'activeOrderCount', 'totalTransactionCount', 'totalTransactionAmount'));
    }

    /*
    |--------------------------------------------------------------------------
    | BELI SEKARANG
    |--------------------------------------------------------------------------
    */
    public function storeDirect(Request $request, Product $product): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
            'payment_method' => ['required', 'in:transfer,cash'],
        ]);

        $buyer = $request->user();

        $quantity = (int) $validated['quantity'];
        $paymentMethod = $validated['payment_method'];

        /*
        |--------------------------------------------------------------------------
        | CEK PRODUK
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
        | NOMOR WHATSAPP SELLER
        |--------------------------------------------------------------------------
        */
        $whatsapp = $seller->sellerProfile?->whatsapp ?? $seller->phone;

        if (!$whatsapp) {
            return back()->withErrors([
                'whatsapp' => 'Nomor WhatsApp seller belum tersedia.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | BUAT PESANAN
        |--------------------------------------------------------------------------
        */
        $order = DB::transaction(function () use ($buyer, $seller, $product, $quantity, $paymentMethod) {
            /*
            |--------------------------------------------------------------------------
            | LOCK PRODUK
            |--------------------------------------------------------------------------
            */
            $lockedProduct = Product::query()->lockForUpdate()->findOrFail($product->id);

            /*
            |--------------------------------------------------------------------------
            | CEK STATUS PRODUK LAGI SETELAH LOCK
            |--------------------------------------------------------------------------
            */
            if ($lockedProduct->status !== 'active') {
                abort(422, 'Produk sedang tidak tersedia.');
            }

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
                'payment_method' => $paymentMethod,

                'status' => 'pending',
            ]);

            /*
            |--------------------------------------------------------------------------
            | CREATE ORDER ITEM
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
        | LOAD ITEM YANG SUDAH TERSIMPAN
        |--------------------------------------------------------------------------
        */
        $order->load('items');

        $orderItem = $order->items->first();

        /*
        |--------------------------------------------------------------------------
        | FORMAT NOMOR WHATSAPP
        |--------------------------------------------------------------------------
        */
        $whatsapp = $this->formatWhatsappNumber($whatsapp);

        /*
        |--------------------------------------------------------------------------
        | LABEL METODE PEMBAYARAN
        |--------------------------------------------------------------------------
        */
        $paymentLabel = $this->paymentLabel($order->payment_method);

        /*
        |--------------------------------------------------------------------------
        | PESAN WHATSAPP
        |--------------------------------------------------------------------------
        */
        $message = "Halo, saya {$order->buyer_name}.\n\n" . "Saya ingin membeli produk dari KampusMart.\n\n" . "📦 *Detail Pesanan*\n" . "Nomor Pesanan: {$order->order_number}\n" . "Produk: {$orderItem->product_name}\n" . "Jumlah: {$orderItem->quantity}\n" . 'Harga Satuan: Rp' . number_format($orderItem->price, 0, ',', '.') . "\n" . 'Total: Rp' . number_format($order->subtotal, 0, ',', '.') . "\n\n" . "💳 *Metode Pembayaran*\n" . "{$paymentLabel}\n\n" . 'Apakah pesanan saya bisa diproses?';

        /*
        |--------------------------------------------------------------------------
        | WHATSAPP URL
        |--------------------------------------------------------------------------
        */
        $waUrl = 'https://wa.me/' . $whatsapp . '?text=' . urlencode($message);

        return redirect()->away($waUrl);
    }

    /*
    |--------------------------------------------------------------------------
    | BUKA WHATSAPP DARI PESANAN YANG SUDAH ADA
    |--------------------------------------------------------------------------
    */
    public function whatsapp(Request $request, Order $order): RedirectResponse
    {
        $buyer = $request->user();

        /*
        |--------------------------------------------------------------------------
        | CEK KEPEMILIKAN ORDER
        |--------------------------------------------------------------------------
        */
        abort_unless((int) $order->buyer_id === (int) $buyer->id, 403, 'Kamu tidak memiliki akses ke pesanan ini.');

        /*
        |--------------------------------------------------------------------------
        | LOAD RELATION
        |--------------------------------------------------------------------------
        */
        $order->load(['items.product', 'seller.sellerProfile']);

        /*
        |--------------------------------------------------------------------------
        | SELLER
        |--------------------------------------------------------------------------
        */
        $seller = $order->seller;

        if (!$seller) {
            return back()->withErrors([
                'whatsapp' => 'Seller pesanan tidak ditemukan.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | NOMOR WHATSAPP
        |--------------------------------------------------------------------------
        */
        $whatsapp = $seller->sellerProfile?->whatsapp ?? $seller->phone;

        if (!$whatsapp) {
            return back()->withErrors([
                'whatsapp' => 'Nomor WhatsApp seller belum tersedia.',
            ]);
        }

        $whatsapp = $this->formatWhatsappNumber($whatsapp);

        /*
        |--------------------------------------------------------------------------
        | DETAIL PRODUK
        |--------------------------------------------------------------------------
        */
        $productLines = $order->items
            ->map(function ($item) {
                return "• {$item->product_name}\n" . "  Jumlah: {$item->quantity}\n" . '  Harga: Rp' . number_format($item->price, 0, ',', '.') . "\n" . '  Subtotal: Rp' . number_format($item->subtotal, 0, ',', '.');
            })
            ->implode("\n\n");

        /*
        |--------------------------------------------------------------------------
        | METODE PEMBAYARAN
        |--------------------------------------------------------------------------
        */
        $paymentLabel = $this->paymentLabel($order->payment_method);

        /*
        |--------------------------------------------------------------------------
        | PESAN WHATSAPP
        |--------------------------------------------------------------------------
        */
        $message = "Halo, saya {$order->buyer_name}.\n\n" . "Saya ingin menindaklanjuti pesanan saya di KampusMart.\n\n" . "📦 *Detail Pesanan*\n" . "Nomor Pesanan: {$order->order_number}\n\n" . "{$productLines}\n\n" . "💰 *Total Pesanan*\n" . 'Rp' . number_format($order->subtotal, 0, ',', '.') . "\n\n" . "💳 *Metode Pembayaran*\n" . "{$paymentLabel}\n\n" . 'Apakah pesanan saya bisa diproses?';

        /*
        |--------------------------------------------------------------------------
        | WHATSAPP URL
        |--------------------------------------------------------------------------
        */
        $waUrl = 'https://wa.me/' . $whatsapp . '?text=' . urlencode($message);

        return redirect()->away($waUrl);
    }

    /*
    |--------------------------------------------------------------------------
    | FORMAT NOMOR WHATSAPP
    |--------------------------------------------------------------------------
    */
    private function formatWhatsappNumber(string $number): string
    {
        $number = preg_replace('/\D+/', '', $number);

        if (str_starts_with($number, '0')) {
            return '62' . substr($number, 1);
        }

        if (str_starts_with($number, '8')) {
            return '62' . $number;
        }

        return $number;
    }

    /*
    |--------------------------------------------------------------------------
    | LABEL METODE PEMBAYARAN
    |--------------------------------------------------------------------------
    */
    private function paymentLabel(?string $paymentMethod): string
    {
        return match ($paymentMethod) {
            'transfer' => 'Transfer',
            'cash' => 'Cash / Tunai',
            default => 'Belum ditentukan',
        };
    }
}
