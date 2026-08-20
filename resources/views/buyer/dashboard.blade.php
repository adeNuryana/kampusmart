@extends('layouts.public')

@section('title', 'Dashboard - KampusMart')

@section('content')

    @php

        /*
        |--------------------------------------------------------------------------
        | Dashboard Data
        |--------------------------------------------------------------------------
        |
        | Variable berikut aman jika controller belum mengirim datanya.
        | Nanti bisa kita hubungkan ke database.
        |
        */

        $cartCount = $cartCount ?? 0;

        $activeOrderCount = $activeOrderCount ?? 0;

        $completedOrderCount = $completedOrderCount ?? 0;

        $totalTransaction = $totalTransaction ?? 0;

        $recentOrders = $recentOrders ?? collect();

        $recommendedProducts = $recommendedProducts ?? collect();

        $latestProducts = $latestProducts ?? collect();

        /*
        |--------------------------------------------------------------------------
        | User
        |--------------------------------------------------------------------------
        */

        $buyer = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Product Colors
        |--------------------------------------------------------------------------
        */

        $productThemes = [
            [
                'bar' => 'from-[#6F4E37] via-[#8B6245] to-[#C89B55]',

                'badge' => 'bg-[#F4EAE2] text-[#6F4E37]',
            ],

            [
                'bar' => 'from-[#C8795A] via-[#B66F52] to-[#A95E43]',

                'badge' => 'bg-[#FBEAE2] text-[#A95E43]',
            ],

            [
                'bar' => 'from-[#7F9275] via-[#879A7D] to-[#65795E]',

                'badge' => 'bg-[#EEF3EA] text-[#65795E]',
            ],

            [
                'bar' => 'from-[#C89B55] via-[#D1A963] to-[#AC7D38]',

                'badge' => 'bg-[#FAF2DF] text-[#A87A37]',
            ],

            [
                'bar' => 'from-[#B97972] via-[#C98C84] to-[#9B5F59]',

                'badge' => 'bg-[#F8EDEC] text-[#9C625D]',
            ],
        ];

    @endphp



    <div
        class="min-h-screen
               bg-gradient-to-br
               from-[#FBF8F5]
               via-[#FAF5F1]
               to-[#F4EAE2]">


        <main
            class="mx-auto
                   max-w-7xl
                   px-4
                   py-5
                   pb-28
                   sm:px-5
                   sm:py-6
                   md:pb-10">


            {{-- ===================================================== --}}
            {{-- HERO / WELCOME --}}
            {{-- ===================================================== --}}

            <section
                class="relative
                       overflow-hidden
                       rounded-3xl
                       bg-gradient-to-br
                       from-[#38251C]
                       via-[#6F4E37]
                       to-[#A66D4B]
                       p-5
                       text-white
                       shadow-xl
                       shadow-[#6F4E37]/15
                       sm:p-7
                       md:p-8">


                {{-- DECORATION --}}

                <div
                    class="pointer-events-none
                           absolute
                           -left-20
                           -top-24
                           size-64
                           rounded-full
                           bg-[#E3B66D]/15
                           blur-3xl">
                </div>


                <div
                    class="pointer-events-none
                           absolute
                           -bottom-24
                           right-5
                           size-64
                           rounded-full
                           bg-[#C8795A]/20
                           blur-3xl">
                </div>


                <div
                    class="pointer-events-none
                           absolute
                           right-1/3
                           top-0
                           size-44
                           rounded-full
                           bg-[#B97972]/10
                           blur-3xl">
                </div>



                <div
                    class="relative
                           z-10
                           flex
                           flex-col
                           gap-6
                           lg:flex-row
                           lg:items-center
                           lg:justify-between">


                    {{-- WELCOME --}}

                    <div class="max-w-2xl">


                        <span
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
                                   font-medium
                                   backdrop-blur
                                   sm:px-4
                                   sm:py-2
                                   sm:text-sm">


                            <span
                                class="flex
                                       size-6
                                       items-center
                                       justify-center
                                       rounded-full
                                       bg-[#E3B66D]
                                       text-[#493124]">

                                <i
                                    class="fa-solid
                                           fa-user
                                           text-[10px]">
                                </i>

                            </span>

                            Dashboard Pembeli

                        </span>



                        <p
                            class="mt-5
                                   text-sm
                                   text-[#F0DED2]">

                            Selamat datang kembali,

                        </p>


                        <h1
                            class="mt-1
                                   text-2xl
                                   font-black
                                   tracking-tight
                                   sm:text-3xl
                                   md:text-4xl">

                            Halo,
                            {{ $buyer?->name ?? 'Buyer' }}

                            <span class="inline-block">
                                👋
                            </span>

                        </h1>


                        <p
                            class="mt-3
                                   max-w-xl
                                   text-sm
                                   leading-6
                                   text-[#F2E5DC]
                                   sm:text-base
                                   sm:leading-7">

                            Pantau aktivitas belanjamu, cek pesanan,
                            dan temukan berbagai produk menarik
                            dari seller KampusMart.

                        </p>



                        {{-- CTA --}}

                        <div
                            class="mt-6
                                   flex
                                   flex-wrap
                                   gap-3">


                            <a href="{{ route('home') }}#produk"
                                class="inline-flex
                                       items-center
                                       gap-2
                                       rounded-xl
                                       bg-white
                                       px-5
                                       py-2.5
                                       text-sm
                                       font-bold
                                       text-[#5B3B2B]
                                       shadow-lg
                                       shadow-black/10
                                       transition
                                       hover:-translate-y-0.5
                                       hover:bg-[#FFF9F5]
                                       hover:shadow-xl">

                                <i class="fa-solid
                                           fa-bag-shopping">
                                </i>

                                Mulai Belanja

                            </a>


                            @if (Route::has('buyer.cart.index'))
                                <a href="{{ route('buyer.cart.index') }}"
                                    class="inline-flex
                                           items-center
                                           gap-2
                                           rounded-xl
                                           border
                                           border-white/20
                                           bg-white/10
                                           px-5
                                           py-2.5
                                           text-sm
                                           font-semibold
                                           text-white
                                           backdrop-blur
                                           transition
                                           hover:bg-white/20">

                                    <i class="fa-solid
                                               fa-cart-shopping">
                                    </i>

                                    Keranjang

                                </a>
                            @endif

                        </div>

                    </div>



                    {{-- HERO CARD --}}

                    <div
                        class="grid
                               grid-cols-2
                               gap-3
                               sm:min-w-[320px]">


                        <div
                            class="rounded-2xl
                                   border
                                   border-white/10
                                   bg-white/10
                                   p-4
                                   backdrop-blur">

                            <p class="text-xs
                                       text-[#EAD9CD]">

                                Keranjang

                            </p>

                            <p
                                class="mt-1
                                       text-2xl
                                       font-black">

                                {{ $cartCount }}

                            </p>

                            <p
                                class="mt-1
                                       text-[10px]
                                       text-[#E8D6CA]">

                                produk tersimpan

                            </p>

                        </div>


                        <div
                            class="rounded-2xl
                                   border
                                   border-white/10
                                   bg-white/10
                                   p-4
                                   backdrop-blur">

                            <p class="text-xs
                                       text-[#EAD9CD]">

                                Pesanan Aktif

                            </p>

                            <p
                                class="mt-1
                                       text-2xl
                                       font-black">

                                {{ $activeOrderCount }}

                            </p>

                            <p
                                class="mt-1
                                       text-[10px]
                                       text-[#E8D6CA]">

                                sedang diproses

                            </p>

                        </div>

                    </div>

                </div>

            </section>



            {{-- ===================================================== --}}
            {{-- QUICK MENU / STATS --}}
            {{-- ===================================================== --}}

            <section
                class="mt-5
                       grid
                       grid-cols-2
                       gap-3
                       lg:grid-cols-4">


                {{-- CART --}}

                @if (Route::has('buyer.cart.index'))
                    <a href="{{ route('buyer.cart.index') }}"
                        class="group
                               rounded-2xl
                               border
                               border-[#E5D8CE]
                               bg-gradient-to-br
                               from-white
                               to-[#F8F0EA]
                               p-4
                               shadow-sm
                               transition
                               duration-300
                               hover:-translate-y-1
                               hover:shadow-lg">


                        <div
                            class="flex
                                   items-start
                                   justify-between
                                   gap-3">


                            <div
                                class="flex
                                       size-11
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-[#F4EAE2]
                                       text-[#6F4E37]
                                       transition
                                       group-hover:bg-[#6F4E37]
                                       group-hover:text-white">

                                <i class="fa-solid
                                           fa-cart-shopping">
                                </i>

                            </div>


                            <span
                                class="rounded-full
                                       bg-white
                                       px-2.5
                                       py-1
                                       text-xs
                                       font-bold
                                       text-[#6F4E37]
                                       shadow-sm">

                                {{ $cartCount }}

                            </span>

                        </div>


                        <p
                            class="mt-4
                                   text-sm
                                   font-bold
                                   text-slate-800">

                            Keranjang Saya

                        </p>


                        <p
                            class="mt-1
                                   text-xs
                                   leading-5
                                   text-slate-500">

                            Lihat produk yang ingin kamu beli.

                        </p>

                    </a>
                @endif



                {{-- ACTIVE ORDER --}}

                <a href="{{ Route::has('buyer.orders.index') ? route('buyer.orders.index') : '#' }}"
                    class="group
                           rounded-2xl
                           border
                           border-[#F1D4C2]
                           bg-gradient-to-br
                           from-[#FFF4EC]
                           to-[#FBE7D9]
                           p-4
                           shadow-sm
                           transition
                           duration-300
                           hover:-translate-y-1
                           hover:shadow-lg">


                    <div
                        class="flex
                               items-start
                               justify-between
                               gap-3">


                        <div
                            class="flex
                                   size-11
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-[#C8795A]
                                   text-white">

                            <i class="fa-solid
                                       fa-box">
                            </i>

                        </div>


                        <span
                            class="rounded-full
                                   bg-white/80
                                   px-2.5
                                   py-1
                                   text-xs
                                   font-bold
                                   text-[#A95E43]">

                            {{ $activeOrderCount }}

                        </span>

                    </div>


                    <p
                        class="mt-4
                               text-sm
                               font-bold
                               text-slate-800">

                        Pesanan Aktif

                    </p>


                    <p
                        class="mt-1
                               text-xs
                               leading-5
                               text-slate-500">

                        Pantau pesanan yang sedang diproses.

                    </p>

                </a>



                {{-- COMPLETED --}}

                <a href="{{ Route::has('buyer.orders.index') ? route('buyer.orders.index') : '#' }}"
                    class="group
                           rounded-2xl
                           border
                           border-[#D6E1D0]
                           bg-gradient-to-br
                           from-[#F1F5ED]
                           to-[#E3ECDD]
                           p-4
                           shadow-sm
                           transition
                           duration-300
                           hover:-translate-y-1
                           hover:shadow-lg">


                    <div
                        class="flex
                               items-start
                               justify-between
                               gap-3">


                        <div
                            class="flex
                                   size-11
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-[#7F9275]
                                   text-white">

                            <i class="fa-solid
                                       fa-circle-check">
                            </i>

                        </div>


                        <span
                            class="rounded-full
                                   bg-white/80
                                   px-2.5
                                   py-1
                                   text-xs
                                   font-bold
                                   text-[#65795E]">

                            {{ $completedOrderCount }}

                        </span>

                    </div>


                    <p
                        class="mt-4
                               text-sm
                               font-bold
                               text-slate-800">

                        Pesanan Selesai

                    </p>


                    <p
                        class="mt-1
                               text-xs
                               leading-5
                               text-slate-500">

                        Lihat riwayat transaksi yang selesai.

                    </p>

                </a>



                {{-- TRANSACTION --}}

                <div
                    class="rounded-2xl
                           border
                           border-[#ECD7AF]
                           bg-gradient-to-br
                           from-[#FAF3E4]
                           to-[#F4E4C5]
                           p-4
                           shadow-sm">


                    <div
                        class="flex
                               size-11
                               items-center
                               justify-center
                               rounded-xl
                               bg-[#C89B55]
                               text-white">

                        <i class="fa-solid
                                   fa-wallet">
                        </i>

                    </div>


                    <p
                        class="mt-4
                               text-sm
                               font-bold
                               text-slate-800">

                        Total Transaksi

                    </p>


                    <p
                        class="mt-1
                               text-lg
                               font-black
                               text-[#6F4E37]">

                        Rp{{ number_format($totalTransaction, 0, ',', '.') }}

                    </p>

                </div>

            </section>



            {{-- ===================================================== --}}
            {{-- RECENT ORDERS --}}
            {{-- ===================================================== --}}

            <section
                class="relative
                       mt-5
                       overflow-hidden
                       rounded-3xl
                       border
                       border-[#E7D9CF]
                       bg-white
                       shadow-sm">


                <div
                    class="pointer-events-none
                           absolute
                           -right-20
                           -top-20
                           size-48
                           rounded-full
                           bg-[#C8795A]/10
                           blur-3xl">
                </div>



                {{-- HEADER --}}

                <div
                    class="relative
                           flex
                           items-center
                           justify-between
                           gap-4
                           border-b
                           border-[#F0E5DD]
                           p-5
                           sm:p-6">


                    <div class="flex
                               items-center
                               gap-3">


                        <div
                            class="flex
                                   size-10
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-gradient-to-br
                                   from-[#C8795A]
                                   to-[#A95E43]
                                   text-white
                                   shadow-lg
                                   shadow-[#C8795A]/20">

                            <i class="fa-solid
                                       fa-clock-rotate-left">
                            </i>

                        </div>


                        <div>

                            <h2
                                class="text-lg
                                       font-bold
                                       text-slate-900
                                       sm:text-xl">

                                Pesanan Terbaru

                            </h2>


                            <p
                                class="mt-1
                                       text-xs
                                       text-slate-500
                                       sm:text-sm">

                                Pantau transaksi terakhirmu

                            </p>

                        </div>

                    </div>


                    @if (Route::has('buyer.orders.index'))
                        <a href="{{ route('buyer.orders.index') }}"
                            class="shrink-0
                                   text-xs
                                   font-semibold
                                   text-[#8B6245]
                                   transition
                                   hover:text-[#5B3B2B]
                                   sm:text-sm">

                            Lihat Semua

                            <i
                                class="fa-solid
                                       fa-chevron-right
                                       ml-1">
                            </i>

                        </a>
                    @endif

                </div>



                {{-- ORDERS --}}

                @if ($recentOrders->isNotEmpty())

                    <div class="divide-y
                               divide-[#F0E7E0]">


                        @foreach ($recentOrders as $order)
                            @php

                                $status = strtolower($order->status ?? '');

                                $statusClass = match ($status) {
                                    'pending' => 'bg-[#FAF2DF] text-[#A87A37]',

                                    'processing', 'diproses' => 'bg-[#FBEAE2] text-[#A95E43]',

                                    'shipped', 'dikirim' => 'bg-[#F4EAE2] text-[#6F4E37]',

                                    'completed', 'selesai' => 'bg-[#EEF3EA] text-[#65795E]',

                                    'cancelled', 'dibatalkan' => 'bg-[#FAEDEC] text-[#A65954]',

                                    default => 'bg-slate-100 text-slate-600',
                                };

                                $orderTotal = $order->total_amount ?? ($order->total ?? 0);

                            @endphp


                            <div
                                class="flex
                                       flex-col
                                       gap-4
                                       p-4
                                       transition
                                       hover:bg-[#FCF8F5]
                                       sm:flex-row
                                       sm:items-center
                                       sm:justify-between
                                       sm:px-6">


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
                                               rounded-xl
                                               bg-[#F4EAE2]
                                               text-[#6F4E37]">

                                        <i
                                            class="fa-solid
                                                   fa-bag-shopping">
                                        </i>

                                    </div>


                                    <div>

                                        <p
                                            class="text-sm
                                                   font-bold
                                                   text-slate-800">

                                            Pesanan
                                            #{{ $order->id }}

                                        </p>


                                        <p
                                            class="mt-1
                                                   text-xs
                                                   text-slate-500">

                                            {{ optional($order->created_at)->format('d M Y, H:i') }}

                                        </p>

                                    </div>

                                </div>



                                <div
                                    class="flex
                                           items-center
                                           justify-between
                                           gap-4
                                           sm:justify-end">


                                    <div class="text-right">

                                        <p
                                            class="text-[10px]
                                                   text-slate-400">

                                            Total

                                        </p>

                                        <p
                                            class="text-sm
                                                   font-bold
                                                   text-[#6F4E37]">

                                            Rp{{ number_format($orderTotal, 0, ',', '.') }}

                                        </p>

                                    </div>


                                    <span
                                        class="rounded-full
                                               px-3
                                               py-1.5
                                               text-[10px]
                                               font-semibold
                                               {{ $statusClass }}">

                                        {{ ucfirst($order->status ?? 'Pesanan') }}

                                    </span>

                                </div>

                            </div>
                        @endforeach

                    </div>
                @else
                    <div
                        class="relative
                               px-5
                               py-12
                               text-center">


                        <div
                            class="mx-auto
                                   flex
                                   size-16
                                   items-center
                                   justify-center
                                   rounded-2xl
                                   bg-gradient-to-br
                                   from-[#F4EAE2]
                                   to-[#EAD9CD]
                                   text-[#8B6245]">

                            <i
                                class="fa-solid
                                       fa-box-open
                                       text-2xl">
                            </i>

                        </div>


                        <h3
                            class="mt-4
                                   text-sm
                                   font-bold
                                   text-slate-700">

                            Belum ada pesanan

                        </h3>


                        <p
                            class="mx-auto
                                   mt-1
                                   max-w-sm
                                   text-xs
                                   leading-5
                                   text-slate-500">

                            Pesanan yang kamu buat akan
                            muncul di bagian ini.

                        </p>


                        <a href="{{ route('home') }}#produk"
                            class="mt-5
                                   inline-flex
                                   items-center
                                   gap-2
                                   rounded-xl
                                   bg-[#6F4E37]
                                   px-4
                                   py-2.5
                                   text-xs
                                   font-bold
                                   text-white
                                   transition
                                   hover:bg-[#5B3B2B]">

                            Mulai Belanja

                            <i class="fa-solid
                                       fa-arrow-right">
                            </i>

                        </a>

                    </div>

                @endif

            </section>



            {{-- ===================================================== --}}
            {{-- RECOMMENDATION --}}
            {{-- ===================================================== --}}

            @if ($recommendedProducts->isNotEmpty())

                <section
                    class="relative
                           mt-5
                           overflow-hidden
                           rounded-3xl
                           border
                           border-[#E8D6D1]
                           bg-gradient-to-br
                           from-white
                           via-[#FBF3F1]
                           to-[#F6ECE8]
                           p-4
                           shadow-sm
                           sm:p-6">


                    <div
                        class="pointer-events-none
                               absolute
                               -bottom-20
                               -left-20
                               size-52
                               rounded-full
                               bg-[#B97972]/10
                               blur-3xl">
                    </div>



                    {{-- HEADER --}}

                    <div
                        class="relative
                               mb-5
                               flex
                               items-end
                               justify-between
                               gap-4">


                        <div
                            class="flex
                                   items-center
                                   gap-3">


                            <div
                                class="flex
                                       size-10
                                       shrink-0
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-gradient-to-br
                                       from-[#8B6245]
                                       via-[#A66D4B]
                                       to-[#B97972]
                                       text-white
                                       shadow-lg
                                       shadow-[#6F4E37]/20">

                                <i class="fa-solid
                                           fa-wand-magic-sparkles">
                                </i>

                            </div>


                            <div>

                                <h2
                                    class="text-xl
                                           font-bold
                                           text-slate-900
                                           sm:text-2xl">

                                    Rekomendasi Untuk Kamu

                                </h2>


                                <p
                                    class="mt-1
                                           hidden
                                           text-sm
                                           text-slate-500
                                           sm:block">

                                    Produk yang mungkin kamu suka

                                </p>

                            </div>

                        </div>


                        <a href="{{ route('home') }}#produk"
                            class="shrink-0
                                   text-xs
                                   font-semibold
                                   text-[#8B6245]
                                   transition
                                   hover:text-[#5B3B2B]
                                   sm:text-sm">

                            Lihat Semua

                            <i
                                class="fa-solid
                                       fa-chevron-right
                                       ml-1">
                            </i>

                        </a>

                    </div>



                    {{-- PRODUCTS --}}

                    <div
                        class="relative
                               grid
                               grid-cols-2
                               gap-3
                               sm:grid-cols-3
                               sm:gap-4
                               lg:grid-cols-5">


                        @foreach ($recommendedProducts as $index => $product)
                            @php

                                $productImage = $product->image ?? ($product->photo ?? ($product->thumbnail ?? null));

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

                                $theme = $productThemes[$index % count($productThemes)];

                            @endphp


                            <a href="{{ route('buyer.products.show', $product) }}"
                                class="group
                                       overflow-hidden
                                       rounded-2xl
                                       border
                                       border-white
                                       bg-white/95
                                       shadow-sm
                                       transition
                                       duration-300
                                       hover:-translate-y-1.5
                                       hover:border-[#E3D3C7]
                                       hover:shadow-xl
                                       hover:shadow-[#6F4E37]/10">


                                <div
                                    class="h-1
                                           bg-gradient-to-r
                                           {{ $theme['bar'] }}">
                                </div>



                                {{-- IMAGE --}}

                                <div
                                    class="relative
                                           aspect-square
                                           overflow-hidden
                                           bg-[#F4EFEB]">


                                    @if ($imageUrl)
                                        <img src="{{ $imageUrl }}" alt="{{ $product->name }}" loading="lazy"
                                            class="size-full
                                                   object-cover
                                                   transition
                                                   duration-500
                                                   group-hover:scale-105">
                                    @else
                                        <div
                                            class="flex
                                                   size-full
                                                   items-center
                                                   justify-center
                                                   bg-gradient-to-br
                                                   from-[#F5EFEB]
                                                   to-[#EEE4DC]">

                                            <i
                                                class="fa-regular
                                                       fa-image
                                                       text-4xl
                                                       text-[#C7B4A7]">
                                            </i>

                                        </div>
                                    @endif


                                    @if ($product->category)
                                        <span
                                            class="absolute
                                                   bottom-2
                                                   left-2
                                                   max-w-[85%]
                                                   truncate
                                                   rounded-lg
                                                   px-2
                                                   py-1
                                                   text-[9px]
                                                   font-semibold
                                                   shadow-sm
                                                   {{ $theme['badge'] }}">

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
                                               sm:text-lg">

                                        Rp{{ number_format($product->price ?? 0, 0, ',', '.') }}

                                    </p>


                                    <div
                                        class="mt-3
                                               flex
                                               items-center
                                               justify-between
                                               gap-2">

                                        <span
                                            class="rounded-md
                                                   bg-[#FAF6F3]
                                                   px-2
                                                   py-1
                                                   text-[9px]
                                                   text-slate-500
                                                   sm:text-[10px]">

                                            Stok
                                            {{ $product->stock ?? 0 }}

                                        </span>


                                        @if ($product->user)
                                            <span
                                                class="max-w-20
                                                       truncate
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

                </section>

            @endif



            {{-- ===================================================== --}}
            {{-- LATEST PRODUCTS --}}
            {{-- ===================================================== --}}

            @if ($latestProducts->isNotEmpty())

                <section
                    class="relative
                           mt-5
                           overflow-hidden
                           rounded-3xl
                           border
                           border-[#E5D8CE]
                           bg-gradient-to-br
                           from-white
                           via-[#FCF8F5]
                           to-[#F5EEE8]
                           p-4
                           shadow-sm
                           sm:p-6">


                    {{-- HEADER --}}

                    <div
                        class="mb-5
                               flex
                               items-end
                               justify-between
                               gap-4">


                        <div
                            class="flex
                                   items-center
                                   gap-3">


                            <div
                                class="flex
                                       size-10
                                       shrink-0
                                       items-center
                                       justify-center
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

                                <h2
                                    class="text-xl
                                           font-bold
                                           text-slate-900
                                           sm:text-2xl">

                                    Produk Terbaru

                                </h2>


                                <p
                                    class="mt-1
                                           hidden
                                           text-sm
                                           text-slate-500
                                           sm:block">

                                    Produk terbaru di KampusMart

                                </p>

                            </div>

                        </div>


                        <a href="{{ route('home') }}#produk"
                            class="shrink-0
                                   text-xs
                                   font-semibold
                                   text-[#8B6245]
                                   transition
                                   hover:text-[#5B3B2B]
                                   sm:text-sm">

                            Lihat Semua

                            <i
                                class="fa-solid
                                       fa-chevron-right
                                       ml-1">
                            </i>

                        </a>

                    </div>



                    <div
                        class="grid
                               grid-cols-2
                               gap-3
                               sm:grid-cols-3
                               sm:gap-4
                               lg:grid-cols-5">


                        @foreach ($latestProducts as $index => $product)
                            @php

                                $productImage = $product->image ?? ($product->photo ?? ($product->thumbnail ?? null));

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

                                $theme = $productThemes[$index % count($productThemes)];

                            @endphp


                            <a href="{{ route('buyer.products.show', $product) }}"
                                class="group
                                       overflow-hidden
                                       rounded-2xl
                                       border
                                       border-white
                                       bg-white
                                       shadow-sm
                                       transition
                                       duration-300
                                       hover:-translate-y-1.5
                                       hover:border-[#E3D3C7]
                                       hover:shadow-xl
                                       hover:shadow-[#6F4E37]/10">


                                <div
                                    class="h-1
                                           bg-gradient-to-r
                                           {{ $theme['bar'] }}">
                                </div>


                                <div
                                    class="relative
                                           aspect-square
                                           overflow-hidden
                                           bg-[#F4EFEB]">


                                    @if ($imageUrl)
                                        <img src="{{ $imageUrl }}" alt="{{ $product->name }}" loading="lazy"
                                            class="size-full
                                                   object-cover
                                                   transition
                                                   duration-500
                                                   group-hover:scale-105">
                                    @else
                                        <div
                                            class="flex
                                                   size-full
                                                   items-center
                                                   justify-center
                                                   bg-gradient-to-br
                                                   from-[#F5EFEB]
                                                   to-[#EEE4DC]">

                                            <i
                                                class="fa-regular
                                                       fa-image
                                                       text-4xl
                                                       text-[#C7B4A7]">
                                            </i>

                                        </div>
                                    @endif


                                    @if ($product->category)
                                        <span
                                            class="absolute
                                                   bottom-2
                                                   left-2
                                                   max-w-[85%]
                                                   truncate
                                                   rounded-lg
                                                   px-2
                                                   py-1
                                                   text-[9px]
                                                   font-semibold
                                                   {{ $theme['badge'] }}">

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
                                               sm:text-lg">

                                        Rp{{ number_format($product->price ?? 0, 0, ',', '.') }}

                                    </p>


                                    <div
                                        class="mt-3
                                               flex
                                               items-center
                                               justify-between
                                               gap-2">

                                        <span
                                            class="rounded-md
                                                   bg-[#FAF6F3]
                                                   px-2
                                                   py-1
                                                   text-[9px]
                                                   text-slate-500">

                                            Stok
                                            {{ $product->stock ?? 0 }}

                                        </span>


                                        <span
                                            class="max-w-20
                                                   truncate
                                                   text-[9px]
                                                   text-slate-400">

                                            {{ $product->user?->name }}

                                        </span>

                                    </div>

                                </div>

                            </a>
                        @endforeach

                    </div>

                </section>

            @endif



            {{-- ===================================================== --}}
            {{-- QUICK ACTION --}}
            {{-- ===================================================== --}}

            <section
                class="mt-5
                       rounded-3xl
                       border
                       border-[#E5D8CE]
                       bg-white
                       p-4
                       shadow-sm
                       sm:p-6">


                <div class="mb-4">

                    <h2
                        class="text-lg
                               font-bold
                               text-slate-900">

                        Akses Cepat

                    </h2>

                    <p class="mt-1
                               text-xs
                               text-slate-500">

                        Kelola aktivitas akunmu dengan cepat.

                    </p>

                </div>


                <div
                    class="grid
                           grid-cols-2
                           gap-3
                           sm:grid-cols-3">


                    {{-- SHOP --}}

                    <a href="{{ route('home') }}#produk"
                        class="group
                               flex
                               items-center
                               gap-3
                               rounded-2xl
                               border
                               border-[#EEE2D9]
                               p-3
                               transition
                               hover:border-[#DCC9BB]
                               hover:bg-[#FBF6F2]">


                        <div
                            class="flex
                                   size-10
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-[#F4EAE2]
                                   text-[#6F4E37]
                                   transition
                                   group-hover:bg-[#6F4E37]
                                   group-hover:text-white">

                            <i class="fa-solid
                                       fa-bag-shopping">
                            </i>

                        </div>


                        <div>

                            <p
                                class="text-xs
                                       font-bold
                                       text-slate-700
                                       sm:text-sm">

                                Belanja

                            </p>

                            <p
                                class="hidden
                                       text-[10px]
                                       text-slate-400
                                       sm:block">

                                Cari produk

                            </p>

                        </div>

                    </a>



                    {{-- CART --}}

                    @if (Route::has('buyer.cart.index'))
                        <a href="{{ route('buyer.cart.index') }}"
                            class="group
                                   flex
                                   items-center
                                   gap-3
                                   rounded-2xl
                                   border
                                   border-[#EEE2D9]
                                   p-3
                                   transition
                                   hover:border-[#DCC9BB]
                                   hover:bg-[#FBF6F2]">


                            <div
                                class="flex
                                       size-10
                                       shrink-0
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-[#EEF3EA]
                                       text-[#65795E]">

                                <i class="fa-solid
                                           fa-cart-shopping">
                                </i>

                            </div>


                            <div>

                                <p
                                    class="text-xs
                                           font-bold
                                           text-slate-700
                                           sm:text-sm">

                                    Keranjang

                                </p>

                                <p
                                    class="hidden
                                           text-[10px]
                                           text-slate-400
                                           sm:block">

                                    Produk tersimpan

                                </p>

                            </div>

                        </a>
                    @endif



                    {{-- PROFILE --}}

                    <a href="{{ Route::has('buyer.profile.edit') ? route('buyer.profile.edit') : '#' }}"
                        class="group
                               flex
                               items-center
                               gap-3
                               rounded-2xl
                               border
                               border-[#EEE2D9]
                               p-3
                               transition
                               hover:border-[#DCC9BB]
                               hover:bg-[#FBF6F2]">


                        <div
                            class="flex
                                   size-10
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-[#FAF2DF]
                                   text-[#A87A37]">

                            <i class="fa-regular
                                       fa-user">
                            </i>

                        </div>


                        <div>

                            <p
                                class="text-xs
                                       font-bold
                                       text-slate-700
                                       sm:text-sm">

                                Profil

                            </p>

                            <p
                                class="hidden
                                       text-[10px]
                                       text-slate-400
                                       sm:block">

                                Kelola akun

                            </p>

                        </div>

                    </a>

                </div>

            </section>

        </main>

    </div>

@endsection
