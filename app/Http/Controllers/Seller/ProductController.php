<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\ActivityLogger;
use App\Services\ImageCompressor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

class ProductController extends Controller
{
    public function __construct(private readonly ImageCompressor $imageCompressor) {}

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

            'images' => [
                'nullable',
                'array',
                'max:5',
            ],

            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:max_width=6000,max_height=6000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */

        $imagePaths = $this->storeUploadedImages(
            $request->file('images', [])
        );

        try {
            $product = DB::transaction(function () use ($request, $validated, $imagePaths) {
                $product = Product::create([
                    'seller_id' => $request->user()->id,

                    'category_id' =>
                    $validated['category_id'],

                    'name' =>
                    $validated['name'],

                    'description' =>
                    $validated['description'] ?? null,

                    'slug' => $this->generateUniqueSlug($validated['name']),

                    'price' =>
                    $validated['price'],

                    'stock' =>
                    $validated['stock'],

                    'status' =>
                    $validated['status'],

                    // Tetap disimpan sebagai thumbnail untuk kompatibilitas data lama.
                    'image' =>
                    $imagePaths[0] ?? null,
                ]);

                $this->createProductImages($product, $imagePaths);

                return $product;
            });
        } catch (Throwable $exception) {
            $this->deleteStoredImages($imagePaths);

            throw $exception;
        }

        ActivityLogger::log(
            'product_created',
            'menambahkan produk "' . $product->name . '"',
            $product
        );
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

        $product->load('images');


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

            'images' => [
                'nullable',
                'array',
                'max:5',
            ],

            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:max_width=6000,max_height=6000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Image Lama
        |--------------------------------------------------------------------------
        */

        $productData = [
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
        ];

        if ($request->hasFile('images')) {
            $product->load('images');

            $oldImagePaths = $product->images
                ->pluck('path')
                ->push($product->image)
                ->filter()
                ->unique()
                ->values();

            $newImagePaths = $this->storeUploadedImages(
                $request->file('images', [])
            );

            $productData['image'] = $newImagePaths[0] ?? null;

            try {
                DB::transaction(function () use ($product, $productData, $newImagePaths) {
                    $product->update($productData);
                    $product->images()->delete();
                    $this->createProductImages($product, $newImagePaths);
                });
            } catch (Throwable $exception) {
                $this->deleteStoredImages($newImagePaths);

                throw $exception;
            }

            $this->deleteStoredImages($oldImagePaths);
        } else {
            $product->update($productData);
        }

        ActivityLogger::log(
            'product_updated',
            'mengubah produk "' . $product->name . '"',
            $product
        );

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

        $product->load('images');


        /*
        |--------------------------------------------------------------------------
        | Hapus Image
        |--------------------------------------------------------------------------
        */

        $imagePaths = $product->images
            ->pluck('path')
            ->push($product->image)
            ->filter()
            ->unique()
            ->values();

        $productName = $product->name;
        ActivityLogger::log(
            'product_deleted',
            'menghapus produk "' . $productName . '"',
            $product
        );
        $product->delete();
        $this->deleteStoredImages($imagePaths);


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
            $product->seller_id !==
                $request->user()->id,
            403
        );
    }
    private function generateUniqueSlug(string $name): string
    {
        $slug = Str::slug($name);

        $originalSlug = $slug;

        $counter = 1;

        while (
            Product::where('slug', $slug)->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;

            $counter++;
        }

        return $slug;
    }

    private function storeUploadedImages(array $images): array
    {
        $paths = [];

        try {
            foreach ($images as $image) {
                $paths[] = $this->imageCompressor->store(
                    $image,
                    'products',
                    1600,
                    1600,
                );
            }
        } catch (Throwable $exception) {
            $this->deleteStoredImages($paths);

            throw $exception;
        }

        return $paths;
    }

    private function createProductImages(Product $product, array $paths): void
    {
        if ($paths === []) {
            return;
        }

        $product->images()->createMany(
            collect($paths)
                ->values()
                ->map(fn (string $path, int $position) => [
                    'path' => $path,
                    'position' => $position,
                ])
                ->all()
        );
    }

    private function deleteStoredImages(iterable $paths): void
    {
        collect($paths)
            ->filter()
            ->unique()
            ->each(fn (string $path) => Storage::disk('public')->delete($path));
    }
}
