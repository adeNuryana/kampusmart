<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SellerOrderStatusTest extends TestCase
{
    use DatabaseTransactions;

    public function test_seller_can_cancel_an_order_and_restore_its_stock_once(): void
    {
        [$seller, $order, $product] = $this->createOrder();

        $this->actingAs($seller)
            ->from(route('seller.orders.show', $order))
            ->patch(route('seller.orders.status', $order), [
                'status' => 'cancelled',
            ])
            ->assertRedirect(route('seller.orders.show', $order))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'cancelled',
        ]);
        $this->assertSame(10, $product->fresh()->stock);
        $this->assertDatabaseHas('activity_logs', [
            'action' => 'order_cancelled',
            'subject_id' => $order->id,
        ]);

        $this->actingAs($seller)
            ->patch(route('seller.orders.status', $order), [
                'status' => 'cancelled',
            ])
            ->assertSessionHasErrors('status');

        $this->assertSame(10, $product->fresh()->stock);
    }

    public function test_completing_an_order_does_not_restore_stock(): void
    {
        [$seller, $order, $product] = $this->createOrder();

        $this->actingAs($seller)
            ->patch(route('seller.orders.status', $order), [
                'status' => 'sold',
            ])
            ->assertSessionHas('success');

        $this->assertSame('sold', $order->fresh()->status);
        $this->assertSame(7, $product->fresh()->stock);
    }

    public function test_seller_cannot_change_another_sellers_order(): void
    {
        [, $order, $product] = $this->createOrder();

        $otherSeller = User::factory()->create([
            'role' => 'seller',
            'status' => 'active',
        ]);

        $this->actingAs($otherSeller)
            ->patch(route('seller.orders.status', $order), [
                'status' => 'cancelled',
            ])
            ->assertForbidden();

        $this->assertSame('processing', $order->fresh()->status);
        $this->assertSame(7, $product->fresh()->stock);
    }

    private function createOrder(): array
    {
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
            'stock' => 7,
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
            'status' => 'processing',
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'price' => $product->price,
            'quantity' => 3,
            'subtotal' => 45000,
        ]);

        return [$seller, $order, $product];
    }
}
