<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php($siteName = $siteSetting?->site_name ?? 'KampusMart')
    <title>Verifikasi Email - {{ $siteName }}</title>

    @include('partials.favicon')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#F6F8FC] text-slate-900 antialiased">
    <main class="flex min-h-screen items-center justify-center px-4 py-10">
        <section class="w-full max-w-lg rounded-3xl border border-slate-200 bg-white p-7 shadow-xl shadow-slate-200/60 sm:p-10">
            <a href="{{ route('home') }}" class="mx-auto flex w-fit items-center gap-3">
                @if ($siteSetting?->logo)
                    <img src="{{ asset('storage/' . $siteSetting->logo) }}" alt="{{ $siteName }}"
                        class="size-11 rounded-2xl object-contain shadow-sm">
                @else
                    <span class="flex size-11 items-center justify-center rounded-2xl bg-[#315ebc] text-lg font-black text-white">
                        {{ strtoupper(substr($siteName, 0, 1)) }}
                    </span>
                @endif

                <span class="text-xl font-black tracking-tight text-[#0a1d45]">{{ $siteName }}</span>
            </a>

            <div class="mx-auto mt-8 flex size-16 items-center justify-center rounded-2xl bg-blue-50 text-[#315ebc]">
                <svg class="size-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 6h16v12H4z" />
                    <path d="m4 7 8 6 8-6" />
                </svg>
            </div>

            <div class="mt-6 text-center">
                <h1 class="text-2xl font-black tracking-tight text-slate-900">Verifikasi email Anda</h1>
                <p class="mt-3 text-sm leading-6 text-slate-500">
                    Tautan verifikasi telah dikirim ke
                    <strong class="font-bold text-slate-700">{{ auth()->user()->email }}</strong>.
                    Buka email tersebut agar Anda dapat mengakses seluruh fitur pembeli.
                </p>
            </div>

            @if (session('status') === 'verification-link-sent')
                <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
                    Tautan verifikasi baru berhasil dikirim. Silakan periksa kotak masuk atau folder spam.
                </div>
            @endif

            <div class="mt-7 space-y-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="flex h-12 w-full items-center justify-center rounded-xl bg-[#315ebc] px-5 text-sm font-bold text-white transition hover:bg-[#254c9e] focus:outline-none focus:ring-4 focus:ring-blue-200">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <a href="{{ route('home') }}"
                    class="flex h-12 w-full items-center justify-center rounded-xl border border-slate-200 px-5 text-sm font-bold text-slate-600 transition hover:bg-slate-50">
                    Kembali ke Beranda
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full py-2 text-sm font-semibold text-slate-400 transition hover:text-slate-700">
                        Keluar dari akun
                    </button>
                </form>
            </div>

            <p class="mt-5 text-center text-xs leading-5 text-slate-400">
                Belum menerima email? Tunggu beberapa menit, periksa folder spam, lalu gunakan tombol kirim ulang.
            </p>
        </section>
    </main>
</body>

</html>
