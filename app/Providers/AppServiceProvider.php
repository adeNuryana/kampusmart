<?php

namespace App\Providers;

use App\Models\CartItem;
use App\Models\SiteSetting;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        $this->configureRateLimiting();

        View::composer('*', function ($view) {
            $siteSetting = SiteSetting::query()->first();

            $view->with('siteSetting', $siteSetting);
        });

        View::composer('layouts.public', function ($view) {
            $cartCount = 0;

            if (Auth::check() && Auth::user()?->role === 'buyer') {
                $cartCount = CartItem::query()->where('user_id', Auth::id())->sum('quantity');
            }

            $view->with('cartCount', $cartCount);
        });
    }

    private function configureRateLimiting(): void
    {
        RateLimiter::for('login', function (Request $request): array {
            $email = Str::lower(trim((string) $request->input('email')));

            return [
                Limit::perMinute(20)->by('login-ip:'.$request->ip()),
                Limit::perMinute(5)->by('login-account:'.$email.'|'.$request->ip()),
            ];
        });

        RateLimiter::for(
            'registration',
            fn (Request $request): Limit => Limit::perHour(5)
                ->by('registration:'.$request->ip()),
        );

        RateLimiter::for(
            'oauth',
            fn (Request $request): Limit => Limit::perMinute(10)
                ->by('oauth:'.$request->ip()),
        );
    }
}
