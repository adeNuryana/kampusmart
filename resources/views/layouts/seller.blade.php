<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Seller') - {{ $siteSetting?->site_name ?? 'KampusMart' }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

</head>


<body class="bg-[#F5F1EC]
           font-sans
           text-[#332B26]
           antialiased">


    <div x-data="{
        mobileSidebar: false
    }" class="min-h-screen">


        {{-- ===================================================== --}}
        {{-- MOBILE OVERLAY --}}
        {{-- ===================================================== --}}

        <div x-cloak x-show="mobileSidebar" x-transition.opacity @click="mobileSidebar = false"
            class="fixed inset-0
                   z-40
                   bg-[#332B26]/40
                   backdrop-blur-sm
                   lg:hidden">
        </div>



        {{-- ===================================================== --}}
        {{-- SIDEBAR --}}
        {{-- ===================================================== --}}

        <aside
            :class="mobileSidebar
                ?
                'translate-x-0' :
                '-translate-x-full lg:translate-x-0'"
            class="fixed inset-y-0 left-0
                   z-50
                   flex w-[260px]
                   flex-col
                   border-r
                   border-[#DFD2C7]
                   bg-[#FFFDF9]
                   transition-transform
                   duration-300
                   lg:z-30">


            {{-- ================================================= --}}
            {{-- BRAND --}}
            {{-- ================================================= --}}

            <div
                class="flex h-[72px]
                       shrink-0
                       items-center
                       border-b
                       border-[#E7DBD1]
                       px-5">

                <a href="{{ Route::has('seller.dashboard') ? route('seller.dashboard') : '#' }}"
                    class="flex
                           min-w-0
                           items-center
                           gap-3">


                    {{-- LOGO --}}
                    @if ($siteSetting?->logo)
                        <img src="{{ asset('storage/' . $siteSetting->logo) }}" alt="{{ $siteSetting->site_name }}"
                            class="size-10
               shrink-0
               rounded-xl
               object-contain">
                    @else
                        <div
                            class="flex size-10
               shrink-0
               items-center justify-center
               rounded-2xl
               bg-gradient-to-br
               from-[#C8795A]
               to-[#6F4E37]
               font-black
               text-white">

                            {{ strtoupper(substr($siteSetting?->site_name ?? 'KampusMart', 0, 1)) }}

                        </div>
                    @endif


                    <div class="min-w-0">

                        <p
                            class="truncate
                                   text-lg
                                   font-black
                                   tracking-tight
                                   text-[#332B26]">

                        <p>
                            {{ $siteSetting?->site_name ?? 'KampusMart' }}
                        </p>
                        </p>

                        <div
                            class="mt-0.5
                                   flex items-center
                                   gap-1.5">

                            <span
                                class="size-1.5
                                       rounded-full
                                       bg-[#C8795A]">
                            </span>

                            <p
                                class="text-[11px]
                                       font-bold
                                       uppercase
                                       tracking-[0.12em]
                                       text-[#A95E43]">

                                Seller Center

                            </p>

                        </div>

                    </div>

                </a>


                {{-- MOBILE CLOSE --}}
                <button type="button" @click="mobileSidebar = false"
                    class="ml-auto
                           flex size-9
                           items-center
                           justify-center
                           rounded-xl
                           text-[#8B7465]
                           transition
                           hover:bg-[#F3EAE3]
                           lg:hidden">

                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <path d="m6 6 12 12" />
                        <path d="m18 6-12 12" />

                    </svg>

                </button>

            </div>



            {{-- ================================================= --}}
            {{-- STORE MINI INFO --}}
            {{-- ================================================= --}}

            <div class="border-b
                       border-[#EEE5DE]
                       px-4 py-4">

                <div
                    class="rounded-2xl
                           border
                           border-[#E7DBD1]
                           bg-[#FAF7F2]
                           p-3">


                    <div class="flex items-center gap-3">


                        {{-- STORE ICON --}}
                        <div
                            class="flex size-9
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-[#FBEAE2]
                                   text-[#A95E43]">

                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <path d="M4 10v10h16V10" />
                                <path d="M3 10l2-6h14l2 6" />
                                <path d="M8 20v-6h8v6" />

                            </svg>

                        </div>


                        <div class="min-w-0">

                            <p
                                class="text-[10px]
                                       font-bold
                                       uppercase
                                       tracking-wider
                                       text-[#A28A7A]">

                                Toko Saya

                            </p>

                            <p
                                class="mt-0.5
                                       truncate
                                       text-sm
                                       font-bold
                                       text-[#4D4038]">

                                {{ auth()->user()?->sellerProfile?->store_name ?? 'Belum ada nama toko' }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- NAVIGATION --}}
            {{-- ================================================= --}}

            <nav class="flex-1
                       overflow-y-auto
                       px-3 py-5">


                <p
                    class="mb-2
                           px-3
                           text-[10px]
                           font-bold
                           uppercase
                           tracking-[0.14em]
                           text-[#AE9B8F]">

                    Operasional Toko

                </p>


                <div class="space-y-1">


                    {{-- ========================================= --}}
                    {{-- DASHBOARD --}}
                    {{-- ========================================= --}}

                    @if (Route::has('seller.dashboard'))
                        <a href="{{ route('seller.dashboard') }}" @click="mobileSidebar = false"
                            class="group
                                   flex items-center
                                   gap-3
                                   rounded-xl
                                   px-3.5 py-3
                                   text-sm
                                   font-semibold
                                   transition
                                   {{ request()->routeIs('seller.dashboard')
                                       ? 'bg-[#FBEAE2] text-[#A95E43]'
                                       : 'text-[#6F6259] hover:bg-[#F5ECE6] hover:text-[#493124]' }}">

                            <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <rect x="3" y="3" width="7" height="7" rx="1" />

                                <rect x="14" y="3" width="7" height="7" rx="1" />

                                <rect x="3" y="14" width="7" height="7" rx="1" />

                                <rect x="14" y="14" width="7" height="7" rx="1" />

                            </svg>

                            <span>
                                Dashboard
                            </span>

                        </a>
                    @endif



                    {{-- ========================================= --}}
                    {{-- PRODUCTS --}}
                    {{-- ========================================= --}}

                    @if (Route::has('seller.products.index'))
                        <a href="{{ route('seller.products.index') }}" @click="mobileSidebar = false"
                            class="group
                                   flex items-center
                                   gap-3
                                   rounded-xl
                                   px-3.5 py-3
                                   text-sm
                                   font-semibold
                                   transition
                                   {{ request()->routeIs('seller.products.*')
                                       ? 'bg-[#FBEAE2] text-[#A95E43]'
                                       : 'text-[#6F6259] hover:bg-[#F5ECE6] hover:text-[#493124]' }}">

                            <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <path d="M6 7h12l1 14H5L6 7Z" />
                                <path d="M9 7a3 3 0 0 1 6 0" />

                            </svg>

                            <span>
                                Produk Saya
                            </span>

                        </a>
                    @endif



                    {{-- ========================================= --}}
                    {{-- CATEGORY --}}
                    {{-- ========================================= --}}

                    @if (Route::has('seller.categories.index'))
                        <a href="{{ route('seller.categories.index') }}" @click="mobileSidebar = false"
                            class="group
                                   flex items-center
                                   gap-3
                                   rounded-xl
                                   px-3.5 py-3
                                   text-sm
                                   font-semibold
                                   transition
                                   {{ request()->routeIs('seller.categories.*')
                                       ? 'bg-[#FBEAE2] text-[#A95E43]'
                                       : 'text-[#6F6259] hover:bg-[#F5ECE6] hover:text-[#493124]' }}">

                            <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <rect x="4" y="4" width="6" height="6" rx="1" />

                                <rect x="14" y="4" width="6" height="6" rx="1" />

                                <rect x="4" y="14" width="6" height="6" rx="1" />

                                <rect x="14" y="14" width="6" height="6" rx="1" />

                            </svg>

                            <span>
                                Kategori
                            </span>

                        </a>
                    @endif



                    {{-- ========================================= --}}
                    {{-- ORDERS --}}
                    {{-- ========================================= --}}

                    @if (Route::has('seller.orders.index'))
                        <a href="{{ route('seller.orders.index') }}" @click="mobileSidebar = false"
                            class="group
                                   flex items-center
                                   gap-3
                                   rounded-xl
                                   px-3.5 py-3
                                   text-sm
                                   font-semibold
                                   transition
                                   {{ request()->routeIs('seller.orders.*')
                                       ? 'bg-[#FBEAE2] text-[#A95E43]'
                                       : 'text-[#6F6259] hover:bg-[#F5ECE6] hover:text-[#493124]' }}">

                            <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <path d="M6 3h12v18H6z" />
                                <path d="M9 8h6" />
                                <path d="M9 12h6" />
                                <path d="M9 16h4" />

                            </svg>

                            <span>
                                Pesanan
                            </span>

                        </a>
                    @endif



                    {{-- ========================================= --}}
                    {{-- SALES --}}
                    {{-- ========================================= --}}

                    @if (Route::has('seller.sales.index'))
                        <a href="{{ route('seller.sales.index') }}" @click="mobileSidebar = false"
                            class="group
                                   flex items-center
                                   gap-3
                                   rounded-xl
                                   px-3.5 py-3
                                   text-sm
                                   font-semibold
                                   transition
                                   {{ request()->routeIs('seller.sales.*')
                                       ? 'bg-[#FBEAE2] text-[#A95E43]'
                                       : 'text-[#6F6259] hover:bg-[#F5ECE6] hover:text-[#493124]' }}">

                            <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <path d="M4 19V9" />
                                <path d="M10 19V5" />
                                <path d="M16 19v-7" />
                                <path d="M22 19V3" />

                            </svg>

                            <span>
                                Penjualan
                            </span>

                        </a>
                    @endif

                </div>



                {{-- ================================================= --}}
                {{-- DIVIDER --}}
                {{-- ================================================= --}}

                <div class="my-5
                           border-t
                           border-[#EEE5DE]">
                </div>



                {{-- ================================================= --}}
                {{-- ACCOUNT --}}
                {{-- ================================================= --}}

                <p
                    class="mb-2
                           px-3
                           text-[10px]
                           font-bold
                           uppercase
                           tracking-[0.14em]
                           text-[#AE9B8F]">

                    Akun

                </p>


                <div class="space-y-1">


                    {{-- SETTINGS --}}
                    @if (Route::has('seller.settings.index'))
                        <a href="{{ route('seller.settings.index') }}" @click="mobileSidebar = false"
                            class="group
                                   flex items-center
                                   gap-3
                                   rounded-xl
                                   px-3.5 py-3
                                   text-sm
                                   font-semibold
                                   transition
                                   {{ request()->routeIs('seller.settings.*')
                                       ? 'bg-[#FBEAE2] text-[#A95E43]'
                                       : 'text-[#6F6259] hover:bg-[#F5ECE6] hover:text-[#493124]' }}">

                            <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <circle cx="12" cy="12" r="3" />

                                <path
                                    d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-2.8 2.8-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.6V21h-4v-.1a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1L4.2 17l.1-.1a1.7 1.7 0 0 0 .3-1.9A1.7 1.7 0 0 0 3 14H3v-4h.1a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9L4.2 7 7 4.2l.1.1a1.7 1.7 0 0 0 1.9.3 1.7 1.7 0 0 0 1-1.6V3h4v.1a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9-.3l.1-.1L19.8 7l-.1.1a1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0 1.6 1H21v4h-.1a1.7 1.7 0 0 0-1.5 1Z" />

                            </svg>

                            <span>
                                Pengaturan
                            </span>

                        </a>
                    @endif

                </div>

            </nav>






        </aside>



        {{-- ===================================================== --}}
        {{-- MAIN WRAPPER --}}
        {{-- ===================================================== --}}

        <div class="lg:pl-[260px]">


            {{-- ================================================= --}}
            {{-- TOPBAR --}}
            {{-- ================================================= --}}

            <header
                class="sticky top-0
                       z-30
                       flex h-[72px]
                       items-center
                       gap-3
                       border-b
                       border-[#DFD2C7]
                       bg-[#FFFDF9]/95
                       px-4
                       backdrop-blur-xl
                       sm:px-5
                       lg:px-7">


                {{-- ============================================= --}}
                {{-- MOBILE MENU --}}
                {{-- ============================================= --}}

                <button type="button" @click="mobileSidebar = true"
                    class="flex size-10
                           shrink-0
                           items-center
                           justify-center
                           rounded-xl
                           border
                           border-[#DFD2C7]
                           bg-white
                           text-[#6F6259]
                           transition
                           hover:bg-[#F3EAE3]
                           lg:hidden">

                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <path d="M4 7h16" />
                        <path d="M4 12h16" />
                        <path d="M4 17h16" />

                    </svg>

                </button>



                {{-- ============================================= --}}
                {{-- MOBILE BRAND --}}
                {{-- ============================================= --}}

                <div class="min-w-0 lg:hidden">

                    <p
                        class="truncate
                               text-sm
                               font-black
                               text-[#332B26]">

                        KampusMart

                    </p>

                    <p
                        class="text-[10px]
                               font-bold
                               uppercase
                               tracking-wider
                               text-[#C8795A]">

                        Seller Center

                    </p>

                </div>



                {{-- ============================================= --}}
                {{-- DESKTOP STORE STATUS --}}
                {{-- ============================================= --}}

                <div
                    class="hidden
                           items-center gap-2
                           rounded-full
                           border
                           border-[#E7DBD1]
                           bg-[#FAF7F2]
                           px-3 py-1.5
                           lg:inline-flex">

                    <span
                        class="size-2
                               rounded-full
                               bg-[#718268]">
                    </span>

                    <span
                        class="max-w-[240px]
                               truncate
                               text-xs
                               font-semibold
                               text-[#65795E]">

                        {{ auth()->user()?->sellerProfile?->store_name ?? 'Toko Seller' }}

                    </span>

                </div>



                {{-- ============================================= --}}
                {{-- RIGHT --}}
                {{-- ============================================= --}}

                <div
                    class="ml-auto
                           flex items-center
                           gap-2 sm:gap-3">


                    {{-- ========================================= --}}
                    {{-- USER DROPDOWN --}}
                    {{-- ========================================= --}}

                    <div x-data="{ open: false }" class="relative">


                        {{-- TRIGGER --}}
                        <button type="button" @click="open = !open"
                            class="flex
                                   items-center
                                   gap-2
                                   rounded-xl
                                   px-1.5 py-1
                                   transition
                                   hover:bg-[#F5ECE6]
                                   sm:gap-3
                                   sm:px-2">


                            {{-- TEXT --}}
                            <div
                                class="hidden
                                       text-right
                                       sm:block">

                                <p
                                    class="max-w-[160px]
                                           truncate
                                           text-sm
                                           font-bold
                                           text-[#332B26]">

                                    {{ auth()->user()?->name }}

                                </p>

                                <p
                                    class="mt-0.5
                                           text-[11px]
                                           font-medium
                                           text-[#A28A7A]">

                                    Seller

                                </p>

                            </div>



                            {{-- PHOTO --}}
                            @if (auth()->user()?->sellerProfile?->photo)
                                <img src="{{ asset('storage/' . auth()->user()->sellerProfile->photo) }}"
                                    alt="{{ auth()->user()?->name }}"
                                    class="size-10
                                           rounded-xl
                                           border
                                           border-[#E7DBD1]
                                           object-cover">
                            @else
                                <div
                                    class="flex size-10
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#C8795A]
                                           text-sm
                                           font-black
                                           text-white">

                                    {{ strtoupper(substr(auth()->user()?->name ?? 'S', 0, 1)) }}

                                </div>
                            @endif



                            {{-- ARROW --}}
                            <svg class="hidden size-4
                                       text-[#A28A7A]
                                       transition-transform
                                       sm:block"
                                :class="{
                                    'rotate-180': open
                                }"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                                <path d="m6 9 6 6 6-6" />

                            </svg>

                        </button>



                        {{-- ===================================== --}}
                        {{-- DROPDOWN --}}
                        {{-- ===================================== --}}

                        <div x-cloak x-show="open" @click.outside="open = false" x-transition.origin.top.right
                            class="absolute
                                   right-0
                                   z-50
                                   mt-2
                                   w-64
                                   overflow-hidden
                                   rounded-2xl
                                   border
                                   border-[#DFD2C7]
                                   bg-white
                                   shadow-xl">


                            {{-- ACCOUNT INFO --}}
                            <div
                                class="border-b
                                       border-[#EEE5DE]
                                       bg-[#FAF7F2]
                                       px-4 py-4">

                                <div
                                    class="flex
                                           items-center
                                           gap-3">


                                    @if (auth()->user()?->sellerProfile?->photo)
                                        <img src="{{ asset('storage/' . auth()->user()->sellerProfile->photo) }}"
                                            alt="{{ auth()->user()?->name }}"
                                            class="size-11
                                                   rounded-xl
                                                   object-cover">
                                    @else
                                        <div
                                            class="flex size-11
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-[#C8795A]
                                                   font-black
                                                   text-white">

                                            {{ strtoupper(substr(auth()->user()?->name ?? 'S', 0, 1)) }}

                                        </div>
                                    @endif


                                    <div class="min-w-0">

                                        <p
                                            class="truncate
                                                   text-sm
                                                   font-bold
                                                   text-[#332B26]">

                                            {{ auth()->user()?->name }}

                                        </p>

                                        <p
                                            class="mt-0.5
                                                   truncate
                                                   text-xs
                                                   text-[#A28A7A]">

                                            {{ auth()->user()?->email }}

                                        </p>

                                    </div>

                                </div>


                                <div
                                    class="mt-3
                                           inline-flex
                                           items-center
                                           gap-1.5
                                           rounded-full
                                           bg-[#FBEAE2]
                                           px-2.5 py-1
                                           text-[10px]
                                           font-bold
                                           text-[#A95E43]">

                                    <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">

                                        <path d="M4 10v10h16V10" />
                                        <path d="M3 10l2-6h14l2 6" />

                                    </svg>

                                    {{ auth()->user()?->sellerProfile?->store_name ?? 'Seller KampusMart' }}

                                </div>

                            </div>



                            {{-- MENU --}}
                            <div class="p-2">


                                @if (Route::has('seller.settings.index'))
                                    <a href="{{ route('seller.settings.index') }}" @click="open = false"
                                        class="flex
                                               items-center
                                               gap-3
                                               rounded-xl
                                               px-3 py-2.5
                                               text-sm
                                               font-semibold
                                               text-[#5F5148]
                                               transition
                                               hover:bg-[#F5ECE6]
                                               hover:text-[#493124]">

                                        <div
                                            class="flex size-8
                                                   items-center
                                                   justify-center
                                                   rounded-lg
                                                   bg-[#F4EAE2]
                                                   text-[#6F4E37]">

                                            <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1.8">

                                                <circle cx="12" cy="8" r="3" />
                                                <path d="M5 20c0-4 3-7 7-7s7 3 7 7" />

                                            </svg>

                                        </div>

                                        <span>
                                            Profil & Pengaturan
                                        </span>

                                    </a>
                                @endif



                                {{-- LOGOUT --}}
                                <form method="POST" action="{{ route('logout') }}">

                                    @csrf


                                    <button type="submit"
                                        class="mt-1
                                               flex w-full
                                               items-center
                                               gap-3
                                               rounded-xl
                                               px-3 py-2.5
                                               text-left
                                               text-sm
                                               font-semibold
                                               text-[#A65954]
                                               transition
                                               hover:bg-[#FAEDEC]">

                                        <div
                                            class="flex size-8
                                                   items-center
                                                   justify-center
                                                   rounded-lg
                                                   bg-[#FAEDEC]">

                                            <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1.8">

                                                <path d="M10 17l5-5-5-5" />
                                                <path d="M15 12H3" />
                                                <path d="M21 19V5a2 2 0 0 0-2-2h-6" />

                                            </svg>

                                        </div>

                                        Logout

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </header>



            {{-- ================================================= --}}
            {{-- PAGE CONTENT --}}
            {{-- ================================================= --}}

            <main
                class="min-h-[calc(100vh-72px)]
                       p-4
                       sm:p-5
                       lg:p-7">

                @yield('content')

            </main>

        </div>

    </div>


    @stack('scripts')

</body>

</html>
