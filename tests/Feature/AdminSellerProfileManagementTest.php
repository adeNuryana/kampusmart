<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSellerProfileManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_update_fields_locked_on_the_seller_profile(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);
        $seller = User::factory()->create([
            'role' => 'seller',
            'status' => 'active',
        ]);
        $seller->sellerProfile()->create([
            'store_name' => 'Toko Lama',
            'whatsapp' => '081111111111',
            'nim' => '2200001',
            'faculty' => 'Fakultas Lama',
            'description' => 'Deskripsi lama',
        ]);

        $this->actingAs($admin)
            ->put(route('admin.sellers.update', $seller), [
                'name' => 'Nama Baru',
                'email' => 'seller-baru@example.test',
                'phone' => '082222222222',
                'nim' => '2300002',
                'faculty' => 'Fakultas Teknik',
                'store_name' => 'Toko Baru',
                'whatsapp' => '083333333333',
                'description' => 'Deskripsi baru',
                'status' => 'active',
            ])
            ->assertRedirect(route('admin.sellers.show', $seller))
            ->assertSessionHas('success', 'Data penjual berhasil diperbarui.');

        $seller->refresh();

        $this->assertSame('Nama Baru', $seller->name);
        $this->assertSame('seller-baru@example.test', $seller->email);
        $this->assertSame('082222222222', $seller->phone);
        $this->assertSame('2300002', $seller->sellerProfile->nim);
        $this->assertSame('Fakultas Teknik', $seller->sellerProfile->faculty);
        $this->assertSame('Toko Baru', $seller->sellerProfile->store_name);
        $this->assertSame('083333333333', $seller->sellerProfile->whatsapp);
    }

    public function test_seller_cannot_change_super_admin_managed_fields(): void
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

        $this->actingAs($seller)
            ->put(route('seller.settings.profile.update'), [
                'store_name' => 'Toko Baru',
                'description' => 'Deskripsi baru',
                'name' => 'Nama Tidak Sah',
                'email' => 'ubah@example.test',
                'phone' => '089999999999',
                'whatsapp' => '088888888888',
                'nim' => '9999999',
                'faculty' => 'Fakultas Lain',
            ])
            ->assertRedirect()
            ->assertSessionHas('profile_success');

        $seller->refresh();

        $this->assertSame('Nama Asli', $seller->name);
        $this->assertSame('seller@example.test', $seller->email);
        $this->assertSame('081111111111', $seller->phone);
        $this->assertSame('082222222222', $seller->sellerProfile->whatsapp);
        $this->assertSame('2200001', $seller->sellerProfile->nim);
        $this->assertSame('Fakultas Lama', $seller->sellerProfile->faculty);
        $this->assertSame('Toko Baru', $seller->sellerProfile->store_name);
    }
}
