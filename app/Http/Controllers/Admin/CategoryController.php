<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim();

        $categories = Category::query()
            ->withCount('products')
            ->when($search->isNotEmpty(), function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],

            'icon' => ['required', Rule::in(['food', 'drink', 'electronics', 'fashion', 'book', 'accessories', 'health', 'sport', 'beauty', 'home', 'service', 'other', 'custom'])],

            'icon_image' => [Rule::requiredIf($request->input('icon') === 'custom'), 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],

            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);
        $baseSlug = Str::slug($validated['name']);

        $slug = $baseSlug;

        $counter = 1;

        while (Category::query()->where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;

            $counter++;
        }

        $validated['slug'] = $slug;

        if ($request->input('icon') === 'custom') {
            $validated['icon_image'] = $request->file('icon_image')->store('category-icons', 'public');
        } else {
            $validated['icon_image'] = null;
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],

            'icon' => ['required', Rule::in(['food', 'drink', 'electronics', 'fashion', 'book', 'accessories', 'health', 'sport', 'beauty', 'home', 'service', 'other', 'custom'])],

            'icon_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],

            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        /*
    |--------------------------------------------------------------------------
    | CUSTOM ICON
    |--------------------------------------------------------------------------
    */

        if ($request->input('icon') === 'custom') {
            if ($request->hasFile('icon_image')) {
                if ($category->icon_image) {
                    Storage::disk('public')->delete($category->icon_image);
                }

                $validated['icon_image'] = $request->file('icon_image')->store('category-icons', 'public');
            } else {
                /*
            | Kalau edit dan tidak upload gambar baru,
            | pertahankan gambar lama.
            */

                $validated['icon_image'] = $category->icon_image;
            }
        } else {
            /*
        | Beralih dari custom ke icon bawaan.
        */

            if ($category->icon_image) {
                Storage::disk('public')->delete($category->icon_image);
            }

            $validated['icon_image'] = null;
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }
    public function updateStatus(Category $category): RedirectResponse
    {
        $category->status = $category->status === 'active' ? 'inactive' : 'active';

        $category->save();

        return back()->with('success', $category->status === 'active' ? 'Kategori berhasil diaktifkan.' : 'Kategori berhasil dinonaktifkan.');
    }
    public function destroy(Category $category): RedirectResponse
    {
        if ($category->products()->exists()) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh produk.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
