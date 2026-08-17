@extends('layouts.seller')

@section('title', 'Dashboard Seller')

@section('content')

<div class="mx-auto max-w-[1400px]">

    {{-- =========================
        HEADER
    ========================== --}}
    <div
        class="mb-7 flex flex-col gap-4
               md:flex-row md:items-end
               md:justify-between"
    >

        <div>

            <p class="text-sm font-semibold text-violet-600">
                Seller Center
            </p>

            <h1
                class="mt-1 text-2xl font-bold
                       tracking-tight text-slate-900
                       lg:text-3xl"
            >
                Selamat datang,
                {{ auth()->user()->name }}
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Pantau produk dan aktivitas penjualan tokomu.
            </p>

        </div>

    </div>


    {{-- =========================
        STATISTIK
    ========================== --}}
    <div
        class="grid gap-4
               sm:grid-cols-2
               xl:grid-cols-4"
    >

        {{-- TOTAL PRODUK --}}
        <div
            class="rounded-2xl border
                   border-slate-200
                   bg-white p-5 shadow-sm"
        >

            <div class="flex items-start justify-between gap-4">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Total Produk
                    </p>

                    <p
                        class="mt-2 text-3xl font-bold
                               tracking-tight text-slate-900"
                    >
                        {{ number_format($totalProducts) }}
                    </p>

                    <p class="mt-2 text-xs text-slate-400">
                        {{ number_format($activeProducts) }}
                        produk aktif
                    </p>

                </div>


                <div
                    class="flex size-11 items-center
                           justify-center rounded-xl
                           bg-violet-50 text-violet-600"
                >

                    <svg
                        class="size-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="M6 7h12l1 14H5L6 7Z" />
                        <path d="M9 7a3 3 0 0 1 6 0" />
                    </svg>

                </div>

            </div>

        </div>


        {{-- PESANAN BARU --}}
        <div
            class="rounded-2xl border
                   border-slate-200
                   bg-white p-5 shadow-sm"
        >

            <div class="flex items-start justify-between gap-4">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Pesanan Baru
                    </p>

                    <p
                        class="mt-2 text-3xl font-bold
                               tracking-tight text-slate-900"
                    >
                        {{ number_format($pendingOrders) }}
                    </p>

                    <p class="mt-2 text-xs text-slate-400">
                        Menunggu konfirmasi
                    </p>

                </div>


                <div
                    class="flex size-11 items-center
                           justify-center rounded-xl
                           bg-amber-50 text-amber-600"
                >

                    <svg
                        class="size-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="M6 3h12v18H6z" />
                        <path d="M9 8h6" />
                        <path d="M9 12h6" />
                    </svg>

                </div>

            </div>

        </div>


        {{-- DIPROSES --}}
        <div
            class="rounded-2xl border
                   border-slate-200
                   bg-white p-5 shadow-sm"
        >

            <div class="flex items-start justify-between gap-4">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Sedang Diproses
                    </p>

                    <p
                        class="mt-2 text-3xl font-bold
                               tracking-tight text-slate-900"
                    >
                        {{ number_format($processingOrders) }}
                    </p>

                    <p class="mt-2 text-xs text-slate-400">
                        Dikonfirmasi & diproses
                    </p>

                </div>


                <div
                    class="flex size-11 items-center
                           justify-center rounded-xl
                           bg-blue-50 text-blue-600"
                >

                    <svg
                        class="size-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <circle cx="12" cy="12" r="9" />
                        <path d="M12 7v5l3 2" />
                    </svg>

                </div>

            </div>

        </div>


        {{-- OMZET --}}
        <a  href="{{ route('seller.sales.index') }}"class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-start justify-between gap-4">

                <div class="min-w-0">

                    <p class="text-sm font-medium text-slate-500">
                        Total Penjualan
                    </p>

                    <p
                        class="mt-2 truncate text-2xl
                               font-bold tracking-tight
                               text-slate-900"
                    >
                        Rp {{ number_format(
                            $totalRevenue,
                            0,
                            ',',
                            '.'
                        ) }}
                    </p>

                    <p class="mt-2 text-xs text-slate-400">
                        Dari pesanan selesai
                    </p>

                </div>


                <div
                    class="flex size-11 shrink-0
                           items-center justify-center
                           rounded-xl bg-green-50
                           text-green-600"
                >

                    <svg
                        class="size-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="M4 19V9" />
                        <path d="M10 19V5" />
                        <path d="M16 19v-7" />
                        <path d="M22 19V3" />
                    </svg>

                </div>

            </div>

        </a>

    </div>


    {{-- =========================
        INFO SECONDARY
    ========================== --}}
    <div class="mt-4 grid gap-4 sm:grid-cols-2">

        {{-- SELESAI --}}
        <div
            class="flex items-center justify-between
                   rounded-2xl border
                   border-slate-200 bg-white
                   p-5 shadow-sm"
        >

            <div>

                <p class="text-sm font-medium text-slate-500">
                    Pesanan Selesai
                </p>

                <p
                    class="mt-1 text-2xl font-bold
                           text-slate-900"
                >
                    {{ number_format($completedOrders) }}
                </p>

            </div>

            <div
                class="flex size-10 items-center
                       justify-center rounded-full
                       bg-green-50 text-green-600"
            >
                ✓
            </div>

        </div>


        {{-- LOW STOCK --}}
        <div
            class="flex items-center justify-between
                   rounded-2xl border
                   border-slate-200 bg-white
                   p-5 shadow-sm"
        >

            <div>

                <p class="text-sm font-medium text-slate-500">
                    Stok Menipis
                </p>

                <p
                    class="mt-1 text-2xl font-bold
                           text-slate-900"
                >
                    {{ number_format($lowStockProducts) }}
                </p>

            </div>

            <div
                class="flex size-10 items-center
                       justify-center rounded-full
                       bg-amber-50 text-amber-600"
            >
                !
            </div>

        </div>

    </div>


    {{-- =========================
        TRANSAKSI + STOK
    ========================== --}}
    <div
        class="mt-7 grid gap-6
               xl:grid-cols-3"
    >

        {{-- PESANAN TERBARU --}}
        <div
            class="overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white shadow-sm
                   xl:col-span-2"
        >

            <div
                class="flex items-center justify-between
                       border-b border-slate-100
                       px-5 py-4"
            >

                <div>

                    <h2 class="font-semibold text-slate-900">
                        Pesanan Terbaru
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        5 pesanan terakhir yang masuk.
                    </p>

                </div>


                @if (Route::has('seller.orders.index'))

                    <a
                        href="{{ route('seller.orders.index') }}"
                        class="text-sm font-semibold
                               text-violet-600
                               hover:text-violet-700"
                    >
                        Lihat Semua
                    </a>

                @endif

            </div>


            <div class="overflow-x-auto">

                <table class="w-full min-w-[700px]">

                    <thead class="bg-slate-50">

                        <tr
                            class="text-left text-xs
                                   font-semibold uppercase
                                   tracking-wide
                                   text-slate-500"
                        >

                            <th class="px-5 py-3">
                                Pesanan
                            </th>

                                                        <th class="px-5 py-3">
                                Pembeli
                            </th>

                            <th class="px-5 py-3">
                                Total
                            </th>

                            <th class="px-5 py-3">
                                Status
                            </th>

                            <th class="px-5 py-3 text-right">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($recentOrders as $order)

                            <tr
                                class="text-sm transition
                                       hover:bg-slate-50/70"
                            >

                                {{-- NOMOR PESANAN --}}
                                <td class="px-5 py-4">

                                    <p class="font-semibold text-slate-900">
                                        {{ $order->order_number }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </p>

                                </td>


                                {{-- PEMBELI --}}
                                <td class="px-5 py-4">

                                    <p class="font-medium text-slate-800">
                                        {{ $order->buyer_name }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $order->items->sum('quantity') }}
                                        barang
                                    </p>

                                </td>


                                {{-- TOTAL --}}
                                <td class="px-5 py-4">

                                    <p class="font-semibold text-slate-900">
                                        Rp {{ number_format(
                                            $order->subtotal,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </p>

                                </td>


                                {{-- STATUS --}}
                                <td class="px-5 py-4">

                                    @php

                                        $statusClass = match ($order->status) {

                                            'pending' =>
                                                'bg-amber-50 text-amber-700',

                                            'confirmed' =>
                                                'bg-blue-50 text-blue-700',

                                            'processing' =>
                                                'bg-violet-50 text-violet-700',

                                            'completed' =>
                                                'bg-green-50 text-green-700',

                                            'cancelled' =>
                                                'bg-red-50 text-red-700',

                                            default =>
                                                'bg-slate-100 text-slate-600',
                                        };


                                        $statusLabel = match ($order->status) {

                                            'pending' =>
                                                'Menunggu',

                                            'confirmed' =>
                                                'Dikonfirmasi',

                                            'processing' =>
                                                'Diproses',

                                            'completed' =>
                                                'Selesai',

                                            'cancelled' =>
                                                'Dibatalkan',

                                            default =>
                                                ucfirst($order->status),
                                        };

                                    @endphp


                                    <span
                                        class="inline-flex rounded-full
                                               px-3 py-1.5
                                               text-xs font-semibold
                                               {{ $statusClass }}"
                                    >
                                        {{ $statusLabel }}
                                    </span>

                                </td>


                                {{-- ACTION --}}
                                <td class="px-5 py-4">

                                    <div class="flex justify-end">

                                        @if (Route::has('seller.orders.show'))

                                            <a
                                                href="{{ route(
                                                    'seller.orders.show',
                                                    $order
                                                ) }}"
                                                class="inline-flex
                                                       size-9 items-center
                                                       justify-center
                                                       rounded-lg
                                                       text-slate-500
                                                       transition
                                                       hover:bg-violet-50
                                                       hover:text-violet-600"
                                                title="Detail Pesanan"
                                            >

                                                <svg
                                                    class="size-5"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path
                                                        d="M2 12s3.5-6 10-6
                                                           10 6 10 6-3.5 6-10 6
                                                           S2 12 2 12Z"
                                                    />

                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="3"
                                                    />
                                                </svg>

                                            </a>

                                        @endif

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-6 py-14 text-center"
                                >

                                    <div
                                        class="mx-auto flex size-14
                                               items-center justify-center
                                               rounded-2xl bg-slate-100"
                                    >

                                        <svg
                                            class="size-7 text-slate-400"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                        >
                                            <path d="M6 3h12v18H6z" />
                                            <path d="M9 8h6" />
                                            <path d="M9 12h6" />
                                        </svg>

                                    </div>

                                    <p
                                        class="mt-4 font-semibold
                                               text-slate-700"
                                    >
                                        Belum ada pesanan
                                    </p>

                                    <p
                                        class="mt-1 text-sm
                                               text-slate-500"
                                    >
                                        Pesanan pembeli akan muncul di sini.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- =========================
            STOK MENIPIS
        ========================== --}}
        <div
            class="overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white shadow-sm"
        >

            <div
                class="flex items-center justify-between
                       border-b border-slate-100
                       px-5 py-4"
            >

                <div>

                    <h2 class="font-semibold text-slate-900">
                        Stok Menipis
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        Produk dengan stok 5 atau kurang.
                    </p>

                </div>


                @if (Route::has('seller.products.index'))

                    <a
                        href="{{ route('seller.products.index') }}"
                        class="text-sm font-semibold
                               text-violet-600
                               hover:text-violet-700"
                    >
                        Kelola
                    </a>

                @endif

            </div>


            <div class="divide-y divide-slate-100">

                @forelse ($lowStockItems as $product)

                    <div
                        class="flex items-center
                               gap-4 p-5"
                    >

                        {{-- IMAGE --}}
                        @if ($product->image)

                            <img
                                src="{{ asset(
                                    'storage/' .
                                    $product->image
                                ) }}"
                                alt="{{ $product->name }}"
                                class="size-12 shrink-0
                                       rounded-xl object-cover"
                            >

                        @else

                            <div
                                class="flex size-12 shrink-0
                                       items-center justify-center
                                       rounded-xl bg-slate-100"
                            >

                                <svg
                                    class="size-6 text-slate-300"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                >
                                    <rect
                                        x="3"
                                        y="3"
                                        width="18"
                                        height="18"
                                        rx="2"
                                    />

                                    <path d="m21 15-5-5L5 21" />
                                </svg>

                            </div>

                        @endif


                        {{-- INFO --}}
                        <div class="min-w-0 flex-1">

                            <p
                                class="truncate text-sm
                                       font-semibold
                                       text-slate-800"
                            >
                                {{ $product->name }}
                            </p>

                            <p
                                class="mt-1 truncate
                                       text-xs text-slate-400"
                            >
                                {{ $product->category?->name
                                    ?? 'Tanpa kategori' }}
                            </p>

                        </div>


                        {{-- STOCK --}}
                        <div class="text-right">

                            <span
                                class="inline-flex rounded-lg
                                       bg-amber-50 px-2.5 py-1
                                       text-xs font-bold
                                       text-amber-700"
                            >
                                {{ $product->stock }}
                            </span>

                            <p class="mt-1 text-[11px] text-slate-400">
                                stok
                            </p>

                        </div>

                    </div>


                @empty

                    <div class="px-6 py-14 text-center">

                        <div
                            class="mx-auto flex size-14
                                   items-center justify-center
                                   rounded-2xl bg-green-50
                                   text-green-600"
                        >
                            ✓
                        </div>

                        <p
                            class="mt-4 font-semibold
                                   text-slate-700"
                        >
                            Stok produk aman
                        </p>

                        <p
                            class="mt-1 text-sm
                                   text-slate-500"
                        >
                            Tidak ada produk dengan stok menipis.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- =========================
        QUICK ACTION
    ========================== --}}
    <div class="mt-7">

        <div
            class="rounded-2xl
                   bg-gradient-to-r
                   from-violet-600 to-indigo-600
                   p-6 text-white
                   shadow-sm"
        >

            <div
                class="flex flex-col gap-5
                       lg:flex-row
                       lg:items-center
                       lg:justify-between"
            >

                <div>

                    <p
                        class="text-xs font-semibold
                               uppercase tracking-wider
                               text-violet-200"
                    >
                        Seller Center
                    </p>

                    <h2
                        class="mt-2 text-xl
                               font-bold md:text-2xl"
                    >
                        Kelola toko lebih mudah
                    </h2>

                    <p
                        class="mt-2 max-w-xl
                               text-sm leading-6
                               text-violet-100"
                    >
                        Tambahkan produk, pantau stok, dan proses
                        pesanan pembeli melalui dashboard seller.
                    </p>

                </div>


                <div class="flex flex-wrap gap-3">

                    @if (Route::has('seller.products.create'))

                        <a
                            href="{{ route('seller.products.create') }}"
                            class="inline-flex h-11
                                   items-center justify-center
                                   rounded-xl bg-white
                                   px-5 text-sm font-semibold
                                   text-violet-700 transition
                                   hover:bg-violet-50"
                        >
                            Tambah Produk
                        </a>

                    @endif


                    @if (Route::has('seller.orders.index'))

                        <a
                            href="{{ route('seller.orders.index') }}"
                            class="inline-flex h-11
                                   items-center justify-center
                                   rounded-xl border
                                   border-white/30
                                   bg-white/10 px-5
                                   text-sm font-semibold
                                   text-white transition
                                   hover:bg-white/20"
                        >
                            Lihat Pesanan
                        </a>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
