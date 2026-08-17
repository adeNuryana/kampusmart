<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use App\Services\ActivityLogger;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Halaman Profile
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $buyer = $request->user();

        return view(
            'buyer.profile.index',
            compact('buyer')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Profile
    |--------------------------------------------------------------------------
    */

    public function updateProfile(Request $request)
    {
        $buyer = $request->user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',

                Rule::unique('users', 'email')
                    ->ignore($buyer->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],
        ]);


        $buyer->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);

        ActivityLogger::log(
            'profile_updated',
            'memperbarui profil',
            $buyer
        );
        return back()->with(
            'profile_success',
            'Profil berhasil diperbarui.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Password
    |--------------------------------------------------------------------------
    */

    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag(
            'updatePassword',
            [
                'current_password' => [
                    'required',
                    'current_password',
                ],

                'password' => [
                    'required',
                    'confirmed',
                    Password::min(8),
                ],
            ]
        );


        $request->user()->update([
            'password' => $validated['password'],
        ]);


        return back()->with(
            'password_success',
            'Password berhasil diperbarui.'
        );
    }
}
