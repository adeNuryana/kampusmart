@extends('layouts.seller')

@section('title', 'Laporan Penjualan')

@section('content')

<div class="mx-auto max-w-[1400px]">

    {{-- HEADER --}}
    <div
        class="mb-7 flex flex-col gap-4
               lg:flex-row lg:items-end
               lg:justify-between"
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
                Laporan Penjualan
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Pantau performa transaksi dan penjualan tokomu.
            </p>

        </div>

    </div>


    {{-- =========================
        FILTER
    ========================== --}}
    <div
        class="mb-6 rounded-2xl
               border border-slate-200
               bg-white p-5 shadow-sm"
    >

        <form
            action="{{ route('seller.sales.index') }}"
            method="GET"
            class="grid gap-4
                   sm:grid-cols-2
                   lg:grid-cols-4"
        >

            {{-- DATE FROM --}}
            <div>

                <label
                    for="date_from"
                    class="mb-2 block
                           text-sm font-medium
                           text-slate-700"
                >
                    Dari Tanggal
                </label>

                <input
                    type="date"
                    name="date_from"
                    id="date_from"
                    value="{{ request('date_from') }}"
                    class="h-11 w-full
                           rounded-xl border
                           border-slate-200
                           px-4 text-sm
                           outline-none
                           focus:border-violet-400
                           focus:ring-4
                           focus:ring-violet-100"
                >

            </div>


            {{-- DATE TO --}}
            <div>

                <label
                    for="date_to"
                    class="mb-2 block
                           text-sm font-medium
                           text-slate-700"
                >
                    Sampai Tanggal
                </label>

                <input
                    type="date"
                    name="date_to"
                    id="date_to"
                    value="{{ request('date_to') }}"
                    class="h-11 w-full
                           rounded-xl border
                           border-slate-200
                           px-4 text-sm
                           outline-none
                           focus:border-violet-400
                           focus:ring-4
                           focus:ring-violet-100"
                >

            </div>


            {{-- BUTTON --}}
            <div class="flex items-end">

                <button
                    type="submit"
                    class="h-11 w-full
                           rounded-xl bg-violet-600
                           px-5 text-sm
                           font-semibold text-white
                           transition
                           hover:bg-violet-700"
                >
                    Terapkan Filter
                </button>

            </div>


            {{-- RESET --}}
            <div class="flex items-end">

                <a
                    href="{{ route('seller.sales.index') }}"
                    class="inline-flex h-11 w-full
                           items-center justify-center
                           rounded-xl border
                           border-slate-200
                           px-5 text-sm
                           font-semibold
                           text-slate-600
                           transition
                           hover:bg-slate-50"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- =========================
        STATISTIC
    ========================== --}}
    <div
        class="grid gap-4
               sm:grid-cols-2
               xl:grid-cols-3"
    >

        {{-- REVENUE --}}
        <div
            class="rounded-2xl border
                   border-slate-200
                   bg-white p-5 shadow-sm"
        >

            <div class="flex items-start justify-between gap-4">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Total Omzet
                    </p>

                    <p
                        class="mt-2 text-2xl
                               font-bold text-slate-900"
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
                    class="flex size-11 items-center
                           justify-center rounded-xl
                           bg-green-50 text-green-600"
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

        </div>


        {{-- ORDERS --}}
        <div
            class="rounded-2xl border
                   border-slate-200
                   bg-white p-5 shadow-sm"
        >

            <div class="flex items-start justify-between gap-4">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Transaksi Selesai
                    </p>

                    <p
                        class="mt-2 text-3xl
                               font-bold text-slate-900"
                    >
                        {{ number_format(
                            $totalCompletedOrders
                        ) }}
                    </p>

                    <p class="mt-2 text-xs text-slate-400">
                        Total order selesai
                    </p>

                </div>


                <div
                    class="flex size-11 items-center
                           justify-center rounded-xl
                           bg-violet-50 text-violet-600"
                >
                    ✓
                </div>

            </div>

        </div>


        {{-- ITEMS --}}
        <div
            class="rounded-2xl border
                   border-slate-200
                   bg-white p-5 shadow-sm"
        >

            <div class="flex items-start justify-between gap-4">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Produk Terjual
                    </p>

                    <p
                        class="mt-2 text-3xl
                               font-bold text-slate-900"
                    >
                        {{ number_format(
                            $totalItemsSold
                        ) }}
                    </p>

                    <p class="mt-2 text-xs text-slate-400">
                        Total unit terjual
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
                        <path d="M6 7h12l1 14H5L6 7Z" />
                        <path d="M9 7a3 3 0 0 1 6 0" />
                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
        BEST SELLER + SALES
    ========================== --}}
    <div
        class="mt-7 grid gap-6
               xl:grid-cols-3"
    >

        {{-- BEST SELLING --}}
        <div
            class="rounded-2xl border
                   border-slate-200
                   bg-white shadow-sm"
        >

            <div
                class="border-b border-slate-100
                       px-5 py-4"
            >

                <h2 class="font-semibold text-slate-900">
                    Produk Terlaris
                </h2>

                <p class="mt-1 text-xs text-slate-400">
                    Berdasarkan jumlah unit terjual.
                </p>

            </div>


            <div class="divide-y divide-slate-100">

                @forelse ($bestSellingProducts as $index => $product)

                    <div
                        class="flex items-center
                               gap-4 px-5 py-4"
                    >

                        {{-- RANK --}}
                        <div
                            class="flex size-9 shrink-0
                                   items-center justify-center
                                   rounded-xl
                                   bg-violet-50
                                   text-sm font-bold
                                   text-violet-700"
                        >
                            {{ $index + 1 }}
                        </div>


                        <div class="min-w-0 flex-1">

                            <p
                                class="truncate text-sm
                                       font-semibold
                                       text-slate-800"
                            >
                                {{ $product->product_name }}
                            </p>

                            <p
                                class="mt-1 text-xs
                                       text-slate-400"
                            >
                                {{ number_format(
                                    $product->total_sold
                                ) }}
                                unit terjual
                            </p>

                        </div>


                        <div class="text-right">

                            <p
                                class="text-xs font-semibold
                                       text-slate-600"
                            >
                                Rp {{ number_format(
                                    $product->total_revenue,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </p>

                        </div>

                    </div>


                @empty

                    <div class="px-6 py-14 text-center">

                        <p class="font-semibold text-slate-700">
                            Belum ada data
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            Produk terlaris akan muncul setelah ada transaksi selesai.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- RIWAYAT SALES --}}
        <div
            class="overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white shadow-sm
                   xl:col-span-2"
        >

            <div
                class="border-b border-slate-100
                       px-5 py-4"
            >

                <h2 class="font-semibold text-slate-900">
                    Riwayat Penjualan
                </h2>

                <p class="mt-1 text-xs text-slate-400">
                    Daftar transaksi yang telah selesai.
                </p>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full min-w-[800px]">

                    <thead class="bg-slate-50">

                        <tr
                            class="text-left text-xs
                                   font-semibold uppercase
                                   tracking-wide
                                   text-slate-500"
                        >

                            <th class="px-5 py-4">
                                Pesanan
                            </th>

                            <th class="px-5 py-4">
                                Pembeli
                            </th>

                            <th class="px-5 py-4">
                                Barang
                            </th>

                            <th class="px-5 py-4">
                                Total
                            </th>

                            <th class="px-5 py-4">
                                Tanggal
                            </th>

                            <th class="px-5 py-4 text-right">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($sales as $sale)

                            <tr
                                class="text-sm
                                       transition
                                       hover:bg-slate-50/70"
                            >

                                {{-- ORDER --}}
                                <td class="px-5 py-4">

                                    <p
                                        class="font-semibold
                                               text-slate-900"
                                    >
                                        {{ $sale->order_number }}
                                    </p>

                                </td>


                                {{-- BUYER --}}
                                <td class="px-5 py-4">

                                    <p
                                        class="font-medium
                                               text-slate-800"
                                    >
                                        {{ $sale->buyer_name }}
                                    </p>

                                    <p
                                        class="mt-1 text-xs
                                               text-slate-400"
                                    >
                                        {{ $sale->buyer_phone ?? '-' }}
                                    </p>

                                </td>


                                {{-- ITEMS --}}
                                <td class="px-5 py-4 text-slate-600">

                                    {{ $sale->items->sum('quantity') }}
                                    barang

                                </td>


                                {{-- TOTAL --}}
                                <td class="px-5 py-4">

                                    <span
                                        class="font-semibold
                                               text-slate-900"
                                    >
                                        Rp {{ number_format(
                                            $sale->subtotal,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </span>

                                </td>


                                {{-- DATE --}}
                                <td class="px-5 py-4">

                                    <p class="text-slate-600">
                                        {{ $sale->created_at
                                            ->format('d M Y') }}
                                    </p>

                                    <p
                                        class="mt-1 text-xs
                                               text-slate-400"
                                    >
                                        {{ $sale->created_at
                                            ->format('H:i') }}
                                    </p>

                                </td>


                                {{-- ACTION --}}
                                <td class="px-5 py-4">

                                    <div class="flex justify-end">

                                        <a
                                            href="{{ route(
                                                'seller.orders.show',
                                                $sale
                                            ) }}"
                                            title="Detail Transaksi"
                                            class="inline-flex
                                                   size-9
                                                   items-center
                                                   justify-center
                                                   rounded-lg
                                                   text-slate-500
                                                   transition
                                                   hover:bg-violet-50
                                                   hover:text-violet-600"
                                        >

                                            <svg
                                                class="size-5"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path
                                                    d="M2 12s3.5-6
                                                       10-6 10 6
                                                       10 6-3.5
                                                       6-10 6S2
                                                       12 2 12Z"
                                                />

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="3"
                                                />
                                            </svg>

                                        </a>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-16
                                           text-center"
                                >

                                    <p
                                        class="font-semibold
                                               text-slate-700"
                                    >
                                        Belum ada penjualan
                                    </p>

                                    <p
                                        class="mt-1 text-sm
                                               text-slate-500"
                                    >
                                        Transaksi yang selesai akan muncul di sini.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if ($sales->hasPages())

                <div
                    class="border-t
                           border-slate-200
                           px-5 py-4"
                >
                    {{ $sales->links() }}
                </div>

            @endif

        </div>

    </div>

</div>

@endsection
