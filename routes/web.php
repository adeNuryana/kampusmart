<?php

use App\Http\Controllers\Admin\BuyerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Buyer\OrderController as BuyerOrderController;
use App\Http\Controllers\Buyer\CheckoutController;
use App\Http\Controllers\Buyer\DashboardController as BuyerDashboardController;
use App\Http\Controllers\Buyer\ProductController as BuyerProductController;
use App\Http\Controllers\Seller\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\Buyer\ProfileController;
use App\Http\Controllers\Seller\SettingController as SellerSettingController;


/*
|--------------------------------------------------------------------------
| Guest
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');
});


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Super Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin',])->prefix('admin')->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // pembeli
        Route::get('/pembeli', [BuyerController::class, 'index'])->name('buyers.index');
        Route::get('/pembeli/tambah', [BuyerController::class, 'create'])->name('buyers.create');
        Route::post('/pembeli', [BuyerController::class, 'store'])->name('buyers.store');
        Route::get('/pembeli/{buyer}', [BuyerController::class, 'show'])->name('buyers.show');
        Route::patch('/pembeli/{buyer}/status', [BuyerController::class, 'updateStatus'])->name('buyers.status');
        Route::get('/pembeli/{buyer}/edit', [BuyerController::class, 'edit'])->name('buyers.edit');
        Route::put('/pembeli/{buyer}', [BuyerController::class, 'update'])->name('buyers.update');



        /*
        |--------------------------------------------------------------------------
        | sellers
        |--------------------------------------------------------------------------
        */
        Route::get('/sellers', [SellerController::class, 'index'])->name('sellers.index');
        Route::get('/sellers/create', [SellerController::class, 'create'])->name('sellers.create');
        Route::post('/sellers', [SellerController::class, 'store'])->name('sellers.store');
        // DETAIL SELLER
        Route::get('/sellers/{seller}', [SellerController::class, 'show'])->name('sellers.show');
        // FORM EDIT
        Route::get('/sellers/{seller}/edit', [SellerController::class, 'edit'])->name('sellers.edit');
        Route::put('/sellers/{seller}', [SellerController::class, 'update'])->name('sellers.update');
        // UPDATE STATUS
        Route::patch('/sellers/{seller}/status', [SellerController::class, 'updateStatus'])->name('sellers.status');

        Route::get('/pesanan', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/pesanan/{order}', [AdminOrderController::class, 'show'])->name('orders.show');

        /*
        |--------------------------------------------------------------------------
        | Category
        |--------------------------------------------------------------------------
        */

        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::patch('/categories/{category}/status', [CategoryController::class, 'updateStatus'])->name('categories.status');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


        // product
        Route::get('/produk', [AdminProductController::class, 'index'])->name('products.index');


        // setting
        Route::get('/pengaturan', [SettingController::class, 'index'])
            ->name('settings.index');

        Route::put('/pengaturan/profil', [SettingController::class, 'updateProfile'])
            ->name('settings.profile');

        Route::put('/pengaturan/password', [SettingController::class, 'updatePassword'])
            ->name('settings.password');
    });


/*
|--------------------------------------------------------------------------
| Seller
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:seller',
])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {

        Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');
        Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
        Route::get('/produk/tambah', [ProductController::class, 'create'])->name('products.create');

        /*
        |--------------------------------------------------------------------------
        | Pesanan
        |--------------------------------------------------------------------------
        */

        Route::get('/pesanan', [SellerOrderController::class, 'index'])->name('orders.index');
        Route::get('/pesanan/{order}', [SellerOrderController::class, 'show'])->name('orders.show');
        Route::patch('/pesanan/{order}/status', [SellerOrderController::class, 'updateStatus'])->name('orders.status');
    });


/*
|--------------------------------------------------------------------------
| Buyer
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:buyer',
])
    ->prefix('buyer')
    ->name('buyer.')
    ->group(function () {

        Route::get('/dashboard', [BuyerDashboardController::class, 'index'])->name('dashboard');
        Route::get('/produk', [BuyerProductController::class, 'index'])->name('products.index');
        Route::get('/produk/{product}', [BuyerProductController::class, 'show'])->name('products.show');


        /*
        |--------------------------------------------------------------------------
        | Keranjang
        |--------------------------------------------------------------------------
        */

        Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
        Route::post('/keranjang/{product}', [CartController::class, 'store'])->name('cart.store');
        Route::patch('/keranjang/{cartItem}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/keranjang/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');

        /*
|--------------------------------------------------------------------------
| Checkout
|--------------------------------------------------------------------------
*/

        Route::get(
            '/checkout',
            [CheckoutController::class, 'index']
        )->name('checkout.index');


        Route::post(
            '/checkout',
            [CheckoutController::class, 'store']
        )->name('checkout.store');


        /*
|--------------------------------------------------------------------------
| Pesanan
|--------------------------------------------------------------------------
*/

        Route::get(
            '/pesanan',
            [BuyerOrderController::class, 'index']
        )->name('orders.index');
        /*
|--------------------------------------------------------------------------
| Profile Buyer
|--------------------------------------------------------------------------
*/

        Route::get(
            '/profile',
            [ProfileController::class, 'index']
        )->name('profile.index');


        Route::put(
            '/profile',
            [ProfileController::class, 'updateProfile']
        )->name('profile.update');


        Route::put(
            '/profile/password',
            [ProfileController::class, 'updatePassword']
        )->name('profile.password');

        /*
|--------------------------------------------------------------------------
| Pengaturan Seller
|--------------------------------------------------------------------------
*/

        Route::get(
            '/pengaturan',
            [SellerSettingController::class, 'index']
        )->name('settings.index');


        Route::put(
            '/pengaturan/profile',
            [SellerSettingController::class, 'updateProfile']
        )->name('settings.profile');


        Route::put(
            '/pengaturan/password',
            [SellerSettingController::class, 'updatePassword']
        )->name('settings.password');
    });
