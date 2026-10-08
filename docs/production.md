# Deployment production KampusMart

## Kebutuhan sistem

- PHP 8.2 atau lebih baru dengan ekstensi `ctype`, `curl`, `dom`, `fileinfo`, `filter`, `gd`, `hash`, `mbstring`, `openssl`, `pdo`, `session`, `tokenizer`, dan `xml`
- Composer 2
- Node.js 20 atau lebih baru dan npm
- MySQL 8/MariaDB 10.6 atau database lain yang didukung Laravel
- Web server dengan document root mengarah ke direktori `public`

## Verifikasi sebelum deploy

```bash
composer validate --strict
composer audit --locked
npm audit --omit=dev
php artisan test
npm run build
```

Semua perintah di atas harus berhasil sebelum rilis diteruskan.

## Langkah deployment

1. Arahkan document root domain ke `<project>/public`, bukan ke root repositori.
2. Salin `.env.production.example` menjadi `.env` di server dan isi seluruh URL, kredensial database, SMTP, Google OAuth, serta nomor WhatsApp. Jangan commit `.env`.
3. Pasang dependency dan bangun aset:

```bash
composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
npm ci
npm run build
```

4. Pada deployment pertama saja, buat application key. Jangan mengganti key pada deployment berikutnya karena akan memutus session dan data terenkripsi.

```bash
php artisan key:generate
```

5. Selesaikan deployment aplikasi:

```bash
php artisan storage:link
php artisan migrate --force
php artisan optimize
```

6. Pastikan user web server dapat menulis ke `storage` dan `bootstrap/cache`. Jalankan worker persisten bila fitur antrean digunakan:

```bash
php artisan queue:work --sleep=3 --tries=3 --max-time=3600
```

Kelola worker dengan systemd, Supervisor, atau process manager platform. Setelah setiap deployment, jalankan `php artisan queue:restart` agar worker memuat kode terbaru.

## Checklist operasi

- Gunakan HTTPS dan pertahankan `APP_DEBUG=false`.
- Set `SESSION_SECURE_COOKIE=true` hanya setelah HTTPS aktif.
- Pastikan callback Google sama persis dengan `GOOGLE_REDIRECT_URI`.
- Pantau endpoint health check `GET /up` dari load balancer atau uptime monitor.
- Jadwalkan backup database dan `storage/app/public`, lalu uji proses restore secara berkala.
- Rotasi kredensial database, SMTP, dan OAuth apabila pernah terekspos.
- Tinjau log di `storage/logs` dan jalankan audit dependency secara berkala.

Untuk mengosongkan cache konfigurasi saat troubleshooting, jalankan `php artisan optimize:clear`, perbaiki `.env`, lalu jalankan kembali `php artisan optimize`.

## Upload dan error 413

Produk dapat mengunggah sampai lima gambar berukuran maksimal 2 MB per gambar. Nginx dan PHP-FPM harus menerima request sedikit lebih besar daripada total tersebut:

```nginx
client_max_body_size 16M;
error_page 413 /413.html;

location = /413.html {
    root /var/www/coness/public;
    internal;
}
```

Gunakan `public/413.html` sebagai popup statis karena request 413 ditolak Nginx sebelum Laravel berjalan. Contoh lengkap tersedia di `deploy/nginx-errors.conf.example`.

Selaraskan konfigurasi PHP-FPM:

```ini
upload_max_filesize = 3M
post_max_size = 16M
```

Validasi Laravel tetap membatasi setiap gambar menjadi 2 MB. Setelah mengubah konfigurasi, uji konfigurasi Nginx lalu muat ulang Nginx dan PHP-FPM.
