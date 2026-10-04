<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BuyerProductRecommendationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_product_page_shows_available_recommendations_from_same_store_and_category(): void
    {
        $category = $this->createCategory('Makanan');
        $otherCategory = $this->createCategory('Minuman');
        $seller = $this->createSeller('Toko Utama');
        $otherSeller = $this->createSeller('Toko Lain');

        $product = $this->createProduct($seller, $category, 'Produk Utama');
        $sameStoreProduct = $this->createProduct($seller, $otherCategory, 'Rekomendasi Toko');
        $sameCategoryProduct = $this->createProduct($otherSeller, $category, 'Rekomendasi Kategori');

        $this->createProduct($seller, $otherCategory, 'Produk Tidak Aktif', [
            'status' => 'inactive',
        ]);
        $this->createProduct($otherSeller, $category, 'Produk Stok Habis', [
            'stock' => 0,
        ]);

        $response = $this->get(route('buyer.products.show', $product));

        $response
            ->assertOk()
            ->assertSee('Produk dari Toko Ini')
            ->assertSee($sameStoreProduct->name)
            ->assertSee('Produk Serupa')
            ->assertSee($sameCategoryProduct->name)
            ->assertDontSee('Produk Tidak Aktif')
            ->assertDontSee('Produk Stok Habis');
    }

    public function test_product_page_shows_recommendation_empty_states_when_no_matches_exist(): void
    {
        $category = $this->createCategory('Kategori Tunggal');
        $seller = $this->createSeller('Toko Tunggal');
        $product = $this->createProduct($seller, $category, 'Produk Tunggal');

        $this->get(route('buyer.products.show', $product))
            ->assertOk()
            ->assertSee('Belum ada produk lain dari toko ini')
            ->assertSee('Belum ada produk lain dari kategori ini');
    }

    private function createSeller(string $name): User
    {
        return User::factory()->create([
            'name' => $name,
            'role' => 'seller',
        ]);
    }

    private function createCategory(string $name): Category
    {
        return Category::create([
            'name' => $name,
            'slug' => fake()->unique()->slug(),
            'status' => 'active',
        ]);
    }

    private function createProduct(
        User $seller,
        Category $category,
        string $name,
        array $attributes = [],
    ): Product {
        return Product::create(array_merge([
            'seller_id' => $seller->id,
            'category_id' => $category->id,
            'name' => $name,
            'slug' => fake()->unique()->slug(),
            'description' => 'Deskripsi '.$name,
            'price' => 15000,
            'stock' => 10,
            'status' => 'active',
        ], $attributes));
    }
}
