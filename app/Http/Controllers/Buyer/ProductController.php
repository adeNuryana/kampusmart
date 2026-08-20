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
            ->with(['category', 'user.sellerProfile'])

            // Hanya produk aktif
            ->where('status', 'active')

            // Hanya produk yang masih tersedia
            ->where('stock', '>', 0)

            // Pastikan seller masih aktif
            ->whereHas('user', function ($query) {
                $query->where('role', 'seller')->where('status', 'active');
            });

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($search->isNotEmpty()) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")->orWhere('description', 'like', "%{$search}%");
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

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::query()->orderBy('name')->get();

        return view('buyer.products.index', compact('products', 'categories'));
    }
    public function show(Product $product): View
    {
        $product->load(['category', 'user.sellerProfile']);

        /*
    |--------------------------------------------------------------------------
    | Produk dari toko / seller yang sama
    |--------------------------------------------------------------------------
    */

        $seller = $product->user;

        $sellerProducts = collect();

        if ($seller) {
            $sellerProducts = Product::query()
                ->with(['category', 'user.sellerProfile'])
                ->whereBelongsTo($seller, 'user')
                ->where('id', '!=', $product->id)
                ->latest()
                ->take(5)
                ->get();
        }

        /*
    |--------------------------------------------------------------------------
    | Produk serupa berdasarkan kategori
    |--------------------------------------------------------------------------
    */

        $relatedProducts = Product::query()
            ->with(['category', 'user.sellerProfile'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(5)
            ->get();

        return view('buyer.products.show', compact('product', 'sellerProducts', 'relatedProducts'));
    }
}
