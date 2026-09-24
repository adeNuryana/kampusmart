<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogger;
use App\Services\ImageCompressor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(private readonly ImageCompressor $imageCompressor) {}

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

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:max_width=6000,max_height=6000',
            ],
        ]);

        $oldPhoto = $buyer->photo;
        $photoPath = $oldPhoto;

        if ($request->hasFile('photo')) {
            $photoPath = $this->imageCompressor->store(
                $request->file('photo'),
                'buyers',
                800,
                800,
            );
        }

        $buyer->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'photo' => $photoPath,
        ]);

        if (
            $request->hasFile('photo') &&
            $oldPhoto &&
            !str_starts_with($oldPhoto, 'http://') &&
            !str_starts_with($oldPhoto, 'https://')
        ) {
            Storage::disk('public')->delete($oldPhoto);
        }

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
