<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Daftar Produk Seller
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $search = $request->string('search')->trim();
        $status = $request->string('status')->trim();
        $category = $request->integer('category');

        $products = Product::query()
            ->with('category')

            // Hanya produk seller login
            ->where('seller_id', $request->user()->id)

            /*
            |--------------------------------------------------------------------------
            | Search
            |--------------------------------------------------------------------------
            */

            ->when($search->isNotEmpty(), function ($query) use ($search) {

                $query->where(function ($query) use ($search) {

                    $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere(
                            'description',
                            'like',
                            "%{$search}%"
                        );

                });

            })

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            ->when(
                in_array(
                    $status->value(),
                    ['active', 'inactive'],
                    true
                ),
                function ($query) use ($status) {

                    $query->where(
                        'status',
                        $status->value()
                    );

                }
            )

            /*
            |--------------------------------------------------------------------------
            | Category
            |--------------------------------------------------------------------------
            */

            ->when(
                $category,
                function ($query) use ($category) {

                    $query->where(
                        'category_id',
                        $category
                    );

                }
            )

            ->latest()
            ->paginate(10)
            ->withQueryString();


        $categories = Category::query()
            ->orderBy('name')
            ->get();


        return view(
            'seller.products.index',
            compact(
                'products',
                'categories'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Tambah
    |--------------------------------------------------------------------------
    */

    public function create(): View
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view(
            'seller.products.create',
            compact('categories')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Simpan
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                ]),
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store(
                    'products',
                    'public'
                );

        }


        Product::create([
            'user_id' => $request->user()->id,

            'category_id' =>
                $validated['category_id'],

            'name' =>
                $validated['name'],

            'description' =>
                $validated['description'] ?? null,

            'price' =>
                $validated['price'],

            'stock' =>
                $validated['stock'],

            'status' =>
                $validated['status'],

            'image' =>
                $imagePath,
        ]);


        return redirect()
            ->route('seller.products.index')
            ->with(
                'success',
                'Produk berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(
        Request $request,
        Product $product
    ): View {

        $this->authorizeProduct(
            $request,
            $product
        );


        $categories = Category::query()
            ->orderBy('name')
            ->get();


        return view(
            'seller.products.edit',
            compact(
                'product',
                'categories'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Product $product
    ) {

        $this->authorizeProduct(
            $request,
            $product
        );


        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                ]),
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Image Lama
        |--------------------------------------------------------------------------
        */

        $imagePath = $product->image;


        /*
        |--------------------------------------------------------------------------
        | Image Baru
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if (
                $imagePath &&
                Storage::disk('public')
                    ->exists($imagePath)
            ) {

                Storage::disk('public')
                    ->delete($imagePath);

            }


            $imagePath = $request
                ->file('image')
                ->store(
                    'products',
                    'public'
                );
        }


        $product->update([
            'category_id' =>
                $validated['category_id'],

            'name' =>
                $validated['name'],

            'description' =>
                $validated['description'] ?? null,

            'price' =>
                $validated['price'],

            'stock' =>
                $validated['stock'],

            'status' =>
                $validated['status'],

            'image' =>
                $imagePath,
        ]);


        return redirect()
            ->route('seller.products.index')
            ->with(
                'success',
                'Produk berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Status
    |--------------------------------------------------------------------------
    */

    public function updateStatus(
        Request $request,
        Product $product
    ) {

        $this->authorizeProduct(
            $request,
            $product
        );


        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                ]),
            ],
        ]);


        $product->update([
            'status' =>
                $validated['status'],
        ]);


        return back()->with(
            'success',
            $validated['status'] === 'active'
                ? 'Produk berhasil diaktifkan.'
                : 'Produk berhasil dinonaktifkan.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Request $request,
        Product $product
    ) {

        $this->authorizeProduct(
            $request,
            $product
        );


        /*
        |--------------------------------------------------------------------------
        | Hapus Image
        |--------------------------------------------------------------------------
        */

        if (
            $product->image &&
            Storage::disk('public')
                ->exists($product->image)
        ) {

            Storage::disk('public')
                ->delete($product->image);

        }


        $product->delete();


        return back()->with(
            'success',
            'Produk berhasil dihapus.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Security
    |--------------------------------------------------------------------------
    */

    private function authorizeProduct(
        Request $request,
        Product $product
    ): void {

        abort_if(
            $product->user_id !==
                $request->user()->id,
            403
        );

    }
}
