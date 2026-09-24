<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'integer', 'exists:categories,id'],
            'status' => ['nullable', Rule::in(['active', 'inactive'])],
        ]);

        $search = trim($validated['search'] ?? '');
        $categoryId = $validated['category'] ?? null;
        $status = $validated['status'] ?? null;

        $query = Product::with([
            'category',
            'user.sellerProfile',
        ]);

        $query
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($sellerQuery) use ($search) {
                            $sellerQuery
                                ->where('name', 'like', "%{$search}%")
                                ->orWhereHas('sellerProfile', function ($profileQuery) use ($search) {
                                    $profileQuery->where('store_name', 'like', "%{$search}%");
                                });
                        });
                });
            })
            ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))
            ->when($status, fn ($query) => $query->where('status', $status));

        $products = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();
        $totalProducts = Product::query()->count();
        $filterActive = $search !== '' || $categoryId !== null || $status !== null;

        return view('admin.products.index', compact(
            'products',
            'categories',
            'totalProducts',
            'filterActive',
        ));
    }

    public function edit(Product $product): View
    {
        $product->load(['category', 'user.sellerProfile']);

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'price' => ['required', 'numeric', 'min:0', 'max:9999999999999.99'],
            'stock' => ['required', 'integer', 'min:0', 'max:999999999'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $product->update($validated);

        ActivityLogger::log(
            'product_updated_by_admin',
            'memperbarui harga, stok, atau status produk "'.$product->name.'"',
            $product,
            $validated,
        );

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->load('images');

        $productName = $product->name;
        $imagePaths = $product->images
            ->pluck('path')
            ->push($product->image)
            ->filter()
            ->unique();

        ActivityLogger::log(
            'product_deleted_by_admin',
            'menghapus produk "'.$productName.'"',
            $product,
        );

        $product->delete();

        $imagePaths->each(
            fn (string $path) => Storage::disk('public')->delete($path)
        );

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
