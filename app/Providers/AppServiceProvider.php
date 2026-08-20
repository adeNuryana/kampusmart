<?php

namespace App\Providers;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.public', function ($view) {
            $cartCount = 0;

            if (Auth::check() && Auth::user()?->role === 'buyer') {
                $cartCount = CartItem::query()
                    ->where('user_id', Auth::id())
                    ->sum('quantity');
            }

            $view->with('cartCount', $cartCount);
        });
    }
}
