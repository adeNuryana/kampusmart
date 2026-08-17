<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class SettingController extends Controller
{
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
            | User
            |--------------------------------------------------------------------------
            */

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
                    ->ignore($seller->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],


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

            'whatsapp' => [
                'required',
                'string',
                'max:20',
            ],

            'nim' => [
                'nullable',
                'string',
                'max:50',
            ],

            'faculty' => [
                'nullable',
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
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Data User
        |--------------------------------------------------------------------------
        */

        $seller->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Ambil Seller Profile
        |--------------------------------------------------------------------------
        */

        $profile = $seller->sellerProfile;

        $photoPath = $profile?->photo;


        /*
        |--------------------------------------------------------------------------
        | Upload Foto Baru
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            if (
                $photoPath &&
                Storage::disk('public')->exists($photoPath)
            ) {

                Storage::disk('public')
                    ->delete($photoPath);
            }


            $photoPath = $request
                ->file('photo')
                ->store('sellers', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Update / Create Seller Profile
        |--------------------------------------------------------------------------
        */

        $seller->sellerProfile()->updateOrCreate(
            [
                'user_id' => $seller->id,
            ],
            [
                'store_name' =>
                    $validated['store_name'],

                'whatsapp' =>
                    $validated['whatsapp'],

                'nim' =>
                    $validated['nim'] ?? null,

                'faculty' =>
                    $validated['faculty'] ?? null,

                'description' =>
                    $validated['description'] ?? null,

                'photo' =>
                    $photoPath,
            ]
        );


        return back()->with(
            'profile_success',
            'Profil toko berhasil diperbarui.'
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
