<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_buyer_is_asked_to_verify_their_email(): void
    {
        Notification::fake();

        $response = $this->post(route('register.process'), [
            'name' => 'Pembeli Baru',
            'email' => 'pembeli@example.test',
            'phone' => '081234567890',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $buyer = User::query()->where('email', 'pembeli@example.test')->firstOrFail();

        $response->assertRedirect(route('verification.notice'));
        $this->assertAuthenticatedAs($buyer);
        $this->assertFalse($buyer->hasVerifiedEmail());
        Notification::assertSentTo($buyer, VerifyEmailNotification::class);
    }

    public function test_unverified_buyer_cannot_access_buyer_area(): void
    {
        $buyer = User::factory()->unverified()->create(['role' => 'buyer']);

        $this->actingAs($buyer)
            ->get(route('buyer.dashboard'))
            ->assertRedirect(route('verification.notice'));

        $this->get(route('verification.notice'))
            ->assertOk()
            ->assertSee('Verifikasi email Anda')
            ->assertSee($buyer->email);
    }

    public function test_buyer_can_verify_email_from_signed_link(): void
    {
        $buyer = User::factory()->unverified()->create(['role' => 'buyer']);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $buyer->id, 'hash' => sha1($buyer->email)],
        );

        $this->actingAs($buyer)
            ->get($verificationUrl)
            ->assertRedirect(route('buyer.dashboard'));

        $this->assertTrue($buyer->fresh()->hasVerifiedEmail());
    }

    public function test_unverified_buyer_can_request_a_new_verification_link(): void
    {
        Notification::fake();
        $buyer = User::factory()->unverified()->create(['role' => 'buyer']);

        $this->actingAs($buyer)
            ->post(route('verification.send'))
            ->assertSessionHas('status', 'verification-link-sent');

        Notification::assertSentTo($buyer, VerifyEmailNotification::class);
    }
}
