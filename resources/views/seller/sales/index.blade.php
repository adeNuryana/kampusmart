@extends('layouts.seller')

@section('title', 'Laporan Penjualan')

@section('content')

    <div class="mx-auto max-w-[1400px]">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section
            class="mb-6 flex flex-col gap-4
                   lg:flex-row lg:items-end
                   lg:justify-between">

            <div>

                <div
                    class="inline-flex items-center gap-2
                           rounded-full bg-[#FBEAE2]
                           px-3 py-1.5
                           text-xs font-bold
                           text-[#A95E43]">

                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                        <path d="M4 19V9" />
                        <path d="M10 19V5" />
                        <path d="M16 19v-7" />
                        <path d="M22 19V3" />

                    </svg>

                    Seller Center

                </div>


                <h1
                    class="mt-3 text-2xl
                           font-black tracking-tight
                           text-[#332B26]
                           lg:text-3xl">

                    Laporan Penjualan

                </h1>


                <p
                    class="mt-2 max-w-2xl
                           text-sm leading-6
                           text-slate-500">

                    Pantau omzet, jumlah transaksi,
                    produk terjual, dan riwayat penjualan tokomu.

                </p>



                <a href="{{ route('seller.export.pdf', request()->query()) }}"
                    class="inline-flex h-11
           items-center justify-center
           gap-2 rounded-xl
           bg-[#C8795A]
           px-5
           text-sm font-bold
           text-white
           shadow-sm transition
           hover:bg-[#B66F52]
           hover:shadow-md">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                        <path d="M12 3v12" />
                        <path d="m7 10 5 5 5-5" />
                        <path d="M5 21h14" />

                    </svg>

                    Export PDF

                </a>
            </div>
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
        {{-- FILTER --}}
        {{-- ===================================================== --}}

        <section
            class="mb-6 overflow-hidden
                   rounded-3xl
                   border border-[#DFD2C7]
                   bg-white shadow-sm">

            <div
                class="border-b
                       border-[#E7DBD1]
                       bg-[#FAF7F2]
                       px-5 py-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex size-9
                               items-center justify-center
                               rounded-xl
                               bg-[#F4EAE2]
                               text-[#4371d1]">

                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <rect x="3" y="5" width="18" height="16" rx="2" />

                            <path d="M16 3v4" />
                            <path d="M8 3v4" />
                            <path d="M3 10h18" />

                        </svg>

                    </div>


                    <div>

                        <h2 class="text-sm font-bold
                                   text-[#332B26]">

                            Periode Laporan

                        </h2>

                        <p class="mt-0.5 text-xs
                                   text-slate-500">

                            Tentukan rentang tanggal untuk melihat data penjualan.

                        </p>

                    </div>

                </div>

            </div>


            <form action="{{ route('seller.sales.index') }}" method="GET"
                class="grid gap-4
                       p-5 sm:grid-cols-2
                       lg:grid-cols-4">


                {{-- DATE FROM --}}
                <div>

                    <label for="date_from"
                        class="mb-2 block
                               text-sm font-semibold
                               text-[#4D4038]">

                        Dari Tanggal

                    </label>


                    <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                        class="h-11 w-full
                               rounded-xl border
                               border-[#DFD2C7]
                               bg-white px-4
                               text-sm text-[#4D4038]
                               outline-none transition
                               focus:border-[#C8795A]
                               focus:ring-4
                               focus:ring-[#FBEAE2]">

                </div>



                {{-- DATE TO --}}
                <div>

                    <label for="date_to"
                        class="mb-2 block
                               text-sm font-semibold
                               text-[#4D4038]">

                        Sampai Tanggal

                    </label>


                    <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                        class="h-11 w-full
                               rounded-xl border
                               border-[#DFD2C7]
                               bg-white px-4
                               text-sm text-[#4D4038]
                               outline-none transition
                               focus:border-[#C8795A]
                               focus:ring-4
                               focus:ring-[#FBEAE2]">

                </div>



                {{-- APPLY --}}
                <div class="flex items-end">

                    <button type="submit"
                        class="inline-flex h-11
                               w-full items-center
                               justify-center gap-2
                               rounded-xl
                               bg-[#4371d1]
                               px-5 text-sm
                               font-bold text-white
                               transition
                               hover:bg-[#0a1d45]">

                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <path d="M4 6h16" />
                            <path d="M7 12h10" />
                            <path d="M10 18h4" />

                        </svg>

                        Terapkan Filter

                    </button>

                </div>



                {{-- RESET --}}
                <div class="flex items-end">

                    <a href="{{ route('seller.sales.index') }}"
                        class="inline-flex h-11
                               w-full items-center
                               justify-center gap-2
                               rounded-xl border
                               border-[#DFD2C7]
                               bg-white px-5
                               text-sm font-semibold
                               text-[#6F6259]
                               transition
                               hover:bg-[#F5ECE6]
                               hover:text-[#0a1d45]">

                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <path d="M3 12a9 9 0 1 0 3-6.7" />
                            <path d="M3 4v6h6" />

                        </svg>

                        Reset

                    </a>

                </div>

            </form>

        </section>



        {{-- ===================================================== --}}
        {{-- STATISTICS --}}
        {{-- ===================================================== --}}

        <section class="grid gap-4
                   sm:grid-cols-2
                   xl:grid-cols-3">


            {{-- REVENUE --}}
            <div
                class="relative overflow-hidden
                       rounded-3xl border
                       border-[#D3DFCE]
                       bg-white p-5
                       shadow-sm">

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

                            Total Omzet

                        </p>


                        <p
                            class="mt-5 truncate
                                   text-2xl font-black
                                   tracking-tight
                                   text-[#332B26]">

                            Rp{{ number_format($totalRevenue, 0, ',', '.') }}

                        </p>


                        <p class="mt-2 text-xs
                                   text-slate-400">

                            Dari transaksi selesai

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

            </div>



            {{-- COMPLETED ORDERS --}}
            <div
                class="relative overflow-hidden
                       rounded-3xl border
                       border-[#DFD2C7]
                       bg-white p-5
                       shadow-sm">

                <div class="absolute inset-x-0 top-0
                           h-1 bg-[#4371d1]">
                </div>


                <div class="flex items-start
                           justify-between gap-4">

                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase tracking-wide
                                   text-[#4371d1]">

                            Transaksi Selesai

                        </p>


                        <p
                            class="mt-5 text-3xl
                                   font-black
                                   tracking-tight
                                   text-[#332B26]">

                            {{ number_format($totalCompletedOrders) }}

                        </p>


                        <p class="mt-2 text-xs
                                   text-slate-400">

                            Total order selesai

                        </p>

                    </div>


                    <div
                        class="flex size-11
                               shrink-0 items-center
                               justify-center
                               rounded-xl
                               bg-[#4371d1]
                               text-white">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                            <circle cx="12" cy="12" r="9" />
                            <path d="m8 12 2.5 2.5L16.5 8.5" />

                        </svg>

                    </div>

                </div>

            </div>



            {{-- ITEMS SOLD --}}
            <div
                class="relative overflow-hidden
                       rounded-3xl border
                       border-[#EBCFC2]
                       bg-white p-5
                       shadow-sm">

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

                            Produk Terjual

                        </p>


                        <p
                            class="mt-5 text-3xl
                                   font-black
                                   tracking-tight
                                   text-[#332B26]">

                            {{ number_format($totalItemsSold) }}

                        </p>


                        <p class="mt-2 text-xs
                                   text-slate-400">

                            Total unit terjual

                        </p>

                    </div>


                    <div
                        class="flex size-11
                               shrink-0 items-center
                               justify-center
                               rounded-xl
                               bg-[#C8795A]
                               text-white">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">

                            <path d="M6 7h12l1 14H5L6 7Z" />
                            <path d="M9 7a3 3 0 0 1 6 0" />

                        </svg>

                    </div>

                </div>

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- BEST SELLING + SALES HISTORY --}}
        {{-- ===================================================== --}}

        <div class="mt-6 grid gap-6
                   xl:grid-cols-[360px_minmax(0,1fr)]">


            {{-- ================================================= --}}
            {{-- BEST SELLING PRODUCTS --}}
            {{-- ================================================= --}}

            <section
                class="overflow-hidden
                       rounded-3xl border
                       border-[#DFD2C7]
                       bg-white shadow-sm">


                {{-- HEADER --}}
                <div
                    class="border-b
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

                                <path d="m12 3 2.5 5 5.5.8-4 3.9.9 5.5-4.9-2.6-4.9 2.6.9-5.5-4-3.9 5.5-.8Z" />

                            </svg>

                        </div>


                        <div>

                            <h2 class="font-bold
                                       text-[#332B26]">

                                Produk Terlaris

                            </h2>

                            <p class="mt-0.5 text-xs
                                       text-slate-500">

                                Berdasarkan jumlah unit terjual.

                            </p>

                        </div>

                    </div>

                </div>



                {{-- LIST --}}
                <div class="divide-y divide-[#EEE5DE]">

                    @forelse ($bestSellingProducts as $index => $product)
                        @php
                            $rankClass = match ($index) {
                                0 => 'bg-[#C89B55] text-white',
                                1 => 'bg-[#F1E6DE] text-[#4371d1]',
                                2 => 'bg-[#FBEAE2] text-[#A95E43]',
                                default => 'bg-[#FAF7F2] text-[#8B7465]',
                            };
                        @endphp


                        <div
                            class="flex items-center
                                   gap-3 px-5 py-4
                                   transition
                                   hover:bg-[#FBF7F3]">


                            {{-- RANK --}}
                            <div
                                class="flex size-9
                                       shrink-0 items-center
                                       justify-center
                                       rounded-xl
                                       text-sm font-black
                                       {{ $rankClass }}">

                                {{ $index + 1 }}

                            </div>


                            {{-- INFO --}}
                            <div class="min-w-0 flex-1">

                                <p
                                    class="truncate
                                           text-sm font-bold
                                           text-[#4D4038]">

                                    {{ $product->product_name }}

                                </p>


                                <p class="mt-1 text-xs
                                           text-slate-400">

                                    {{ number_format($product->total_sold) }}
                                    unit terjual

                                </p>

                            </div>


                            {{-- REVENUE --}}
                            <div class="text-right">

                                <p
                                    class="whitespace-nowrap
                                           text-xs font-bold
                                           text-[#65795E]">

                                    Rp{{ number_format($product->total_revenue, 0, ',', '.') }}

                                </p>

                            </div>

                        </div>


                    @empty

                        <div class="px-6 py-14 text-center">

                            <div
                                class="mx-auto flex size-14
                                       items-center justify-center
                                       rounded-2xl
                                       bg-[#FAF2DF]
                                       text-[#A87A37]">

                                <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.7">

                                    <path d="m12 3 2.5 5 5.5.8-4 3.9.9 5.5-4.9-2.6-4.9 2.6.9-5.5-4-3.9 5.5-.8Z" />

                                </svg>

                            </div>


                            <p class="mt-4 font-bold
                                       text-[#4D4038]">

                                Belum ada data

                            </p>


                            <p
                                class="mt-2 text-sm
                                       leading-6
                                       text-slate-500">

                                Produk terlaris akan muncul setelah
                                terdapat transaksi selesai.

                            </p>

                        </div>
                    @endforelse

                </div>

            </section>



            {{-- ================================================= --}}
            {{-- SALES HISTORY --}}
            {{-- ================================================= --}}

            <section
                class="overflow-hidden
                       rounded-3xl border
                       border-[#DFD2C7]
                       bg-white shadow-sm">


                {{-- HEADER --}}
                <div
                    class="flex flex-col gap-2
                           border-b
                           border-[#E7DBD1]
                           bg-[#FAF7F2]
                           px-5 py-4
                           sm:flex-row
                           sm:items-center
                           sm:justify-between">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex size-9
                                   items-center justify-center
                                   rounded-xl
                                   bg-[#EEF3EA]
                                   text-[#65795E]">

                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <path d="M6 3h12v18H6z" />
                                <path d="M9 8h6" />
                                <path d="M9 12h6" />
                                <path d="M9 16h4" />

                            </svg>

                        </div>


                        <div>

                            <h2 class="font-bold
                                       text-[#332B26]">

                                Riwayat Penjualan

                            </h2>

                            <p class="mt-0.5 text-xs
                                       text-slate-500">

                                Daftar transaksi yang telah selesai.

                            </p>

                        </div>

                    </div>


                    <span
                        class="inline-flex w-fit
                               rounded-full
                               bg-[#EEF3EA]
                               px-3 py-1.5
                               text-xs font-bold
                               text-[#65795E]">

                        {{ number_format($sales->total()) }}
                        transaksi

                    </span>

                </div>



                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="w-full min-w-[800px]">

                        <thead class="bg-[#F8F3ED]">

                            <tr
                                class="text-left text-xs
                                       font-bold uppercase
                                       tracking-wide
                                       text-[#907A6C]">

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


                        <tbody class="divide-y divide-[#EEE5DE]">

                            @forelse ($sales as $sale)
                                <tr
                                    class="text-sm transition
                                           hover:bg-[#FBF7F3]">


                                    {{-- ORDER --}}
                                    <td class="px-5 py-4">

                                        <p
                                            class="font-bold
                                                   text-[#332B26]">

                                            {{ $sale->order_number }}

                                        </p>

                                    </td>



                                    {{-- BUYER --}}
                                    <td class="px-5 py-4">

                                        <p
                                            class="font-semibold
                                                   text-[#4D4038]">

                                            {{ $sale->buyer_name }}

                                        </p>


                                        <p
                                            class="mt-1 text-xs
                                                   text-slate-400">

                                            {{ $sale->buyer_phone ?? '-' }}

                                        </p>

                                    </td>



                                    {{-- ITEMS --}}
                                    <td class="px-5 py-4">

                                        <span
                                            class="inline-flex
                                                   rounded-lg
                                                   bg-[#F4EAE2]
                                                   px-2.5 py-1.5
                                                   text-xs font-bold
                                                   text-[#4371d1]">

                                            {{ $sale->items->sum('quantity') }}
                                            barang

                                        </span>

                                    </td>



                                    {{-- TOTAL --}}
                                    <td class="px-5 py-4">

                                        <span
                                            class="whitespace-nowrap
                                                   font-bold
                                                   text-[#65795E]">

                                            Rp{{ number_format($sale->subtotal, 0, ',', '.') }}

                                        </span>

                                    </td>



                                    {{-- DATE --}}
                                    <td class="px-5 py-4">

                                        <p
                                            class="font-medium
                                                   text-[#6F6259]">

                                            {{ $sale->created_at->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') }}

                                        </p>


                                        <p
                                            class="mt-1 text-xs
                                                   text-slate-400">

                                            {{ $sale->created_at->timezone('Asia/Jakarta')->format('H:i') }}
                                            WIB

                                        </p>

                                    </td>



                                    {{-- ACTION --}}
                                    <td class="px-5 py-4">

                                        <div class="flex justify-end">

                                            <a href="{{ route('seller.orders.show', $sale) }}" title="Detail Transaksi"
                                                class="inline-flex size-9
                                                       items-center justify-center
                                                       rounded-xl
                                                       text-[#A95E43]
                                                       transition
                                                       hover:bg-[#FBEAE2]">

                                                <svg class="size-4.5" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.8">

                                                    <path d="M2 12s3.5-6 10-6
                                                                       10 6 10 6-3.5 6-10 6
                                                                       S2 12 2 12Z" />

                                                    <circle cx="12" cy="12" r="3" />

                                                </svg>

                                            </a>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="6" class="px-6 py-16">

                                        <div class="text-center">

                                            <div
                                                class="mx-auto flex
                                                       size-16
                                                       items-center
                                                       justify-center
                                                       rounded-2xl
                                                       bg-[#EEF3EA]
                                                       text-[#65795E]">

                                                <svg class="size-7" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.7">

                                                    <path d="M6 3h12v18H6z" />
                                                    <path d="M9 8h6" />
                                                    <path d="M9 12h6" />

                                                </svg>

                                            </div>


                                            <p
                                                class="mt-4 font-bold
                                                       text-[#4D4038]">

                                                Belum ada penjualan

                                            </p>


                                            <p
                                                class="mt-2 text-sm
                                                       text-slate-500">

                                                Transaksi yang sudah selesai
                                                akan muncul di sini.

                                            </p>

                                        </div>

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
                               border-[#E7DBD1]
                               bg-[#FAF7F2]
                               px-5 py-4">

                        {{ $sales->links() }}

                    </div>
                @endif

            </section>

        </div>

    </div>

@endsection
