<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use RuntimeException;
use Tests\TestCase;

class ErrorResponseTest extends TestCase
{
    public function test_unhandled_web_error_shows_safe_popup_page(): void
    {
        config(['app.debug' => false]);

        Route::middleware('web')->get('/_tests/server-error', function (): never {
            throw new RuntimeException('Detail exception yang tidak boleh tampil.');
        });

        $this->get('/_tests/server-error')
            ->assertInternalServerError()
            ->assertSee('Terjadi kesalahan')
            ->assertDontSee('Detail exception yang tidak boleh tampil.');
    }
}
