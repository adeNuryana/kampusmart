<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title') - {{ $siteSetting?->site_name ?? 'KampusMart' }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

</head>


<body class="min-h-screen
           bg-slate-50
           pb-20
           text-slate-900
           md:pb-0">

    {{-- NAVBAR --}}
    <header
        class="sticky top-0 z-50
               border-b border-slate-200/80
               bg-white/90 backdrop-blur">

        <div
            class="mx-auto flex h-16 max-w-7xl
                   items-center gap-6 px-4
                   sm:px-6 lg:px-8">

            {{-- LOGO --}}
            {{-- BRAND --}}
            <a href="{{ route('home') }}"
                class="flex
                           shrink-0
                           items-center
                           gap-2.5">

                @if ($siteSetting?->logo)
                    <img src="{{ asset('storage/' . $siteSetting->logo) }}"
                        alt="{{ $siteSetting?->site_name ?? 'KampusMart' }}"
                        class="size-10
                                   rounded-2xl
                                   object-contain
                                   shadow-sm">
                @else
                    <div
                        class="flex
                                   size-10
                                   items-center
                                   justify-center
                                   rounded-2xl
                                   bg-gradient-to-br
                                   from-[#0a1d45]
                                   to-[#4371d1]
                                   text-sm
                                   font-black
                                   text-white
                                   shadow-lg
                                   shadow-blue-600/20">
                        {{ strtoupper(substr($siteSetting?->site_name ?? 'KampusMart', 0, 1)) }}
                    </div>
                @endif

                <div class="hidden sm:block">

                    <p
                        class="text-lg
                                   font-black
                                   tracking-tight
                                   text-[#0a1d45]">
                        {{ $siteSetting?->site_name ?? 'KampusMart' }}
                    </p>

                    <p
                        class="-mt-0.5
                                   text-[9px]
                                   font-semibold
                                   uppercase
                                   tracking-[0.18em]
                                   text-slate-400">
                        Campus Marketplace
                    </p>

                </div>

            </a>


            {{-- SEARCH --}}
            <div class="hidden flex-1 md:block">
                <form action="{{ route('buyer.products.index') }}" method="GET" class="hidden flex-1 md:block">

                    <div class="relative max-w-xl">




                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari produk di KampusMart..."
                            class="h-11 w-full rounded-xl
                   border border-[#06296f]
                   bg-slate-50 pl-11 pr-4
                   text-sm outline-none
                   transition
                   focus:border-[#3b72df]
                   focus:bg-white
                   focus:ring-4
                   focus:ring-[#477eec]">

                    </div>

                </form>

            </div>


            {{-- RIGHT MENU --}}
            <div class="ml-auto flex items-center gap-2">
                <a href="{{ route('buyer.orders.index') }}"
                    class="hidden rounded-xl
           px-4 py-2
           text-sm font-medium
           text-slate-600
           transition
           hover:bg-slate-100
           hover:text-[#315EBB]
           md:inline-flex">
                    Pesanan
                </a>

                {{-- CART --}}
                @php
                    $cartCount = auth()->check() ? auth()->user()->cartItems()->sum('quantity') : 0;
                @endphp


                <a href="{{ route('buyer.cart.index') }}" title="Keranjang"
                    class="relative hidden size-10
           items-center justify-center
           rounded-xl text-slate-600
           transition hover:bg-slate-100
           md:inline-flex">

                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M3 4h2l2 11h10l2-7H6" />
                        <circle cx="9" cy="19" r="1" />
                        <circle cx="17" cy="19" r="1" />
                    </svg>


                    @if ($cartCount > 0)
                        <span
                            class="absolute -right-1 -top-1
                   flex min-w-5 items-center
                   justify-center rounded-full
                   bg-[#315EBB] px-1
                   text-[10px] font-bold
                   text-white">
                            {{ $cartCount > 99 ? '99+' : $cartCount }}
                        </span>
                    @endif

                </a>

                {{-- PROFILE --}}
                {{-- PROFILE DROPDOWN --}}
                @auth
                    <details class="group relative hidden md:block">

                        {{-- BUTTON PROFILE --}}
                        <summary
                            class="flex cursor-pointer
               list-none items-center gap-3
               rounded-xl px-2 py-1.5
               transition
               hover:bg-slate-100">

                            {{-- AVATAR --}}
                            <div
                                class="flex size-9 shrink-0
                   items-center justify-center
                   rounded-full bg-[#315EBB]
                   text-sm font-bold
                   text-[#dfe5f1]">
                                {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
                            </div>


                            {{-- NAME --}}
                            <div class="hidden text-left lg:block">

                                <p
                                    class="max-w-[130px] truncate
                       text-sm font-semibold
                       text-slate-800">
                                    {{ auth()->user()?->name ?? 'Akun' }}
                                </p>

                                <p class="text-xs text-slate-400">
                                    Pembeli
                                </p>

                            </div>


                            {{-- ARROW --}}
                            <svg class="hidden size-4
                   text-slate-400
                   transition-transform
                   group-open:rotate-180
                   lg:block"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m6 9 6 6 6-6" />
                            </svg>

                        </summary>


                        {{-- DROPDOWN --}}
                        <div
                            class="absolute right-0 top-full
               z-50 mt-2 w-56
               overflow-hidden rounded-2xl
               border border-slate-200
               bg-white p-2
               shadow-xl shadow-slate-200/60">

                            {{-- USER INFO --}}
                            <div class="px-3 py-3">

                                <p class="truncate text-sm
                       font-semibold text-slate-900">
                                    {{ auth()->user()?->name ?? 'Akun' }}
                                </p>

                                <p class="mt-1 truncate
                       text-xs text-slate-400">
                                    {{ auth()->user()?->email ?? '' }}
                                </p>

                            </div>


                            <div class="my-1 border-t border-slate-100"></div>

                            {{-- DASHBOARD --}}
                            <a href="{{ route('buyer.dashboard') }}"
                                class="flex
           items-center
           gap-3
           rounded-xl
           px-3
           py-2.5
           text-sm
           font-medium
           text-slate-600
           transition
           hover:bg-violet-50
           hover:text-[#315EBB]">

                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path d="M3 3h7v7H3z" />
                                    <path d="M14 3h7v7h-7z" />
                                    <path d="M3 14h7v7H3z" />
                                    <path d="M14 14h7v7h-7z" />
                                </svg>

                                Dashboard

                            </a>
                            {{-- PROFILE --}}
                            <a href="{{ route('buyer.profile.index') }}"
                                class="flex items-center gap-3
                   rounded-xl px-3 py-2.5
                   text-sm font-medium
                   text-slate-600 transition
                   hover:bg-violet-50
                   hover:text-[#315EBB]">

                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">
                                    <circle cx="12" cy="8" r="4" />

                                    <path d="M4 21a8 8 0 0 1
                               16 0" />
                                </svg>

                                Profile

                            </a>


                            {{-- LOGOUT --}}
                            <form action="{{ route('logout') }}" method="POST">

                                @csrf

                                <button type="submit"
                                    class="flex w-full
                       items-center gap-3
                       rounded-xl px-3 py-2.5
                       text-left text-sm
                       font-medium text-red-500
                       transition
                       hover:bg-red-50
                       hover:text-red-600">

                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <path d="M10 17l5-5-5-5" />

                                        <path d="M15 12H3" />

                                        <path d="M14 3h5
                                   a2 2 0 0 1 2 2
                                   v14
                                   a2 2 0 0 1-2 2
                                   h-5" />
                                    </svg>

                                    Logout

                                </button>

                            </form>

                        </div>

                    </details>
                @else
                    <a href="{{ route('login') }}"
                        class="hidden
                               items-center
                               justify-center
                               rounded-xl
                               bg-[#315EBB]
                               px-4
                               py-2.5
                               text-sm
                               font-bold
                               text-white
                               transition
                               hover:bg-[#315EBB]
                               md:inline-flex">
                        Masuk
                    </a>

                @endauth

            </div>

        </div>

    </header>


    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>


    {{-- FOOTER --}}
    <footer class=" hidden border-t border-slate-200
               bg-white md:block">

        <div
            class="mx-auto max-w-7xl px-4 py-8
                   text-center text-sm text-slate-500
                   sm:px-6 lg:px-8">
            © {{ date('Y') }} {{ $siteSetting?->site_name ?? 'KampusMart' }}.
            Marketplace mahasiswa.
        </div>

    </footer>
    {{-- ========================================================= --}}
    {{-- MOBILE BOTTOM NAVIGATION --}}
    {{-- ========================================================= --}}

    <div x-data="{
        accountMenu: false
    }" class="md:hidden">

        {{-- BOTTOM NAV --}}
        <nav
            class="fixed
               inset-x-0
               bottom-0
               z-50
               border-t
               border-slate-200/80
               bg-white/95
               px-2
               shadow-[0_-8px_30px_rgba(15,23,42,0.08)]
               backdrop-blur-xl">

            <div
                class="mx-auto
                   grid
                   h-[68px]
                   max-w-md
                   grid-cols-4">

                {{-- HOME --}}
                <a href="{{ route('home') }}"
                    class="group
                       flex
                       flex-col
                       items-center
                       justify-center
                       gap-1
                       transition
                       {{ request()->routeIs('home') ? 'text-[#315EBB]' : 'text-slate-400' }}">

                    <i class="fa-solid fa-house text-lg"></i>

                    <span class="text-[10px] font-semibold">
                        Home
                    </span>

                    @if (request()->routeIs('home'))
                        <span class="h-1 w-1 rounded-full bg-[#315EBB]"></span>
                    @endif

                </a>


                {{-- PESANAN --}}
                <a href="{{ route('buyer.orders.index') }}"
                    class="group
                       flex
                       flex-col
                       items-center
                       justify-center
                       gap-1
                       transition
                       {{ request()->routeIs('buyer.orders.*') ? 'text-[#315EBB]' : 'text-slate-400' }}">

                    <i class="fa-solid fa-receipt text-lg"></i>

                    <span class="text-[10px] font-semibold">
                        Pesanan
                    </span>

                    @if (request()->routeIs('buyer.orders.*'))
                        <span class="h-1 w-1 rounded-full bg-[#315EBB]"></span>
                    @endif

                </a>


                {{-- CART --}}
                <a href="{{ route('buyer.cart.index') }}"
                    class="group
                       relative
                       flex
                       flex-col
                       items-center
                       justify-center
                       gap-1
                       transition
                       {{ request()->routeIs('buyer.cart.*') ? 'text-[#315EBB]' : 'text-slate-400' }}">

                    <div class="relative">

                        <i class="fa-solid fa-cart-shopping text-lg"></i>

                        @if ($cartCount > 0)
                            <span
                                class="absolute
                                   -right-3
                                   -top-2
                                   flex
                                   min-w-4
                                   items-center
                                   justify-center
                                   rounded-full
                                   bg-[#315EBB]
                                   px-1
                                   text-[8px]
                                   font-bold
                                   text-white">
                                {{ $cartCount > 99 ? '99+' : $cartCount }}
                            </span>
                        @endif

                    </div>

                    <span class="text-[10px] font-semibold">
                        Keranjang
                    </span>

                    @if (request()->routeIs('buyer.cart.*'))
                        <span class="h-1 w-1 rounded-full bg-[#315EBB]"></span>
                    @endif

                </a>


                {{-- ACCOUNT --}}
                @auth

                    <button type="button" @click="accountMenu = true"
                        class="group
                       flex
                       flex-col
                       items-center
                       justify-center
                       gap-1
                       transition
                       {{ request()->routeIs('buyer.dashboard', 'buyer.profile.*') ? 'text-[#315EBB]' : 'text-slate-400' }}">

                        <div
                            class="flex
                           size-7
                           items-center
                           justify-center
                           rounded-full
                           text-[10px]
                           font-black
                           {{ request()->routeIs('buyer.dashboard', 'buyer.profile.*')
                               ? 'bg-[#315EBB] text-white'
                               : 'bg-[#315EBB] text-[#315EBB]' }}">
                            {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
                        </div>

                        <span class="text-[10px] font-semibold">
                            Akun
                        </span>

                        @if (request()->routeIs('buyer.dashboard', 'buyer.profile.*'))
                            <span class="h-1 w-1 rounded-full bg-[#315EBB]"></span>
                        @endif

                    </button>
                @else
                    <a href="{{ route('login') }}"
                        class="group
                           flex
                           flex-col
                           items-center
                           justify-center
                           gap-1
                           text-slate-400
                           transition">

                        <div
                            class="flex
                               size-7
                               items-center
                               justify-center
                               rounded-full
                               bg-slate-100
                               text-[10px]
                               font-black
                               text-slate-500">
                            <i class="fa-regular fa-user"></i>
                        </div>

                        <span class="text-[10px] font-semibold">
                            Masuk
                        </span>

                    </a>

                @endauth

            </div>

        </nav>


        {{-- ========================================================= --}}
        {{-- ACCOUNT BOTTOM SHEET --}}
        {{-- ========================================================= --}}

        @auth

            <div x-cloak x-show="accountMenu" @keydown.escape.window="accountMenu = false"
                class="fixed
               inset-0
               z-[100]
               flex
               items-end">

                {{-- BACKDROP --}}
                <button type="button" @click="accountMenu = false"
                    class="absolute
                   inset-0
                   bg-slate-950/40
                   backdrop-blur-[2px]"
                    aria-label="Tutup menu akun"></button>


                {{-- SHEET --}}
                <div x-show="accountMenu" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0"
                    x-transition:leave-end="translate-y-full" @click.stop
                    class="relative
                   w-full
                   overflow-hidden
                   rounded-t-[28px]
                   bg-white
                   shadow-2xl">

                    {{-- HANDLE --}}
                    <div class="flex justify-center pt-3">

                        <div
                            class="h-1.5
                           w-12
                           rounded-full
                           bg-slate-200">
                        </div>

                    </div>


                    {{-- USER --}}
                    <div
                        class="flex
                       items-center
                       gap-3
                       px-5
                       pb-5
                       pt-4">

                        <div
                            class="flex
                           size-12
                           shrink-0
                           items-center
                           justify-center
                           rounded-2xl
                           bg-gradient-to-br
                           from-[#315EBB]
                           to-[#315EBB]
                           text-lg
                           font-black
                           text-white
                           shadow-lg
                           shadow-[#315EBB]/20">
                            {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
                        </div>


                        <div class="min-w-0 flex-1">

                            <p
                                class="truncate
                               text-sm
                               font-bold
                               text-slate-900">
                                {{ auth()->user()?->name ?? 'Akun' }}
                            </p>

                            <p
                                class="mt-0.5
                               truncate
                               text-xs
                               text-slate-400">
                                {{ auth()->user()?->email ?? '' }}
                            </p>

                        </div>


                        <button type="button" @click="accountMenu = false"
                            class="flex
                           size-9
                           items-center
                           justify-center
                           rounded-xl
                           bg-slate-100
                           text-slate-400">
                            <i class="fa-solid fa-xmark"></i>
                        </button>

                    </div>


                    <div class="h-px bg-slate-100"></div>


                    {{-- MENU --}}
                    <div class="space-y-1 p-3">

                        {{-- DASHBOARD --}}
                        <a href="{{ route('buyer.dashboard') }}"
                            class="flex
                           items-center
                           gap-3
                           rounded-2xl
                           px-3
                           py-3
                           transition
                           active:bg-violet-50">

                            <div
                                class="flex
                               size-10
                               shrink-0
                               items-center
                               justify-center
                               rounded-xl
                               bg-violet-50
                               text-[#315EBB]">
                                <i class="fa-solid fa-chart-pie"></i>
                            </div>

                            <div class="flex-1">

                                <p
                                    class="text-sm
                                   font-bold
                                   text-slate-700">
                                    Dashboard
                                </p>

                                <p class="mt-0.5 text-[10px] text-slate-400">
                                    Ringkasan aktivitas akun
                                </p>

                            </div>

                            <i
                                class="fa-solid
                               fa-chevron-right
                               text-[10px]
                               text-slate-300"></i>

                        </a>


                        {{-- PROFILE --}}
                        <a href="{{ route('buyer.profile.index') }}"
                            class="flex
                           items-center
                           gap-3
                           rounded-2xl
                           px-3
                           py-3
                           transition
                           active:bg-blue-50">

                            <div
                                class="flex
                               size-10
                               shrink-0
                               items-center
                               justify-center
                               rounded-xl
                               bg-blue-50
                               text-blue-600">
                                <i class="fa-regular fa-user"></i>
                            </div>

                            <div class="flex-1">

                                <p
                                    class="text-sm
                                   font-bold
                                   text-slate-700">
                                    Profil Saya
                                </p>

                                <p class="mt-0.5 text-[10px] text-slate-400">
                                    Kelola informasi akun
                                </p>

                            </div>

                            <i
                                class="fa-solid
                               fa-chevron-right
                               text-[10px]
                               text-slate-300"></i>

                        </a>


                        {{-- ORDER --}}
                        <a href="{{ route('buyer.orders.index') }}"
                            class="flex
                           items-center
                           gap-3
                           rounded-2xl
                           px-3
                           py-3
                           transition
                           active:bg-amber-50">

                            <div
                                class="flex
                               size-10
                               shrink-0
                               items-center
                               justify-center
                               rounded-xl
                               bg-amber-50
                               text-amber-600">
                                <i class="fa-solid fa-receipt"></i>
                            </div>

                            <div class="flex-1">

                                <p
                                    class="text-sm
                                   font-bold
                                   text-slate-700">
                                    Pesanan Saya
                                </p>

                                <p class="mt-0.5 text-[10px] text-slate-400">
                                    Lihat transaksi dan status pesanan
                                </p>

                            </div>

                            <i
                                class="fa-solid
                               fa-chevron-right
                               text-[10px]
                               text-slate-300"></i>

                        </a>

                    </div>


                    {{-- LOGOUT --}}
                    <div
                        class="border-t
                       border-slate-100
                       px-3
                       pb-[max(20px,env(safe-area-inset-bottom))]
                       pt-3">

                        <form action="{{ route('logout') }}" method="POST">

                            @csrf

                            <button type="submit"
                                class="flex
                               w-full
                               items-center
                               gap-3
                               rounded-2xl
                               px-3
                               py-3
                               text-left
                               transition
                               active:bg-red-50">

                                <div
                                    class="flex
                                   size-10
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-red-50
                                   text-red-500">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                </div>

                                <div class="flex-1">

                                    <p
                                        class="text-sm
                                       font-bold
                                       text-red-500">
                                        Logout
                                    </p>

                                    <p class="mt-0.5 text-[10px] text-slate-400">
                                        Keluar dari akun KampusMart
                                    </p>

                                </div>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @endauth

    </div>

</body>

</html>
