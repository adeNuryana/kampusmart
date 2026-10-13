<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderDeletionService
{
    /**
     * @return array{
     *     orderNumber: string,
     *     restoredQuantity: int,
     *     missingProductQuantity: int,
     *     stockWasAlreadyRestored: bool
     * }
     */
    public function delete(Order $order): array
    {
        return DB::transaction(function () use ($order): array {
            $lockedOrder = Order::query()
                ->whereKey($order->id)
                ->with('items')
                ->lockForUpdate()
                ->firstOrFail();

            $restoredQuantity = 0;
            $missingProductQuantity = 0;
            $stockWasAlreadyRestored = $lockedOrder->status === 'cancelled';

            if (! $stockWasAlreadyRestored) {
                foreach ($lockedOrder->items->sortBy('product_id') as $item) {
                    if (! $item->product_id) {
                        $missingProductQuantity += $item->quantity;

                        continue;
                    }

                    $product = Product::query()
                        ->whereKey($item->product_id)
                        ->lockForUpdate()
                        ->first();

                    if (! $product) {
                        $missingProductQuantity += $item->quantity;

                        continue;
                    }

                    $product->increment('stock', $item->quantity);
                    $restoredQuantity += $item->quantity;
                }
            }

            $orderNumber = $lockedOrder->order_number;

            ActivityLogger::log(
                'order_deleted',
                'menghapus pesanan '.$orderNumber,
                $lockedOrder,
                [
                    'order_number' => $orderNumber,
                    'order_status' => $lockedOrder->status,
                    'restored_stock_quantity' => $restoredQuantity,
                    'missing_product_quantity' => $missingProductQuantity,
                    'stock_was_already_restored' => $stockWasAlreadyRestored,
                ]
            );

            $lockedOrder->delete();

            return compact(
                'orderNumber',
                'restoredQuantity',
                'missingProductQuantity',
                'stockWasAlreadyRestored'
            );
        });
    }
}
