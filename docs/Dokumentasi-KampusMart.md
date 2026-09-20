# Dokumentasi Website KampusMart

**Jenis dokumen:** Panduan Pengguna dan Dokumentasi Teknis  
**Versi dokumen:** 1.0  
**Tanggal pembaruan:** 20 September 2026  
**Aplikasi:** KampusMart

---

## 1. Ringkasan Aplikasi

KampusMart adalah marketplace berbasis web yang mempertemukan pembeli dan penjual dalam lingkungan kampus. Pembeli dapat mencari produk, memasukkan produk ke keranjang, membuat pesanan, memilih metode pembayaran, dan menghubungi penjual melalui WhatsApp. Penjual dapat mengelola produk, memproses pesanan, memantau performa toko, serta mengunduh laporan penjualan. Admin mengelola pengguna, kategori, produk, pesanan, laporan, dan identitas website.

Nama dan logo website dapat diubah oleh admin. Apabila belum diatur, nama bawaan aplikasi adalah **KampusMart**.

### 1.1 Tujuan

- Menyediakan tempat jual beli yang mudah digunakan oleh komunitas kampus.
- Memusatkan katalog produk dari berbagai penjual.
- Membantu penjual mengelola stok, pesanan, dan laporan penjualan.
- Membantu admin memantau aktivitas dan data marketplace.
- Mempermudah komunikasi transaksi melalui WhatsApp.

### 1.2 Ruang Lingkup

Aplikasi menangani katalog, keranjang, pembuatan pesanan, pencatatan metode pembayaran, status transaksi, komunikasi WhatsApp, dan laporan. Penyelesaian pembayaran tetap dilakukan langsung antara pembeli dan penjual; aplikasi belum menyediakan payment gateway internal.

---

## 2. Peran dan Hak Akses

| Peran | Cara memperoleh akun | Hak akses utama |
|---|---|---|
| Pengunjung | Tidak perlu login | Melihat beranda, mencari/filter produk, melihat detail produk, login, dan registrasi |
| Buyer/Pembeli | Registrasi mandiri, login Google, atau dibuat admin | Dashboard pembeli, katalog, keranjang, checkout, beli langsung, riwayat pesanan, halaman toko, dan profil |
| Seller/Penjual | Dibuat oleh admin | Dashboard toko, produk, pesanan, laporan penjualan, ekspor PDF, dan pengaturan toko |
| Admin | Dibuat melalui seeder atau dikelola pada basis data | Dashboard admin, pembeli, seller, kategori, moderasi produk, seluruh pesanan, laporan, profil admin, dan branding website |

Setiap area privat dilindungi autentikasi dan pemeriksaan role. Pengguna yang mencoba membuka area milik role lain akan menerima respons akses ditolak.

---

## 3. Alur Bisnis Utama

### 3.1 Alur Transaksi dari Keranjang

1. Pembeli mencari produk di beranda atau halaman katalog.
2. Pembeli membuka detail produk dan menambahkan produk ke keranjang.
3. Keranjang mengelompokkan item berdasarkan penjual.
4. Pembeli melakukan checkout untuk satu penjual pada satu waktu.
5. Pembeli mengisi nama, nomor telepon, metode pembayaran, dan catatan opsional.
6. Sistem memeriksa kembali status produk dan stok di dalam transaksi database.
7. Sistem membuat pesanan, menyimpan snapshot nama/harga produk, mengurangi stok, dan menghapus item terkait dari keranjang.
8. Pembeli diarahkan ke WhatsApp penjual dengan pesan pesanan yang telah disusun otomatis.
9. Penjual memproses transaksi, lalu menandainya sebagai selesai atau menolak/membatalkan pesanan.

### 3.2 Alur Beli Sekarang

1. Pembeli membuka detail produk.
2. Pembeli menentukan jumlah dan metode pembayaran.
3. Sistem memvalidasi produk dan stok.
4. Pesanan dibuat langsung dan stok dikurangi secara atomik.
5. Pembeli diarahkan ke WhatsApp penjual.

### 3.3 Status Pesanan

| Status sistem | Arti | Perubahan status |
|---|---|---|
| `processing` | Pesanan baru dan sedang diproses | Dibuat otomatis ketika checkout/beli langsung |
| `sold` | Transaksi telah selesai | Diubah oleh seller pemilik pesanan |
| `cancelled` | Pesanan ditolak atau dibatalkan | Diubah oleh seller pemilik pesanan; stok item otomatis dikembalikan |

Pesanan yang sudah berstatus `sold` atau `cancelled` memiliki keputusan akhir dan tidak dapat diubah lagi melalui antarmuka yang tersedia. Pengembalian stok hanya dijalankan sekali saat status berubah dari `processing` menjadi `cancelled`.

### 3.4 Metode Pembayaran

- **Transfer** — pembayaran melalui transfer yang disepakati pembeli dan penjual.
- **Cash/Tunai** — pembayaran langsung secara tunai.

---

## 4. Panduan Pengunjung dan Pembeli

### 4.1 Beranda

Beranda menampilkan kategori, produk terbaru, rekomendasi acak, dan seluruh produk. Produk yang ditampilkan harus aktif, memiliki stok lebih dari nol, dan berasal dari seller aktif.

Pengunjung dapat:

- Mencari berdasarkan nama produk, kategori, atau nama seller pada beranda.
- Memilih kategori untuk mempersempit hasil.
- Membuka detail produk dan informasi toko.
- Berpindah ke halaman login atau registrasi.

### 4.2 Registrasi Pembeli

1. Buka menu **Daftar**.
2. Isi nama, email, nomor HP, password, dan konfirmasi password.
3. Nomor HP harus memakai format Indonesia yang diawali `0`, `62`, atau `+62`.
4. Password minimal terdiri dari 8 karakter.
5. Setelah berhasil, pengguna otomatis login sebagai buyer dan diarahkan ke dashboard.

### 4.3 Login

Pengguna dapat login memakai email dan password. Hanya akun berstatus aktif yang dapat masuk. Arah setelah login ditentukan oleh role:

- Admin menuju dashboard admin.
- Seller menuju dashboard seller.
- Buyer menuju dashboard buyer atau halaman tujuan sebelumnya.

Pembeli juga dapat memakai **Login dengan Google**. Login Google hanya berlaku untuk buyer. Apabila email belum terdaftar, sistem membuat akun buyer baru. Akun admin atau seller tidak dapat masuk melalui jalur Google buyer.

### 4.4 Dashboard Pembeli

Dashboard menampilkan:

- Jumlah item keranjang.
- Pesanan aktif dan pesanan selesai.
- Jumlah dan nilai seluruh transaksi.
- Tiga pesanan terbaru.
- Daftar kategori, produk terbaru, dan produk rekomendasi.

### 4.5 Katalog Produk

Pada halaman produk, pembeli dapat:

- Mencari nama atau deskripsi produk.
- Memfilter berdasarkan kategori.
- Mengurutkan produk terbaru, harga terendah, harga tertinggi, atau nama.
- Membuka detail produk, produk lain dari toko yang sama, dan produk terkait.

### 4.6 Keranjang

1. Pilih jumlah pada detail produk, lalu tambahkan ke keranjang.
2. Jika produk sudah ada, jumlah baru ditambahkan ke jumlah lama selama tidak melebihi stok.
3. Pada halaman keranjang, ubah jumlah atau hapus item bila diperlukan.
4. Item dikelompokkan per seller karena checkout dilakukan per seller.
5. Pilih checkout pada kelompok seller yang ingin diproses.

Satu produk hanya memiliki satu baris keranjang untuk setiap pembeli.

### 4.7 Checkout

1. Pastikan produk dan jumlah sudah benar.
2. Isi nama pembeli dan nomor telepon.
3. Pilih **Transfer** atau **Cash/Tunai**.
4. Tambahkan catatan jika diperlukan.
5. Konfirmasi pesanan.
6. Sistem akan membuat nomor pesanan, misalnya `KM-YYYYMMDD-XXXXXXXX`.
7. Lanjutkan komunikasi pada WhatsApp penjual yang terbuka otomatis.

Harga dan nama produk disimpan sebagai snapshot pada detail pesanan sehingga riwayat tidak berubah apabila produk kemudian diperbarui atau dihapus.

### 4.8 Pesanan Pembeli

Halaman pesanan menampilkan riwayat transaksi, status, detail item, metode pembayaran, total, dan informasi seller. Tombol WhatsApp tersedia untuk menindaklanjuti pesanan. Sistem hanya mengizinkan pembeli membuka WhatsApp untuk pesanannya sendiri.

### 4.9 Profil Pembeli

Pembeli dapat memperbarui nama, email, nomor telepon, dan password. Perubahan password membutuhkan password saat ini, password baru minimal 8 karakter, dan konfirmasi password.

---

## 5. Panduan Seller

### 5.1 Dashboard Seller

Dashboard seller menampilkan:

- Total produk dan produk aktif.
- Produk dengan stok menipis, yaitu stok 1–5.
- Pesanan yang sedang diproses dan selesai.
- Total omzet dari pesanan berstatus selesai.
- Grafik penjualan untuk 1 bulan, 6 bulan, dan 1 tahun terakhir.
- Lima pesanan terbaru dan lima produk stok menipis.

### 5.2 Mengelola Produk

Seller dapat mencari dan memfilter produknya berdasarkan status dan kategori.

Untuk menambahkan produk:

1. Buka **Produk → Tambah Produk**.
2. Pilih kategori.
3. Isi nama, deskripsi, harga, dan stok.
4. Pilih status `active` agar tampil atau `inactive` agar disembunyikan.
5. Unggah gambar opsional berformat JPG, JPEG, PNG, atau WebP dengan ukuran maksimal 2 MB.
6. Simpan produk.

Slug produk dibuat otomatis dan dijaga agar unik. Seller hanya dapat mengedit, mengubah status, atau menghapus produk miliknya sendiri.

### 5.3 Mengelola Pesanan

Seller dapat:

- Mencari berdasarkan nomor pesanan, nama pembeli, atau nomor telepon.
- Memfilter status `processing` atau `sold`.
- Membuka detail item dan data pembeli.
- Menandai pesanan `processing` sebagai `sold`.
- Menolak/membatalkan pesanan `processing`; sistem mengembalikan stok setiap item yang produknya masih tersedia.

Seller tidak dapat melihat atau mengubah pesanan seller lain.

### 5.4 Laporan Penjualan

Laporan seller hanya menghitung pesanan berstatus `sold`. Fitur yang tersedia:

- Filter tanggal awal dan akhir.
- Total omzet, pesanan selesai, dan item terjual.
- Lima produk terlaris.
- Grafik harian, bulanan, atau tahunan berdasarkan rentang data.
- Riwayat penjualan dengan pagination.
- Ekspor PDF ukuran A4 landscape.

### 5.5 Pengaturan Toko

Seller dapat mengganti nama toko, deskripsi, foto toko, dan password. Foto toko menerima JPG, JPEG, PNG, atau WebP maksimal 2 MB. Nomor WhatsApp, NIM, dan fakultas dikelola melalui data seller yang dibuat atau diperbarui admin.

---

## 6. Panduan Admin

### 6.1 Dashboard Admin

Dashboard menampilkan:

- Total buyer dan seller.
- Jumlah seller aktif dan tidak aktif.
- Delapan aktivitas terbaru.
- Grafik pertumbuhan buyer dan seller per hari dalam satu bulan atau per bulan dalam satu tahun.

### 6.2 Manajemen Pembeli

Admin dapat mencari, memfilter, menambah, melihat, mengedit, mengaktifkan, dan menonaktifkan akun pembeli. Admin juga dapat mengatur ulang password pembeli melalui formulir edit.

### 6.3 Manajemen Seller

Admin adalah pihak yang membuat akun seller. Data seller meliputi:

- Nama, email, dan nomor telepon.
- Nama toko dan nomor WhatsApp.
- NIM dan fakultas opsional.
- Deskripsi dan foto toko.
- Status akun dan password.

Admin dapat melihat, mengedit, serta mengaktifkan atau menonaktifkan seller. Seller nonaktif tidak dapat login dan produknya tidak ditampilkan pada katalog publik yang menerapkan filter seller aktif.

### 6.4 Manajemen Kategori

Admin dapat menambah, mencari, mengedit, mengaktifkan, menonaktifkan, dan menghapus kategori. Ikon dapat dipilih dari ikon bawaan atau gambar khusus maksimal 1 MB. Kategori yang masih dipakai produk tidak dapat dihapus.

### 6.5 Moderasi Produk

Admin dapat mencari produk berdasarkan nama, deskripsi, seller, atau toko; memfilter kategori dan status; serta memperbarui harga, stok, dan status. Admin juga dapat menghapus produk beserta file gambarnya.

### 6.6 Pemantauan Pesanan

Admin dapat melihat semua pesanan, mencari berdasarkan nomor pesanan, pembeli, telepon, seller, atau nama toko, serta memfilter status. Halaman admin menyediakan ringkasan total, diproses, selesai, dan ditolak/dibatalkan. Perubahan status transaksi dilakukan oleh seller.

### 6.7 Laporan Marketplace

Laporan admin menyediakan periode bulanan, tahunan, atau tanggal khusus. Informasi yang ditampilkan meliputi:

- Jumlah pesanan dan nilai transaksi.
- Jumlah item, transaksi selesai, buyer unik, dan seller unik.
- Ringkasan status.
- Grafik nilai dan jumlah transaksi.
- Lima seller teratas dan lima produk teratas.
- Daftar pesanan pada periode terpilih.
- Ekspor PDF A4 landscape.

### 6.8 Profil dan Branding

Admin dapat memperbarui profil, email, nomor telepon, dan password sendiri. Pada pengaturan website, admin dapat mengganti nama website dan logo. Logo menerima JPG, JPEG, PNG, atau WebP maksimal 2 MB.

---

## 7. Arsitektur dan Teknologi

### 7.1 Teknologi Utama

| Lapisan | Teknologi |
|---|---|
| Backend | PHP 8.2+, Laravel 12 |
| Template | Blade |
| Database/ORM | Laravel Eloquent; SQLite sebagai contoh bawaan, dapat memakai MySQL |
| Frontend | Tailwind CSS 4, Alpine.js 3 |
| Grafik | Chart.js 4 |
| Build tool | Vite 6 |
| PDF | barryvdh/laravel-dompdf 3 |
| OAuth | Laravel Socialite 5, provider Google |
| Ikon | Font Awesome 6 dari CDN |

### 7.2 Pola Aplikasi

Aplikasi menggunakan pola MVC Laravel:

- `routes/web.php` mendefinisikan endpoint dan middleware.
- `app/Http/Controllers` menangani permintaan per role.
- `app/Models` mendefinisikan entitas dan relasi Eloquent.
- `resources/views` menyimpan halaman Blade.
- `database/migrations` mendefinisikan skema basis data.
- `app/Services/ActivityLogger.php` mencatat aktivitas penting.
- `public/storage` digunakan untuk menyajikan gambar dari disk `public` setelah symbolic link dibuat.

### 7.3 Entitas dan Relasi Data

| Entitas | Fungsi dan relasi utama |
|---|---|
| `users` | Akun buyer, seller, dan admin; memiliki status aktif/nonaktif |
| `seller_profiles` | Profil satu-ke-satu untuk seller; menyimpan toko, WhatsApp, NIM, fakultas, deskripsi, dan foto |
| `categories` | Kategori yang memiliki banyak produk |
| `products` | Dimiliki seller dan termasuk satu kategori |
| `cart_items` | Item keranjang unik per kombinasi buyer dan produk |
| `orders` | Pesanan milik satu buyer dan satu seller |
| `order_items` | Detail pesanan dan snapshot data produk |
| `activity_logs` | Catatan aktivitas pengguna terhadap objek aplikasi |
| `site_settings` | Nama dan logo website |
| `sessions`, `cache`, `jobs` | Infrastruktur Laravel untuk sesi, cache/rate limit, dan antrean |

Relasi ringkas:

`User (seller) → SellerProfile`  
`User (seller) → Products → Category`  
`User (buyer) → CartItems → Product`  
`User (buyer) → Orders ← User (seller)`  
`Order → OrderItems → Product (opsional setelah produk dihapus)`

---

## 8. Kelompok Endpoint Utama

| Area | Prefix/endpoint | Proteksi |
|---|---|---|
| Publik | `/`, `/products/filter`, `/buyer/produk/{product}` | Middleware web |
| Autentikasi | `/login`, `/register`, `/auth/google` | Guest |
| Buyer | `/buyer/*` | Auth + role buyer |
| Seller | `/seller/*` | Auth + role seller |
| Admin | `/admin/*` | Auth + role admin |
| Logout | `/logout` | Auth |
| Health check | `/up` | Endpoint kesehatan Laravel |

Aplikasi memiliki 76 route bisnis/web, di luar endpoint health dan route storage internal.

---

## 9. Instalasi Lokal

### 9.1 Prasyarat

- PHP 8.2 atau lebih baru.
- Composer.
- Node.js dan npm.
- SQLite atau MySQL/MariaDB.
- Ekstensi PHP yang dibutuhkan Laravel dan DomPDF, termasuk PDO, Mbstring, OpenSSL, Tokenizer, XML, Ctype, JSON, Fileinfo, dan GD/Imagick sesuai lingkungan.

### 9.2 Langkah Instalasi

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm run build
```

Pada Windows PowerShell, gunakan `Copy-Item .env.example .env` sebagai pengganti `cp` bila diperlukan.

Untuk menjalankan mode pengembangan:

```bash
composer run dev
```

Atau jalankan backend dan frontend pada terminal terpisah:

```bash
php artisan serve
npm run dev
```

### 9.3 Konfigurasi Basis Data

Contoh SQLite:

```env
DB_CONNECTION=sqlite
```

Pastikan file `database/database.sqlite` tersedia.

Contoh MySQL/MariaDB:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kampusmart
DB_USERNAME=root
DB_PASSWORD=
```

### 9.4 Konfigurasi Google Login

Tambahkan variabel berikut ke `.env`:

```env
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI="http://localhost:8000/auth/google/callback"
```

URI callback pada Google Cloud Console harus sama persis dengan `GOOGLE_REDIRECT_URI`.

### 9.5 Akun Admin Awal

Seeder saat ini membuat akun berikut:

- Email: `admin@kampusmart.com`
- Password awal: `admin12345`

Kredensial tersebut hanya layak untuk inisialisasi lokal. Ganti password segera dan ubah nilai seeder sebelum aplikasi dipublikasikan.

---

## 10. Konfigurasi Lingkungan Penting

| Variabel | Kegunaan | Rekomendasi produksi |
|---|---|---|
| `APP_NAME` | Nama internal aplikasi | `KampusMart` |
| `APP_ENV` | Lingkungan aplikasi | `production` |
| `APP_KEY` | Kunci enkripsi Laravel | Hasil `php artisan key:generate` |
| `APP_DEBUG` | Menampilkan detail error | `false` |
| `APP_URL` | URL utama aplikasi | URL HTTPS produksi |
| `APP_TIMEZONE` | Zona waktu | `Asia/Jakarta` |
| `DB_*` | Koneksi basis data | Akun database khusus aplikasi |
| `SESSION_DRIVER` | Penyimpanan sesi | `database` atau `redis` |
| `CACHE_STORE` | Cache dan penyimpanan rate limiter | `database` atau `redis` |
| `FILESYSTEM_DISK` | Disk file bawaan | Sesuaikan kebutuhan deployment |
| `GOOGLE_*` | OAuth Google | Kredensial dari Google Cloud |
| `ADMIN_WHATSAPP` | Nomor WhatsApp admin jika dipakai tampilan | Format nomor internasional |

Jangan menyimpan file `.env` dalam version control atau membagikan kredensial produksi di dokumentasi publik.

---

## 11. Keamanan yang Diterapkan

- Autentikasi berbasis session Laravel.
- Password disimpan menggunakan hashing Laravel.
- Pemeriksaan role untuk area admin, seller, dan buyer.
- Pemeriksaan kepemilikan produk, pesanan, dan keranjang.
- Perlindungan CSRF pada form web.
- Regenerasi session setelah login dan invalidasi saat logout.
- Validasi tipe, ukuran, dan format file upload.
- Validasi input server-side untuk data utama.
- Transaksi database dan `lockForUpdate` ketika stok dikurangi untuk mencegah race condition.
- Pengembalian stok secara atomik ketika seller menolak/membatalkan pesanan, dengan perlindungan agar tidak dijalankan dua kali.
- Filter akun aktif ketika login serta filter seller aktif pada katalog utama.
- Activity log untuk sejumlah aksi produk, pesanan, dan profil.
- Rate limit global **50 request per menit per alamat IP** untuk route web. Request berlebih menerima HTTP `429 Too Many Requests` dan header `Retry-After`.

Karena rate limit dijalankan sebelum session dan route binding, trafik berlebih dapat ditolak sebelum pekerjaan aplikasi yang lebih mahal dijalankan. Pada deployment dengan lebih dari satu server aplikasi, gunakan cache bersama seperti Redis atau database agar hitungan rate limit konsisten. Konfigurasi trusted proxy juga harus benar agar IP klien tidak dapat dipalsukan atau seluruh pengguna proxy tidak terbaca sebagai satu IP.

### 11.1 Checklist Produksi

- Set `APP_ENV=production` dan `APP_DEBUG=false`.
- Gunakan HTTPS dan cookie sesi yang aman.
- Ganti kredensial admin awal.
- Gunakan password database yang kuat dan hak akses minimum.
- Pastikan folder storage tidak mengizinkan eksekusi script upload.
- Jadwalkan backup database dan file upload.
- Aktifkan monitoring log, kapasitas disk, error 5xx, dan lonjakan respons 429.
- Perbarui dependency Composer dan npm secara berkala setelah pengujian.
- Gunakan Redis bila trafik tinggi atau aplikasi dijalankan pada beberapa instance.

---

## 12. Operasional dan Pemeliharaan

### 12.1 Perintah Umum

```bash
# Menjalankan migration
php artisan migrate

# Menjalankan seeder
php artisan db:seed

# Menghapus cache aplikasi
php artisan optimize:clear

# Membuat cache produksi
php artisan optimize

# Melihat daftar route
php artisan route:list

# Menjalankan test
php artisan test

# Memeriksa format kode
php vendor/bin/pint --test
```

### 12.2 Deployment Ringkas

1. Ambil versi kode yang telah diuji.
2. Instal dependency produksi dengan Composer dan npm.
3. Siapkan `.env` produksi dan database.
4. Jalankan `php artisan migrate --force`.
5. Jalankan `php artisan storage:link` jika belum ada.
6. Build aset dengan `npm run build`.
7. Optimalkan Laravel menggunakan `php artisan optimize`.
8. Pastikan web server mengarah ke folder `public`.
9. Periksa `/up`, login, upload, checkout, WhatsApp, dan ekspor PDF.

### 12.3 Backup

Backup minimal mencakup:

- Seluruh basis data.
- Folder `storage/app/public` yang berisi gambar produk, kategori, seller, dan branding.
- Konfigurasi deployment yang aman, tanpa menyimpan secret pada media yang tidak terenkripsi.

Uji proses restore secara berkala; backup yang belum pernah diuji tidak dapat dianggap siap digunakan.

---

## 13. Pengujian dan Kriteria Penerimaan

Pengujian otomatis dapat dijalankan dengan:

```bash
php artisan test
```

Skenario penting yang perlu diuji sebelum rilis:

- Registrasi dan login buyer.
- Login Google untuk buyer serta penolakan role seller/admin.
- Penolakan login akun nonaktif.
- Pembatasan akses antar-role.
- CRUD produk seller dan verifikasi kepemilikan.
- Perubahan stok pada checkout dan beli langsung.
- Penolakan pembelian melebihi stok.
- Checkout keranjang per seller.
- Perubahan status pesanan hanya oleh seller pemilik.
- Penolakan/pembatalan mengembalikan stok tepat satu kali dan tidak dapat diulang.
- Perhitungan dashboard dan laporan.
- Ekspor PDF admin dan seller.
- Upload dan penggantian gambar.
- Rate limit: 50 request berhasil dan request ke-51 menerima status 429.

---

## 14. Troubleshooting

### Gambar tidak tampil

Jalankan:

```bash
php artisan storage:link
```

Pastikan `storage/app/public` dan `public/storage` dapat dibaca web server.

### Aset CSS/JavaScript tidak tampil

Jalankan `npm install` lalu `npm run build`. Pada pengembangan, pastikan `npm run dev` tetap berjalan.

### Login Google gagal

Periksa `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, dan `GOOGLE_REDIRECT_URI`. Pastikan callback pada Google Cloud sama persis dengan URL aplikasi.

### Error tabel tidak ditemukan

Periksa konfigurasi database, kemudian jalankan:

```bash
php artisan migrate --seed
```

### Terlalu banyak request / HTTP 429

Tunggu sesuai nilai header `Retry-After`. Jika terjadi pada pengguna normal, periksa apakah banyak pengguna berbagi IP publik yang sama dan pastikan konfigurasi proxy benar sebelum mengubah limit.

### PDF gagal dibuat

Periksa dependency Composer, permission folder temporary/storage, ketersediaan gambar, serta penggunaan memori PHP.

### Perubahan konfigurasi tidak terbaca

Jalankan:

```bash
php artisan optimize:clear
```

---

## 15. Batasan Saat Ini dan Pengembangan Lanjutan

- Pembayaran dikonfirmasi secara manual melalui komunikasi pembeli dan seller.
- Status transaksi mencakup `processing`, `sold`, dan `cancelled`; penolakan dan pembatalan masih digabung dalam satu status serta belum ada alur refund.
- Belum ada fitur lupa password melalui email.
- Belum ada notifikasi internal atau push notification.
- Belum ada ulasan/rating produk dan seller.
- Belum ada API publik atau aplikasi mobile khusus.
- Dokumentasi operasional sebaiknya diperbarui setiap kali route, status, role, atau alur transaksi berubah.

Pengembangan berikutnya dapat memprioritaskan reset password, pembatalan dan pemulihan stok, notifikasi, audit log yang lebih lengkap, payment gateway, pengujian fitur tambahan, serta observability produksi.

---

## 16. Kontak dan Kepemilikan Dokumen

Pemilik aplikasi perlu melengkapi bagian berikut sebelum dokumentasi dibagikan secara resmi:

- **Pemilik sistem:** ........................................................
- **Administrator teknis:** ................................................
- **Kontak dukungan:** ......................................................
- **URL produksi:** ..........................................................
- **Lokasi backup:** .........................................................
- **Jadwal pemeliharaan:** ..................................................

Dokumen ini disusun berdasarkan source code KampusMart yang tersedia pada 20 September 2026.
