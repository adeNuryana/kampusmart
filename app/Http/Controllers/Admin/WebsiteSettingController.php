<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WebsiteSettingController extends Controller
{
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

            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

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
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }

            $setting->logo = $request->file('logo')->store('branding', 'public');
        }

        if ($request->hasFile('favicon')) {
            if ($setting->favicon) {
                Storage::disk('public')->delete($setting->favicon);
            }

            $setting->favicon = $request->file('favicon')->store('branding/favicons', 'public');
        }

        $setting->save();

        return back()->with('success', 'Branding website berhasil diperbarui.');
    }
}
