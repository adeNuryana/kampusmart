<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductGalleryTest extends TestCase
{
    use DatabaseTransactions;

    public function test_seller_can_upload_five_compressed_product_images_and_buyer_can_view_them(): void
    {
        Storage::fake('public');

        [$seller, $category] = $this->createSellerAndCategory();
        $images = $this->fakeImages(5);

        $this->actingAs($seller)
            ->post(route('seller.products.store'), [
                'category_id' => $category->id,
                'name' => 'Produk Galeri Lima Foto',
                'description' => 'Produk untuk menguji galeri.',
                'price' => 25000,
                'stock' => 10,
                'status' => 'active',
                'images' => $images,
            ])
            ->assertRedirect(route('seller.products.index'))
            ->assertSessionHas('success');

        $product = Product::query()
            ->where('seller_id', $seller->id)
            ->where('name', 'Produk Galeri Lima Foto')
            ->firstOrFail();

        $gallery = $product->images()->get();

        $this->assertCount(5, $gallery);
        $this->assertSame($gallery->first()->path, $product->image);
        $this->assertSame([0, 1, 2, 3, 4], $gallery->pluck('position')->all());

        $gallery->each(function ($image): void {
            $this->assertStringEndsWith('.webp', $image->path);
            Storage::disk('public')->assertExists($image->path);
        });

        $response = $this->get(route('buyer.products.show', $product));

        $response->assertOk();

        $gallery->each(
            fn ($image) => $response->assertSee(asset('storage/'.$image->path), false)
        );
    }

    public function test_seller_cannot_upload_more_than_five_product_images(): void
    {
        Storage::fake('public');

        [$seller, $category] = $this->createSellerAndCategory();

        $this->actingAs($seller)
            ->from(route('seller.products.create'))
            ->post(route('seller.products.store'), [
                'category_id' => $category->id,
                'name' => 'Produk Terlalu Banyak Foto',
                'price' => 25000,
                'stock' => 10,
                'status' => 'active',
                'images' => $this->fakeImages(6),
            ])
            ->assertRedirect(route('seller.products.create'))
            ->assertSessionHasErrors('images');

        $this->assertDatabaseMissing('products', [
            'seller_id' => $seller->id,
            'name' => 'Produk Terlalu Banyak Foto',
        ]);
    }

    private function createSellerAndCategory(): array
    {
        $seller = User::factory()->create([
            'role' => 'seller',
            'status' => 'active',
        ]);

        $category = Category::create([
            'name' => 'Kategori '.fake()->unique()->word(),
            'slug' => fake()->unique()->slug(),
            'status' => 'active',
        ]);

        return [$seller, $category];
    }

    private function fakeImages(int $count): array
    {
        return collect(range(1, $count))
            ->map(fn (int $number) => UploadedFile::fake()->image(
                "produk-{$number}.jpg",
                500,
                500,
            ))
            ->all();
    }
}
