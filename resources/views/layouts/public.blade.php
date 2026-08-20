<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'MarketKu')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        [x-cloak] {
            display: none !important;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>

</head>


<body
    class="min-h-screen
           bg-gradient-to-br
           from-[#FBF8F5]
           via-[#FAF5F1]
           to-[#F4EAE2]
           text-slate-800
           antialiased">


    {{-- ========================================================= --}}
    {{-- NAVBAR --}}
    {{-- ========================================================= --}}

    <header
        class="sticky
               top-0
               z-50
               border-b
               border-[#E7D9CF]
               bg-white/90
               shadow-sm
               shadow-[#6F4E37]/5
               backdrop-blur-xl">


        <div class="mx-auto
                   max-w-7xl
                   px-4
                   sm:px-5">


            <div
                class="flex
                       items-center
                       gap-3
                       py-3
                       md:gap-5
                       md:py-4">


                {{-- ================================================= --}}
                {{-- LOGO --}}
                {{-- ================================================= --}}

                <a href="{{ route('home') }}"
                    class="flex
                           shrink-0
                           items-center
                           gap-2">


                    <div
                        class="flex
                               size-10
                               items-center
                               justify-center
                               rounded-xl
                               bg-gradient-to-br
                               from-[#493124]
                               via-[#6F4E37]
                               to-[#9A6948]
                               text-lg
                               font-black
                               text-white
                               shadow-lg
                               shadow-[#6F4E37]/20
                               sm:size-11
                               sm:text-xl">

                        M

                    </div>


                    <span
                        class="hidden
                               bg-gradient-to-r
                               from-[#493124]
                               to-[#8B6245]
                               bg-clip-text
                               text-xl
                               font-black
                               tracking-tight
                               text-transparent
                               sm:block">

                        MarketKu

                    </span>

                </a>



                {{-- ================================================= --}}
                {{-- SEARCH DESKTOP --}}
                {{-- ================================================= --}}

                <form action="{{ route('home') }}" method="GET"
                    class="hidden
                           min-w-0
                           flex-1
                           overflow-hidden
                           rounded-2xl
                           border
                           border-[#E5D5C9]
                           bg-white
                           shadow-sm
                           transition
                           focus-within:border-[#A97957]
                           focus-within:ring-4
                           focus-within:ring-[#F5E9DF]
                           sm:flex">


                    <div
                        class="flex
                               w-11
                               shrink-0
                               items-center
                               justify-center
                               text-[#A38B7B]">

                        <i class="fa-solid
                                   fa-magnifying-glass">
                        </i>

                    </div>


                    <input type="search" name="search" value="{{ request('search') }}"
                        placeholder="Cari produk, kategori, atau toko..." autocomplete="off"
                        class="min-w-0
                               flex-1
                               border-0
                               bg-transparent
                               py-2.5
                               pr-4
                               text-sm
                               outline-none
                               placeholder:text-slate-400">


                    @if (request('search'))
                        <a href="{{ route('home') }}"
                            class="flex
                                   w-10
                                   shrink-0
                                   items-center
                                   justify-center
                                   text-slate-400
                                   transition
                                   hover:text-[#B97972]">

                            <i class="fa-solid fa-xmark"></i>

                        </a>
                    @endif


                    <button type="submit"
                        class="flex
                               w-12
                               shrink-0
                               items-center
                               justify-center
                               bg-gradient-to-r
                               from-[#5B3B2B]
                               via-[#6F4E37]
                               to-[#8B6245]
                               text-white
                               transition
                               hover:from-[#493124]
                               hover:to-[#6F4E37]
                               md:w-14">

                        <i class="fa-solid
                                   fa-arrow-right">
                        </i>

                    </button>

                </form>



                {{-- ================================================= --}}
                {{-- CART --}}
                {{-- ================================================= --}}

                @auth

                    @if (auth()->user()->role === 'buyer' && Route::has('buyer.cart.index'))
                        <a href="{{ route('buyer.cart.index') }}"
                            class="relative
               flex
               size-10
               shrink-0
               items-center
               justify-center
               rounded-xl
               border
               border-[#EEE2D9]
               bg-white
               text-[#6F4E37]
               shadow-sm
               transition
               duration-300
               hover:-translate-y-0.5
               hover:border-[#DCC4B2]
               hover:bg-[#FBF4EF]
               hover:shadow-md
               sm:size-11">

                            <i class="fa-solid
                   fa-cart-shopping
                   text-lg">
                            </i>


                            {{-- CART BADGE --}}

                            @if (($cartCount ?? 0) > 0)
                                <span
                                    class="absolute
                       -right-1.5
                       -top-1.5
                       flex
                       min-h-5
                       min-w-5
                       items-center
                       justify-center
                       rounded-full
                       bg-[#C8795A]
                       px-1
                       text-[9px]
                       font-black
                       leading-none
                       text-white
                       shadow-sm
                       ring-2
                       ring-white">

                                    {{ $cartCount > 99 ? '99+' : $cartCount }}

                                </span>
                            @endif

                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="relative
                               flex
                               size-10
                               shrink-0
                               items-center
                               justify-center
                               rounded-xl
                               border
                               border-[#EEE2D9]
                               bg-white
                               text-[#6F4E37]
                               shadow-sm
                               transition
                               duration-300
                               hover:-translate-y-0.5
                               hover:border-[#DCC4B2]
                               hover:bg-[#FBF4EF]
                               sm:size-11">

                        <i
                            class="fa-solid
                                   fa-cart-shopping
                                   text-lg">
                        </i>

                    </a>

                @endauth



                {{-- ================================================= --}}
                {{-- ACCOUNT --}}
                {{-- ================================================= --}}

                <div class="hidden
           items-center
           lg:flex">


                    @guest

                        {{-- LOGIN --}}

                        <a href="{{ route('login') }}"
                            class="rounded-xl
                   border
                   border-[#E5D5C9]
                   bg-white
                   px-4
                   py-2
                   text-sm
                   font-semibold
                   text-[#6F4E37]
                   shadow-sm
                   transition
                   duration-300
                   hover:border-[#DCC4B2]
                   hover:bg-[#FBF4EF]">

                            Masuk

                        </a>


                        {{-- REGISTER --}}

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-2
                       rounded-xl
                       bg-gradient-to-r
                       from-[#5B3B2B]
                       via-[#6F4E37]
                       to-[#8B6245]
                       px-4
                       py-2
                       text-sm
                       font-semibold
                       text-white
                       shadow-sm
                       shadow-[#6F4E37]/15
                       transition
                       duration-300
                       hover:-translate-y-0.5
                       hover:shadow-lg">

                                Daftar

                            </a>
                        @endif
                    @else
                        @if (auth()->user()->role === 'buyer')
                            {{-- ================================================= --}}
                            {{-- BUYER DROPDOWN --}}
                            {{-- ================================================= --}}

                            <div x-data="{
                                open: false
                            }" @click.outside="open = false" @keydown.escape.window="open = false"
                                class="relative">


                                {{-- DROPDOWN TRIGGER --}}

                                <button type="button" @click="open = !open"
                                    class="flex
                           items-center
                           gap-3
                           rounded-xl
                           px-2
                           py-1.5
                           text-left
                           transition
                           duration-300
                           hover:bg-[#FBF4EF]">


                                    {{-- USER INFO --}}

                                    <div
                                        class="hidden
                               text-right
                               xl:block">

                                        <p
                                            class="max-w-36
                                   truncate
                                   text-sm
                                   font-semibold
                                   text-slate-800">

                                            {{ auth()->user()->name }}

                                        </p>

                                        <p
                                            class="mt-0.5
                                   text-[10px]
                                   text-[#A38B7B]">

                                            Buyer

                                        </p>

                                    </div>


                                    {{-- AVATAR --}}

                                    <div
                                        class="flex
                               size-10
                               shrink-0
                               items-center
                               justify-center
                               rounded-full
                               bg-gradient-to-br
                               from-[#F4EAE2]
                               to-[#E4CDBD]
                               text-sm
                               font-black
                               uppercase
                               text-[#6F4E37]
                               ring-2
                               ring-white
                               shadow-sm">

                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                                    </div>


                                    {{-- CHEVRON --}}

                                    <div
                                        class="flex
                               size-6
                               items-center
                               justify-center
                               text-[#A38B7B]">

                                        <i class="fa-solid
                                   fa-chevron-down
                                   text-[10px]
                                   transition
                                   duration-300"
                                            :class="open
                                                ?
                                                'rotate-180' :
                                                ''">
                                        </i>

                                    </div>

                                </button>



                                {{-- ================================================= --}}
                                {{-- DROPDOWN MENU --}}
                                {{-- ================================================= --}}

                                <div x-cloak x-show="open"
                                    x-transition:enter="
                        transition
                        ease-out
                        duration-150
                    "
                                    x-transition:enter-start="
                        opacity-0
                        translate-y-1
                        scale-95
                    "
                                    x-transition:enter-end="
                        opacity-100
                        translate-y-0
                        scale-100
                    "
                                    x-transition:leave="
                        transition
                        ease-in
                        duration-100
                    "
                                    x-transition:leave-start="
                        opacity-100
                        translate-y-0
                        scale-100
                    "
                                    x-transition:leave-end="
                        opacity-0
                        translate-y-1
                        scale-95
                    "
                                    class="absolute
                           right-0
                           top-full
                           z-50
                           mt-3
                           w-64
                           origin-top-right
                           overflow-hidden
                           rounded-2xl
                           border
                           border-[#E6D8CD]
                           bg-white
                           shadow-2xl
                           shadow-[#6F4E37]/10">


                                    {{-- USER HEADER --}}

                                    <div
                                        class="border-b
                               border-[#EFE4DC]
                               bg-gradient-to-br
                               from-[#FBF8F5]
                               to-[#F4EAE2]
                               p-4">


                                        <div
                                            class="flex
                                   items-center
                                   gap-3">


                                            <div
                                                class="flex
                                       size-11
                                       shrink-0
                                       items-center
                                       justify-center
                                       rounded-full
                                       bg-gradient-to-br
                                       from-[#5B3B2B]
                                       via-[#6F4E37]
                                       to-[#8B6245]
                                       text-sm
                                       font-black
                                       uppercase
                                       text-white
                                       shadow-md">

                                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                                            </div>


                                            <div class="min-w-0">

                                                <p
                                                    class="truncate
                                           text-sm
                                           font-bold
                                           text-slate-800">

                                                    {{ auth()->user()->name }}

                                                </p>


                                                <p
                                                    class="mt-0.5
                                           truncate
                                           text-xs
                                           text-slate-500">

                                                    {{ auth()->user()->email }}

                                                </p>

                                            </div>

                                        </div>

                                    </div>



                                    {{-- MENU --}}

                                    <div class="p-2">


                                        {{-- PROFILE --}}

                                        <a href="{{ Route::has('buyer.profile.index') ? route('buyer.profile.index') : route('buyer.dashboard') }}"
                                            @click="open = false"
                                            class="group
                                   flex
                                   items-center
                                   gap-3
                                   rounded-xl
                                   px-3
                                   py-2.5
                                   transition
                                   hover:bg-[#FBF4EF]">


                                            <div
                                                class="flex
                                       size-9
                                       shrink-0
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-[#F4EAE2]
                                       text-[#6F4E37]
                                       transition
                                       group-hover:bg-[#6F4E37]
                                       group-hover:text-white">

                                                <i class="fa-regular
                                           fa-user">
                                                </i>

                                            </div>


                                            <div class="min-w-0">

                                                <p
                                                    class="text-sm
                                           font-semibold
                                           text-slate-700">

                                                    Profil Saya

                                                </p>

                                                <p
                                                    class="mt-0.5
                                           text-[10px]
                                           text-slate-400">

                                                    Kelola informasi akun

                                                </p>

                                            </div>

                                        </a>



                                        {{-- DIVIDER --}}

                                        <div
                                            class="my-2
                                   border-t
                                   border-[#EFE4DC]">
                                        </div>



                                        {{-- LOGOUT --}}

                                        <form action="{{ route('logout') }}" method="POST">

                                            @csrf


                                            <button type="submit"
                                                class="group
                                       flex
                                       w-full
                                       items-center
                                       gap-3
                                       rounded-xl
                                       px-3
                                       py-2.5
                                       text-left
                                       transition
                                       hover:bg-[#FAEDEC]">


                                                <div
                                                    class="flex
                                           size-9
                                           shrink-0
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#FAEDEC]
                                           text-[#A65954]
                                           transition
                                           group-hover:bg-[#A65954]
                                           group-hover:text-white">

                                                    <i
                                                        class="fa-solid
                                               fa-arrow-right-from-bracket">
                                                    </i>

                                                </div>


                                                <div>

                                                    <p
                                                        class="text-sm
                                               font-semibold
                                               text-[#A65954]">

                                                        Keluar

                                                    </p>


                                                    <p
                                                        class="mt-0.5
                                               text-[10px]
                                               text-slate-400">

                                                        Logout dari akun

                                                    </p>

                                                </div>

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>
                        @endif

                    @endguest

                </div>

            </div>



            {{-- ===================================================== --}}
            {{-- SEARCH MOBILE --}}
            {{-- ===================================================== --}}

            <form action="{{ route('home') }}" method="GET"
                class="mb-3
                       flex
                       overflow-hidden
                       rounded-2xl
                       border
                       border-[#E5D5C9]
                       bg-white
                       shadow-sm
                       transition
                       focus-within:border-[#A97957]
                       focus-within:ring-4
                       focus-within:ring-[#F5E9DF]
                       sm:hidden">


                <div
                    class="flex
                           w-10
                           shrink-0
                           items-center
                           justify-center
                           text-[#A38B7B]">

                    <i
                        class="fa-solid
                               fa-magnifying-glass
                               text-sm">
                    </i>

                </div>


                <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                    class="min-w-0
                           flex-1
                           bg-transparent
                           py-2.5
                           pr-3
                           text-sm
                           outline-none
                           placeholder:text-slate-400">


                <button type="submit"
                    class="flex
                           w-12
                           items-center
                           justify-center
                           bg-gradient-to-r
                           from-[#5B3B2B]
                           to-[#8B6245]
                           text-white">

                    <i class="fa-solid
                               fa-arrow-right">
                    </i>

                </button>

            </form>

        </div>

    </header>



    {{-- ========================================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================================= --}}

    @yield('content')



    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <footer
        class="mt-14
               hidden
               border-t
               border-[#E6D8CD]
               bg-gradient-to-br
               from-white
               via-[#FBF6F2]
               to-[#F4EAE2]
               md:block">


        <div
            class="mx-auto
                   grid
                   max-w-7xl
                   grid-cols-2
                   gap-10
                   px-5
                   py-12
                   lg:grid-cols-4">


            {{-- ================================================= --}}
            {{-- BRAND --}}
            {{-- ================================================= --}}

            <div>


                <div class="flex
                           items-center
                           gap-2">


                    <div
                        class="flex
                               size-10
                               items-center
                               justify-center
                               rounded-xl
                               bg-gradient-to-br
                               from-[#493124]
                               via-[#6F4E37]
                               to-[#8B6245]
                               font-black
                               text-white
                               shadow-md
                               shadow-[#6F4E37]/15">

                        M

                    </div>


                    <h3
                        class="text-xl
                               font-black
                               text-[#5B3B2B]">

                        MarketKu

                    </h3>

                </div>


                <p
                    class="mt-4
                           max-w-xs
                           text-sm
                           leading-6
                           text-slate-500">

                    Marketplace modern untuk memenuhi kebutuhan
                    customer secara aman, mudah, dan nyaman.

                </p>

            </div>



            {{-- ================================================= --}}
            {{-- ABOUT --}}
            {{-- ================================================= --}}

            <div>

                <h4 class="font-semibold
                           text-slate-800">

                    Tentang Kami

                </h4>


                <div
                    class="mt-4
                           flex
                           flex-col
                           gap-3
                           text-sm
                           text-slate-500">

                    <a href="#" class="transition
                               hover:text-[#6F4E37]">

                        Tentang MarketKu

                    </a>

                    <a href="#" class="transition
                               hover:text-[#6F4E37]">

                        Kebijakan Privasi

                    </a>

                    <a href="#" class="transition
                               hover:text-[#6F4E37]">

                        Syarat & Ketentuan

                    </a>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- HELP --}}
            {{-- ================================================= --}}

            <div>

                <h4 class="font-semibold
                           text-slate-800">

                    Bantuan

                </h4>


                <div
                    class="mt-4
                           flex
                           flex-col
                           gap-3
                           text-sm
                           text-slate-500">

                    <a href="#" class="transition
                               hover:text-[#8B6245]">

                        Pusat Bantuan

                    </a>

                    <a href="#" class="transition
                               hover:text-[#8B6245]">

                        Cara Belanja

                    </a>

                    <a href="#" class="transition
                               hover:text-[#8B6245]">

                        Pembayaran

                    </a>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- SECURITY --}}
            {{-- ================================================= --}}

            <div>

                <h4 class="font-semibold
                           text-slate-800">

                    Keamanan

                </h4>


                <div
                    class="mt-4
                           flex
                           gap-3
                           rounded-2xl
                           border
                           border-[#D3DFCE]
                           bg-gradient-to-br
                           from-[#F1F5ED]
                           to-[#E4ECE0]
                           p-4">


                    <div
                        class="flex
                               size-10
                               shrink-0
                               items-center
                               justify-center
                               rounded-xl
                               bg-gradient-to-br
                               from-[#7F9275]
                               to-[#647A5D]
                               text-white
                               shadow-sm">

                        <i class="fa-solid
                                   fa-shield-halved">
                        </i>

                    </div>


                    <div>

                        <p
                            class="text-sm
                                   font-semibold
                                   text-slate-800">

                            Transaksi Terlindungi

                        </p>


                        <p
                            class="mt-1
                                   text-xs
                                   leading-5
                                   text-slate-500">

                            Belanja aman bersama MarketKu

                        </p>

                    </div>

                </div>

            </div>

        </div>



        {{-- FOOTER BOTTOM --}}

        <div
            class="border-t
                   border-[#E6D8CD]
                   py-5
                   text-center
                   text-xs
                   text-slate-500">

            © {{ date('Y') }} MarketKu.
            All rights reserved.

        </div>

    </footer>



    {{-- ========================================================= --}}
    {{-- MOBILE NAVIGATION --}}
    {{-- ========================================================= --}}

    <nav
        class="fixed
               inset-x-0
               bottom-0
               z-50
               border-t
               border-[#E6D8CD]
               bg-white/95
               px-2
               shadow-[0_-6px_30px_rgba(111,78,55,0.08)]
               backdrop-blur-xl
               md:hidden">


        <div class="mx-auto
                   grid
                   max-w-md
                   grid-cols-4">


            {{-- ================================================= --}}
            {{-- HOME --}}
            {{-- ================================================= --}}

            <a href="{{ route('home') }}"
                class="flex
                       flex-col
                       items-center
                       justify-center
                       gap-1
                       py-3
                       text-[#6F4E37]
                       transition
                       active:scale-95">

                <i class="fa-solid
                           fa-house
                           text-lg">
                </i>

                <span class="text-[10px]
                           font-semibold">

                    Home

                </span>

            </a>



            {{-- ================================================= --}}
            {{-- CATEGORY --}}
            {{-- ================================================= --}}

            <a href="{{ route('home') }}#kategori"
                class="flex
                       flex-col
                       items-center
                       justify-center
                       gap-1
                       py-3
                       text-[#C8795A]
                       transition
                       active:scale-95">

                <i class="fa-solid
                           fa-border-all
                           text-lg">
                </i>

                <span class="text-[10px]
                           font-medium">

                    Kategori

                </span>

            </a>



            {{-- ================================================= --}}
            {{-- CART --}}
            {{-- ================================================= --}}

            @auth

                @if (auth()->user()->role === 'buyer' && Route::has('buyer.cart.index'))
                    <a href="{{ route('buyer.cart.index') }}"
                        class="flex
                               flex-col
                               items-center
                               justify-center
                               gap-1
                               py-3
                               text-[#7F9275]
                               transition
                               active:scale-95">

                        <i
                            class="fa-solid
                                   fa-cart-shopping
                                   text-lg">
                        </i>

                        <span class="text-[10px]">
                            Keranjang
                        </span>

                    </a>
                @endif
            @else
                <a href="{{ route('login') }}"
                    class="flex
                           flex-col
                           items-center
                           justify-center
                           gap-1
                           py-3
                           text-[#7F9275]
                           transition
                           active:scale-95">

                    <i
                        class="fa-solid
                               fa-cart-shopping
                               text-lg">
                    </i>

                    <span class="text-[10px]">
                        Keranjang
                    </span>

                </a>

            @endauth



            {{-- ================================================= --}}
            {{-- ACCOUNT --}}
            {{-- ================================================= --}}

            @auth

                @if (auth()->user()->role === 'buyer')
                    <a href="{{ route('buyer.dashboard') }}"
                        class="flex
                               flex-col
                               items-center
                               justify-center
                               gap-1
                               py-3
                               text-[#C89B55]
                               transition
                               active:scale-95">

                        <i
                            class="fa-regular
                                   fa-user
                                   text-lg">
                        </i>

                        <span class="text-[10px]">
                            Akun
                        </span>

                    </a>
                @endif
            @else
                <a href="{{ route('login') }}"
                    class="flex
                           flex-col
                           items-center
                           justify-center
                           gap-1
                           py-3
                           text-[#C89B55]
                           transition
                           active:scale-95">

                    <i class="fa-regular
                               fa-user
                               text-lg">
                    </i>

                    <span class="text-[10px]">
                        Masuk
                    </span>

                </a>

            @endauth

        </div>

    </nav>


    @stack('scripts')

</body>

</html>
