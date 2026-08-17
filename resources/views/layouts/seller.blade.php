<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Seller - KampusMart')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

</head>


<body class="bg-slate-50 text-slate-900">

    <div class="min-h-screen">

        {{-- =========================
            SIDEBAR
        ========================== --}}
        <aside
            class="fixed inset-y-0 left-0 z-40
                   hidden w-[260px]
                   border-r border-slate-200
                   bg-white lg:flex
                   lg:flex-col">

            {{-- LOGO --}}
            <div
                class="flex h-20 items-center
                       border-b border-slate-100
                       px-6">

                <a href="{{ Route::has('seller.dashboard') ? route('seller.dashboard') : '#' }}"
                    class="flex items-center gap-3">

                    <div
                        class="flex size-10 items-center
                               justify-center rounded-xl
                               bg-violet-600 text-lg
                               font-bold text-white">
                        K
                    </div>


                    <div>

                        <p class="text-lg font-bold
                                   tracking-tight text-slate-900">
                            KampusMart
                        </p>

                        <p class="text-xs font-medium
                                   text-violet-600">
                            Seller Center
                        </p>

                    </div>

                </a>

            </div>


            {{-- MENU --}}
            <nav class="flex-1 space-y-1
                       overflow-y-auto px-4 py-6">

                <p
                    class="mb-3 px-4 text-[11px]
                           font-semibold uppercase
                           tracking-wider text-slate-400">
                    Menu Utama
                </p>


                {{-- DASHBOARD --}}
                @if (Route::has('seller.dashboard'))
                    <a href="{{ route('seller.dashboard') }}"
                        class="flex items-center gap-4
                               rounded-xl px-4 py-3
                               text-sm font-medium
                               transition
                               {{ request()->routeIs('seller.dashboard') ? 'bg-violet-50 text-violet-700' : 'text-slate-600 hover:bg-slate-50' }}">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="3" y="3" width="7" height="7" rx="1" />

                            <rect x="14" y="3" width="7" height="7" rx="1" />

                            <rect x="3" y="14" width="7" height="7" rx="1" />

                            <rect x="14" y="14" width="7" height="7" rx="1" />
                        </svg>

                        Dashboard

                    </a>
                @endif


                {{-- PRODUK --}}
                @if (Route::has('seller.products.index'))
                    <a href="{{ route('seller.products.index') }}"
                        class="flex items-center gap-4
                               rounded-xl px-4 py-3
                               text-sm font-medium
                               transition
                               {{ request()->routeIs('seller.products.*')
                                   ? 'bg-violet-50 text-violet-700'
                                   : 'text-slate-600 hover:bg-slate-50' }}">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M6 7h12l1 14H5L6 7Z" />
                            <path d="M9 7a3 3 0 0 1 6 0" />
                        </svg>

                        Produk

                    </a>
                @endif


                {{-- KATEGORI --}}
                @if (Route::has('seller.categories.index'))
                    <a href="{{ route('seller.categories.index') }}"
                        class="flex items-center gap-4
                               rounded-xl px-4 py-3
                               text-sm font-medium
                               transition
                               {{ request()->routeIs('seller.categories.*')
                                   ? 'bg-violet-50 text-violet-700'
                                   : 'text-slate-600 hover:bg-slate-50' }}">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M4 4h6v6H4z
                                   M14 4h6v6h-6z
                                   M4 14h6v6H4z
                                   M14 14h6v6h-6z" />
                        </svg>

                        Kategori

                    </a>
                @endif


                {{-- PESANAN --}}
                @if (Route::has('seller.orders.index'))
                    <a href="{{ route('seller.orders.index') }}"
                        class="flex items-center gap-4
                               rounded-xl px-4 py-3
                               text-sm font-medium
                               transition
                               {{ request()->routeIs('seller.orders.*') ? 'bg-violet-50 text-violet-700' : 'text-slate-600 hover:bg-slate-50' }}">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M6 3h12v18H6z" />
                            <path d="M9 8h6" />
                            <path d="M9 12h6" />
                            <path d="M9 16h4" />
                        </svg>

                        Pesanan

                    </a>
                @endif


                {{-- PENJUALAN --}}
                @if (Route::has('seller.sales.index'))
                    <a href="{{ route('seller.sales.index') }}"
                        class="flex items-center gap-4
                               rounded-xl px-4 py-3
                               text-sm font-medium
                               transition
                               {{ request()->routeIs('seller.sales.*') ? 'bg-violet-50 text-violet-700' : 'text-slate-600 hover:bg-slate-50' }}">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M4 19V9" />
                            <path d="M10 19V5" />
                            <path d="M16 19v-7" />
                            <path d="M22 19V3" />
                        </svg>

                        Penjualan

                    </a>
                @endif


                <div class="my-5 border-t border-slate-100"></div>


                <p
                    class="mb-3 px-4 text-[11px]
                           font-semibold uppercase
                           tracking-wider text-slate-400">
                    Akun
                </p>


                {{-- PENGATURAN --}}
                @if (Route::has('seller.settings.index'))
                    <a href="{{ route('seller.settings.index') }}"
                        class="flex items-center gap-4
                               rounded-xl px-4 py-3
                               text-sm font-medium
                               transition
                               {{ request()->routeIs('seller.settings.*')
                                   ? 'bg-violet-50 text-violet-700'
                                   : 'text-slate-600 hover:bg-slate-50' }}">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="12" cy="12" r="3" />

                            <path d="M19 12a7 7 0 0 0-.1-1
                                   l2-1.5-2-3.5-2.4 1
                                   a8 8 0 0 0-1.7-1
                                   L14.5 3h-5l-.3 3
                                   a8 8 0 0 0-1.7 1
                                   L5 6 3 9.5 5 11
                                   a7 7 0 0 0 0 2
                                   l-2 1.5L5 18l2.5-1
                                   a8 8 0 0 0 1.7 1
                                   l.3 3h5l.3-3
                                   a8 8 0 0 0 1.7-1
                                   l2.5 1 2-3.5-2-1.5
                                   a7 7 0 0 0 .1-1Z" />
                        </svg>

                        Pengaturan

                    </a>
                @endif

            </nav>


            {{-- SELLER PROFILE --}}
            <div class="border-t border-slate-100 p-4">

                <div
                    class="flex items-center gap-3
                           rounded-2xl bg-slate-50
                           p-3">

                    {{-- FOTO --}}
                    @if (auth()->user()?->sellerProfile?->photo)
                        <img src="{{ asset('storage/' . auth()->user()->sellerProfile->photo) }}"
                            alt="{{ auth()->user()->name }}"
                            class="size-10 shrink-0
                                   rounded-full object-cover">
                    @else
                        <div
                            class="flex size-10 shrink-0
                                   items-center justify-center
                                   rounded-full bg-violet-100
                                   text-sm font-bold
                                   text-violet-700">
                            {{ strtoupper(substr(auth()->user()?->name ?? 'S', 0, 1)) }}
                        </div>
                    @endif


                    <div class="min-w-0 flex-1">

                        <p class="truncate text-sm
                                   font-semibold text-slate-800">
                            {{ auth()->user()?->name }}
                        </p>

                        <p class="truncate text-xs
                                   text-slate-400">
                            {{ auth()->user()?->sellerProfile?->store_name ?? 'Seller' }}
                        </p>

                    </div>

                </div>

            </div>

        </aside>


        {{-- =========================
            MAIN
        ========================== --}}
        <div class="lg:pl-[260px]">

            {{-- TOPBAR --}}
            <header
                class="sticky top-0 z-30
                       flex h-20 items-center
                       border-b border-slate-200
                       bg-white/90 px-4
                       backdrop-blur
                       sm:px-6 lg:px-8">

                {{-- MOBILE LOGO --}}
                <div class="lg:hidden">

                    <span class="text-lg font-bold
                               text-violet-600">
                        KampusMart
                    </span>

                </div>


                <div class="ml-auto flex
                           items-center gap-3">




                     {{-- USER --}}
                     <div x-data="{ open: false }" class="relative hidden sm:block">

                        {{-- Trigger --}}
                        <button type="button" x-on:click="open = !open"
                            class="flex items-center gap-3 rounded-xl px-2 py-1.5 transition hover:bg-slate-100">

                            {{-- Nama --}}
                            <div class="text-right">

                                <p
                                    class="max-w-[160px] truncate
                       text-sm font-semibold
                       text-slate-800">
                                    {{ auth()->user()?->name }}
                                </p>

                                <p class="text-xs text-slate-400">
                                    Seller
                                </p>

                            </div>


                            {{-- Foto --}}
                            @if (auth()->user()?->sellerProfile?->photo)
                                <img src="{{ asset('storage/' . auth()->user()->sellerProfile->photo) }}"
                                    alt="{{ auth()->user()?->name }}" class="size-10 rounded-full object-cover">
                            @else
                                <div
                                    class="flex size-10 items-center
                       justify-center rounded-full
                       bg-violet-100 text-sm
                       font-bold text-violet-700">
                                    {{ strtoupper(substr(auth()->user()?->name ?? 'S', 0, 1)) }}
                                </div>
                            @endif


                            {{-- Arrow --}}
                            <svg class="size-4 text-slate-400
                   transition-transform"
                                x-bind:class="{ 'rotate-180': open }" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                            </svg>

                        </button>


                        {{-- Dropdown --}}
                        <div x-show="open" x-cloak x-on:click.outside="open = false" x-transition.origin.top.right
                            class="absolute right-0 z-50
               mt-2 w-56 overflow-hidden
               rounded-2xl
               border border-slate-200
               bg-white shadow-xl">

                            {{-- Info akun --}}
                            <div class="border-b border-slate-100
                   px-4 py-3">

                                <p class="truncate text-sm
                       font-semibold text-slate-800">
                                    {{ auth()->user()?->name }}
                                </p>

                                <p class="mt-0.5 truncate
                       text-xs text-slate-400">
                                    {{ auth()->user()?->email }}
                                </p>

                            </div>


                            <div class="p-2">

                                {{-- Profile --}}
                                <a href="{{ route('seller.settings.index') }}" x-on:click="open = false"
                                    class="flex items-center gap-3
                       rounded-xl px-3 py-2.5
                       text-sm font-medium
                       text-slate-700 transition
                       hover:bg-slate-100">

                                    <svg class="size-5 text-slate-400" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="8" r="4" />

                                        <path d="M4 21a8 8 0 0 1 16 0" />
                                    </svg>

                                    Profile

                                </a>


                                {{-- Logout --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit"
                                        class="flex w-full items-center
                           gap-3 rounded-xl
                           px-3 py-2.5
                           text-left text-sm
                           font-medium text-red-600
                           transition hover:bg-red-50">

                                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 17l5-5-5-5" />

                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3" />

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 19V5a2 2 0 0 0-2-2h-6" />
                                        </svg>

                                        Logout

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>



                </div>

            </header>


            {{-- CONTENT --}}
            <main class="p-4 sm:p-6 lg:p-8">

                @yield('content')

            </main>

        </div>

    </div>

    @stack('scripts')

</body>

</html>
