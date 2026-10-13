<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminUserDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_delete_buyer_and_restore_order_stock(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('buyers/photo.jpg', 'photo');

        [$admin, $seller, $buyer, $product] = $this->createMarketplaceUsers();
        $buyer->update(['photo' => 'buyers/photo.jpg']);
        $order = $this->createOrder($buyer, $seller, $product);

        CartItem::create([
            'user_id' => $buyer->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.buyers.show', $buyer))
            ->assertOk()
            ->assertSee('Hapus Akun Pembeli');

        $this->actingAs($admin)
            ->delete(route('admin.buyers.destroy', $buyer))
            ->assertRedirect(route('admin.buyers.index'))
            ->assertSessionHas('success');

        $this->assertSame(10, $product->fresh()->stock);
        $this->assertDatabaseMissing('users', ['id' => $buyer->id]);
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
        $this->assertDatabaseMissing('cart_items', ['user_id' => $buyer->id]);
        $this->assertDatabaseHas('activity_logs', [
            'action' => 'buyer_deleted',
            'subject_id' => $buyer->id,
        ]);
        Storage::disk('public')->assertMissing('buyers/photo.jpg');
    }

    public function test_super_admin_can_delete_seller_products_orders_and_files(): void
    {
        Storage::fake('public');

        foreach ([
            'sellers/user.jpg',
            'sellers/profile.jpg',
            'products/main.jpg',
            'products/gallery.jpg',
        ] as $path) {
            Storage::disk('public')->put($path, 'file');
        }

        [$admin, $seller, $buyer, $product] = $this->createMarketplaceUsers([
            'seller_photo' => 'sellers/user.jpg',
            'product_image' => 'products/main.jpg',
        ]);
        $seller->sellerProfile()->create([
            'store_name' => 'Toko Seller',
            'whatsapp' => '081234567890',
            'photo' => 'sellers/profile.jpg',
        ]);
        $productImage = $product->images()->create([
            'path' => 'products/gallery.jpg',
            'position' => 0,
        ]);
        $order = $this->createOrder($buyer, $seller, $product);

        CartItem::create([
            'user_id' => $buyer->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.sellers.show', $seller))
            ->assertOk()
            ->assertSee('Hapus Akun Penjual');

        $this->actingAs($admin)
            ->delete(route('admin.sellers.destroy', $seller))
            ->assertRedirect(route('admin.sellers.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('users', ['id' => $seller->id]);
        $this->assertDatabaseHas('users', ['id' => $buyer->id]);
        $this->assertDatabaseMissing('seller_profiles', ['user_id' => $seller->id]);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $this->assertDatabaseMissing('product_images', ['id' => $productImage->id]);
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
        $this->assertDatabaseMissing('cart_items', ['product_id' => $product->id]);
        $this->assertDatabaseHas('activity_logs', [
            'action' => 'seller_deleted',
            'subject_id' => $seller->id,
        ]);

        Storage::disk('public')->assertMissing([
            'sellers/user.jpg',
            'sellers/profile.jpg',
            'products/main.jpg',
            'products/gallery.jpg',
        ]);
    }

    public function test_delete_endpoints_reject_a_user_with_the_wrong_role(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);
        $seller = User::factory()->create([
            'role' => 'seller',
            'status' => 'active',
        ]);
        $buyer = User::factory()->create([
            'role' => 'buyer',
            'status' => 'active',
        ]);

        $this->actingAs($admin)
            ->delete(route('admin.buyers.destroy', $seller))
            ->assertNotFound();

        $this->actingAs($admin)
            ->delete(route('admin.sellers.destroy', $buyer))
            ->assertNotFound();

        $this->assertDatabaseHas('users', ['id' => $seller->id]);
        $this->assertDatabaseHas('users', ['id' => $buyer->id]);
    }

    private function createMarketplaceUsers(array $options = []): array
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);
        $seller = User::factory()->create([
            'role' => 'seller',
            'status' => 'active',
            'photo' => $options['seller_photo'] ?? null,
        ]);
        $buyer = User::factory()->create([
            'role' => 'buyer',
            'status' => 'active',
        ]);
        $category = Category::create([
            'name' => 'Kategori '.fake()->unique()->word(),
            'slug' => fake()->unique()->slug(),
            'status' => 'active',
        ]);
        $product = Product::create([
            'seller_id' => $seller->id,
            'category_id' => $category->id,
            'name' => 'Produk '.fake()->unique()->word(),
            'slug' => fake()->unique()->slug(),
            'price' => 15000,
            'stock' => 7,
            'image' => $options['product_image'] ?? null,
            'status' => 'active',
        ]);

        return [$admin, $seller, $buyer, $product];
    }

    private function createOrder(User $buyer, User $seller, Product $product): Order
    {
        $order = Order::create([
            'order_number' => 'TEST-'.fake()->unique()->numerify('########'),
            'buyer_id' => $buyer->id,
            'seller_id' => $seller->id,
            'buyer_name' => $buyer->name,
            'buyer_phone' => '081234567890',
            'payment_method' => 'cash',
            'subtotal' => 45000,
            'status' => 'processing',
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'price' => $product->price,
            'quantity' => 3,
            'subtotal' => 45000,
        ]);

        return $order;
    }
}
