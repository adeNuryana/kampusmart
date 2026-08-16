<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Penjual
            |--------------------------------------------------------------------------
            |
            | seller_id mengarah ke tabel users.
            | User tersebut harus memiliki role = seller.
            |
            */

            $table->foreignId('seller_id')
                ->constrained('users')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Kategori
            |--------------------------------------------------------------------------
            */

            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Informasi Produk
            |--------------------------------------------------------------------------
            */

            $table->string('name', 150);

            $table->string('slug')
                ->unique();

            $table->text('description')
                ->nullable();

            $table->decimal('price', 15, 2);

            $table->unsignedInteger('stock')
                ->default(0);

            $table->enum('condition', [
                'new',
                'used',
            ])->default('new');

            $table->string('image')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'active',
                'inactive',
            ])->default('active');


            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
