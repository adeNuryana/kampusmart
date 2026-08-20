<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        /*
        |--------------------------------------------------------------------------
        | Parameter Filter
        |--------------------------------------------------------------------------
        */

        $search = trim((string) $request->query('search'));

        $selectedCategory = $request->integer('category') ?: null;

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categories = Category::query()->withCount('products')->orderBy('name')->get();

        /*
        |--------------------------------------------------------------------------
        | Sedang melakukan pencarian/filter?
        |--------------------------------------------------------------------------
        */

        $isFiltering = $search !== '' || $selectedCategory !== null;

        /*
        |--------------------------------------------------------------------------
        | Hasil Pencarian / Filter
        |--------------------------------------------------------------------------
        */

        $products = Product::query()
            ->with(['category', 'user.sellerProfile'])

            /*
            |--------------------------------------------------------------
            | Search
            |--------------------------------------------------------------
            */

            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('name', 'like', "%{$search}%")

                        ->orWhereHas('category', function ($categoryQuery) use ($search) {
                            $categoryQuery->where('name', 'like', "%{$search}%");
                        })

                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })

            /*
            |--------------------------------------------------------------
            | Category
            |--------------------------------------------------------------
            */

            ->when($selectedCategory, fn($query) => $query->where('category_id', $selectedCategory))

            ->latest()

            ->paginate(10)

            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Produk Terbaru
        |--------------------------------------------------------------------------
        |
        | Hanya digunakan ketika customer tidak sedang search/filter.
        |
        */

        $latestProducts = Product::query()
            ->with(['category', 'user.sellerProfile'])
            ->latest()
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recommendation
        |--------------------------------------------------------------------------
        */

        $recommendedProducts = Product::query()
            ->with(['category', 'user.sellerProfile'])
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view('buyer.home', compact('categories', 'products', 'latestProducts', 'recommendedProducts', 'search', 'selectedCategory', 'isFiltering'));
    }
    public function filterProducts(Request $request)
    {
        $categoryId = $request->query('category');
        $search = trim((string) $request->query('search', ''));

        $query = Product::query()->with(['category', 'user.sellerProfile']);

        /*
    |--------------------------------------------------------------------------
    | Filter kategori
    |--------------------------------------------------------------------------
    */

        if ($categoryId !== null && $categoryId !== '') {
            $query->where('category_id', (int) $categoryId);
        }

        /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

        if ($search !== '') {
            $query->where(function ($query) use ($search) {
                $query
                    ->where('name', 'like', "%{$search}%")

                    ->orWhereHas('category', function ($categoryQuery) use ($search) {
                        $categoryQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $products = $query->latest()->take(10)->get();

        return response()->json([
            'category_id' => $categoryId,

            'total' => $products->count(),

            'html' => view('buyer.partials.product-grid', compact('products'))->render(),
        ]);
    }
}
