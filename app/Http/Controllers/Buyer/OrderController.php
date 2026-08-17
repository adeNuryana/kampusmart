<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::query()
            ->with([
                'seller.sellerProfile',
                'items',
            ])
            ->where('buyer_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('buyer.orders.index', compact(
            'orders'
        ));
    }
public function whatsapp(
    Request $request,
    Order $order
) {
    /*
    |--------------------------------------------------------------------------
    | Pastikan Order Milik Buyer
    |--------------------------------------------------------------------------
    */

    abort_if(
        (int) $order->buyer_id !==
        (int) $request->user()->id,
        403
    );


    /*
    |--------------------------------------------------------------------------
    | Load Data
    |--------------------------------------------------------------------------
    */

    $order->load([
        'seller.sellerProfile',
        'items',
    ]);


    /*
    |--------------------------------------------------------------------------
    | Nomor WhatsApp Seller
    |--------------------------------------------------------------------------
    */

    $whatsapp = $order
        ->seller
        ?->sellerProfile
        ?->whatsapp;


    if (!$whatsapp) {

        return redirect()
            ->route('buyer.orders.index')
            ->with(
                'error',
                'Nomor WhatsApp penjual belum tersedia.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Normalisasi Nomor
    |--------------------------------------------------------------------------
    */

    $whatsapp = preg_replace(
        '/[^0-9]/',
        '',
        $whatsapp
    );


    /*
    |--------------------------------------------------------------------------
    | 0812... -> 62812...
    |--------------------------------------------------------------------------
    */

    if (
        str_starts_with(
            $whatsapp,
            '0'
        )
    ) {

        $whatsapp =
            '62' .
            substr(
                $whatsapp,
                1
            );
    }


    /*
    |--------------------------------------------------------------------------
    | 812... -> 62812...
    |--------------------------------------------------------------------------
    */

    elseif (
        str_starts_with(
            $whatsapp,
            '8'
        )
    ) {

        $whatsapp =
            '62' .
            $whatsapp;
    }


    /*
    |--------------------------------------------------------------------------
    | Nama Toko
    |--------------------------------------------------------------------------
    */

    $storeName =
        $order
            ->seller
            ?->sellerProfile
            ?->store_name
        ?? $order->seller?->name
        ?? 'Penjual';


    /*
    |--------------------------------------------------------------------------
    | Format Produk
    |--------------------------------------------------------------------------
    */

    $itemsText = '';


    foreach (
        $order->items as $index => $item
    ) {

        $itemsText .=
            ($index + 1) .
            '. *' .
            $item->product_name .
            "*\n";


        $itemsText .=
            '   ' .
            $item->quantity .
            ' x Rp ' .
            number_format(
                $item->price,
                0,
                ',',
                '.'
            ) .
            "\n";


        $itemsText .=
            '   Subtotal: Rp ' .
            number_format(
                $item->subtotal,
                0,
                ',',
                '.'
            ) .
            "\n\n";
    }


    /*
    |--------------------------------------------------------------------------
    | Format Pesan
    |--------------------------------------------------------------------------
    */

    $message =
        "Halo Kak 👋\n\n" .

        "Saya ingin melakukan pemesanan melalui *KampusMart*.\n\n" .

        "━━━━━━━━━━━━━━━━━━\n" .

        "*DETAIL PESANAN*\n" .

        "━━━━━━━━━━━━━━━━━━\n\n" .

        "No. Pesanan: *{$order->order_number}*\n" .

        "Toko: {$storeName}\n\n" .

        "*DATA PEMBELI*\n" .

        "Nama: {$order->buyer_name}\n" .

        "WhatsApp: " .
        ($order->buyer_phone ?? '-') .
        "\n\n" .

        "*PRODUK YANG DIPESAN*\n\n" .

        $itemsText .

        "━━━━━━━━━━━━━━━━━━\n" .

        "*TOTAL: Rp " .
        number_format(
            $order->subtotal,
            0,
            ',',
            '.'
        ) .
        "*\n" .

        "━━━━━━━━━━━━━━━━━━\n";


    /*
    |--------------------------------------------------------------------------
    | Catatan
    |--------------------------------------------------------------------------
    */

    if ($order->notes) {

        $message .=
            "\n*CATATAN PEMBELI*\n" .
            $order->notes .
            "\n";
    }


    $message .=
        "\nMohon konfirmasi pesanan saya ya Kak. Terima kasih 🙏";


    /*
    |--------------------------------------------------------------------------
    | WhatsApp URL
    |--------------------------------------------------------------------------
    */

    $url =
        'https://wa.me/' .
        $whatsapp .
        '?text=' .
        rawurlencode(
            $message
        );


    /*
    |--------------------------------------------------------------------------
    | Redirect
    |--------------------------------------------------------------------------
    */

    return redirect()->away(
        $url
    );
}
}
