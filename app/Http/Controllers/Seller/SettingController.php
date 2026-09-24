<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogger;
use App\Services\ImageCompressor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function __construct(private readonly ImageCompressor $imageCompressor) {}

    /*
    |--------------------------------------------------------------------------
    | Halaman Pengaturan
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $seller = $request->user();

        $seller->load('sellerProfile');

        return view(
            'seller.settings.index',
            compact('seller')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update Profil & Toko
    |--------------------------------------------------------------------------
    */

    public function updateProfile(Request $request)
    {
        $seller = $request->user();

        $validated = $request->validate([
            /*
            |--------------------------------------------------------------------------
            | Seller Profile
            |--------------------------------------------------------------------------
            */

            'store_name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:max_width=6000,max_height=6000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Ambil Seller Profile
        |--------------------------------------------------------------------------
        */

        $profile = $seller->sellerProfile;

        $photoPath = $profile?->photo;
        $oldPhotoPath = $photoPath;

        /*
        |--------------------------------------------------------------------------
        | Upload Foto Baru
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {
            $photoPath = $this->imageCompressor->store(
                $request->file('photo'),
                'sellers',
                1000,
                1000,
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Update / Create Seller Profile
        |--------------------------------------------------------------------------
        */

        $profile = $seller->sellerProfile()->updateOrCreate(
            [
                'user_id' => $seller->id,
            ],
            [
                'store_name' => $validated['store_name'],

                'whatsapp' => $profile?->whatsapp ?? '',

                'nim' => $profile?->nim,

                'faculty' => $profile?->faculty,

                'description' => $validated['description'] ?? null,

                'photo' => $photoPath,
            ]
        );

        if (
            $oldPhotoPath &&
            $oldPhotoPath !== $photoPath &&
            Storage::disk('public')->exists($oldPhotoPath)
        ) {
            Storage::disk('public')->delete($oldPhotoPath);
        }

        ActivityLogger::log(
            'seller_profile_updated',
            'memperbarui profil toko',
            $profile,
            [
                'store_name' => $profile->store_name,
            ]
        );

        return back()->with(
            'profile_success',
            'Informasi toko berhasil diperbarui.'
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
