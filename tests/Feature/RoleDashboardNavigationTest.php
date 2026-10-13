<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleDashboardNavigationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_super_admin_can_return_to_its_dashboard_from_home(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);

        $this->actingAs($admin)
            ->get(route('home'))
            ->assertOk()
            ->assertSee(route('admin.dashboard'), false)
            ->assertSee('Dashboard Admin');
    }

    public function test_seller_can_return_to_its_dashboard_from_home(): void
    {
        $seller = User::factory()->create([
            'role' => 'seller',
            'status' => 'active',
        ]);

        $this->actingAs($seller)
            ->get(route('home'))
            ->assertOk()
            ->assertSee(route('seller.dashboard'), false)
            ->assertSee('Dashboard Seller');
    }

    public function test_authenticated_users_visiting_login_are_redirected_to_their_dashboard(): void
    {
        foreach ([
            'admin' => 'admin.dashboard',
            'seller' => 'seller.dashboard',
            'buyer' => 'buyer.dashboard',
        ] as $role => $dashboardRoute) {
            $user = User::factory()->create([
                'role' => $role,
                'status' => 'active',
            ]);

            $this->actingAs($user)
                ->get(route('login'))
                ->assertRedirect(route($dashboardRoute));

            $this->post(route('logout'));
        }
    }
}
