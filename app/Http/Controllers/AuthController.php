<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],

            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        $authenticated = Auth::attempt(
            [
                'email' => $credentials['email'],
                'password' => $credentials['password'],
                'status' => 'active',
            ],
            $remember,
        );

        if (!$authenticated) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password salah.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'seller' => redirect()->route('seller.dashboard'),
            'buyer' => redirect()->intended(route('buyer.dashboard')),

            default => $this->logout($request),
        };
    }
    public function showRegister(): View
    {
        return view('auth.register');
    }
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],

                'email' => ['required', 'email', 'max:255', 'unique:users,email'],

                'phone' => ['required', 'string', 'max:20', 'unique:users,phone', 'regex:/^(\+62|62|0)[0-9]{8,15}$/'],

                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'phone.required' => 'Nomor HP wajib diisi.',

                'phone.unique' => 'Nomor HP sudah digunakan.',

                'phone.regex' => 'Format nomor HP tidak valid.',
            ],
        );

        $user = User::create([
            'name' => $validated['name'],

            'email' => $validated['email'],

            'phone' => $validated['phone'],

            'password' => Hash::make($validated['password']),

            'role' => 'buyer',

            'status' => 'active',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('buyer.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
