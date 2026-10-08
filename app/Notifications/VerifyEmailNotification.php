<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes((int) config('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ],
        );

        return (new MailMessage)
            ->subject('Verifikasi alamat email Anda')
            ->greeting('Halo, '.$notifiable->name.'!')
            ->line('Terima kasih sudah mendaftar. Klik tombol di bawah untuk memverifikasi alamat email akun pembeli Anda.')
            ->action('Verifikasi Email', $verificationUrl)
            ->line('Tautan verifikasi ini berlaku selama '.config('auth.verification.expire', 60).' menit.')
            ->line('Jika Anda tidak membuat akun ini, abaikan email ini.');
    }
}
