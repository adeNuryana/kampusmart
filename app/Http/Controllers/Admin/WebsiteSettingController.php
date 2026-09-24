<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\ImageCompressor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WebsiteSettingController extends Controller
{
    public function __construct(private readonly ImageCompressor $imageCompressor) {}

    public function edit(): View
    {
        $setting = SiteSetting::query()->firstOrCreate(
            [],
            [
                'site_name' => 'KampusMart',
            ],
        );

        return view('admin.settings.website', compact('setting'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:100'],

            'admin_whatsapp' => ['nullable', 'string', 'min:9', 'max:25', 'regex:/^[+0-9()\-\s]+$/'],

            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048', 'dimensions:max_width=6000,max_height=6000'],

            'favicon' => ['nullable', 'file', 'mimes:ico,jpg,jpeg,png,webp', 'max:1024'],
        ]);

        $setting = SiteSetting::query()->firstOrCreate(
            [],
            [
                'site_name' => 'KampusMart',
            ],
        );

        $setting->site_name = $validated['site_name'];
        $setting->admin_whatsapp = $validated['admin_whatsapp'] ?? null;

        if ($request->hasFile('logo')) {
            $logoPath = $this->imageCompressor->store(
                $request->file('logo'),
                'branding',
                1000,
                1000,
                88,
            );

            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }

            $setting->logo = $logoPath;
        }

        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
            $faviconPath = strtolower($favicon->getClientOriginalExtension()) === 'ico'
                ? $favicon->store('branding/favicons', 'public')
                : $this->imageCompressor->store(
                    $favicon,
                    'branding/favicons',
                    256,
                    256,
                    90,
                );

            if ($setting->favicon) {
                Storage::disk('public')->delete($setting->favicon);
            }

            $setting->favicon = $faviconPath;
        }

        $setting->save();

        return back()->with('success', 'Branding website berhasil diperbarui.');
    }
}
