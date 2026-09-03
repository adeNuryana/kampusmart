@extends('layouts.seller')

@section('title', 'Dashboard Seller')

@section('content')

    <div class="mx-auto max-w-[1400px]">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section
            class="mb-6 flex flex-col gap-4
                   md:flex-row md:items-end
                   md:justify-between">

            <div>

                <div
                    class="inline-flex items-center gap-2
                           rounded-full bg-[#FBEAE2]
                           px-3 py-1.5
                           text-xs font-bold
                           text-[#A95E43]">

                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                        <path d="M4 10v10h16V10" />
                        <path d="M3 10l2-6h14l2 6" />
                        <path d="M8 20v-6h8v6" />

                    </svg>

                    Seller Center

                </div>


                <h1
                    class="mt-3 text-2xl
                           font-black tracking-tight
                           text-[#332B26]
                           lg:text-3xl">

                    Selamat datang,
                    {{ auth()->user()->name }}

                </h1>


                <p
                    class="mt-2 max-w-2xl
                           text-sm leading-6
                           text-slate-500">

                    Pantau performa toko, produk, stok,
                    serta pesanan terbaru dari pembeli.

                </p>

            </div>


            {{-- STORE --}}
            <div
                class="hidden items-center gap-3
                       rounded-2xl border
                       border-[#DFD2C7]
                       bg-white px-4 py-3
                       shadow-sm md:flex">

                <div
                    class="flex size-9
                           items-center justify-center
                           rounded-xl
                           bg-[#FBEAE2]
                           text-[#A95E43]">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                        <path d="M4 10v10h16V10" />
                        <path d="M3 10l2-6h14l2 6" />
                        <path d="M8 20v-6h8v6" />

                    </svg>

                </div>


                <div>

                    <p
                        class="text-[10px]
                               font-bold uppercase
                               tracking-wider
                               text-[#A28A7A]">

                        Toko

                    </p>

                    <p
                        class="mt-0.5 max-w-[200px]
                               truncate text-sm
                               font-bold text-[#4D4038]">

                        {{ auth()->user()?->sellerProfile?->store_name ?? 'Toko Saya' }}

                    </p>

                </div>

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- MAIN STATISTICS --}}
        {{-- ===================================================== --}}

        <section class="grid gap-4
                   sm:grid-cols-2
                   xl:grid-cols-4">


            {{-- TOTAL PRODUCT --}}
            <div
                class="relative overflow-hidden
                       rounded-3xl border
                       border-[#DFD2C7]
                       bg-white p-5 shadow-sm">

                <div class="absolute inset-x-0 top-0
                           h-1 bg-[#4371d1]">
                </div>


                <div class="flex items-start
                           justify-between gap-4">

                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase tracking-wide
                                   text-[#998274]">

                            Total Produk

                        </p>


                        <p
                            class="mt-5 text-3xl
                                   font-black
                                   tracking-tight
                                   text-[#332B26]">

                            {{ number_format($totalProducts) }}

                        </p>


                        <div class="mt-2 flex items-center gap-2
                                   text-xs text-slate-400">

                            <span class="size-1.5 rounded-full
                                       bg-[#718268]">
                            </span>

                            {{ number_format($activeProducts) }}
                            produk aktif

                        </div>

                    </div>


                    <div
                        class="flex size-11
                               shrink-0 items-center
                               justify-center
                               rounded-xl
                               bg-[#4371d1]
                               text-white">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <path d="M6 7h12l1 14H5L6 7Z" />
                            <path d="M9 7a3 3 0 0 1 6 0" />

                        </svg>

                    </div>

                </div>

            </div>



            {{-- NEW ORDER --}}
            <div
                class="relative overflow-hidden
                       rounded-3xl border
                       border-[#E8D8B9]
                       bg-white p-5 shadow-sm">

                <div class="absolute inset-x-0 top-0
                           h-1 bg-[#C89B55]">
                </div>


                <div class="flex items-start
                           justify-between gap-4">

                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase tracking-wide
                                   text-[#A87A37]">

                            Pesanan Baru

                        </p>


                        <p
                            class="mt-5 text-3xl
                                   font-black
                                   tracking-tight
                                   text-[#A87A37]">

                            {{ number_format($pendingOrders) }}

                        </p>


                        <p class="mt-2 text-xs
                                   text-slate-400">

                            Menunggu konfirmasi

                        </p>

                    </div>


                    <div
                        class="flex size-11
                               shrink-0 items-center
                               justify-center
                               rounded-xl
                               bg-[#C89B55]
                               text-white">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <path d="M6 3h12v18H6z" />
                            <path d="M9 8h6" />
                            <path d="M9 12h6" />

                        </svg>

                    </div>

                </div>

            </div>



            {{-- PROCESSING --}}
            <div
                class="relative overflow-hidden
                       rounded-3xl border
                       border-[#EBCFC2]
                       bg-white p-5 shadow-sm">

                <div class="absolute inset-x-0 top-0
                           h-1 bg-[#C8795A]">
                </div>


                <div class="flex items-start
                           justify-between gap-4">

                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase tracking-wide
                                   text-[#A95E43]">

                            Sedang Diproses

                        </p>


                        <p
                            class="mt-5 text-3xl
                                   font-black
                                   tracking-tight
                                   text-[#A95E43]">

                            {{ number_format($processingOrders) }}

                        </p>


                        <p class="mt-2 text-xs
                                   text-slate-400">

                            Dikonfirmasi & diproses

                        </p>

                    </div>


                    <div
                        class="flex size-11
                               shrink-0 items-center
                               justify-center
                               rounded-xl
                               bg-[#C8795A]
                               text-white">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 7v5l3 2" />

                        </svg>

                    </div>

                </div>

            </div>



            {{-- SALES --}}
            <a href="{{ route('seller.sales.index') }}"
                class="relative overflow-hidden
                       rounded-3xl border
                       border-[#D3DFCE]
                       bg-white p-5
                       shadow-sm
                       transition
                       hover:-translate-y-0.5
                       hover:shadow-md">

                <div class="absolute inset-x-0 top-0
                           h-1 bg-[#718268]">
                </div>


                <div class="flex items-start
                           justify-between gap-4">

                    <div class="min-w-0">

                        <p
                            class="text-xs font-bold
                                   uppercase tracking-wide
                                   text-[#65795E]">

                            Total Penjualan

                        </p>


                        <p
                            class="mt-5 truncate
                                   text-2xl font-black
                                   tracking-tight
                                   text-[#65795E]">

                            Rp{{ number_format($totalRevenue, 0, ',', '.') }}

                        </p>


                        <p class="mt-2 text-xs
                                   text-slate-400">

                            Dari pesanan selesai

                        </p>

                    </div>


                    <div
                        class="flex size-11
                               shrink-0 items-center
                               justify-center
                               rounded-xl
                               bg-[#718268]
                               text-white">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <path d="M4 19V9" />
                            <path d="M10 19V5" />
                            <path d="M16 19v-7" />
                            <path d="M22 19V3" />

                        </svg>

                    </div>

                </div>

            </a>

        </section>



        {{-- ===================================================== --}}
        {{-- SECONDARY STATISTICS --}}
        {{-- ===================================================== --}}

        <section class="mt-4 grid gap-4
                   sm:grid-cols-2">


            {{-- COMPLETED --}}
            <div
                class="flex items-center
                       justify-between
                       rounded-2xl
                       border border-[#D3DFCE]
                       bg-white p-5
                       shadow-sm">

                <div>

                    <p class="text-sm font-semibold
                               text-slate-500">

                        Pesanan Selesai

                    </p>


                    <p
                        class="mt-1 text-2xl
                               font-black
                               text-[#332B26]">

                        {{ number_format($completedOrders) }}

                    </p>

                </div>


                <div
                    class="flex size-10
                           items-center justify-center
                           rounded-xl
                           bg-[#EEF3EA]
                           text-[#65795E]">

                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <circle cx="12" cy="12" r="9" />
                        <path d="m8 12 2.5 2.5L16.5 8.5" />

                    </svg>

                </div>

            </div>



            {{-- LOW STOCK --}}
            <div
                class="flex items-center
                       justify-between
                       rounded-2xl
                       border border-[#E8D8B9]
                       bg-white p-5
                       shadow-sm">

                <div>

                    <p class="text-sm font-semibold
                               text-slate-500">

                        Stok Menipis

                    </p>


                    <p
                        class="mt-1 text-2xl
                               font-black
                               text-[#332B26]">

                        {{ number_format($lowStockProducts) }}

                    </p>

                </div>


                <div
                    class="flex size-10
                           items-center justify-center
                           rounded-xl
                           bg-[#FAF2DF]
                           text-[#A87A37]">

                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                        <circle cx="12" cy="12" r="9" />
                        <path d="M12 8v5" />
                        <path d="M12 17h.01" />

                    </svg>

                </div>

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- RECENT ORDERS + LOW STOCK --}}
        {{-- ===================================================== --}}

        <div class="mt-6 grid gap-6
                   xl:grid-cols-[minmax(0,2fr)_360px]">


            {{-- ================================================= --}}
            {{-- RECENT ORDERS --}}
            {{-- ================================================= --}}

            <section
                class="overflow-hidden
                       rounded-3xl border
                       border-[#DFD2C7]
                       bg-white shadow-sm">


                {{-- HEADER --}}
                <div
                    class="flex items-center
                           justify-between gap-4
                           border-b
                           border-[#E7DBD1]
                           bg-[#FAF7F2]
                           px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex size-9
                                   items-center justify-center
                                   rounded-xl
                                   bg-[#FBEAE2]
                                   text-[#A95E43]">

                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <path d="M6 3h12v18H6z" />
                                <path d="M9 8h6" />
                                <path d="M9 12h6" />

                            </svg>

                        </div>


                        <div>

                            <h2 class="font-bold
                                       text-[#332B26]">

                                Pesanan Terbaru

                            </h2>

                            <p class="mt-0.5 text-xs
                                       text-slate-500">

                                5 pesanan terakhir yang masuk.

                            </p>

                        </div>

                    </div>


                    @if (Route::has('seller.orders.index'))
                        <a href="{{ route('seller.orders.index') }}"
                            class="inline-flex items-center
                                   gap-1 text-xs
                                   font-bold
                                   text-[#A95E43]
                                   transition
                                   hover:text-[#8E4E38]">

                            Lihat Semua

                            <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">

                                <path d="m9 18 6-6-6-6" />

                            </svg>

                        </a>
                    @endif

                </div>



                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="w-full min-w-[720px]">

                        <thead class="bg-[#F8F3ED]">

                            <tr
                                class="text-left
                                       text-xs font-bold
                                       uppercase tracking-wide
                                       text-[#907A6C]">

                                <th class="px-5 py-3.5">
                                    Pesanan
                                </th>

                                <th class="px-5 py-3.5">
                                    Pembeli
                                </th>

                                <th class="px-5 py-3.5">
                                    Total
                                </th>

                                <th class="px-5 py-3.5">
                                    Status
                                </th>

                                <th class="px-5 py-3.5 text-right">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-[#EEE5DE]">

                            @forelse ($recentOrders as $order)
                                @php
                                    $statusClass = match ($order->status) {
                                        'pending' => 'border-[#E8D8B9] bg-[#FAF2DF] text-[#A87A37]',

                                        'confirmed' => 'border-[#DFD2C7] bg-[#F1E6DE] text-[#4371d1]',

                                        'processing' => 'border-[#EBCFC2] bg-[#FBEAE2] text-[#A95E43]',

                                        'completed', 'sold' => 'border-[#D3DFCE] bg-[#EEF3EA] text-[#65795E]',

                                        'cancelled' => 'border-[#ECD2CF] bg-[#FAEDEC] text-[#A65954]',

                                        default => 'border-slate-200 bg-slate-100 text-slate-600',
                                    };

                                    $statusDot = match ($order->status) {
                                        'pending' => 'bg-[#C89B55]',
                                        'confirmed' => 'bg-[#4371d1]',
                                        'processing' => 'bg-[#C8795A]',
                                        'completed', 'sold' => 'bg-[#718268]',
                                        'cancelled' => 'bg-[#A65954]',
                                        default => 'bg-slate-400',
                                    };

                                    $statusLabel = match ($order->status) {
                                        'pending' => 'Menunggu',
                                        'confirmed' => 'Dikonfirmasi',
                                        'processing' => 'Diproses',
                                        'completed' => 'Selesai',
                                        'sold' => 'Terjual',
                                        'cancelled' => 'Dibatalkan',
                                        default => ucfirst($order->status),
                                    };
                                @endphp


                                <tr
                                    class="text-sm transition
                                           hover:bg-[#FBF7F3]">


                                    {{-- ORDER --}}
                                    <td class="px-5 py-4">

                                        <p
                                            class="font-bold
                                                   text-[#332B26]">

                                            {{ $order->order_number }}

                                        </p>


                                        <p
                                            class="mt-1 text-xs
                                                   text-slate-400">

                                            {{ $order->created_at->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y, H:i') }}
                                            WIB

                                        </p>

                                    </td>



                                    {{-- BUYER --}}
                                    <td class="px-5 py-4">

                                        <p
                                            class="font-semibold
                                                   text-[#4D4038]">

                                            {{ $order->buyer_name }}

                                        </p>


                                        <p
                                            class="mt-1 text-xs
                                                   text-slate-400">

                                            {{ $order->items->sum('quantity') }}
                                            barang

                                        </p>

                                    </td>



                                    {{-- TOTAL --}}
                                    <td class="px-5 py-4">

                                        <p
                                            class="font-bold
                                                   text-[#332B26]">

                                            Rp{{ number_format($order->subtotal, 0, ',', '.') }}

                                        </p>

                                    </td>



                                    {{-- STATUS --}}
                                    <td class="px-5 py-4">

                                        <span
                                            class="inline-flex
                                                   items-center gap-2
                                                   rounded-full
                                                   border px-3 py-1.5
                                                   text-xs font-bold
                                                   {{ $statusClass }}">

                                            <span
                                                class="size-1.5
                                                       rounded-full
                                                       {{ $statusDot }}">
                                            </span>

                                            {{ $statusLabel }}

                                        </span>

                                    </td>



                                    {{-- ACTION --}}
                                    <td class="px-5 py-4">

                                        <div class="flex justify-end">

                                            @if (Route::has('seller.orders.show'))
                                                <a href="{{ route('seller.orders.show', $order) }}"
                                                    title="Detail Pesanan"
                                                    class="inline-flex size-9
                                                           items-center
                                                           justify-center
                                                           rounded-xl
                                                           text-[#8B7465]
                                                           transition
                                                           hover:bg-[#FBEAE2]
                                                           hover:text-[#A95E43]">

                                                    <svg class="size-4.5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.8">

                                                        <path d="M2 12s3.5-6 10-6
                                                                   10 6 10 6-3.5 6-10 6
                                                                   S2 12 2 12Z" />

                                                        <circle cx="12" cy="12" r="3" />

                                                    </svg>

                                                </a>
                                            @endif

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="5" class="px-6 py-14">

                                        <div class="text-center">

                                            <div
                                                class="mx-auto flex
                                                       size-14
                                                       items-center
                                                       justify-center
                                                       rounded-2xl
                                                       bg-[#F4EAE2]
                                                       text-[#4371d1]">

                                                <svg class="size-6" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.6">

                                                    <path d="M6 3h12v18H6z" />
                                                    <path d="M9 8h6" />
                                                    <path d="M9 12h6" />

                                                </svg>

                                            </div>


                                            <p
                                                class="mt-4 font-bold
                                                       text-[#4D4038]">

                                                Belum ada pesanan

                                            </p>


                                            <p
                                                class="mt-1 text-sm
                                                       text-slate-500">

                                                Pesanan dari pembeli
                                                akan muncul di sini.

                                            </p>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>



            {{-- ================================================= --}}
            {{-- LOW STOCK --}}
            {{-- ================================================= --}}

            <section
                class="overflow-hidden
                       rounded-3xl
                       border border-[#DFD2C7]
                       bg-white shadow-sm">


                {{-- HEADER --}}
                <div
                    class="flex items-center
                           justify-between gap-4
                           border-b
                           border-[#E7DBD1]
                           bg-[#FAF7F2]
                           px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex size-9
                                   items-center justify-center
                                   rounded-xl
                                   bg-[#FAF2DF]
                                   text-[#A87A37]">

                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <circle cx="12" cy="12" r="9" />
                                <path d="M12 8v5" />
                                <path d="M12 17h.01" />

                            </svg>

                        </div>


                        <div>

                            <h2 class="font-bold
                                       text-[#332B26]">

                                Stok Menipis

                            </h2>

                            <p class="mt-0.5 text-xs
                                       text-slate-500">

                                Stok 5 atau kurang.

                            </p>

                        </div>

                    </div>


                    @if (Route::has('seller.products.index'))
                        <a href="{{ route('seller.products.index') }}"
                            class="text-xs font-bold
                                   text-[#A87A37]
                                   transition
                                   hover:text-[#8E672F]">

                            Kelola

                        </a>
                    @endif

                </div>



                {{-- ITEMS --}}
                <div class="divide-y divide-[#EEE5DE]">

                    @forelse ($lowStockItems as $product)
                        <div class="flex items-center
                                   gap-3 p-4">


                            {{-- IMAGE --}}
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="size-12
                                           shrink-0
                                           rounded-xl
                                           border
                                           border-[#E7DBD1]
                                           object-cover">
                            @else
                                <div
                                    class="flex size-12
                                           shrink-0
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#FAF7F2]
                                           text-[#B19E91]">

                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.6">

                                        <rect x="3" y="3" width="18" height="18" rx="2" />

                                        <circle cx="8.5" cy="8.5" r="1.5" />

                                        <path d="m21 15-5-5L5 21" />

                                    </svg>

                                </div>
                            @endif


                            {{-- INFO --}}
                            <div class="min-w-0 flex-1">

                                <p
                                    class="truncate
                                           text-sm font-bold
                                           text-[#4D4038]">

                                    {{ $product->name }}

                                </p>


                                <p
                                    class="mt-1 truncate
                                           text-xs
                                           text-slate-400">

                                    {{ $product->category?->name ?? 'Tanpa kategori' }}

                                </p>

                            </div>


                            {{-- STOCK --}}
                            <div class="text-right">

                                @if ($product->stock <= 0)
                                    <span
                                        class="inline-flex
                                               rounded-lg
                                               bg-[#FAEDEC]
                                               px-2.5 py-1
                                               text-xs font-black
                                               text-[#A65954]">

                                        Habis

                                    </span>
                                @else
                                    <span
                                        class="inline-flex
                                               rounded-lg
                                               bg-[#FAF2DF]
                                               px-2.5 py-1
                                               text-xs font-black
                                               text-[#A87A37]">

                                        {{ $product->stock }}

                                    </span>
                                @endif


                                <p class="mt-1 text-[10px]
                                           text-slate-400">

                                    stok

                                </p>

                            </div>

                        </div>


                    @empty

                        <div class="px-6 py-14 text-center">

                            <div
                                class="mx-auto flex
                                       size-14
                                       items-center
                                       justify-center
                                       rounded-2xl
                                       bg-[#EEF3EA]
                                       text-[#65795E]">

                                <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">

                                    <circle cx="12" cy="12" r="9" />
                                    <path d="m8 12 2.5 2.5L16.5 8.5" />

                                </svg>

                            </div>


                            <p class="mt-4 font-bold
                                       text-[#4D4038]">

                                Stok produk aman

                            </p>


                            <p class="mt-1 text-sm
                                       text-slate-500">

                                Tidak ada produk dengan
                                stok menipis.

                            </p>

                        </div>
                    @endforelse

                </div>

            </section>

        </div>



        {{-- ===================================================== --}}
        {{-- QUICK ACTION --}}
        {{-- ===================================================== --}}

        <section class="mt-6">

            <div
                class="relative overflow-hidden
                       rounded-3xl
                       bg-gradient-to-r
                       from-[#A95E43]
                       via-[#B96F51]
                       to-[#4371d1]
                       p-6 text-white
                       shadow-sm
                       sm:p-7">


                {{-- DECORATION --}}
                <div
                    class="pointer-events-none
                           absolute -right-16
                           -top-20 size-56
                           rounded-full
                           border-[35px]
                           border-white/5">
                </div>


                <div
                    class="relative flex flex-col
                           gap-5 lg:flex-row
                           lg:items-center
                           lg:justify-between">

                    <div>

                        <div
                            class="inline-flex
                                   items-center gap-2
                                   rounded-full
                                   bg-white/10
                                   px-3 py-1.5
                                   text-[10px]
                                   font-bold uppercase
                                   tracking-[0.14em]
                                   text-white/80">

                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">

                                <path d="M4 10v10h16V10" />
                                <path d="M3 10l2-6h14l2 6" />

                            </svg>

                            Seller Center

                        </div>


                        <h2
                            class="mt-3
                                   text-xl font-black
                                   md:text-2xl">

                            Kelola toko lebih mudah

                        </h2>


                        <p
                            class="mt-2 max-w-xl
                                   text-sm leading-6
                                   text-white/75">

                            Tambahkan produk, perbarui stok,
                            dan proses pesanan pembeli melalui
                            dashboard seller KampusMart.

                        </p>

                    </div>



                    <div class="flex flex-wrap gap-3">

                        @if (Route::has('seller.products.create'))
                            <a href="{{ route('seller.products.create') }}"
                                class="inline-flex h-11
                                       items-center justify-center
                                       gap-2 rounded-xl
                                       bg-white px-5
                                       text-sm font-bold
                                       text-[#A95E43]
                                       shadow-sm transition
                                       hover:bg-[#FFF8F3]">

                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">

                                    <path d="M12 5v14" />
                                    <path d="M5 12h14" />

                                </svg>

                                Tambah Produk

                            </a>
                        @endif


                        @if (Route::has('seller.orders.index'))
                            <a href="{{ route('seller.orders.index') }}"
                                class="inline-flex h-11
                                       items-center justify-center
                                       gap-2 rounded-xl
                                       border border-white/25
                                       bg-white/10 px-5
                                       text-sm font-bold
                                       text-white
                                       transition
                                       hover:bg-white/20">

                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <path d="M6 3h12v18H6z" />
                                    <path d="M9 8h6" />
                                    <path d="M9 12h6" />

                                </svg>

                                Lihat Pesanan

                            </a>
                        @endif

                    </div>

                </div>

            </div>

        </section>

    </div>

@endsection
