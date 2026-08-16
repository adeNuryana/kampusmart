<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\CategoryController;
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

Route::middleware([
    'auth',
    'role:admin',
])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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



        /*
        |--------------------------------------------------------------------------
        | Category
        |--------------------------------------------------------------------------
        */

        Route::get('/categories',[CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create',[CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories',[CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit',[CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}',[CategoryController::class, 'update'])->name('categories.update');
        Route::patch('/categories/{category}/status',[CategoryController::class, 'updateStatus'])->name('categories.status');
        Route::delete('/categories/{category}',[CategoryController::class, 'destroy'])->name('categories.destroy');
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

        Route::get('/dashboard', function () {
            return 'Dashboard Penjual';
        })->name('dashboard');
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

        Route::get('/home', function () {
            return 'Home Pembeli';
        })->name('home');
    });
