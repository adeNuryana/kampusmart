<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
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

        $categories = Category::query()
            ->withCount([
                'products' => fn (Builder $query) => $this->availableProductConstraints($query),
            ])
            ->orderBy('name')
            ->get();

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

        $products = $this->availableProductsQuery()

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

            ->when($selectedCategory, fn ($query) => $query->where('category_id', $selectedCategory))

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

        $latestProducts = $this->availableProductsQuery()
            ->latest()
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recommendation
        |--------------------------------------------------------------------------
        */

        $recommendedProducts = $this->availableProductsQuery()
            ->inRandomOrder()
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Semua Produk
        |--------------------------------------------------------------------------
        */

        $allProducts = $this->availableProductsQuery()
            ->latest()
            ->paginate(12, ['*'], 'all_page')
            ->withQueryString()
            ->fragment('semua-produk');

        $cartCount = 0;

        if ($request->user()?->role === 'buyer') {
            $cartCount = CartItem::query()
                ->where('user_id', $request->user()->id)
                ->sum('quantity');
        }

        return view('buyer.home', compact('categories', 'products', 'latestProducts', 'recommendedProducts', 'allProducts', 'search', 'selectedCategory', 'isFiltering', 'cartCount'));
    }

    public function filterProducts(Request $request)
    {
        $categoryId = $request->query('category');
        $search = trim((string) $request->query('search', ''));

        $query = $this->availableProductsQuery();

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

    private function availableProductsQuery(): Builder
    {
        return $this->availableProductConstraints(
            Product::query()->with(['category', 'user.sellerProfile'])
        );
    }

    private function availableProductConstraints(Builder $query): Builder
    {
        return $query
            ->where('status', 'active')
            ->where('stock', '>', 0)
            ->whereHas('user', function (Builder $query) {
                $query
                    ->where('role', 'seller')
                    ->where('status', 'active');
            });
    }
}
