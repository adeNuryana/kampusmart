<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Daftar Keranjang
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $cartItems = CartItem::query()
            ->with([
                'product.category',
                'product.user.sellerProfile',
            ])
            ->where(
                'user_id',
                $request->user()->id
            )
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Total Semua Keranjang
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


        /*
        |--------------------------------------------------------------------------
        | Group Berdasarkan Seller
        |--------------------------------------------------------------------------
        */

        $sellerGroups = $cartItems
            ->filter(
                fn ($item) =>
                    $item->product !== null
            )
            ->groupBy(
                fn ($item) =>
                    $item->product->seller_id
            );


        /*
        |--------------------------------------------------------------------------
        | Subtotal Per Seller
        |--------------------------------------------------------------------------
        */

        $sellerSubtotals = $sellerGroups
            ->map(
                function ($items) {

                    return $items->sum(
                        fn ($item) =>
                            $item->product->price *
                            $item->quantity
                    );
                }
            );


        return view(
            'buyer.cart.index',
            compact(
                'cartItems',
                'subtotal',
                'sellerGroups',
                'sellerSubtotals'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Tambah Ke Keranjang
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request,
        Product $product
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Produk Harus Aktif
        |--------------------------------------------------------------------------
        */

        abort_if(
            $product->status !== 'active',
            404
        );


        abort_if(
            $product->stock <= 0,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | Seller
        |--------------------------------------------------------------------------
        */

        $product->load('user');


        abort_if(
            !$product->user ||
            $product->user->role !== 'seller' ||
            $product->user->status !== 'active',
            404
        );


        /*
        |--------------------------------------------------------------------------
        | Quantity
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' . $product->stock,
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Produk Sudah Ada?
        |--------------------------------------------------------------------------
        */

        $cartItem = CartItem::query()
            ->where(
                'user_id',
                $request->user()->id
            )
            ->where(
                'product_id',
                $product->id
            )
            ->first();


        if ($cartItem) {

            $newQuantity =
                $cartItem->quantity +
                $validated['quantity'];


            if (
                $newQuantity >
                $product->stock
            ) {

                return back()
                    ->withErrors([
                        'quantity' =>
                            'Jumlah produk di keranjang melebihi stok tersedia.',
                    ]);
            }


            $cartItem->update([
                'quantity' =>
                    $newQuantity,
            ]);

        } else {

            CartItem::create([
                'user_id' =>
                    $request->user()->id,

                'product_id' =>
                    $product->id,

                'quantity' =>
                    $validated['quantity'],
            ]);
        }


        return redirect()
            ->route(
                'buyer.cart.index'
            )
            ->with(
                'success',
                'Produk berhasil ditambahkan ke keranjang.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Quantity
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        CartItem $cartItem
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Ownership
        |--------------------------------------------------------------------------
        */

        abort_if(
            (int) $cartItem->user_id !==
            (int) $request->user()->id,
            403
        );


        $cartItem->load('product');


        abort_if(
            !$cartItem->product,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' .
                    $cartItem
                        ->product
                        ->stock,
            ],
        ]);


        $cartItem->update([
            'quantity' =>
                $validated['quantity'],
        ]);


        return back()->with(
            'success',
            'Jumlah produk berhasil diperbarui.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Hapus Produk
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Request $request,
        CartItem $cartItem
    ): RedirectResponse {

        abort_if(
            (int) $cartItem->user_id !==
            (int) $request->user()->id,
            403
        );


        $cartItem->delete();


        return back()->with(
            'success',
            'Produk berhasil dihapus dari keranjang.'
        );
    }
}
