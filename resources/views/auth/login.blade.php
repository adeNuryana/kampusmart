<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $siteName = $siteSetting?->site_name ?? 'KampusMart';

        $adminWhatsapp = preg_replace('/\D+/', '', (string) config('app.admin_whatsapp', ''));

        if (str_starts_with($adminWhatsapp, '0')) {
            $adminWhatsapp = '62' . substr($adminWhatsapp, 1);
        } elseif (str_starts_with($adminWhatsapp, '8')) {
            $adminWhatsapp = '62' . $adminWhatsapp;
        }

        $sellerMessage = urlencode(
            "Halo Admin {$siteName}.\n\n" .
                "Saya ingin mendaftar sebagai penjual di {$siteName}.\n" .
                "Mohon informasi mengenai proses pendaftaran akun seller.\n\n" .
                'Terima kasih.',
        );

        $sellerWhatsappUrl = $adminWhatsapp ? "https://wa.me/{$adminWhatsapp}?text={$sellerMessage}" : null;
    @endphp
    <title>Masuk - {{ $siteName }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>



<body class="min-h-screen bg-[#F6F8FC] text-slate-900 antialiased">

    <main class="min-h-screen lg:grid lg:grid-cols-[1.05fr_.95fr]">

        {{-- LEFT --}}
        <section
            class="relative hidden min-h-screen overflow-hidden
                   bg-gradient-to-br from-[#071633] via-[#173b82] to-[#315ebc]
                   px-12 py-10 text-white lg:flex">

            <div class="pointer-events-none absolute -left-28 -top-28 size-96 rounded-full bg-blue-400/20 blur-3xl">
            </div>
            <div
                class="pointer-events-none absolute -bottom-32 -right-24 size-96 rounded-full bg-violet-400/20 blur-3xl">
            </div>

            <div class="relative z-10 flex w-full flex-col justify-between">

                <a href="{{ route('home') }}" class="inline-flex w-fit items-center gap-3">

                    @if ($siteSetting?->logo)
                        <img src="{{ asset('storage/' . $siteSetting->logo) }}" alt="{{ $siteName }}"
                            class="size-11 rounded-2xl bg-white object-contain p-1 shadow-lg">
                    @else
                        <div
                            class="flex size-11 items-center justify-center rounded-2xl
                                   bg-white text-base font-black text-[#315ebc] shadow-lg">
                            {{ strtoupper(substr($siteName, 0, 1)) }}
                        </div>
                    @endif

                    <div>
                        <p class="text-xl font-black tracking-tight">
                            {{ $siteName }}
                        </p>
                        <p class="text-[9px] font-semibold uppercase tracking-[0.2em] text-blue-200">
                            Campus Marketplace
                        </p>
                    </div>

                </a>


                <div class="max-w-xl">

                    <span
                        class="inline-flex items-center gap-2 rounded-full
                               border border-white/15 bg-white/10 px-3 py-1.5
                               text-xs font-semibold text-blue-50 backdrop-blur">
                        <span class="flex size-6 items-center justify-center rounded-full bg-white text-[#315ebc]">
                            <i class="fa-solid fa-bolt text-[9px]"></i>
                        </span>

                        Marketplace mahasiswa yang lebih praktis
                    </span>

                    <h1
                        class="mt-6 text-4xl font-black leading-[1.08]
                               tracking-tight xl:text-5xl">
                        Masuk, temukan produk,
                        <span
                            class="mt-1 block bg-gradient-to-r
                                   from-blue-100 via-white to-violet-200
                                   bg-clip-text text-transparent">
                            dan terhubung dengan seller.
                        </span>
                    </h1>

                    <p class="mt-5 max-w-lg text-sm leading-7 text-blue-100/85">
                        {{ $siteName }} mempertemukan buyer dan seller kampus
                        dalam satu platform yang ringkas, terstruktur,
                        dan mudah digunakan.
                    </p>

                    <div class="mt-8 grid grid-cols-3 gap-3">

                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                            <div class="flex size-9 items-center justify-center rounded-xl bg-white/10">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </div>
                            <p class="mt-3 text-xs font-bold">Belanja Mudah</p>
                        </div>

                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                            <div class="flex size-9 items-center justify-center rounded-xl bg-white/10">
                                <i class="fa-solid fa-store"></i>
                            </div>
                            <p class="mt-3 text-xs font-bold">Seller Kampus</p>
                        </div>

                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                            <div class="flex size-9 items-center justify-center rounded-xl bg-white/10">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                            <p class="mt-3 text-xs font-bold">Terhubung Cepat</p>
                        </div>

                    </div>

                </div>


                <div class="flex items-center justify-between text-xs text-blue-200">
                    <span>
                        © {{ date('Y') }} {{ $siteName }}
                    </span>
                    <span>Marketplace Mahasiswa</span>
                </div>

            </div>

        </section>


        {{-- RIGHT --}}
        <section
            class="relative flex min-h-screen items-center justify-center
                   overflow-hidden px-4 py-8 sm:px-6 lg:px-10">

            <div class="pointer-events-none absolute -right-32 -top-32 size-80 rounded-full bg-blue-200/35 blur-3xl">
            </div>
            <div
                class="pointer-events-none absolute -bottom-32 -left-32 size-80 rounded-full bg-violet-200/35 blur-3xl">
            </div>

            <div class="relative z-10 w-full max-w-md">

                {{-- MOBILE HEADER --}}
                <div class="mb-6 flex items-center justify-between lg:hidden">

                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">

                        <div
                            class="flex size-10 items-center justify-center rounded-2xl
                                   bg-gradient-to-br from-[#0a1d45] to-[#315ebc]
                                   text-sm font-black text-white shadow-lg shadow-blue-600/20">
                            {{ strtoupper(substr($siteName, 0, 1)) }}
                        </div>

                        <div>
                            <p class="text-sm font-black text-[#0a1d45]">
                                {{ $siteName }}
                            </p>
                            <p class="text-[9px] text-slate-400">Campus Marketplace</p>
                        </div>

                    </a>

                    <a href="{{ route('home') }}" title="Halaman Awal"
                        class="flex size-10 items-center justify-center rounded-xl
                               border border-slate-200 bg-white text-slate-500 shadow-sm">
                        <i class="fa-solid fa-house"></i>
                    </a>

                </div>


                {{-- CARD --}}
                <div
                    class="rounded-[28px] border border-slate-200 bg-white/95
                           p-5 shadow-2xl shadow-slate-950/5 backdrop-blur-xl sm:p-7">

                    <div class="mb-6">

                        <span
                            class="inline-flex items-center gap-2 rounded-full
                                   bg-blue-50 px-3 py-1.5 text-[10px]
                                   font-bold uppercase tracking-[0.16em] text-[#315ebc]">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            Login
                        </span>

                        <h2 class="mt-4 text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">
                            Selamat datang kembali
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Masuk untuk melanjutkan aktivitasmu di {{ $siteName }}.
                        </p>

                    </div>


                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div
                            class="mb-5 flex items-start gap-3 rounded-2xl
                                   border border-red-200 bg-red-50 p-4 text-red-700">
                            <div class="flex size-9 shrink-0 items-center justify-center rounded-xl bg-red-100">
                                <i class="fa-solid fa-circle-exclamation text-sm"></i>
                            </div>

                            <div>
                                <p class="text-sm font-bold">Gagal masuk</p>
                                <p class="mt-1 text-xs leading-5">
                                    {{ $errors->first() }}
                                </p>
                            </div>
                        </div>
                    @endif


                    {{-- GOOGLE --}}
                    @if (Route::has('google.redirect'))
                        <a href="{{ route('google.redirect') }}"
                            class="group flex h-12 w-full items-center justify-center
                                   gap-3 rounded-xl border border-slate-200 bg-white
                                   px-4 text-sm font-bold text-slate-700 shadow-sm
                                   transition hover:-translate-y-0.5 hover:border-slate-300
                                   hover:bg-slate-50 hover:shadow-md">
                            <svg class="size-5" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill="#4285F4"
                                    d="M21.35 12.27c0-.64-.06-1.25-.17-1.84H12v3.48h5.25a4.49 4.49 0 0 1-1.95 2.95v2.26h3.16c1.85-1.7 2.89-4.22 2.89-6.85Z" />
                                <path fill="#34A853"
                                    d="M12 21.8c2.64 0 4.86-.88 6.48-2.38l-3.16-2.46c-.88.59-2 .94-3.32.94-2.55 0-4.7-1.72-5.47-4.03H3.27v2.54A9.79 9.79 0 0 0 12 21.8Z" />
                                <path fill="#FBBC05"
                                    d="M6.53 13.87A5.9 5.9 0 0 1 6.22 12c0-.65.11-1.28.31-1.87V7.59H3.27A9.8 9.8 0 0 0 2.2 12c0 1.58.38 3.08 1.07 4.41l3.26-2.54Z" />
                                <path fill="#EA4335"
                                    d="M12 6.1c1.44 0 2.73.49 3.74 1.46l2.81-2.81C16.85 3.17 14.64 2.2 12 2.2a9.79 9.79 0 0 0-8.73 5.39l3.26 2.54C7.3 7.82 9.45 6.1 12 6.1Z" />
                            </svg>

                            Masuk dengan Google
                        </a>
                    @endif


                    {{-- DIVIDER --}}
                    <div class="my-5 flex items-center gap-3">
                        <div class="h-px flex-1 bg-slate-200"></div>
                        <span class="text-[10px] font-semibold uppercase tracking-[0.16em] text-slate-400">
                            atau gunakan email
                        </span>
                        <div class="h-px flex-1 bg-slate-200"></div>
                    </div>


                    {{-- FORM --}}
                    <form action="{{ route('login.process') }}" method="POST" class="space-y-4">

                        @csrf

                        <div>
                            <label for="email" class="mb-2 block text-xs font-bold text-slate-700">
                                Email
                            </label>

                            <div class="relative">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0
                                           flex w-11 items-center justify-center text-slate-400">
                                    <i class="fa-regular fa-envelope text-sm"></i>
                                </div>

                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="nama@email.com" autocomplete="email" required autofocus
                                    class="h-12 w-full rounded-xl border border-slate-200
                                           bg-slate-50 pl-11 pr-4 text-sm outline-none transition
                                           placeholder:text-slate-400 focus:border-blue-300
                                           focus:bg-white focus:ring-4 focus:ring-blue-100">

                            </div>
                        </div>


                        <div x-data="{ showPassword: false }">

                            <label for="password" class="mb-2 block text-xs font-bold text-slate-700">
                                Password
                            </label>

                            <div class="relative">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0
                                           flex w-11 items-center justify-center text-slate-400">
                                    <i class="fa-solid fa-lock text-sm"></i>
                                </div>

                                <input :type="showPassword ? 'text' : 'password'" id="password" name="password"
                                    placeholder="Masukkan password" autocomplete="current-password" required
                                    class="h-12 w-full rounded-xl border border-slate-200
                                           bg-slate-50 pl-11 pr-12 text-sm outline-none transition
                                           placeholder:text-slate-400 focus:border-blue-300
                                           focus:bg-white focus:ring-4 focus:ring-blue-100">

                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 flex w-11 items-center
                                           justify-center text-slate-400 transition hover:text-[#315ebc]">
                                    <i class="fa-regular" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>

                            </div>

                        </div>


                        <label class="flex cursor-pointer items-center gap-2 text-xs font-medium text-slate-500">
                            <input type="checkbox" name="remember" value="1"
                                class="size-4 rounded border-slate-300 text-[#315ebc] focus:ring-blue-200">
                            Ingat saya
                        </label>


                        <button type="submit"
                            class="group flex h-12 w-full items-center justify-center gap-2
                                   rounded-xl bg-gradient-to-r from-[#0a1d45] to-[#315ebc]
                                   px-5 text-sm font-bold text-white shadow-lg shadow-blue-600/20
                                   transition hover:-translate-y-0.5 hover:shadow-xl">
                            Masuk

                            <i
                                class="fa-solid fa-arrow-right text-xs transition
                                       group-hover:translate-x-1"></i>
                        </button>

                    </form>


                    {{-- REGISTER --}}
                    <div class="mt-6 border-t border-slate-100 pt-5">

                        <div class="mb-3">
                            <p class="text-sm font-black text-slate-800">
                                Belum punya akun?
                            </p>

                            <p class="mt-1 text-xs leading-5 text-slate-400">
                                Pilih jenis akun yang ingin digunakan.
                            </p>
                        </div>


                        <div class="grid grid-cols-2 gap-3">

                            {{-- BUYER --}}
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="group rounded-2xl border border-blue-100
                                           bg-blue-50/70 p-4 transition
                                           hover:-translate-y-0.5 hover:border-blue-200
                                           hover:bg-blue-50 hover:shadow-md">
                                    <div
                                        class="flex size-9 items-center justify-center
                                               rounded-xl bg-[#315ebc] text-white">
                                        <i class="fa-solid fa-user-plus text-sm"></i>
                                    </div>

                                    <p class="mt-3 text-xs font-black text-slate-800">
                                        Daftar Pembeli
                                    </p>

                                    <p class="mt-1 text-[10px] leading-4 text-slate-500">
                                        Buat akun buyer secara langsung.
                                    </p>
                                </a>
                            @endif


                            {{-- SELLER --}}
                            @if ($sellerWhatsappUrl)
                                <a href="{{ $sellerWhatsappUrl }}" target="_blank" rel="noopener noreferrer"
                                    class="group rounded-2xl border border-emerald-100
                                           bg-emerald-50/70 p-4 transition
                                           hover:-translate-y-0.5 hover:border-emerald-200
                                           hover:bg-emerald-50 hover:shadow-md">
                                    <div
                                        class="flex size-9 items-center justify-center
                                               rounded-xl bg-emerald-600 text-white">
                                        <i class="fa-brands fa-whatsapp text-base"></i>
                                    </div>

                                    <p class="mt-3 text-xs font-black text-slate-800">
                                        Daftar Penjual
                                    </p>

                                    <p class="mt-1 text-[10px] leading-4 text-slate-500">
                                        Hubungi admin untuk akun seller.
                                    </p>
                                </a>
                            @else
                                <div
                                    class="rounded-2xl border border-slate-200
                                           bg-slate-50 p-4 opacity-70">
                                    <div
                                        class="flex size-9 items-center justify-center
                                               rounded-xl bg-slate-200 text-slate-500">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </div>

                                    <p class="mt-3 text-xs font-black text-slate-600">
                                        Daftar Penjual
                                    </p>

                                    <p class="mt-1 text-[10px] leading-4 text-slate-400">
                                        WhatsApp admin belum tersedia.
                                    </p>
                                </div>
                            @endif

                        </div>

                    </div>


                    {{-- HOME --}}
                    <div class="mt-5">
                        <a href="{{ route('home') }}"
                            class="flex h-11 w-full items-center justify-center gap-2
                                   rounded-xl border border-slate-200 bg-white
                                   text-xs font-bold text-slate-500 transition
                                   hover:border-blue-200 hover:bg-blue-50 hover:text-[#315ebc]">
                            <i class="fa-solid fa-house text-[10px]"></i>
                            Kembali ke Halaman Awal
                        </a>
                    </div>

                </div>


                <p class="mt-5 text-center text-[10px] leading-5 text-slate-400 lg:hidden">
                    Akun seller dibuat oleh Super Admin {{ $siteName }}.
                </p>

            </div>

        </section>

    </main>

</body>

</html>
