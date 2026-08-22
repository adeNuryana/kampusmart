<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MarketKu</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        [x-cloak] {
            display: none !important;
        }

        html {
            scroll-behavior: smooth;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>


<body
    class="min-h-screen
           bg-gradient-to-br
           from-[#FBF8F5]
           via-[#F9F3EE]
           to-[#F4EAE2]
           text-slate-800
           antialiased">


    {{-- ========================================================= --}}
    {{-- NAVBAR --}}
    {{-- ========================================================= --}}

    <header
        class="sticky top-0 z-50
               border-b border-[#E9DCD2]
               bg-white/90
               shadow-sm shadow-[#6F4E37]/5
               backdrop-blur-xl">

        <div class="mx-auto max-w-7xl px-4 sm:px-5">

            <div class="flex items-center
                       gap-3 py-3
                       md:gap-5 md:py-4">


                {{-- LOGO --}}

                <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2">

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

                    <span
                        class="hidden
                               bg-gradient-to-r
                               from-[#493124]
                               to-[#8B6245]
                               bg-clip-text
                               text-xl font-black
                               tracking-tight
                               text-transparent
                               sm:block">

                        <p>
                            {{ $siteSetting?->site_name ?? 'KampusMart' }}
                        </p>

                    </span>

                </a>



                {{-- SEARCH DESKTOP --}}

                <form action="{{ route('home') }}" method="GET"
                    class="hidden min-w-0 flex-1
                           overflow-hidden rounded-2xl
                           border border-[#E5D5C9]
                           bg-white
                           shadow-sm
                           transition
                           focus-within:border-[#A97957]
                           focus-within:ring-4
                           focus-within:ring-[#F5E9DF]
                           sm:flex">

                    <input type="hidden" name="category" value="{{ $selectedCategory ?? '' }}"
                        class="js-category-input">

                    <div
                        class="flex w-11 shrink-0
                               items-center justify-center
                               text-[#9A806F]">

                        <i class="fa-solid fa-magnifying-glass"></i>

                    </div>

                    <input type="search" name="search" value="{{ $search }}"
                        placeholder="Cari produk, kategori, atau toko..." autocomplete="off"
                        class="min-w-0 flex-1
                               bg-transparent
                               py-2.5 pr-4
                               text-sm
                               outline-none">

                    @if ($search !== '')
                        <a href="{{ route('home') }}"
                            class="flex w-10 items-center
                                   justify-center
                                   text-slate-400
                                   transition
                                   hover:text-[#B97972]">

                            <i class="fa-solid fa-xmark"></i>

                        </a>
                    @endif

                    <button type="submit"
                        class="flex w-12 shrink-0
                               items-center justify-center
                               bg-gradient-to-r
                               from-[#5B3B2B]
                               to-[#8B6245]
                               text-white
                               transition
                               hover:from-[#493124]
                               hover:to-[#6F4E37]
                               md:w-14">

                        <i class="fa-solid fa-arrow-right"></i>

                    </button>

                </form>



                {{-- CART --}}

                @auth

                    @if (auth()->user()->role === 'buyer' && Route::has('buyer.cart.index'))
                        <a href="{{ route('buyer.cart.index') }}"
                            class="relative flex size-10
                                   shrink-0 items-center justify-center
                                   rounded-xl
                                   border border-[#EEE2D9]
                                   bg-white
                                   text-[#6F4E37]
                                   shadow-sm
                                   transition
                                   hover:border-[#DCC4B2]
                                   hover:bg-[#FBF4EF]
                                   sm:size-11">

                            <i class="fa-solid fa-cart-shopping text-lg"></i>

                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="relative flex size-10
                               shrink-0 items-center justify-center
                               rounded-xl
                               border border-[#EEE2D9]
                               bg-white
                               text-[#6F4E37]
                               shadow-sm
                               transition
                               hover:bg-[#FBF4EF]
                               sm:size-11">

                        <i class="fa-solid fa-cart-shopping text-lg"></i>

                    </a>

                @endauth



                {{-- ACCOUNT --}}

                <div class="hidden items-center gap-2 lg:flex">

                    @guest

                        <a href="{{ route('login') }}"
                            class="rounded-xl
                                   border border-[#E5D5C9]
                                   bg-white
                                   px-4 py-2
                                   text-sm font-semibold
                                   text-[#6F4E37]
                                   transition
                                   hover:bg-[#FBF4EF]">

                            Masuk

                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="rounded-xl
                                       bg-gradient-to-r
                                       from-[#5B3B2B]
                                       to-[#8B6245]
                                       px-4 py-2
                                       text-sm font-semibold
                                       text-white
                                       shadow-sm
                                       transition
                                       hover:-translate-y-0.5
                                       hover:shadow-md">

                                Daftar

                            </a>
                        @endif
                    @else
                        @if (auth()->user()->role === 'buyer')
                            <a href="{{ route('buyer.dashboard') }}"
                                class="flex items-center gap-2
                                       rounded-xl
                                       px-3 py-2
                                       transition
                                       hover:bg-[#FBF4EF]">

                                <div
                                    class="flex size-9
                                           items-center justify-center
                                           rounded-full
                                           bg-[#F4EAE2]
                                           text-[#6F4E37]">

                                    <i class="fa-regular fa-user"></i>

                                </div>

                                <div>

                                    <p
                                        class="max-w-32 truncate
                                               text-sm font-semibold">

                                        {{ auth()->user()->name }}

                                    </p>

                                    <p class="text-[10px] text-slate-400">
                                        Buyer
                                    </p>

                                </div>

                            </a>
                        @endif

                    @endguest

                </div>

            </div>



            {{-- SEARCH MOBILE --}}

            <form action="{{ route('home') }}" method="GET"
                class="mb-3 flex
                       overflow-hidden rounded-2xl
                       border border-[#E5D5C9]
                       bg-white
                       shadow-sm
                       focus-within:border-[#A97957]
                       focus-within:ring-4
                       focus-within:ring-[#F5E9DF]
                       sm:hidden">

                <input type="hidden" name="category" value="{{ $selectedCategory ?? '' }}" class="js-category-input">

                <div
                    class="flex w-10 items-center
                           justify-center
                           text-[#9A806F]">

                    <i class="fa-solid fa-magnifying-glass text-sm"></i>

                </div>

                <input type="search" name="search" value="{{ $search }}" placeholder="Cari produk..."
                    class="min-w-0 flex-1
                           bg-transparent
                           py-2.5 pr-3
                           text-sm outline-none">

                <button type="submit"
                    class="flex w-12
                           items-center justify-center
                           bg-gradient-to-r
                           from-[#5B3B2B]
                           to-[#8B6245]
                           text-white">

                    <i class="fa-solid fa-arrow-right"></i>

                </button>

            </form>

        </div>

    </header>



    {{-- ========================================================= --}}
    {{-- MAIN --}}
    {{-- ========================================================= --}}

    <main
        class="mx-auto max-w-7xl
               px-4 py-4 pb-28
               sm:px-5 sm:py-5
               md:pb-8">


        {{-- ===================================================== --}}
        {{-- HERO --}}
        {{-- ===================================================== --}}

        <section class="grid gap-3
                   lg:grid-cols-[2fr_1fr]
                   lg:gap-4">


            {{-- HERO UTAMA --}}

            <div
                class="relative overflow-hidden
                       rounded-3xl
                       bg-gradient-to-br
                       from-[#38251C]
                       via-[#6F4E37]
                       to-[#A66D4B]
                       px-5 py-9
                       text-white
                       shadow-xl
                       shadow-[#493124]/15
                       sm:px-8 sm:py-11
                       md:px-10 md:py-14">


                {{-- DECORATION --}}

                <div
                    class="pointer-events-none
                           absolute -left-20 -top-24
                           size-64 rounded-full
                           bg-amber-300/20
                           blur-3xl">
                </div>

                <div
                    class="pointer-events-none
                           absolute -bottom-24 right-10
                           size-64 rounded-full
                           bg-rose-300/20
                           blur-3xl">
                </div>

                <div
                    class="pointer-events-none
                           absolute right-0 top-0
                           size-48 rounded-full
                           bg-orange-300/15
                           blur-3xl">
                </div>


                <div class="relative z-10 max-w-xl">

                    <span
                        class="inline-flex items-center gap-2
                               rounded-full
                               border border-white/15
                               bg-white/10
                               px-3 py-1.5
                               text-xs font-medium
                               backdrop-blur
                               sm:px-4 sm:py-2 sm:text-sm">

                        <span
                            class="flex size-6
                                   items-center justify-center
                                   rounded-full
                                   bg-[#E3B66D]
                                   text-[#493124]">

                            <i class="fa-solid fa-bolt text-[10px]"></i>

                        </span>

                        Marketplace untuk kebutuhanmu

                    </span>


                    <h1
                        class="mt-5
                               text-3xl font-black
                               leading-[1.12]
                               tracking-tight
                               sm:text-4xl
                               md:text-5xl">

                        Temukan Produk

                        <span
                            class="block
                                   bg-gradient-to-r
                                   from-amber-200
                                   via-white
                                   to-orange-200
                                   bg-clip-text
                                   text-transparent">

                            yang Kamu Butuhkan.

                        </span>

                    </h1>


                    <p
                        class="mt-4 max-w-lg
                               text-sm leading-6
                               text-[#F2E7DF]
                               sm:text-base sm:leading-7">

                        Jelajahi berbagai produk dari seller terpercaya
                        dalam satu marketplace yang praktis,
                        nyaman, dan mudah digunakan.

                    </p>


                    <div class="mt-7 flex flex-wrap gap-3">

                        <a href="#produk"
                            class="inline-flex items-center gap-2
                                   rounded-xl
                                   bg-[#FFFDFB]
                                   px-5 py-3
                                   text-sm font-bold
                                   text-[#5B3B2B]
                                   shadow-xl
                                   shadow-black/10
                                   transition
                                   hover:-translate-y-1
                                   hover:bg-[#F8EEE7]
                                   hover:shadow-2xl">

                            Belanja Sekarang

                            <i class="fa-solid fa-arrow-right"></i>

                        </a>


                        <a href="#kategori"
                            class="inline-flex items-center gap-2
                                   rounded-xl
                                   border border-white/20
                                   bg-white/10
                                   px-5 py-3
                                   text-sm font-semibold
                                   text-white
                                   backdrop-blur
                                   transition
                                   hover:bg-white/20">

                            Lihat Kategori

                            <i class="fa-solid fa-border-all"></i>

                        </a>

                    </div>

                </div>

            </div>



            {{-- SIDE CARDS --}}

            <div class="grid grid-cols-2 gap-3
                       lg:grid-cols-1 lg:gap-4">


                {{-- TERRACOTTA --}}

                <div
                    class="group relative overflow-hidden
                           rounded-3xl
                           border border-[#F0D2C0]
                           bg-gradient-to-br
                           from-[#FFF4EC]
                           via-[#FCE9DD]
                           to-[#F4D8C8]
                           p-4
                           shadow-sm
                           transition
                           hover:-translate-y-1
                           hover:shadow-lg
                           sm:p-6">

                    <div
                        class="absolute -right-10 -top-10
                               size-32 rounded-full
                               bg-[#C8795A]/10">
                    </div>

                    <div class="relative">

                        <div
                            class="flex size-10
                                   items-center justify-center
                                   rounded-xl
                                   bg-gradient-to-br
                                   from-[#C8795A]
                                   to-[#A95E43]
                                   text-white
                                   shadow-lg
                                   shadow-[#C8795A]/20
                                   sm:size-12">

                            <i class="fa-solid fa-truck-fast"></i>

                        </div>

                        <p
                            class="mt-4
                                   text-[10px] font-bold
                                   uppercase tracking-wider
                                   text-[#B46547]
                                   sm:text-xs">

                            Pengiriman

                        </p>

                        <h3
                            class="mt-1
                                   text-base font-bold
                                   leading-snug
                                   text-slate-900
                                   sm:text-xl">

                            Belanja Lebih
                            <br>
                            Praktis

                        </h3>

                        <p
                            class="mt-2 hidden
                                   text-xs leading-5
                                   text-slate-500
                                   sm:block">

                            Pilih produk dari berbagai seller.

                        </p>

                    </div>

                </div>



                {{-- SAGE --}}

                <div
                    class="group relative overflow-hidden
                           rounded-3xl
                           border border-[#D5E0D0]
                           bg-gradient-to-br
                           from-[#F1F5ED]
                           via-[#E8EFE3]
                           to-[#DDE8D7]
                           p-4
                           shadow-sm
                           transition
                           hover:-translate-y-1
                           hover:shadow-lg
                           sm:p-6">

                    <div
                        class="absolute -bottom-10 -right-10
                               size-32 rounded-full
                               bg-[#7F9275]/10">
                    </div>

                    <div class="relative">

                        <div
                            class="flex size-10
                                   items-center justify-center
                                   rounded-xl
                                   bg-gradient-to-br
                                   from-[#7F9275]
                                   to-[#647A5D]
                                   text-white
                                   shadow-lg
                                   shadow-[#7F9275]/20
                                   sm:size-12">

                            <i class="fa-solid fa-shield-halved"></i>

                        </div>

                        <p
                            class="mt-4
                                   text-[10px] font-bold
                                   uppercase tracking-wider
                                   text-[#647A5D]
                                   sm:text-xs">

                            Terpercaya

                        </p>

                        <h3
                            class="mt-1
                                   text-base font-bold
                                   leading-snug
                                   text-slate-900
                                   sm:text-xl">

                            Belanja Aman
                            <br>
                            dan Nyaman

                        </h3>

                        <p
                            class="mt-2 hidden
                                   text-xs leading-5
                                   text-slate-500
                                   sm:block">

                            Temukan produk dari seller terdaftar.

                        </p>

                    </div>

                </div>

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- BENEFIT --}}
        {{-- ===================================================== --}}

        @php

            $benefits = [
                [
                    'icon' => 'fa-truck-fast',
                    'title' => 'Pengiriman Mudah',
                    'description' => 'Belanja dari seller pilihan',
                    'card' => 'from-[#FFF4EC] to-[#FBE7D9] border-[#F1D4C2]',
                    'iconBox' => 'from-[#C8795A] to-[#AB6045]',
                ],

                [
                    'icon' => 'fa-shield-halved',
                    'title' => 'Transaksi Aman',
                    'description' => 'Proses pembelian terlindungi',
                    'card' => 'from-[#F1F5ED] to-[#E3ECDD] border-[#D6E1D0]',
                    'iconBox' => 'from-[#7F9275] to-[#65795E]',
                ],

                [
                    'icon' => 'fa-wallet',
                    'title' => 'Belanja Praktis',
                    'description' => 'Proses transaksi lebih mudah',
                    'card' => 'from-[#FAF3E4] to-[#F4E4C5] border-[#ECD7AF]',
                    'iconBox' => 'from-[#C89B55] to-[#AC7D38]',
                ],

                [
                    'icon' => 'fa-star',
                    'title' => 'Seller Pilihan',
                    'description' => 'Temukan seller terpercaya',
                    'card' => 'from-[#FAEEEC] to-[#F2DEDB] border-[#E8CAC6]',
                    'iconBox' => 'from-[#B97972] to-[#9B5F59]',
                ],
            ];

        @endphp


        <section class="mt-4 grid
                   grid-cols-2 gap-3
                   md:grid-cols-4">

            @foreach ($benefits as $benefit)
                <div
                    class="group rounded-2xl
                           border
                           bg-gradient-to-br
                           p-3
                           shadow-sm
                           transition duration-300
                           hover:-translate-y-1
                           hover:shadow-lg
                           sm:p-4
                           {{ $benefit['card'] }}">

                    <div
                        class="flex size-10
                               items-center justify-center
                               rounded-xl
                               bg-gradient-to-br
                               text-white
                               shadow-lg
                               transition duration-300
                               group-hover:scale-110
                               sm:size-12
                               {{ $benefit['iconBox'] }}">

                        <i class="fa-solid {{ $benefit['icon'] }}"></i>

                    </div>

                    <p
                        class="mt-3
                               text-xs font-bold
                               text-slate-800
                               sm:text-sm">

                        {{ $benefit['title'] }}

                    </p>

                    <p
                        class="mt-1 hidden
                               text-xs leading-5
                               text-slate-500
                               sm:block">

                        {{ $benefit['description'] }}

                    </p>

                </div>
            @endforeach

        </section>



        {{-- ========================================================= --}}
        {{-- INITIAL DATA --}}
        {{-- ========================================================= --}}

        @php

            $initialProducts = $isFiltering ? $products : $latestProducts;

            $activeCategory = $selectedCategory ? $categories->firstWhere('id', $selectedCategory) : null;

            if ($search !== '') {
                $initialTitle = 'Hasil Pencarian';
            } elseif ($activeCategory) {
                $initialTitle = 'Produk ' . $activeCategory->name;
            } else {
                $initialTitle = 'Produk Terbaru';
            }

            $initialTotal = $isFiltering ? $products->total() : $latestProducts->count();

            /*
            |--------------------------------------------------------------------------
            | CATEGORY COLOR PALETTE
            |--------------------------------------------------------------------------
            */

            $categoryThemes = [
                [
                    'box' => 'bg-[#F4EAE2] text-[#7A5138]',
                    'active' => 'border-[#BA8C6A] bg-[#F7EEE8]',
                    'pill' => 'bg-[#6F4E37] text-white',
                    'hover' => 'group-hover:bg-[#6F4E37] group-hover:text-white',
                ],

                [
                    'box' => 'bg-[#F5E7DD] text-[#B66F4D]',
                    'active' => 'border-[#D39578] bg-[#FAECE3]',
                    'pill' => 'bg-[#B66F4D] text-white',
                    'hover' => 'group-hover:bg-[#B66F4D] group-hover:text-white',
                ],

                [
                    'box' => 'bg-[#EEF3EA] text-[#708566]',
                    'active' => 'border-[#9BAC91] bg-[#F1F5EE]',
                    'pill' => 'bg-[#788B6F] text-white',
                    'hover' => 'group-hover:bg-[#788B6F] group-hover:text-white',
                ],

                [
                    'box' => 'bg-[#FAF2DF] text-[#B48944]',
                    'active' => 'border-[#D2AC69] bg-[#FBF5E8]',
                    'pill' => 'bg-[#C0934B] text-white',
                    'hover' => 'group-hover:bg-[#C0934B] group-hover:text-white',
                ],

                [
                    'box' => 'bg-[#F7EAEA] text-[#AC716D]',
                    'active' => 'border-[#C99591] bg-[#FAEFEF]',
                    'pill' => 'bg-[#B97972] text-white',
                    'hover' => 'group-hover:bg-[#B97972] group-hover:text-white',
                ],

                [
                    'box' => 'bg-[#EFE9E4] text-[#765E50]',
                    'active' => 'border-[#9C8373] bg-[#F4EFEB]',
                    'pill' => 'bg-[#80695A] text-white',
                    'hover' => 'group-hover:bg-[#80695A] group-hover:text-white',
                ],
            ];

            $categoryIcons = [
                'fa-bag-shopping',
                'fa-mobile-screen-button',
                'fa-laptop',
                'fa-shirt',
                'fa-house',
                'fa-utensils',
                'fa-headphones',
                'fa-gamepad',
            ];

        @endphp



        <div x-data="categoryFilter({

            selectedCategory: @js($selectedCategory ? (int) $selectedCategory : null),

            initialTitle: @js($initialTitle),

            initialTotal: {{ $initialTotal }},

            filterUrl: @js(route('products.filter'))

        })">


            {{-- ===================================================== --}}
            {{-- CATEGORY --}}
            {{-- ===================================================== --}}

            <section id="kategori"
                class="relative mt-5
                       overflow-hidden
                       rounded-3xl
                       border border-[#E8D9CD]
                       bg-gradient-to-br
                       from-white
                       via-[#FBF5F0]
                       to-[#F6EDE6]
                       p-4
                       shadow-sm
                       shadow-[#6F4E37]/5
                       sm:mt-6 sm:p-6">


                <div
                    class="pointer-events-none
                           absolute -right-20 -top-20
                           size-52 rounded-full
                           bg-[#C89B55]/10
                           blur-3xl">
                </div>


                <div class="relative z-10">


                    {{-- HEADER --}}

                    <div
                        class="mb-5 flex
                               items-end justify-between
                               gap-4">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex size-10
                                       shrink-0
                                       items-center justify-center
                                       rounded-xl
                                       bg-gradient-to-br
                                       from-[#6F4E37]
                                       to-[#A66D4B]
                                       text-white
                                       shadow-lg
                                       shadow-[#6F4E37]/20">

                                <i class="fa-solid fa-layer-group"></i>

                            </div>

                            <div>

                                <h2
                                    class="text-lg font-bold
                                           text-slate-900
                                           sm:text-xl">

                                    Kategori Pilihan

                                </h2>

                                <p
                                    class="mt-1 hidden
                                           text-sm text-slate-500
                                           sm:block">

                                    Temukan produk berdasarkan kebutuhanmu

                                </p>

                            </div>

                        </div>


                        @if (Route::has('buyer.products.index'))
                            <a href="{{ route('buyer.products.index') }}"
                                class="shrink-0
                                       text-xs font-semibold
                                       text-[#8B6245]
                                       transition
                                       hover:text-[#5B3B2B]
                                       sm:text-sm">

                                Lihat Semua

                                <i class="fa-solid fa-chevron-right ml-1"></i>

                            </a>
                        @endif

                    </div>



                    @if ($categories->isNotEmpty())


                        {{-- CATEGORY PILLS --}}

                        <div
                            class="hide-scrollbar
                                   mb-5 flex
                                   items-center gap-2
                                   overflow-x-auto
                                   pb-1">

                            <button type="button"
                                @click="
                                    loadCategory(
                                        null,
                                        'Produk Terbaru'
                                    )
                                "
                                class="shrink-0
                                       rounded-full
                                       px-4 py-2
                                       text-xs font-semibold
                                       transition duration-300"
                                :class="selectedCategory === null ?
                                    'bg-[#6F4E37] text-white shadow-md' :
                                    'border border-[#E7DAD0] bg-white text-slate-600 hover:bg-[#FBF6F2]'">

                                Semua

                            </button>



                            @foreach ($categories as $index => $category)
                                @php

                                    $theme = $categoryThemes[$index % count($categoryThemes)];

                                @endphp

                                <button type="button"
                                    @click="
                                        loadCategory(
                                            {{ $category->id }},
                                            @js('Produk ' . $category->name)
                                        )
                                    "
                                    class="shrink-0
                                           rounded-full
                                           border border-transparent
                                           px-4 py-2
                                           text-xs font-semibold
                                           transition duration-300"
                                    :class="selectedCategory ===
                                        {{ $category->id }}

                                        ?
                                        @js($theme['pill'] . ' shadow-md')

                                        :
                                        'bg-white text-slate-600 hover:border-[#E7DAD0] hover:bg-[#FBF6F2]'">

                                    {{ $category->name }}

                                </button>
                            @endforeach

                        </div>



                        {{-- CATEGORY CARDS --}}

                        <div
                            class="grid
                                   grid-cols-4 gap-2
                                   sm:grid-cols-4
                                   sm:gap-3
                                   lg:grid-cols-8">

                            @foreach ($categories as $index => $category)
                                @php

                                    $theme = $categoryThemes[$index % count($categoryThemes)];

                                    $icon = $categoryIcons[$index % count($categoryIcons)];

                                @endphp


                                <button type="button"
                                    @click="
                                        loadCategory(
                                            {{ $category->id }},
                                            @js('Produk ' . $category->name)
                                        )
                                    "
                                    class="group
                                           flex min-w-0
                                           flex-col items-center
                                           rounded-2xl
                                           border
                                           p-2.5 text-center
                                           transition duration-300
                                           hover:-translate-y-1
                                           hover:shadow-lg
                                           sm:p-4"
                                    :class="selectedCategory ===
                                        {{ $category->id }}

                                        ?
                                        @js($theme['active'] . ' shadow-md')

                                        :
                                        'border-white bg-white/80 hover:border-[#EEE2D9]'">


                                    <div
                                        class="flex size-11
                                               items-center justify-center
                                               rounded-xl
                                               transition duration-300
                                               group-hover:scale-105
                                               sm:size-14
                                               sm:rounded-2xl

                                               {{ $theme['box'] }}
                                               {{ $theme['hover'] }}">

                                        <i
                                            class="fa-solid
                                                   {{ $icon }}
                                                   text-lg
                                                   sm:text-2xl">
                                        </i>

                                    </div>


                                    <span
                                        class="mt-2
                                               w-full truncate
                                               text-[11px]
                                               font-semibold
                                               text-slate-700
                                               sm:mt-3
                                               sm:text-sm">

                                        {{ $category->name }}

                                    </span>


                                    <span
                                        class="mt-1
                                               text-[9px]
                                               text-slate-400
                                               sm:text-[10px]">

                                        {{ $category->products_count }}
                                        produk

                                    </span>

                                </button>
                            @endforeach

                        </div>
                    @else
                        <div
                            class="rounded-2xl
                                   border border-dashed
                                   border-[#DDD0C7]
                                   bg-white/60
                                   py-10
                                   text-center">

                            <i
                                class="fa-solid fa-box-open
                                       text-3xl
                                       text-[#B69A86]">
                            </i>

                            <p class="mt-3 text-sm font-semibold">
                                Belum ada kategori
                            </p>

                        </div>

                    @endif

                </div>

            </section>



            {{-- ===================================================== --}}
            {{-- DYNAMIC PRODUCTS --}}
            {{-- ===================================================== --}}

            <section id="produk" x-ref="productSection"
                class="relative mt-5
                       overflow-hidden
                       rounded-3xl
                       border border-[#E6D9CE]
                       bg-gradient-to-br
                       from-white
                       via-[#FCF8F5]
                       to-[#F6EFE9]
                       p-4
                       shadow-sm
                       shadow-[#6F4E37]/5
                       sm:mt-6 sm:p-6">


                <div
                    class="pointer-events-none
                           absolute -left-20 -top-24
                           size-52 rounded-full
                           bg-[#C8795A]/10
                           blur-3xl">
                </div>


                <div class="relative z-10">


                    {{-- HEADER --}}

                    <div
                        class="mb-5 flex
                               items-end
                               justify-between
                               gap-4">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex size-10
                                       shrink-0
                                       items-center justify-center
                                       rounded-xl
                                       bg-gradient-to-br
                                       from-[#C89B55]
                                       via-[#C8795A]
                                       to-[#9A6244]
                                       text-white
                                       shadow-lg
                                       shadow-[#C8795A]/20">

                                <i class="fa-solid fa-bolt"></i>

                            </div>

                            <div>

                                <h2 class="text-xl font-bold
                                           text-slate-900
                                           sm:text-2xl"
                                    x-text="title">

                                    {{ $initialTitle }}

                                </h2>


                                <p
                                    class="mt-1
                                           text-xs text-slate-500
                                           sm:text-sm">

                                    <template x-if="!loading">

                                        <span>

                                            Ditemukan

                                            <strong class="text-[#6F4E37]" x-text="total">

                                                {{ $initialTotal }}

                                            </strong>

                                            produk

                                        </span>

                                    </template>


                                    <template x-if="loading">

                                        <span>
                                            Memuat produk...
                                        </span>

                                    </template>

                                </p>

                            </div>

                        </div>


                        @if (Route::has('buyer.products.index'))
                            <a href="{{ route('buyer.products.index') }}"
                                class="hidden
                                       shrink-0
                                       items-center
                                       text-sm font-semibold
                                       text-[#8B6245]
                                       transition
                                       hover:text-[#5B3B2B]
                                       sm:inline-flex">

                                Lihat Semua

                                <i class="fa-solid fa-chevron-right ml-1"></i>

                            </a>
                        @endif

                    </div>



                    {{-- LOADING --}}

                    <div x-show="loading" x-cloak
                        class="grid
                               grid-cols-2 gap-3
                               sm:grid-cols-3 sm:gap-4
                               lg:grid-cols-5">

                        @for ($i = 0; $i < 5; $i++)
                            <div
                                class="overflow-hidden
                                       rounded-2xl
                                       border border-white
                                       bg-white">

                                <div
                                    class="aspect-square
                                           animate-pulse
                                           bg-[#EDE4DD]">
                                </div>

                                <div class="p-4">

                                    <div
                                        class="h-3
                                               animate-pulse
                                               rounded-full
                                               bg-[#EDE4DD]">
                                    </div>

                                    <div
                                        class="mt-2 h-3
                                               w-3/4
                                               animate-pulse
                                               rounded-full
                                               bg-[#EDE4DD]">
                                    </div>

                                    <div
                                        class="mt-5 h-4
                                               w-1/2
                                               animate-pulse
                                               rounded-full
                                               bg-[#EDE4DD]">
                                    </div>

                                </div>

                            </div>
                        @endfor

                    </div>



                    {{-- PRODUCT GRID --}}

                    <div x-ref="productGrid" x-show="!loading">


                        @if ($initialProducts->isNotEmpty())

                            @php

                                $productColors = [
                                    [
                                        'bar' => 'from-[#6F4E37] via-[#9A6948] to-[#C89B55]',
                                        'badge' => 'bg-[#F4EAE2] text-[#6F4E37]',
                                    ],

                                    [
                                        'bar' => 'from-[#C8795A] via-[#B56F52] to-[#A05E45]',
                                        'badge' => 'bg-[#FBEAE2] text-[#A95E43]',
                                    ],

                                    [
                                        'bar' => 'from-[#7F9275] via-[#8EA082] to-[#A7B39D]',
                                        'badge' => 'bg-[#EFF4EC] text-[#65795E]',
                                    ],

                                    [
                                        'bar' => 'from-[#C89B55] via-[#D1A963] to-[#B88944]',
                                        'badge' => 'bg-[#FAF2DF] text-[#A87A37]',
                                    ],

                                    [
                                        'bar' => 'from-[#B97972] via-[#C98C84] to-[#A86964]',
                                        'badge' => 'bg-[#F8EDEC] text-[#9C625D]',
                                    ],
                                ];

                            @endphp


                            <div
                                class="grid
                                       grid-cols-2 gap-3
                                       sm:grid-cols-3 sm:gap-4
                                       lg:grid-cols-5">


                                @foreach ($initialProducts as $index => $product)
                                    @php

                                        $productImage =
                                            $product->image ?? ($product->photo ?? ($product->thumbnail ?? null));

                                        if ($productImage) {
                                            $imageUrl = \Illuminate\Support\Str::startsWith($productImage, [
                                                'http://',
                                                'https://',
                                            ])
                                                ? $productImage
                                                : asset('storage/' . $productImage);
                                        } else {
                                            $imageUrl = null;
                                        }

                                        $productTheme = $productColors[$index % count($productColors)];

                                    @endphp


                                    <a href="{{ route('buyer.products.show', $product) }}"
                                        class="group
                                               overflow-hidden
                                               rounded-2xl
                                               border border-white/80
                                               bg-white/90
                                               shadow-sm
                                               transition duration-300
                                               hover:-translate-y-1.5
                                               hover:border-[#E5D5C9]
                                               hover:shadow-xl
                                               hover:shadow-[#6F4E37]/10">


                                        <div
                                            class="h-1
                                                   bg-gradient-to-r
                                                   {{ $productTheme['bar'] }}">
                                        </div>


                                        {{-- IMAGE --}}

                                        <div
                                            class="relative
                                                   aspect-square
                                                   overflow-hidden
                                                   bg-[#F4EFEB]">


                                            @if ($imageUrl)
                                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}"
                                                    loading="lazy"
                                                    class="size-full
                                                           object-cover
                                                           transition duration-500
                                                           group-hover:scale-105">
                                            @else
                                                <div
                                                    class="flex size-full
                                                           items-center justify-center
                                                           bg-gradient-to-br
                                                           from-[#F5EFEB]
                                                           to-[#EEE4DC]">

                                                    <i
                                                        class="fa-regular
                                                               fa-image
                                                               text-4xl
                                                               text-[#C9B7AA]">
                                                    </i>

                                                </div>
                                            @endif


                                            @if ($product->category)
                                                <span
                                                    class="absolute
                                                           bottom-2 left-2
                                                           max-w-[85%]
                                                           truncate
                                                           rounded-lg
                                                           px-2 py-1
                                                           text-[9px]
                                                           font-semibold
                                                           shadow-sm
                                                           {{ $productTheme['badge'] }}">

                                                    {{ $product->category->name }}

                                                </span>
                                            @endif

                                        </div>



                                        {{-- CONTENT --}}

                                        <div class="p-3 sm:p-4">

                                            <h3
                                                class="line-clamp-2
                                                       min-h-10
                                                       text-xs
                                                       font-semibold
                                                       leading-5
                                                       text-slate-700
                                                       transition
                                                       group-hover:text-[#6F4E37]
                                                       sm:text-sm">

                                                {{ $product->name }}

                                            </h3>


                                            <p
                                                class="mt-2
                                                       bg-gradient-to-r
                                                       from-[#5B3B2B]
                                                       to-[#A66D4B]
                                                       bg-clip-text
                                                       text-sm
                                                       font-black
                                                       text-transparent
                                                       sm:mt-3
                                                       sm:text-lg">

                                                Rp{{ number_format($product->price ?? 0, 0, ',', '.') }}

                                            </p>


                                            <div
                                                class="mt-3
                                                       flex items-center
                                                       justify-between
                                                       gap-2">

                                                <span
                                                    class="rounded-md
                                                           bg-[#FAF6F3]
                                                           px-2 py-1
                                                           text-[9px]
                                                           font-medium
                                                           text-slate-500
                                                           sm:text-[10px]">

                                                    Stok
                                                    {{ $product->stock ?? 0 }}

                                                </span>


                                                @if ($product->user)
                                                    <span
                                                        class="max-w-24 truncate
                                                               text-[9px]
                                                               text-slate-400
                                                               sm:text-[10px]">

                                                        <i
                                                            class="fa-solid
                                                                   fa-store
                                                                   mr-1
                                                                   text-[#A97957]">
                                                        </i>

                                                        {{ $product->user->name }}

                                                    </span>
                                                @endif

                                            </div>

                                        </div>

                                    </a>
                                @endforeach

                            </div>
                        @else
                            <div
                                class="rounded-3xl
                                       border border-dashed
                                       border-[#DDD0C7]
                                       bg-white/80
                                       px-5 py-14
                                       text-center">

                                <div
                                    class="mx-auto flex
                                           size-16
                                           items-center justify-center
                                           rounded-2xl
                                           bg-[#F4EAE2]
                                           text-[#8B6245]">

                                    <i class="fa-solid fa-box-open text-2xl"></i>

                                </div>

                                <h3
                                    class="mt-4
                                           font-bold
                                           text-slate-700">

                                    Produk tidak ditemukan

                                </h3>

                                <p
                                    class="mt-1
                                           text-sm
                                           text-slate-500">

                                    Coba pilih kategori atau kata pencarian lain.

                                </p>

                            </div>

                        @endif

                    </div>

                </div>

            </section>



            {{-- ===================================================== --}}
            {{-- RECOMMENDATION --}}
            {{-- ===================================================== --}}

            <div x-show="
                    selectedCategory === null
                    && !loading
                "
                x-cloak>

                <section
                    class="relative mt-6
                           overflow-hidden
                           rounded-3xl
                           border border-[#E8D6D1]
                           bg-gradient-to-br
                           from-white
                           via-[#FBF3F1]
                           to-[#F6ECE8]
                           p-4
                           shadow-sm
                           shadow-[#B97972]/5
                           sm:p-6">


                    <div
                        class="pointer-events-none
                               absolute -bottom-20 -left-20
                               size-52 rounded-full
                               bg-[#B97972]/10
                               blur-3xl">
                    </div>


                    <div class="relative z-10">


                        <div
                            class="mb-5
                                   flex items-end
                                   justify-between
                                   gap-4">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex size-10
                                           shrink-0
                                           items-center justify-center
                                           rounded-xl
                                           bg-gradient-to-br
                                           from-[#8B6245]
                                           via-[#A66D4B]
                                           to-[#B97972]
                                           text-white
                                           shadow-lg
                                           shadow-[#6F4E37]/20">

                                    <i class="fa-solid fa-wand-magic-sparkles"></i>

                                </div>

                                <div>

                                    <h2
                                        class="text-xl font-bold
                                               text-slate-900
                                               sm:text-2xl">

                                        Rekomendasi Untuk Kamu

                                    </h2>

                                    <p
                                        class="mt-1 hidden
                                               text-sm text-slate-500
                                               sm:block">

                                        Pilihan produk menarik dari berbagai seller

                                    </p>

                                </div>

                            </div>


                            @if (Route::has('buyer.products.index'))
                                <a href="{{ route('buyer.products.index') }}"
                                    class="shrink-0
                                           text-xs font-semibold
                                           text-[#9A6244]
                                           transition
                                           hover:text-[#6F4E37]
                                           sm:text-sm">

                                    Lihat Semua

                                    <i class="fa-solid fa-chevron-right ml-1"></i>

                                </a>
                            @endif

                        </div>



                        @if ($recommendedProducts->isNotEmpty())

                            <div
                                class="grid
                                       grid-cols-2 gap-3
                                       sm:grid-cols-3 sm:gap-4
                                       lg:grid-cols-5">

                                @foreach ($recommendedProducts as $index => $product)
                                    @php

                                        $productImage =
                                            $product->image ?? ($product->photo ?? ($product->thumbnail ?? null));

                                        if ($productImage) {
                                            $imageUrl = \Illuminate\Support\Str::startsWith($productImage, [
                                                'http://',
                                                'https://',
                                            ])
                                                ? $productImage
                                                : asset('storage/' . $productImage);
                                        } else {
                                            $imageUrl = null;
                                        }

                                        $recommendThemes = [
                                            [
                                                'bar' => 'from-[#6F4E37] to-[#A66D4B]',
                                                'badge' => 'bg-[#F4EAE2] text-[#6F4E37]',
                                                'heart' => 'text-[#8B6245]',
                                            ],

                                            [
                                                'bar' => 'from-[#C8795A] to-[#A95E43]',
                                                'badge' => 'bg-[#FBEAE2] text-[#A95E43]',
                                                'heart' => 'text-[#C8795A]',
                                            ],

                                            [
                                                'bar' => 'from-[#7F9275] to-[#647A5D]',
                                                'badge' => 'bg-[#EFF4EC] text-[#647A5D]',
                                                'heart' => 'text-[#7F9275]',
                                            ],

                                            [
                                                'bar' => 'from-[#C89B55] to-[#AC7D38]',
                                                'badge' => 'bg-[#FAF2DF] text-[#A87A37]',
                                                'heart' => 'text-[#C89B55]',
                                            ],

                                            [
                                                'bar' => 'from-[#B97972] to-[#9B5F59]',
                                                'badge' => 'bg-[#F8EDEC] text-[#9C625D]',
                                                'heart' => 'text-[#B97972]',
                                            ],
                                        ];

                                        $recommendTheme = $recommendThemes[$index % count($recommendThemes)];

                                        $sellerLocation =
                                            $product->user?->sellerProfile?->city ??
                                            ($product->user?->sellerProfile?->address ?? null);
                                    @endphp


                                    <a href="{{ route('buyer.products.show', $product) }}"
                                        class="group
                                               overflow-hidden
                                               rounded-2xl
                                               border border-white
                                               bg-white/90
                                               shadow-sm
                                               transition duration-300
                                               hover:-translate-y-1.5
                                               hover:border-[#E8D6D1]
                                               hover:shadow-xl
                                               hover:shadow-[#B97972]/10">


                                        <div
                                            class="h-1
                                                   bg-gradient-to-r
                                                   {{ $recommendTheme['bar'] }}">
                                        </div>


                                        <div
                                            class="relative
                                                   aspect-square
                                                   overflow-hidden
                                                   bg-[#F4EFEB]">

                                            @if ($imageUrl)
                                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}"
                                                    loading="lazy"
                                                    class="size-full
                                                           object-cover
                                                           transition duration-500
                                                           group-hover:scale-105">
                                            @else
                                                <div
                                                    class="flex size-full
                                                           items-center justify-center
                                                           bg-gradient-to-br
                                                           from-[#F4EFEB]
                                                           to-[#EEE4DC]">

                                                    <i
                                                        class="fa-regular
                                                               fa-image
                                                               text-4xl
                                                               text-[#C9B7AA]">
                                                    </i>

                                                </div>
                                            @endif


                                            @if ($product->category)
                                                <span
                                                    class="absolute
                                                           bottom-2 left-2
                                                           max-w-[85%]
                                                           truncate
                                                           rounded-lg
                                                           px-2 py-1
                                                           text-[9px]
                                                           font-semibold
                                                           shadow-sm
                                                           {{ $recommendTheme['badge'] }}">

                                                    {{ $product->category->name }}

                                                </span>
                                            @endif

                                        </div>



                                        <div class="p-3 sm:p-4">

                                            <h3
                                                class="line-clamp-2
                                                       min-h-10
                                                       text-xs
                                                       font-semibold
                                                       leading-5
                                                       text-slate-700
                                                       transition
                                                       group-hover:text-[#6F4E37]
                                                       sm:text-sm">

                                                {{ $product->name }}

                                            </h3>


                                            <p
                                                class="mt-2
                                                       bg-gradient-to-r
                                                       from-[#5B3B2B]
                                                       to-[#A66D4B]
                                                       bg-clip-text
                                                       text-sm
                                                       font-black
                                                       text-transparent
                                                       sm:mt-3
                                                       sm:text-lg">

                                                Rp{{ number_format($product->price ?? 0, 0, ',', '.') }}

                                            </p>


                                            <div
                                                class="mt-2
                                                       flex items-center
                                                       justify-between
                                                       gap-2">

                                                <span
                                                    class="text-[10px]
                                                           text-slate-500
                                                           sm:text-xs">

                                                    Stok
                                                    {{ $product->stock ?? 0 }}

                                                </span>

                                                <i
                                                    class="fa-solid fa-heart
                                                           text-xs
                                                           {{ $recommendTheme['heart'] }}">
                                                </i>

                                            </div>


                                            <div
                                                class="mt-3
                                                       border-t
                                                       border-[#F0E7E0]
                                                       pt-3">

                                                <p
                                                    class="truncate
                                                           text-[10px]
                                                           font-medium
                                                           text-slate-600
                                                           sm:text-xs">

                                                    <i
                                                        class="fa-solid fa-store
                                                               mr-1
                                                               text-[#A97957]">
                                                    </i>

                                                    {{ $product->user?->name ?? 'Seller' }}

                                                </p>


                                                @if ($sellerLocation)
                                                    <p
                                                        class="mt-1 truncate
                                                               text-[9px]
                                                               text-slate-400
                                                               sm:text-[10px]">

                                                        <i
                                                            class="fa-solid
                                                                   fa-location-dot
                                                                   mr-1
                                                                   text-[#C8795A]">
                                                        </i>

                                                        {{ $sellerLocation }}

                                                    </p>
                                                @endif

                                            </div>

                                        </div>

                                    </a>
                                @endforeach

                            </div>
                        @else
                            <div
                                class="rounded-2xl
                                       border border-dashed
                                       border-[#DDD0C7]
                                       bg-white/60
                                       py-12
                                       text-center">

                                <i
                                    class="fa-solid fa-box-open
                                           text-4xl
                                           text-[#C9B7AA]">
                                </i>

                                <p class="mt-3
                                           text-sm font-semibold">

                                    Belum ada produk rekomendasi

                                </p>

                            </div>

                        @endif

                    </div>

                </section>

            </div>

        </div>

    </main>



    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <footer
        class="mt-12 hidden
               border-t border-[#E6D8CD]
               bg-gradient-to-br
               from-white
               via-[#FBF6F2]
               to-[#F4EAE2]
               md:block">

        <div
            class="mx-auto grid
                   max-w-7xl
                   grid-cols-2 gap-10
                   px-5 py-12
                   lg:grid-cols-4">


            {{-- BRAND --}}

            <div>

                <div class="flex items-center gap-2">

                    <div
                        class="flex size-10
                               items-center justify-center
                               rounded-xl
                               bg-gradient-to-br
                               from-[#493124]
                               to-[#8B6245]
                               font-black text-white">

                        M

                    </div>

                    <h3 class="text-xl font-black
                               text-[#5B3B2B]">

                        <p>
                            {{ $siteSetting?->site_name ?? 'KampusMart' }}
                        </p>

                    </h3>

                </div>

                <p
                    class="mt-4 max-w-xs
                           text-sm leading-6
                           text-slate-500">

                    Marketplace modern untuk mempertemukan customer
                    dengan seller secara mudah, nyaman, dan terstruktur.

                </p>

            </div>



            {{-- ABOUT --}}

            <div>

                <h4 class="font-semibold text-slate-800">
                    Tentang Kami
                </h4>

                <div
                    class="mt-4 flex
                           flex-col gap-3
                           text-sm text-slate-500">

                    <a href="#" class="transition hover:text-[#6F4E37]">

                        Tentang MarketKu

                    </a>

                    <a href="#" class="transition hover:text-[#6F4E37]">

                        Kebijakan Privasi

                    </a>

                    <a href="#" class="transition hover:text-[#6F4E37]">

                        Syarat & Ketentuan

                    </a>

                </div>

            </div>



            {{-- HELP --}}

            <div>

                <h4 class="font-semibold text-slate-800">
                    Bantuan
                </h4>

                <div
                    class="mt-4 flex
                           flex-col gap-3
                           text-sm text-slate-500">

                    <a href="#" class="transition hover:text-[#8B6245]">

                        Pusat Bantuan

                    </a>

                    <a href="#" class="transition hover:text-[#8B6245]">

                        Cara Belanja

                    </a>

                    <a href="#" class="transition hover:text-[#8B6245]">

                        Pembayaran

                    </a>

                    <a href="#" class="transition hover:text-[#8B6245]">

                        Pengiriman

                    </a>

                </div>

            </div>



            {{-- SECURITY --}}

            <div>

                <h4 class="font-semibold text-slate-800">
                    Keamanan
                </h4>

                <div
                    class="mt-4 flex gap-3
                           rounded-2xl
                           border border-[#D3DFCE]
                           bg-gradient-to-br
                           from-[#F1F5ED]
                           to-[#E4ECE0]
                           p-4">

                    <div
                        class="flex size-10
                               shrink-0
                               items-center justify-center
                               rounded-xl
                               bg-[#7F9275]
                               text-white">

                        <i class="fa-solid fa-shield-halved"></i>

                    </div>

                    <div>

                        <p class="text-sm font-semibold">
                            Transaksi Terlindungi
                        </p>

                        <p class="mt-1
                                   text-xs text-slate-500">

                            Belanja lebih nyaman bersama MarketKu.

                        </p>

                    </div>

                </div>

            </div>

        </div>


        <div
            class="border-t border-[#E6D8CD]
                   py-5
                   text-center
                   text-xs
                   text-slate-500">

            © {{ date('Y') }} MarketKu.
            All rights reserved.

        </div>

    </footer>



    {{-- ========================================================= --}}
    {{-- MOBILE BOTTOM NAVIGATION --}}
    {{-- ========================================================= --}}

    <nav
        class="fixed inset-x-0 bottom-0 z-50
               border-t border-[#E6D8CD]
               bg-white/95
               px-2
               shadow-[0_-5px_20px_rgba(111,78,55,0.07)]
               backdrop-blur-xl
               md:hidden">

        <div class="mx-auto grid
                   max-w-md
                   grid-cols-4">


            {{-- HOME --}}

            <a href="{{ route('home') }}"
                class="flex flex-col
                       items-center justify-center
                       gap-1 py-3
                       text-[#6F4E37]">

                <i class="fa-solid fa-house text-lg"></i>

                <span class="text-[10px] font-semibold">
                    Home
                </span>

            </a>



            {{-- CATEGORY --}}

            <a href="#kategori"
                class="flex flex-col
                       items-center justify-center
                       gap-1 py-3
                       text-[#C8795A]">

                <i class="fa-solid fa-border-all text-lg"></i>

                <span class="text-[10px] font-medium">
                    Kategori
                </span>

            </a>



            {{-- CART --}}

            @auth

                @if (auth()->user()->role === 'buyer' && Route::has('buyer.cart.index'))
                    <a href="{{ route('buyer.cart.index') }}"
                        class="flex flex-col
                               items-center justify-center
                               gap-1 py-3
                               text-[#7F9275]">

                        <i class="fa-solid fa-cart-shopping text-lg"></i>

                        <span class="text-[10px]">
                            Keranjang
                        </span>

                    </a>
                @endif
            @else
                <a href="{{ route('login') }}"
                    class="flex flex-col
                           items-center justify-center
                           gap-1 py-3
                           text-[#7F9275]">

                    <i class="fa-solid fa-cart-shopping text-lg"></i>

                    <span class="text-[10px]">
                        Keranjang
                    </span>

                </a>

            @endauth



            {{-- ACCOUNT --}}

            @auth

                @if (auth()->user()->role === 'buyer')
                    <a href="{{ route('buyer.dashboard') }}"
                        class="flex flex-col
                               items-center justify-center
                               gap-1 py-3
                               text-[#C89B55]">

                        <i class="fa-regular fa-user text-lg"></i>

                        <span class="text-[10px]">
                            Akun
                        </span>

                    </a>
                @endif
            @else
                <a href="{{ route('login') }}"
                    class="flex flex-col
                           items-center justify-center
                           gap-1 py-3
                           text-[#C89B55]">

                    <i class="fa-regular fa-user text-lg"></i>

                    <span class="text-[10px]">
                        Masuk
                    </span>

                </a>

            @endauth

        </div>

    </nav>



    {{-- ========================================================= --}}
    {{-- ALPINE CATEGORY FILTER --}}
    {{-- ========================================================= --}}

    <script>
        function categoryFilter(config) {

            return {

                selectedCategory: config.selectedCategory,

                title: config.initialTitle,

                total: config.initialTotal,

                loading: false,

                filterUrl: config.filterUrl,


                async loadCategory(
                    categoryId,
                    categoryTitle
                ) {

                    if (this.loading) {
                        return;
                    }


                    this.selectedCategory =
                        categoryId;

                    this.title =
                        categoryTitle;

                    this.loading =
                        true;


                    const browserUrl =
                        new URL(
                            window.location.href
                        );


                    const search =
                        browserUrl
                        .searchParams
                        .get('search') ?? '';


                    const requestUrl =
                        new URL(
                            this.filterUrl,
                            window.location.origin
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | CATEGORY
                    |--------------------------------------------------------------------------
                    */

                    if (categoryId !== null) {

                        requestUrl
                            .searchParams
                            .set(
                                'category',
                                categoryId
                            );

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | SEARCH
                    |--------------------------------------------------------------------------
                    */

                    if (search.trim() !== '') {

                        requestUrl
                            .searchParams
                            .set(
                                'search',
                                search
                            );

                    }


                    try {

                        const response =
                            await fetch(
                                requestUrl.toString(), {
                                    method: 'GET',

                                    cache: 'no-store',

                                    headers: {

                                        'Accept': 'application/json',

                                        'X-Requested-With': 'XMLHttpRequest',

                                    },
                                }
                            );


                        if (!response.ok) {

                            throw new Error(
                                'Gagal mengambil produk.'
                            );

                        }


                        const data =
                            await response.json();


                        /*
                        |--------------------------------------------------------------------------
                        | UPDATE PRODUCT GRID
                        |--------------------------------------------------------------------------
                        */

                        this.$refs
                            .productGrid
                            .innerHTML =
                            data.html;


                        this.total =
                            data.total;


                        /*
                        |--------------------------------------------------------------------------
                        | UPDATE URL TANPA REFRESH
                        |--------------------------------------------------------------------------
                        */

                        if (categoryId === null) {

                            browserUrl
                                .searchParams
                                .delete(
                                    'category'
                                );

                        } else {

                            browserUrl
                                .searchParams
                                .set(
                                    'category',
                                    categoryId
                                );

                        }


                        window.history
                            .replaceState({},
                                '',
                                browserUrl.toString()
                            );


                        /*
                        |--------------------------------------------------------------------------
                        | UPDATE HIDDEN INPUT SEARCH
                        |--------------------------------------------------------------------------
                        */

                        document
                            .querySelectorAll(
                                '.js-category-input'
                            )
                            .forEach(
                                (input) => {

                                    input.value =
                                        categoryId ?? '';

                                }
                            );


                    } catch (error) {

                        console.error(
                            'Filter kategori error:',
                            error
                        );


                    } finally {

                        this.loading =
                            false;

                    }

                },

            };

        }
    </script>

</body>

</html>
