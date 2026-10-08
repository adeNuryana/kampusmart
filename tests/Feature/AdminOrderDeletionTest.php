<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminOrderDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_delete_an_order_and_restore_stock(): void
    {
        [$admin, $order, $product] = $this->createOrder('processing', 7);

        $this->actingAs($admin)
            ->delete(route('admin.orders.destroy', $order))
            ->assertRedirect(route('admin.orders.index'))
            ->assertSessionHas('success');

        $this->assertSame(10, $product->fresh()->stock);
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
        $this->assertDatabaseMissing('order_items', ['order_id' => $order->id]);
        $this->assertDatabaseHas('activity_logs', [
            'action' => 'order_deleted',
            'subject_id' => $order->id,
        ]);
    }

    public function test_deleting_cancelled_order_does_not_restore_stock_twice(): void
    {
        [$admin, $order, $product] = $this->createOrder('cancelled', 10);

        $this->actingAs($admin)
            ->delete(route('admin.orders.destroy', $order))
            ->assertRedirect(route('admin.orders.index'))
            ->assertSessionHas('success');

        $this->assertSame(10, $product->fresh()->stock);
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }

    private function createOrder(string $status, int $currentStock): array
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
            'stock' => $currentStock,
            'status' => 'active',
        ]);
        $order = Order::create([
            'order_number' => 'TEST-'.fake()->unique()->numerify('########'),
            'buyer_id' => $buyer->id,
            'seller_id' => $seller->id,
            'buyer_name' => $buyer->name,
            'buyer_phone' => '081234567890',
            'payment_method' => 'cash',
            'subtotal' => 45000,
            'status' => $status,
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'price' => $product->price,
            'quantity' => 3,
            'subtotal' => 45000,
        ]);

        return [$admin, $order, $product];
    }
}
