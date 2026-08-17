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
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();


        $subtotal = $cartItems->sum(function ($item) {

            if (!$item->product) {
                return 0;
            }

            return $item->product->price * $item->quantity;
        });


        return view('buyer.cart.index', compact(
            'cartItems',
            'subtotal'
        ));
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
        | Validasi Produk
        |--------------------------------------------------------------------------
        */

        abort_if($product->status !== 'active', 404);

        abort_if($product->stock <= 0, 404);


        $product->load('user');


        /*
        |--------------------------------------------------------------------------
        | Seller Harus Aktif
        |--------------------------------------------------------------------------
        */

        abort_if(
            !$product->user ||
                $product->user->role !== 'seller' ||
                $product->user->status !== 'active',
            404
        );


        /*
        |--------------------------------------------------------------------------
        | Validasi Quantity
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
        | Cari Produk Yang Sudah Ada
        |--------------------------------------------------------------------------
        */

        $cartItem = CartItem::query()
            ->where('user_id', $request->user()->id)
            ->where('product_id', $product->id)
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Kalau Sudah Ada, Tambahkan Quantity
        |--------------------------------------------------------------------------
        */

        if ($cartItem) {

            $newQuantity =
                $cartItem->quantity +
                $validated['quantity'];


            /*
            |--------------------------------------------------------------------------
            | Jangan Melebihi Stok
            |--------------------------------------------------------------------------
            */

            if ($newQuantity > $product->stock) {

                return back()
                    ->withErrors([
                        'quantity' =>
                        'Jumlah produk di keranjang melebihi stok tersedia.',
                    ]);
            }


            $cartItem->update([
                'quantity' => $newQuantity,
            ]);
        } else {

            /*
            |--------------------------------------------------------------------------
            | Belum Ada Di Keranjang
            |--------------------------------------------------------------------------
            */

            CartItem::create([
                'user_id' => $request->user()->id,
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
            ]);
        }


        return redirect()
            ->route('buyer.cart.index')
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
        | Pastikan Keranjang Milik User Login
        |--------------------------------------------------------------------------
        */

        abort_if(
            $cartItem->user_id !== $request->user()->id,
            403
        );


        $cartItem->load('product');


        abort_if(!$cartItem->product, 404);


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
                'max:' . $cartItem->product->stock,
            ],
        ]);


        $cartItem->update([
            'quantity' => $validated['quantity'],
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
            $cartItem->user_id !== $request->user()->id,
            403
        );


        $cartItem->delete();


        return back()->with(
            'success',
            'Produk berhasil dihapus dari keranjang.'
        );
    }
}
