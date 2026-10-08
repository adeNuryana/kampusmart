<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationController extends Controller
{
    public function notice(Request $request): View|RedirectResponse
    {
        abort_unless($request->user()?->role === 'buyer', 403);

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('buyer.dashboard');
        }

        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        abort_unless($request->user()?->role === 'buyer', 403);

        if (! $request->user()->hasVerifiedEmail()) {
            $request->fulfill();
        }

        return redirect()
            ->route('buyer.dashboard')
            ->with('success', 'Email berhasil diverifikasi. Akun Anda sekarang sudah aktif sepenuhnya.');
    }

    public function send(Request $request): RedirectResponse
    {
        abort_unless($request->user()?->role === 'buyer', 403);

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('buyer.dashboard');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
