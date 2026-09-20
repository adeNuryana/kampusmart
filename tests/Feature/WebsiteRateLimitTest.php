<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class WebsiteRateLimitTest extends TestCase
{
    public function test_web_requests_are_limited_to_fifty_per_minute_per_ip_address(): void
    {
        Route::middleware('web')->get('/_tests/rate-limit', fn () => response('OK'));

        for ($request = 1; $request <= 50; $request++) {
            $this->withServerVariables(['REMOTE_ADDR' => '192.0.2.10'])
                ->get('/_tests/rate-limit')
                ->assertOk()
                ->assertHeader('X-RateLimit-Limit', '50');
        }

        $this->withServerVariables(['REMOTE_ADDR' => '192.0.2.10'])
            ->get('/_tests/rate-limit')
            ->assertTooManyRequests()
            ->assertHeader('Retry-After');

        $this->withServerVariables(['REMOTE_ADDR' => '192.0.2.11'])
            ->get('/_tests/rate-limit')
            ->assertOk();
    }
}
