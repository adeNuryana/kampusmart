<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\ActivityLogger;
use App\Services\ImageCompressor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
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

        $setting = SiteSetting::query()->first();
        $lockedProfileFields = $setting?->lockedSellerProfileFields()
            ?? array_keys(SiteSetting::SELLER_PROFILE_FIELDS);
        $profileFieldLabels = SiteSetting::SELLER_PROFILE_FIELDS;

        return view(
            'seller.settings.index',
            compact('seller', 'lockedProfileFields', 'profileFieldLabels')
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

        $setting = SiteSetting::query()->first();
        $lockedFields = $setting?->lockedSellerProfileFields()
            ?? array_keys(SiteSetting::SELLER_PROFILE_FIELDS);

        $fieldIsEditable = fn (string $field): bool => ! in_array($field, $lockedFields, true);

        $rules = [
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
        ];

        if ($fieldIsEditable('name')) {
            $rules['name'] = ['required', 'string', 'max:255'];
        }

        if ($fieldIsEditable('email')) {
            $rules['email'] = [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($seller->id),
            ];
        }

        if ($fieldIsEditable('phone')) {
            $rules['phone'] = ['nullable', 'string', 'max:20'];
        }

        if ($fieldIsEditable('whatsapp')) {
            $rules['whatsapp'] = ['required', 'string', 'max:20'];
        }

        if ($fieldIsEditable('nim')) {
            $rules['nim'] = ['nullable', 'string', 'max:50'];
        }

        if ($fieldIsEditable('faculty')) {
            $rules['faculty'] = ['nullable', 'string', 'max:255'];
        }

        $validated = $request->validate($rules);

        $sellerData = [];

        foreach (['name', 'email', 'phone'] as $field) {
            if ($fieldIsEditable($field)) {
                $sellerData[$field] = $validated[$field] ?? null;
            }
        }

        if ($sellerData !== []) {
            $seller->update($sellerData);
        }

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

                'whatsapp' => $fieldIsEditable('whatsapp')
                    ? $validated['whatsapp']
                    : ($profile?->whatsapp ?? ''),

                'nim' => $fieldIsEditable('nim')
                    ? ($validated['nim'] ?? null)
                    : $profile?->nim,

                'faculty' => $fieldIsEditable('faculty')
                    ? ($validated['faculty'] ?? null)
                    : $profile?->faculty,

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
                'editable_fields' => array_values(array_diff(
                    array_keys(SiteSetting::SELLER_PROFILE_FIELDS),
                    $lockedFields
                )),
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
