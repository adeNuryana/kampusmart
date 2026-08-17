<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('order_number')->unique();

            // Pembeli
            $table->foreignId('buyer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Seller
            $table->foreignId('seller_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Snapshot data pembeli
            $table->string('buyer_name');
            $table->string('buyer_phone')->nullable();

            $table->decimal('subtotal', 15, 2);

            $table->enum('status', [
                'processing',
                'sold',
            ])->default('processing');
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
