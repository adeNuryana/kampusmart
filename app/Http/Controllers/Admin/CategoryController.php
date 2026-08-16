<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            ->when(
                $search->isNotEmpty(),
                function ($query) use ($search) {

                    $query->where(
                        'name',
                        'like',
                        "%{$search}%"
                    );
                }
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.categories.index',
            compact('categories')
        );
    }


    public function create(): View
    {
        return view('admin.categories.create');
    }


    public function store(
        Request $request
    ): RedirectResponse {

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:categories,name',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:50',
            ],

            'description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],
        ]);


        Category::create([
            'name' => $validated['name'],

            'slug' => Str::slug(
                $validated['name']
            ),

            'icon' => $validated['icon']
                ?? null,

            'description' =>
            $validated['description']
                ?? null,

            'status' => $validated['status'],
        ]);


        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Kategori berhasil ditambahkan.'
            );
    }
    public function edit(Category $category): View
    {
        return view(
            'admin.categories.edit',
            compact('category')
        );
    }
    public function update(
        Request $request,
        Category $category
    ): RedirectResponse {

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',

                Rule::unique('categories', 'name')
                    ->ignore($category),
            ],

            'icon' => [
                'nullable',
                'string',
                'max:50',
            ],

            'description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                ]),
            ],
        ]);


        $newSlug = Str::slug($validated['name']);


        /*
    |--------------------------------------------------------------------------
    | Pastikan slug tidak bertabrakan
    |--------------------------------------------------------------------------
    */

        $slugExists = Category::query()
            ->where('slug', $newSlug)
            ->whereKeyNot($category->getKey())
            ->exists();


        if ($slugExists) {
            return back()
                ->withErrors([
                    'name' => 'Nama kategori menghasilkan slug yang sudah digunakan.',
                ])
                ->withInput();
        }


        $category->name = $validated['name'];

        $category->slug = $newSlug;

        $category->icon =
            $validated['icon'] ?? null;

        $category->description =
            $validated['description'] ?? null;

        $category->status =
            $validated['status'];

        $category->save();


        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Kategori berhasil diperbarui.'
            );
    }
    public function updateStatus(
        Category $category
    ): RedirectResponse {

        $category->status =
            $category->status === 'active'
            ? 'inactive'
            : 'active';

        $category->save();


        return back()->with(
            'success',
            $category->status === 'active'
                ? 'Kategori berhasil diaktifkan.'
                : 'Kategori berhasil dinonaktifkan.'
        );
    }
    public function destroy(
        Category $category
    ): RedirectResponse {

        if ($category->products()->exists()) {

            return back()->with(
                'error',
                'Kategori tidak dapat dihapus karena masih digunakan oleh produk.'
            );
        }


        $category->delete();


        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Kategori berhasil dihapus.'
            );
    }
}
