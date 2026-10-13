<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SellerRegistrationSettingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_seller_registration_is_disabled_by_default(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('Pendaftaran penjual sedang ditutup.')
            ->assertDontSee('Saya ingin mendaftar sebagai penjual', false);
    }

    public function test_super_admin_can_enable_seller_registration(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);

        $this->actingAs($admin)
            ->put(route('admin.settings.website.update'), [
                'site_name' => 'KampusMart',
                'admin_whatsapp' => '081234567890',
                'seller_registration_enabled' => true,
            ])
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertTrue(
            SiteSetting::query()->firstOrFail()->seller_registration_enabled
        );

        $this->post(route('logout'));

        $this->get(route('login'))
            ->assertOk()
            ->assertSee('Daftar Penjual')
            ->assertSee('https://wa.me/6281234567890', false);
    }

    public function test_super_admin_can_disable_seller_registration_again(): void
    {
        $setting = SiteSetting::query()->create([
            'site_name' => 'KampusMart',
            'admin_whatsapp' => '081234567890',
            'seller_registration_enabled' => true,
        ]);

        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);

        $this->actingAs($admin)
            ->put(route('admin.settings.website.update'), [
                'site_name' => 'KampusMart',
                'admin_whatsapp' => '081234567890',
                'seller_registration_enabled' => false,
            ])
            ->assertRedirect();

        $this->assertFalse($setting->fresh()->seller_registration_enabled);

        $this->post(route('logout'));

        $this->get(route('register'))
            ->assertOk()
            ->assertSee('Pendaftaran penjual sedang ditutup oleh');
    }
}
