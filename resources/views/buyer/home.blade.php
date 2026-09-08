<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $siteSetting?->site_name ?? 'KampusMart' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

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
           bg-[#F6F8FC]
           text-slate-800
           antialiased"
>

    @php
        $search = $search ?? '';
        $selectedCategory = $selectedCategory ?? null;
        $isFiltering = $isFiltering ?? false;

        $categories = $categories ?? collect();
        $latestProducts = $latestProducts ?? collect();
        $recommendedProducts = $recommendedProducts ?? collect();
        $products = $products ?? collect();

        $initialProducts = $isFiltering ? $products : $latestProducts;

        $activeCategory = $selectedCategory
            ? $categories->firstWhere('id', $selectedCategory)
            : null;

        if ($search !== '') {
            $initialTitle = 'Hasil Pencarian';
        } elseif ($activeCategory) {
            $initialTitle = 'Produk ' . $activeCategory->name;
        } else {
            $initialTitle = 'Produk Terbaru';
        }

        $initialTotal = $isFiltering
            ? ($products?->total() ?? $products->count())
            : $latestProducts->count();

        $categoryThemes = [
            [
                'icon' => 'fa-bag-shopping',
                'box' => 'from-blue-50 to-indigo-50 text-[#315ebc]',
                'active' => 'border-blue-200 bg-blue-50',
            ],
            [
                'icon' => 'fa-mobile-screen-button',
                'box' => 'from-violet-50 to-fuchsia-50 text-violet-600',
                'active' => 'border-violet-200 bg-violet-50',
            ],
            [
                'icon' => 'fa-laptop',
                'box' => 'from-cyan-50 to-sky-50 text-cyan-600',
                'active' => 'border-cyan-200 bg-cyan-50',
            ],
            [
                'icon' => 'fa-shirt',
                'box' => 'from-rose-50 to-pink-50 text-rose-600',
                'active' => 'border-rose-200 bg-rose-50',
            ],
            [
                'icon' => 'fa-house',
                'box' => 'from-amber-50 to-orange-50 text-amber-600',
                'active' => 'border-amber-200 bg-amber-50',
            ],
            [
                'icon' => 'fa-utensils',
                'box' => 'from-emerald-50 to-green-50 text-emerald-600',
                'active' => 'border-emerald-200 bg-emerald-50',
            ],
            [
                'icon' => 'fa-headphones',
                'box' => 'from-slate-100 to-slate-50 text-slate-600',
                'active' => 'border-slate-300 bg-slate-100',
            ],
            [
                'icon' => 'fa-gamepad',
                'box' => 'from-purple-50 to-indigo-50 text-purple-600',
                'active' => 'border-purple-200 bg-purple-50',
            ],
        ];
    @endphp


    {{-- ========================================================= --}}
    {{-- NAVBAR --}}
    {{-- ========================================================= --}}

    <header
        class="sticky
               top-0
               z-50
               border-b
               border-slate-200/70
               bg-white/85
               shadow-sm
               shadow-slate-950/5
               backdrop-blur-xl"
    >

        <div class="mx-auto max-w-7xl px-4 sm:px-5">

            <div
                class="flex
                       items-center
                       gap-3
                       py-3
                       md:gap-5"
            >

                {{-- BRAND --}}
                <a
                    href="{{ route('home') }}"
                    class="flex
                           shrink-0
                           items-center
                           gap-2.5"
                >

                    @if ($siteSetting?->logo)
                        <img
                            src="{{ asset('storage/' . $siteSetting->logo) }}"
                            alt="{{ $siteSetting?->site_name ?? 'KampusMart' }}"
                            class="size-10
                                   rounded-2xl
                                   object-contain
                                   shadow-sm"
                        >
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
                                   shadow-blue-600/20"
                        >
                            {{ strtoupper(substr($siteSetting?->site_name ?? 'KampusMart', 0, 1)) }}
                        </div>
                    @endif

                    <div class="hidden sm:block">

                        <p
                            class="text-lg
                                   font-black
                                   tracking-tight
                                   text-[#0a1d45]"
                        >
                            {{ $siteSetting?->site_name ?? 'KampusMart' }}
                        </p>

                        <p
                            class="-mt-0.5
                                   text-[9px]
                                   font-semibold
                                   uppercase
                                   tracking-[0.18em]
                                   text-slate-400"
                        >
                            Campus Marketplace
                        </p>

                    </div>

                </a>


                {{-- SEARCH DESKTOP --}}
                <form
                    action="{{ route('home') }}"
                    method="GET"
                    class="hidden
                           min-w-0
                           flex-1
                           overflow-hidden
                           rounded-2xl
                           border
                           border-slate-200
                           bg-slate-50
                           transition
                           focus-within:border-blue-300
                           focus-within:bg-white
                           focus-within:ring-4
                           focus-within:ring-blue-100
                           sm:flex"
                >

                    <input
                        type="hidden"
                        name="category"
                        value="{{ $selectedCategory ?? '' }}"
                        class="js-category-input"
                    >

                    <div
                        class="flex
                               w-11
                               shrink-0
                               items-center
                               justify-center
                               text-slate-400"
                    >
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </div>

                    <input
                        type="search"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari produk, kategori, atau toko..."
                        autocomplete="off"
                        class="min-w-0
                               flex-1
                               bg-transparent
                               py-2.5
                               pr-4
                               text-sm
                               outline-none
                               placeholder:text-slate-400"
                    >

                    @if ($search !== '')
                        <a
                            href="{{ route('home') }}"
                            class="flex
                                   w-10
                                   items-center
                                   justify-center
                                   text-slate-400
                                   transition
                                   hover:text-rose-500"
                        >
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    @endif

                    <button
                        type="submit"
                        class="flex
                               w-12
                               shrink-0
                               items-center
                               justify-center
                               bg-[#315ebc]
                               text-white
                               transition
                               hover:bg-[#244d9f]"
                    >
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </button>

                </form>


                {{-- RIGHT ACTION --}}
                <div
                    class="ml-auto
                           flex
                           items-center
                           gap-2"
                >

                    @auth

                        @if (auth()->user()->role === 'buyer' && Route::has('buyer.cart.index'))
                            <a
                                href="{{ route('buyer.cart.index') }}"
                                class="relative
                                       flex
                                       size-10
                                       items-center
                                       justify-center
                                       rounded-xl
                                       border
                                       border-slate-200
                                       bg-white
                                       text-[#315ebc]
                                       transition
                                       hover:border-blue-200
                                       hover:bg-blue-50
                                       sm:size-11"
                            >
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                        @endif

                        @if (auth()->user()->role === 'buyer')
                            <a
                                href="{{ route('buyer.dashboard') }}"
                                class="hidden
                                       items-center
                                       gap-2.5
                                       rounded-xl
                                       border
                                       border-slate-200
                                       bg-white
                                       px-2.5
                                       py-1.5
                                       transition
                                       hover:border-blue-200
                                       hover:bg-blue-50
                                       lg:flex"
                            >
                                <div
                                    class="flex
                                           size-8
                                           items-center
                                           justify-center
                                           rounded-lg
                                           bg-blue-50
                                           text-[#315ebc]"
                                >
                                    <i class="fa-regular fa-user text-xs"></i>
                                </div>

                                <div class="max-w-32">

                                    <p
                                        class="truncate
                                               text-xs
                                               font-bold
                                               text-slate-700"
                                    >
                                        {{ auth()->user()->name }}
                                    </p>

                                    <p class="text-[9px] text-slate-400">
                                        Dashboard Buyer
                                    </p>

                                </div>
                            </a>
                        @endif

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="hidden
                                   rounded-xl
                                   px-4
                                   py-2.5
                                   text-sm
                                   font-semibold
                                   text-slate-600
                                   transition
                                   hover:bg-slate-100
                                   sm:inline-flex"
                        >
                            Masuk
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-flex
                                       items-center
                                       rounded-xl
                                       bg-[#315ebc]
                                       px-4
                                       py-2.5
                                       text-sm
                                       font-bold
                                       text-white
                                       shadow-lg
                                       shadow-blue-600/15
                                       transition
                                       hover:-translate-y-0.5
                                       hover:bg-[#244d9f]"
                            >
                                Daftar
                            </a>
                        @endif

                    @endauth

                </div>

            </div>


            {{-- SEARCH MOBILE --}}
            <form
                action="{{ route('home') }}"
                method="GET"
                class="mb-3
                       flex
                       overflow-hidden
                       rounded-2xl
                       border
                       border-slate-200
                       bg-slate-50
                       focus-within:border-blue-300
                       focus-within:bg-white
                       focus-within:ring-4
                       focus-within:ring-blue-100
                       sm:hidden"
            >

                <input
                    type="hidden"
                    name="category"
                    value="{{ $selectedCategory ?? '' }}"
                    class="js-category-input"
                >

                <div
                    class="flex
                           w-10
                           items-center
                           justify-center
                           text-slate-400"
                >
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </div>

                <input
                    type="search"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Cari produk..."
                    class="min-w-0
                           flex-1
                           bg-transparent
                           py-2.5
                           pr-3
                           text-sm
                           outline-none"
                >

                <button
                    type="submit"
                    class="flex
                           w-12
                           items-center
                           justify-center
                           bg-[#315ebc]
                           text-white"
                >
                    <i class="fa-solid fa-arrow-right"></i>
                </button>

            </form>

        </div>

    </header>


    {{-- ========================================================= --}}
    {{-- MAIN --}}
    {{-- ========================================================= --}}

    <main
        class="mx-auto
               max-w-7xl
               px-4
               py-5
               pb-28
               sm:px-5
               sm:py-6
               md:pb-10"
    >

        {{-- ===================================================== --}}
        {{-- HERO BENTO --}}
        {{-- ===================================================== --}}

        <section
            class="grid
                   gap-4
                   lg:grid-cols-[minmax(0,1.65fr)_minmax(310px,.75fr)]"
        >

            {{-- HERO MAIN --}}
            <div
                class="relative
                       overflow-hidden
                       rounded-[30px]
                       bg-gradient-to-br
                       from-[#071633]
                       via-[#173b82]
                       to-[#315ebc]
                       px-5
                       py-8
                       text-white
                       shadow-2xl
                       shadow-blue-950/15
                       sm:px-8
                       sm:py-10
                       md:px-10
                       md:py-12"
            >

                <div
                    class="pointer-events-none
                           absolute
                           -left-20
                           -top-24
                           size-72
                           rounded-full
                           bg-blue-400/20
                           blur-3xl"
                ></div>

                <div
                    class="pointer-events-none
                           absolute
                           -bottom-28
                           right-0
                           size-72
                           rounded-full
                           bg-violet-400/20
                           blur-3xl"
                ></div>

                <div
                    class="pointer-events-none
                           absolute
                           right-10
                           top-10
                           hidden
                           size-48
                           rotate-12
                           rounded-[40px]
                           border
                           border-white/10
                           bg-white/5
                           backdrop-blur
                           md:block"
                ></div>

                <div class="relative z-10 max-w-2xl">

                    <div
                        class="inline-flex
                               items-center
                               gap-2
                               rounded-full
                               border
                               border-white/15
                               bg-white/10
                               px-3
                               py-1.5
                               text-xs
                               font-semibold
                               text-blue-50
                               backdrop-blur"
                    >
                        <span
                            class="flex
                                   size-6
                                   items-center
                                   justify-center
                                   rounded-full
                                   bg-white
                                   text-[#315ebc]"
                        >
                            <i class="fa-solid fa-bolt text-[9px]"></i>
                        </span>

                        Marketplace kampus yang praktis
                    </div>

                    <h1
                        class="mt-5
                               text-3xl
                               font-black
                               leading-[1.08]
                               tracking-tight
                               sm:text-4xl
                               md:text-5xl"
                    >
                        Belanja kebutuhanmu
                        <span
                            class="mt-1
                                   block
                                   bg-gradient-to-r
                                   from-blue-100
                                   via-white
                                   to-violet-200
                                   bg-clip-text
                                   text-transparent"
                        >
                            lebih cepat dan simpel.
                        </span>
                    </h1>

                    <p
                        class="mt-4
                               max-w-xl
                               text-sm
                               leading-6
                               text-blue-100/90
                               sm:text-base
                               sm:leading-7"
                    >
                        Temukan produk dari seller kampus, cek detail produk,
                        simpan ke keranjang, dan lanjut transaksi lewat WhatsApp.
                    </p>

                    <div
                        class="mt-7
                               flex
                               flex-wrap
                               gap-3"
                    >

                        <a
                            href="#produk"
                            class="inline-flex
                                   items-center
                                   gap-2
                                   rounded-xl
                                   bg-white
                                   px-5
                                   py-3
                                   text-sm
                                   font-bold
                                   text-[#0a1d45]
                                   shadow-xl
                                   shadow-black/10
                                   transition
                                   hover:-translate-y-0.5
                                   hover:shadow-2xl"
                        >
                            Jelajahi Produk
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>

                        <a
                            href="#kategori"
                            class="inline-flex
                                   items-center
                                   gap-2
                                   rounded-xl
                                   border
                                   border-white/15
                                   bg-white/10
                                   px-5
                                   py-3
                                   text-sm
                                   font-semibold
                                   text-white
                                   backdrop-blur
                                   transition
                                   hover:bg-white/15"
                        >
                            Lihat Kategori
                            <i class="fa-solid fa-grid-2 text-xs"></i>
                        </a>

                    </div>

                    <div
                        class="mt-8
                               grid
                               max-w-xl
                               grid-cols-3
                               gap-3"
                    >

                        <div
                            class="rounded-2xl
                                   border
                                   border-white/10
                                   bg-white/10
                                   p-3
                                   backdrop-blur"
                        >
                            <p class="text-lg font-black sm:text-xl">
                                {{ $categories->count() }}
                            </p>
                            <p class="mt-0.5 text-[10px] text-blue-100">
                                kategori
                            </p>
                        </div>

                        <div
                            class="rounded-2xl
                                   border
                                   border-white/10
                                   bg-white/10
                                   p-3
                                   backdrop-blur"
                        >
                            <p class="text-lg font-black sm:text-xl">
                                {{ $latestProducts->count() }}
                            </p>
                            <p class="mt-0.5 text-[10px] text-blue-100">
                                produk terbaru
                            </p>
                        </div>

                        <div
                            class="rounded-2xl
                                   border
                                   border-white/10
                                   bg-white/10
                                   p-3
                                   backdrop-blur"
                        >
                            <p class="text-lg font-black sm:text-xl">
                                24/7
                            </p>
                            <p class="mt-0.5 text-[10px] text-blue-100">
                                akses marketplace
                            </p>
                        </div>

                    </div>

                </div>

            </div>


            {{-- HERO SIDE --}}
            <div
                class="grid
                       grid-cols-2
                       gap-4
                       lg:grid-cols-1"
            >

                <div
                    class="relative
                           overflow-hidden
                           rounded-[28px]
                           border
                           border-slate-200
                           bg-white
                           p-5
                           shadow-sm
                           transition
                           hover:-translate-y-0.5
                           hover:shadow-lg"
                >
                    <div
                        class="absolute
                               -right-10
                               -top-10
                               size-32
                               rounded-full
                               bg-blue-100
                               blur-2xl"
                    ></div>

                    <div class="relative">

                        <div
                            class="flex
                                   size-11
                                   items-center
                                   justify-center
                                   rounded-2xl
                                   bg-blue-50
                                   text-[#315ebc]"
                        >
                            <i class="fa-solid fa-store"></i>
                        </div>

                        <p
                            class="mt-4
                                   text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-[0.18em]
                                   text-blue-500"
                        >
                            Seller Kampus
                        </p>

                        <h3
                            class="mt-1
                                   text-base
                                   font-black
                                   leading-snug
                                   text-slate-900
                                   sm:text-xl"
                        >
                            Produk dari seller terdaftar.
                        </h3>

                        <p
                            class="mt-2
                                   hidden
                                   text-xs
                                   leading-5
                                   text-slate-500
                                   sm:block"
                        >
                            Jelajahi produk dari seller di lingkungan KampusMart.
                        </p>

                    </div>
                </div>


                <div
                    class="relative
                           overflow-hidden
                           rounded-[28px]
                           border
                           border-slate-200
                           bg-gradient-to-br
                           from-[#0a1d45]
                           to-[#173b82]
                           p-5
                           text-white
                           shadow-sm
                           transition
                           hover:-translate-y-0.5
                           hover:shadow-lg"
                >

                    <div
                        class="absolute
                               -bottom-12
                               -right-12
                               size-36
                               rounded-full
                               bg-violet-400/20
                               blur-2xl"
                    ></div>

                    <div class="relative">

                        <div
                            class="flex
                                   size-11
                                   items-center
                                   justify-center
                                   rounded-2xl
                                   bg-white/10
                                   text-white
                                   backdrop-blur"
                        >
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>

                        <p
                            class="mt-4
                                   text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-[0.18em]
                                   text-blue-200"
                        >
                            Transaksi Praktis
                        </p>

                        <h3
                            class="mt-1
                                   text-base
                                   font-black
                                   leading-snug
                                   sm:text-xl"
                        >
                            Konfirmasi langsung via WhatsApp.
                        </h3>

                        <p
                            class="mt-2
                                   hidden
                                   text-xs
                                   leading-5
                                   text-blue-100/80
                                   sm:block"
                        >
                            Sistem mencatat pesanan, komunikasi lanjut ke seller.
                        </p>

                    </div>
                </div>

            </div>

        </section>


        {{-- ===================================================== --}}
        {{-- BENEFITS --}}
        {{-- ===================================================== --}}

        <section
            class="mt-4
                   grid
                   grid-cols-2
                   gap-3
                   lg:grid-cols-4"
        >

            @php
                $benefits = [
                    [
                        'icon' => 'fa-bolt',
                        'title' => 'Cepat & Praktis',
                        'description' => 'Temukan kebutuhan lebih cepat.',
                    ],
                    [
                        'icon' => 'fa-store',
                        'title' => 'Seller Terdaftar',
                        'description' => 'Produk dari seller KampusMart.',
                    ],
                    [
                        'icon' => 'fa-comments',
                        'title' => 'Langsung Terhubung',
                        'description' => 'Lanjut transaksi via WhatsApp.',
                    ],
                    [
                        'icon' => 'fa-mobile-screen',
                        'title' => 'Responsif',
                        'description' => 'Nyaman di desktop dan mobile.',
                    ],
                ];
            @endphp

            @foreach ($benefits as $benefit)

                <div
                    class="rounded-2xl
                           border
                           border-slate-200
                           bg-white
                           p-4
                           shadow-sm"
                >
                    <div
                        class="flex
                               size-10
                               items-center
                               justify-center
                               rounded-xl
                               bg-slate-100
                               text-[#315ebc]"
                    >
                        <i class="fa-solid {{ $benefit['icon'] }}"></i>
                    </div>

                    <p
                        class="mt-3
                               text-sm
                               font-bold
                               text-slate-800"
                    >
                        {{ $benefit['title'] }}
                    </p>

                    <p
                        class="mt-1
                               hidden
                               text-xs
                               leading-5
                               text-slate-500
                               sm:block"
                    >
                        {{ $benefit['description'] }}
                    </p>
                </div>

            @endforeach

        </section>


        {{-- ===================================================== --}}
        {{-- CATEGORY + FILTER --}}
        {{-- ===================================================== --}}

        <div
            x-data="categoryFilter({
                selectedCategory: @js($selectedCategory ? (int) $selectedCategory : null),
                initialTitle: @js($initialTitle),
                initialTotal: {{ $initialTotal }},
                filterUrl: @js(route('products.filter'))
            })"
        >

            <section
                id="kategori"
                class="mt-6
                       rounded-[28px]
                       border
                       border-slate-200
                       bg-white
                       p-4
                       shadow-sm
                       sm:p-6"
            >

                <div
                    class="flex
                           flex-col
                           gap-4
                           sm:flex-row
                           sm:items-end
                           sm:justify-between"
                >

                    <div>

                        <span
                            class="inline-flex
                                   items-center
                                   gap-2
                                   rounded-full
                                   bg-blue-50
                                   px-3
                                   py-1
                                   text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-[0.16em]
                                   text-[#315ebc]"
                        >
                            <i class="fa-solid fa-layer-group"></i>
                            Kategori
                        </span>

                        <h2
                            class="mt-3
                                   text-xl
                                   font-black
                                   tracking-tight
                                   text-slate-900
                                   sm:text-2xl"
                        >
                            Temukan berdasarkan kategori
                        </h2>

                        <p
                            class="mt-1
                                   text-sm
                                   text-slate-500"
                        >
                            Pilih kategori yang sesuai dengan kebutuhanmu.
                        </p>

                    </div>

                    @if (Route::has('buyer.products.index'))
                        <a
                            href="{{ route('buyer.products.index') }}"
                            class="inline-flex
                                   items-center
                                   gap-2
                                   text-xs
                                   font-bold
                                   text-[#315ebc]
                                   hover:text-[#0a1d45]"
                        >
                            Lihat Semua
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    @endif

                </div>


                @if ($categories->isNotEmpty())

                    {{-- PILLS --}}
                    <div
                        class="hide-scrollbar
                               mt-5
                               flex
                               items-center
                               gap-2
                               overflow-x-auto
                               pb-1"
                    >

                        <button
                            type="button"
                            @click="loadCategory(null, 'Produk Terbaru')"
                            class="shrink-0
                                   rounded-full
                                   border
                                   px-4
                                   py-2
                                   text-xs
                                   font-bold
                                   transition"
                            :class="selectedCategory === null
                                ? 'border-[#315ebc] bg-[#315ebc] text-white'
                                : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50'"
                        >
                            Semua
                        </button>

                        @foreach ($categories as $category)

                            <button
                                type="button"
                                @click="
                                    loadCategory(
                                        {{ $category->id }},
                                        @js('Produk ' . $category->name)
                                    )
                                "
                                class="shrink-0
                                       rounded-full
                                       border
                                       px-4
                                       py-2
                                       text-xs
                                       font-bold
                                       transition"
                                :class="selectedCategory === {{ $category->id }}
                                    ? 'border-[#315ebc] bg-[#315ebc] text-white'
                                    : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50'"
                            >
                                {{ $category->name }}
                            </button>

                        @endforeach

                    </div>


                    {{-- CATEGORY CARDS --}}
                    <div
                        class="mt-5
                               grid
                               grid-cols-4
                               gap-2
                               sm:grid-cols-4
                               sm:gap-3
                               lg:grid-cols-8"
                    >

                        @foreach ($categories as $index => $category)

                            @php
                                $theme = $categoryThemes[$index % count($categoryThemes)];
                            @endphp

                            <button
                                type="button"
                                @click="
                                    loadCategory(
                                        {{ $category->id }},
                                        @js('Produk ' . $category->name)
                                    )
                                "
                                class="group
                                       min-w-0
                                       rounded-2xl
                                       border
                                       p-2.5
                                       text-center
                                       transition
                                       duration-300
                                       hover:-translate-y-1
                                       hover:shadow-lg
                                       sm:p-3"
                                :class="selectedCategory === {{ $category->id }}
                                    ? @js($theme['active'] . ' shadow-sm')
                                    : 'border-slate-200 bg-white hover:border-blue-200'"
                            >

                                <div
                                    class="mx-auto
                                           flex
                                           size-11
                                           items-center
                                           justify-center
                                           rounded-2xl
                                           bg-gradient-to-br
                                           transition
                                           group-hover:scale-105
                                           sm:size-13
                                           {{ $theme['box'] }}"
                                >
                                    <i class="fa-solid {{ $theme['icon'] }} text-lg"></i>
                                </div>

                                <p
                                    class="mt-2
                                           truncate
                                           text-[11px]
                                           font-bold
                                           text-slate-700
                                           sm:text-xs"
                                >
                                    {{ $category->name }}
                                </p>

                                <p class="mt-0.5 text-[9px] text-slate-400">
                                    {{ $category->products_count }} produk
                                </p>

                            </button>

                        @endforeach

                    </div>

                @else

                    <div
                        class="mt-5
                               rounded-2xl
                               border
                               border-dashed
                               border-slate-300
                               bg-slate-50
                               py-10
                               text-center"
                    >
                        <i class="fa-solid fa-box-open text-3xl text-slate-300"></i>

                        <p class="mt-3 text-sm font-bold text-slate-600">
                            Belum ada kategori
                        </p>
                    </div>

                @endif

            </section>


            {{-- ===================================================== --}}
            {{-- PRODUCTS --}}
            {{-- ===================================================== --}}

            <section
                id="produk"
                x-ref="productSection"
                class="mt-6
                       rounded-[28px]
                       border
                       border-slate-200
                       bg-white
                       p-4
                       shadow-sm
                       sm:p-6"
            >

                <div
                    class="flex
                           items-end
                           justify-between
                           gap-4"
                >

                    <div>

                        <span
                            class="inline-flex
                                   items-center
                                   gap-2
                                   rounded-full
                                   bg-violet-50
                                   px-3
                                   py-1
                                   text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-[0.16em]
                                   text-violet-600"
                        >
                            <i class="fa-solid fa-bolt"></i>
                            Produk
                        </span>

                        <h2
                            class="mt-3
                                   text-xl
                                   font-black
                                   tracking-tight
                                   text-slate-900
                                   sm:text-2xl"
                            x-text="title"
                        >
                            {{ $initialTitle }}
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">

                            <template x-if="!loading">
                                <span>
                                    Ditemukan
                                    <strong class="text-[#315ebc]" x-text="total">
                                        {{ $initialTotal }}
                                    </strong>
                                    produk
                                </span>
                            </template>

                            <template x-if="loading">
                                <span>Memuat produk...</span>
                            </template>

                        </p>

                    </div>

                    @if (Route::has('buyer.products.index'))
                        <a
                            href="{{ route('buyer.products.index') }}"
                            class="hidden
                                   items-center
                                   gap-2
                                   text-xs
                                   font-bold
                                   text-[#315ebc]
                                   hover:text-[#0a1d45]
                                   sm:inline-flex"
                        >
                            Lihat Semua
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    @endif

                </div>


                {{-- SKELETON --}}
                <div
                    x-show="loading"
                    x-cloak
                    class="mt-5
                           grid
                           grid-cols-2
                           gap-3
                           sm:grid-cols-3
                           sm:gap-4
                           lg:grid-cols-5"
                >

                    @for ($i = 0; $i < 5; $i++)

                        <div
                            class="overflow-hidden
                                   rounded-2xl
                                   border
                                   border-slate-200
                                   bg-white"
                        >
                            <div class="aspect-square animate-pulse bg-slate-100"></div>

                            <div class="p-4">
                                <div class="h-3 animate-pulse rounded-full bg-slate-100"></div>
                                <div class="mt-2 h-3 w-3/4 animate-pulse rounded-full bg-slate-100"></div>
                                <div class="mt-5 h-4 w-1/2 animate-pulse rounded-full bg-slate-100"></div>
                            </div>
                        </div>

                    @endfor

                </div>


                {{-- GRID --}}
                <div
                    x-ref="productGrid"
                    x-show="!loading"
                    class="mt-5"
                >

                    @if ($initialProducts->isNotEmpty())

                        <div
                            class="grid
                                   grid-cols-2
                                   gap-3
                                   sm:grid-cols-3
                                   sm:gap-4
                                   lg:grid-cols-5"
                        >

                            @foreach ($initialProducts as $product)

                                @php
                                    $productImage =
                                        $product->image
                                        ?? ($product->photo
                                        ?? ($product->thumbnail ?? null));

                                    if ($productImage) {
                                        $imageUrl = \Illuminate\Support\Str::startsWith(
                                            $productImage,
                                            ['http://', 'https://']
                                        )
                                            ? $productImage
                                            : asset('storage/' . $productImage);
                                    } else {
                                        $imageUrl = null;
                                    }
                                @endphp

                                <a
                                    href="{{ route('buyer.products.show', $product) }}"
                                    class="group
                                           overflow-hidden
                                           rounded-2xl
                                           border
                                           border-slate-200
                                           bg-white
                                           transition
                                           duration-300
                                           hover:-translate-y-1
                                           hover:border-blue-200
                                           hover:shadow-xl
                                           hover:shadow-blue-950/5"
                                >

                                    {{-- IMAGE --}}
                                    <div
                                        class="relative
                                               aspect-square
                                               overflow-hidden
                                               bg-slate-100"
                                    >

                                        @if ($imageUrl)
                                            <img
                                                src="{{ $imageUrl }}"
                                                alt="{{ $product->name }}"
                                                loading="lazy"
                                                class="size-full
                                                       object-cover
                                                       transition
                                                       duration-500
                                                       group-hover:scale-105"
                                            >
                                        @else
                                            <div
                                                class="flex
                                                       size-full
                                                       items-center
                                                       justify-center
                                                       text-slate-300"
                                            >
                                                <i class="fa-regular fa-image text-4xl"></i>
                                            </div>
                                        @endif


                                        @if ($product->category)
                                            <span
                                                class="absolute
                                                       left-2
                                                       top-2
                                                       max-w-[85%]
                                                       truncate
                                                       rounded-full
                                                       bg-white/90
                                                       px-2.5
                                                       py-1
                                                       text-[9px]
                                                       font-bold
                                                       text-[#315ebc]
                                                       shadow-sm
                                                       backdrop-blur"
                                            >
                                                {{ $product->category->name }}
                                            </span>
                                        @endif


                                        @if (($product->stock ?? 0) > 0)
                                            <span
                                                class="absolute
                                                       bottom-2
                                                       right-2
                                                       rounded-full
                                                       bg-emerald-500/90
                                                       px-2
                                                       py-1
                                                       text-[9px]
                                                       font-bold
                                                       text-white
                                                       shadow-sm"
                                            >
                                                Tersedia
                                            </span>
                                        @endif

                                    </div>


                                    {{-- BODY --}}
                                    <div class="p-3 sm:p-4">

                                        <h3
                                            class="line-clamp-2
                                                   min-h-10
                                                   text-xs
                                                   font-bold
                                                   leading-5
                                                   text-slate-700
                                                   transition
                                                   group-hover:text-[#315ebc]
                                                   sm:text-sm"
                                        >
                                            {{ $product->name }}
                                        </h3>

                                        <p
                                            class="mt-2
                                                   text-base
                                                   font-black
                                                   tracking-tight
                                                   text-[#0a1d45]
                                                   sm:text-lg"
                                        >
                                            Rp{{ number_format($product->price ?? 0, 0, ',', '.') }}
                                        </p>

                                        <div
                                            class="mt-3
                                                   flex
                                                   items-center
                                                   justify-between
                                                   gap-2
                                                   border-t
                                                   border-slate-100
                                                   pt-3"
                                        >

                                            <span
                                                class="text-[10px]
                                                       font-medium
                                                       text-slate-400"
                                            >
                                                Stok {{ $product->stock ?? 0 }}
                                            </span>

                                            @if ($product->user)
                                                <span
                                                    class="max-w-24
                                                           truncate
                                                           text-[10px]
                                                           font-medium
                                                           text-slate-500"
                                                >
                                                    <i class="fa-solid fa-store mr-1 text-[#315ebc]"></i>
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
                            class="rounded-[24px]
                                   border
                                   border-dashed
                                   border-slate-300
                                   bg-slate-50
                                   px-5
                                   py-14
                                   text-center"
                        >
                            <div
                                class="mx-auto
                                       flex
                                       size-16
                                       items-center
                                       justify-center
                                       rounded-2xl
                                       bg-white
                                       text-slate-300
                                       shadow-sm"
                            >
                                <i class="fa-solid fa-box-open text-2xl"></i>
                            </div>

                            <h3
                                class="mt-4
                                       font-black
                                       text-slate-700"
                            >
                                Produk tidak ditemukan
                            </h3>

                            <p
                                class="mt-1
                                       text-sm
                                       text-slate-500"
                            >
                                Coba kategori atau kata pencarian lain.
                            </p>
                        </div>

                    @endif

                </div>

            </section>


            {{-- ===================================================== --}}
            {{-- RECOMMENDATION --}}
            {{-- ===================================================== --}}

            <section
                x-show="selectedCategory === null && !loading"
                x-cloak
                class="mt-6
                       rounded-[28px]
                       border
                       border-slate-200
                       bg-gradient-to-br
                       from-[#0a1d45]
                       via-[#153b82]
                       to-[#244d9f]
                       p-4
                       text-white
                       shadow-xl
                       shadow-blue-950/10
                       sm:p-6"
            >

                <div
                    class="flex
                           items-end
                           justify-between
                           gap-4"
                >

                    <div>

                        <span
                            class="inline-flex
                                   items-center
                                   gap-2
                                   rounded-full
                                   bg-white/10
                                   px-3
                                   py-1
                                   text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-[0.16em]
                                   text-blue-100"
                        >
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                            Rekomendasi
                        </span>

                        <h2
                            class="mt-3
                                   text-xl
                                   font-black
                                   tracking-tight
                                   sm:text-2xl"
                        >
                            Pilihan untuk kamu
                        </h2>

                        <p class="mt-1 text-sm text-blue-100/80">
                            Produk menarik dari berbagai seller.
                        </p>

                    </div>

                    @if (Route::has('buyer.products.index'))
                        <a
                            href="{{ route('buyer.products.index') }}"
                            class="hidden
                                   items-center
                                   gap-2
                                   text-xs
                                   font-bold
                                   text-white
                                   sm:inline-flex"
                        >
                            Lihat Semua
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    @endif

                </div>


                @if ($recommendedProducts->isNotEmpty())

                    <div
                        class="mt-5
                               grid
                               grid-cols-2
                               gap-3
                               sm:grid-cols-3
                               sm:gap-4
                               lg:grid-cols-5"
                    >

                        @foreach ($recommendedProducts as $product)

                            @php
                                $productImage =
                                    $product->image
                                    ?? ($product->photo
                                    ?? ($product->thumbnail ?? null));

                                if ($productImage) {
                                    $imageUrl = \Illuminate\Support\Str::startsWith(
                                        $productImage,
                                        ['http://', 'https://']
                                    )
                                        ? $productImage
                                        : asset('storage/' . $productImage);
                                } else {
                                    $imageUrl = null;
                                }

                                $sellerLocation =
                                    $product->user?->sellerProfile?->city
                                    ?? ($product->user?->sellerProfile?->address ?? null);
                            @endphp

                            <a
                                href="{{ route('buyer.products.show', $product) }}"
                                class="group
                                       overflow-hidden
                                       rounded-2xl
                                       bg-white
                                       text-slate-800
                                       shadow-sm
                                       transition
                                       duration-300
                                       hover:-translate-y-1
                                       hover:shadow-xl"
                            >

                                <div
                                    class="relative
                                           aspect-square
                                           overflow-hidden
                                           bg-slate-100"
                                >

                                    @if ($imageUrl)
                                        <img
                                            src="{{ $imageUrl }}"
                                            alt="{{ $product->name }}"
                                            loading="lazy"
                                            class="size-full
                                                   object-cover
                                                   transition
                                                   duration-500
                                                   group-hover:scale-105"
                                        >
                                    @else
                                        <div
                                            class="flex
                                                   size-full
                                                   items-center
                                                   justify-center
                                                   text-slate-300"
                                        >
                                            <i class="fa-regular fa-image text-4xl"></i>
                                        </div>
                                    @endif

                                    <span
                                        class="absolute
                                               right-2
                                               top-2
                                               flex
                                               size-8
                                               items-center
                                               justify-center
                                               rounded-full
                                               bg-white/90
                                               text-rose-500
                                               shadow-sm
                                               backdrop-blur"
                                    >
                                        <i class="fa-solid fa-heart text-xs"></i>
                                    </span>

                                </div>


                                <div class="p-3 sm:p-4">

                                    <h3
                                        class="line-clamp-2
                                               min-h-10
                                               text-xs
                                               font-bold
                                               leading-5
                                               text-slate-700
                                               group-hover:text-[#315ebc]
                                               sm:text-sm"
                                    >
                                        {{ $product->name }}
                                    </h3>

                                    <p
                                        class="mt-2
                                               text-base
                                               font-black
                                               text-[#0a1d45]
                                               sm:text-lg"
                                    >
                                        Rp{{ number_format($product->price ?? 0, 0, ',', '.') }}
                                    </p>

                                    <div
                                        class="mt-3
                                               border-t
                                               border-slate-100
                                               pt-3"
                                    >

                                        <p
                                            class="truncate
                                                   text-[10px]
                                                   font-semibold
                                                   text-slate-500"
                                        >
                                            <i class="fa-solid fa-store mr-1 text-[#315ebc]"></i>
                                            {{ $product->user?->name ?? 'Seller' }}
                                        </p>

                                        @if ($sellerLocation)
                                            <p
                                                class="mt-1
                                                       truncate
                                                       text-[9px]
                                                       text-slate-400"
                                            >
                                                <i class="fa-solid fa-location-dot mr-1"></i>
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
                        class="mt-5
                               rounded-2xl
                               border
                               border-white/10
                               bg-white/10
                               py-12
                               text-center
                               backdrop-blur"
                    >
                        <i class="fa-solid fa-box-open text-4xl text-blue-200"></i>

                        <p class="mt-3 text-sm font-bold text-white">
                            Belum ada produk rekomendasi
                        </p>
                    </div>

                @endif

            </section>

        </div>

    </main>


    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <footer
        class="mt-12
               hidden
               border-t
               border-slate-200
               bg-white
               md:block"
    >

        <div
            class="mx-auto
                   grid
                   max-w-7xl
                   grid-cols-2
                   gap-10
                   px-5
                   py-12
                   lg:grid-cols-4"
        >

            <div>

                <div class="flex items-center gap-2">

                    <div
                        class="flex
                               size-10
                               items-center
                               justify-center
                               rounded-xl
                               bg-[#315ebc]
                               font-black
                               text-white"
                    >
                        {{ strtoupper(substr($siteSetting?->site_name ?? 'KampusMart', 0, 1)) }}
                    </div>

                    <div>
                        <h3 class="font-black text-[#0a1d45]">
                            {{ $siteSetting?->site_name ?? 'KampusMart' }}
                        </h3>

                        <p class="text-[9px] uppercase tracking-wider text-slate-400">
                            Campus Marketplace
                        </p>
                    </div>

                </div>

                <p
                    class="mt-4
                           max-w-xs
                           text-sm
                           leading-6
                           text-slate-500"
                >
                    Marketplace yang mempertemukan buyer dan seller kampus
                    dalam pengalaman belanja yang sederhana dan terstruktur.
                </p>

            </div>


            <div>
                <h4 class="font-bold text-slate-800">
                    Jelajahi
                </h4>

                <div class="mt-4 flex flex-col gap-3 text-sm text-slate-500">
                    <a href="#produk" class="hover:text-[#315ebc]">Produk</a>
                    <a href="#kategori" class="hover:text-[#315ebc]">Kategori</a>
                    <a href="{{ route('home') }}" class="hover:text-[#315ebc]">Beranda</a>
                </div>
            </div>


            <div>
                <h4 class="font-bold text-slate-800">
                    Bantuan
                </h4>

                <div class="mt-4 flex flex-col gap-3 text-sm text-slate-500">
                    <span>Cara Belanja</span>
                    <span>Pembayaran</span>
                    <span>Kontak Seller</span>
                </div>
            </div>


            <div>
                <h4 class="font-bold text-slate-800">
                    Transaksi
                </h4>

                <div
                    class="mt-4
                           rounded-2xl
                           border
                           border-slate-200
                           bg-slate-50
                           p-4"
                >
                    <div class="flex items-start gap-3">

                        <div
                            class="flex
                                   size-10
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-emerald-50
                                   text-emerald-600"
                        >
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>

                        <div>
                            <p class="text-sm font-bold text-slate-700">
                                Lanjut via WhatsApp
                            </p>

                            <p class="mt-1 text-xs leading-5 text-slate-500">
                                Komunikasi transaksi dilakukan langsung dengan seller.
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div
            class="border-t
                   border-slate-200
                   py-5
                   text-center
                   text-xs
                   text-slate-400"
        >
            © {{ date('Y') }} {{ $siteSetting?->site_name ?? 'KampusMart' }}.
            All rights reserved.
        </div>

    </footer>


    {{-- ========================================================= --}}
    {{-- MOBILE BOTTOM NAV --}}
    {{-- ========================================================= --}}

    <nav
        class="fixed
               inset-x-0
               bottom-0
               z-50
               border-t
               border-slate-200
               bg-white/95
               px-2
               shadow-[0_-8px_30px_rgba(15,23,42,0.08)]
               backdrop-blur-xl
               md:hidden"
    >

        <div
            class="mx-auto
                   grid
                   max-w-md
                   grid-cols-4"
        >

            <a
                href="{{ route('home') }}"
                class="flex
                       flex-col
                       items-center
                       justify-center
                       gap-1
                       py-3
                       text-[#315ebc]"
            >
                <i class="fa-solid fa-house text-base"></i>
                <span class="text-[9px] font-bold">Home</span>
            </a>

            <a
                href="#kategori"
                class="flex
                       flex-col
                       items-center
                       justify-center
                       gap-1
                       py-3
                       text-slate-400"
            >
                <i class="fa-solid fa-border-all text-base"></i>
                <span class="text-[9px] font-semibold">Kategori</span>
            </a>

            @auth

                @if (auth()->user()->role === 'buyer' && Route::has('buyer.cart.index'))
                    <a
                        href="{{ route('buyer.cart.index') }}"
                        class="flex
                               flex-col
                               items-center
                               justify-center
                               gap-1
                               py-3
                               text-slate-400"
                    >
                        <i class="fa-solid fa-cart-shopping text-base"></i>
                        <span class="text-[9px] font-semibold">Keranjang</span>
                    </a>
                @else
                    <a
                        href="{{ route('home') }}"
                        class="flex
                               flex-col
                               items-center
                               justify-center
                               gap-1
                               py-3
                               text-slate-400"
                    >
                        <i class="fa-solid fa-cart-shopping text-base"></i>
                        <span class="text-[9px] font-semibold">Keranjang</span>
                    </a>
                @endif

            @else

                <a
                    href="{{ route('login') }}"
                    class="flex
                           flex-col
                           items-center
                           justify-center
                           gap-1
                           py-3
                           text-slate-400"
                >
                    <i class="fa-solid fa-cart-shopping text-base"></i>
                    <span class="text-[9px] font-semibold">Keranjang</span>
                </a>

            @endauth


            @auth

                @if (auth()->user()->role === 'buyer')
                    <a
                        href="{{ route('buyer.dashboard') }}"
                        class="flex
                               flex-col
                               items-center
                               justify-center
                               gap-1
                               py-3
                               text-slate-400"
                    >
                        <i class="fa-regular fa-user text-base"></i>
                        <span class="text-[9px] font-semibold">Akun</span>
                    </a>
                @else
                    <a
                        href="{{ route('home') }}"
                        class="flex
                               flex-col
                               items-center
                               justify-center
                               gap-1
                               py-3
                               text-slate-400"
                    >
                        <i class="fa-regular fa-user text-base"></i>
                        <span class="text-[9px] font-semibold">Akun</span>
                    </a>
                @endif

            @else

                <a
                    href="{{ route('login') }}"
                    class="flex
                           flex-col
                           items-center
                           justify-center
                           gap-1
                           py-3
                           text-slate-400"
                >
                    <i class="fa-regular fa-user text-base"></i>
                    <span class="text-[9px] font-semibold">Masuk</span>
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

                async loadCategory(categoryId, categoryTitle) {

                    if (this.loading) {
                        return;
                    }

                    this.selectedCategory = categoryId;
                    this.title = categoryTitle;
                    this.loading = true;

                    const browserUrl = new URL(window.location.href);

                    const search =
                        browserUrl.searchParams.get('search') ?? '';

                    const requestUrl =
                        new URL(
                            this.filterUrl,
                            window.location.origin
                        );

                    if (categoryId !== null) {
                        requestUrl
                            .searchParams
                            .set(
                                'category',
                                categoryId
                            );
                    }

                    if (search.trim() !== '') {
                        requestUrl
                            .searchParams
                            .set(
                                'search',
                                search
                            );
                    }

                    try {

                        const response = await fetch(
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

                        this.$refs
                            .productGrid
                            .innerHTML =
                            data.html;

                        this.total =
                            data.total;

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
                            .replaceState(
                                {},
                                '',
                                browserUrl.toString()
                            );

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

                        this.loading = false;

                    }

                },

            };

        }
    </script>

</body>

</html>
