<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim();
        $category = $request->integer('category');
        $sort = $request->string('sort')->value();

        $query = Product::query()
            ->with([
                'category',
                'user.sellerProfile',
            ])

            // Hanya produk aktif
            ->where('status', 'active')

            // Hanya produk yang masih tersedia
            ->where('stock', '>', 0)

            // Pastikan seller masih aktif
            ->whereHas('user', function ($query) {
                $query
                    ->where('role', 'seller')
                    ->where('status', 'active');
            });


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($search->isNotEmpty()) {

            $query->where(function ($query) use ($search) {

                $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Filter Category
        |--------------------------------------------------------------------------
        */

        if ($category) {
            $query->where('category_id', $category);
        }


        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        match ($sort) {

            'price_low' => $query->orderBy('price', 'asc'),

            'price_high' => $query->orderBy('price', 'desc'),

            'name' => $query->orderBy('name', 'asc'),

            default => $query->latest(),
        };


        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $products = $query
            ->paginate(12)
            ->withQueryString();


        $categories = Category::query()
            ->orderBy('name')
            ->get();


        return view('buyer.products.index', compact(
            'products',
            'categories'
        ));
    }
    public function show(Product $product): View
    {
        /*
    |--------------------------------------------------------------------------
    | Produk harus aktif
    |--------------------------------------------------------------------------
    */

        abort_if($product->status !== 'active', 404);

        /*
    |--------------------------------------------------------------------------
    | Produk harus masih tersedia
    |--------------------------------------------------------------------------
    */

        abort_if($product->stock <= 0, 404);


        /*
    |--------------------------------------------------------------------------
    | Load Relasi
    |--------------------------------------------------------------------------
    */

        $product->load([
            'category',
            'user.sellerProfile',
        ]);


        /*
    |--------------------------------------------------------------------------
    | Pastikan Seller Aktif
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
    | Produk Terkait
    |--------------------------------------------------------------------------
    */

        $relatedProducts = Product::query()
            ->with([
                'category',
                'user.sellerProfile',
            ])
            ->where('status', 'active')
            ->where('stock', '>', 0)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->whereHas('user', function ($query) {
                $query
                    ->where('role', 'seller')
                    ->where('status', 'active');
            })
            ->latest()
            ->take(4)
            ->get();


        return view('buyer.products.show', compact(
            'product',
            'relatedProducts'
        ));
    }
}
