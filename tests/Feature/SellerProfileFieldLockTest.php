<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SellerProfileFieldLockTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_unlock_one_field_while_the_others_remain_locked(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);
        $seller = $this->createSeller();
        $lockedFields = ['email', 'phone', 'whatsapp', 'nim', 'faculty'];

        $this->actingAs($admin)
            ->put(route('admin.settings.website.update'), [
                'site_name' => 'KampusMart',
                'seller_profile_locked_fields' => $lockedFields,
            ])
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertSame(
            $lockedFields,
            SiteSetting::query()->firstOrFail()->lockedSellerProfileFields()
        );

        $this->actingAs($admin)
            ->get(route('admin.settings.website'))
            ->assertOk()
            ->assertSee('Kunci Profil Seller');

        $this->actingAs($seller)
            ->get(route('seller.settings.index'))
            ->assertOk()
            ->assertSee('Sebagian data identitas dikunci');

        $this->actingAs($seller)
            ->put(route('seller.settings.profile.update'), [
                'store_name' => 'Toko Baru',
                'description' => 'Deskripsi baru',
                'name' => 'Nama Diubah Seller',
                'email' => 'tidak-boleh-berubah@example.test',
                'phone' => '089999999999',
                'whatsapp' => '088888888888',
                'nim' => '9999999',
                'faculty' => 'Fakultas Lain',
            ])
            ->assertRedirect()
            ->assertSessionHas('profile_success');

        $seller->refresh();

        $this->assertSame('Nama Diubah Seller', $seller->name);
        $this->assertSame('seller@example.test', $seller->email);
        $this->assertSame('081111111111', $seller->phone);
        $this->assertSame('082222222222', $seller->sellerProfile->whatsapp);
        $this->assertSame('2200001', $seller->sellerProfile->nim);
        $this->assertSame('Fakultas Lama', $seller->sellerProfile->faculty);
    }

    public function test_super_admin_can_unlock_all_profile_fields(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);
        $seller = $this->createSeller();

        $this->actingAs($admin)
            ->put(route('admin.settings.website.update'), [
                'site_name' => 'KampusMart',
            ])
            ->assertRedirect();

        $this->assertSame(
            [],
            SiteSetting::query()->firstOrFail()->lockedSellerProfileFields()
        );

        $this->actingAs($seller)
            ->put(route('seller.settings.profile.update'), [
                'store_name' => 'Toko Baru',
                'description' => 'Deskripsi baru',
                'name' => 'Nama Baru',
                'email' => 'seller-baru@example.test',
                'phone' => '083333333333',
                'whatsapp' => '084444444444',
                'nim' => '2300002',
                'faculty' => 'Fakultas Teknik',
            ])
            ->assertRedirect()
            ->assertSessionHas('profile_success');

        $seller->refresh();

        $this->assertSame('Nama Baru', $seller->name);
        $this->assertSame('seller-baru@example.test', $seller->email);
        $this->assertSame('083333333333', $seller->phone);
        $this->assertSame('084444444444', $seller->sellerProfile->whatsapp);
        $this->assertSame('2300002', $seller->sellerProfile->nim);
        $this->assertSame('Fakultas Teknik', $seller->sellerProfile->faculty);
    }

    public function test_super_admin_can_lock_all_profile_fields(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);

        $this->actingAs($admin)
            ->put(route('admin.settings.website.update'), [
                'site_name' => 'KampusMart',
                'seller_profile_locked_fields' => array_keys(SiteSetting::SELLER_PROFILE_FIELDS),
            ])
            ->assertRedirect();

        $this->assertSame(
            array_keys(SiteSetting::SELLER_PROFILE_FIELDS),
            SiteSetting::query()->firstOrFail()->lockedSellerProfileFields()
        );
    }

    private function createSeller(): User
    {
        $seller = User::factory()->create([
            'name' => 'Nama Asli',
            'email' => 'seller@example.test',
            'phone' => '081111111111',
            'role' => 'seller',
            'status' => 'active',
        ]);

        $seller->sellerProfile()->create([
            'store_name' => 'Toko Lama',
            'whatsapp' => '082222222222',
            'nim' => '2200001',
            'faculty' => 'Fakultas Lama',
            'description' => 'Deskripsi lama',
        ]);

        return $seller;
    }
}
