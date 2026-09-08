<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REDIRECT KE GOOGLE
    |--------------------------------------------------------------------------
    */

    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /*
    |--------------------------------------------------------------------------
    | CALLBACK GOOGLE
    |--------------------------------------------------------------------------
    */

    public function callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            /*
            |--------------------------------------------------------------------------
            | CARI USER BERDASARKAN EMAIL
            |--------------------------------------------------------------------------
            */

            $user = User::query()->where('email', $googleUser->getEmail())->first();

            /*
            |--------------------------------------------------------------------------
            | USER BELUM ADA
            |--------------------------------------------------------------------------
            |
            | Login Google hanya boleh membuat BUYER.
            | Seller tetap dibuat oleh Super Admin.
            |
            */

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName() ?: 'Buyer KampusMart',

                    'email' => $googleUser->getEmail(),

                    'google_id' => $googleUser->getId(),

                    'google_avatar' => $googleUser->getAvatar(),

                    'password' => Hash::make(Str::random(40)),

                    'role' => 'buyer',
                ]);
            } else {
                /*
                |--------------------------------------------------------------------------
                | CEGAH SELLER / ADMIN LOGIN DARI GOOGLE BUYER
                |--------------------------------------------------------------------------
                */

                if ($user->role !== 'buyer') {
                    return redirect()
                        ->route('login')
                        ->withErrors([
                            'email' => 'Login Google hanya tersedia untuk akun pembeli.',
                        ]);
                }

                /*
                |--------------------------------------------------------------------------
                | HUBUNGKAN AKUN LAMA DENGAN GOOGLE
                |--------------------------------------------------------------------------
                */

                $user->update([
                    'google_id' => $googleUser->getId(),

                    'google_avatar' => $googleUser->getAvatar(),
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | LOGIN
            |--------------------------------------------------------------------------
            */

            Auth::login($user, true);

            request()->session()->regenerate();

            return redirect()->route('buyer.dashboard');
        } catch (Throwable $e) {
            report($e);

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Login dengan Google gagal. Silakan coba lagi.',
                ]);
        }
    }
}
