<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Mockery;
use Tests\TestCase;

class ProductionHardeningTest extends TestCase
{
    use RefreshDatabase;

    public function test_web_responses_include_security_headers(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin')
            ->assertHeader(
                'Permissions-Policy',
                'camera=(), microphone=(), geolocation=(), payment=()',
            );
    }

    public function test_login_is_rate_limited_per_account_and_ip(): void
    {
        $credentials = [
            'email' => 'rate-limit@example.test',
            'password' => 'incorrect-password',
        ];

        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->withServerVariables(['REMOTE_ADDR' => '192.0.2.20'])
                ->post('/login', $credentials)
                ->assertRedirect();
        }

        $this->withServerVariables(['REMOTE_ADDR' => '192.0.2.20'])
            ->post('/login', $credentials)
            ->assertTooManyRequests();
    }

    public function test_inactive_buyer_cannot_sign_in_with_google(): void
    {
        $buyer = User::factory()->create([
            'email' => 'inactive@example.test',
            'role' => 'buyer',
            'status' => 'inactive',
        ]);

        $googleUser = new SocialiteUser;
        $googleUser->id = 'google-user-id';
        $googleUser->name = $buyer->name;
        $googleUser->email = $buyer->email;

        $provider = Mockery::mock();
        $provider->shouldReceive('user')->once()->andReturn($googleUser);

        Socialite::shouldReceive('driver')
            ->once()
            ->with('google')
            ->andReturn($provider);

        $this->get('/auth/google/callback')
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors('email');

        $this->assertGuest();
        $this->assertNull($buyer->fresh()->google_id);
    }
}
