@extends('layouts.admin')

@section('title', 'Kelola Pesanan')

@section('content')

    <div class="mx-auto max-w-[1400px]">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section class="mb-6">

            <div
                class="inline-flex items-center gap-2
                       rounded-full bg-[#FFF7ED]
                       px-3 py-1.5
                       text-xs font-bold
                       text-[#A87A37]">

                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                    <path d="M6 3h12v18H6z" />
                    <path d="M9 8h6" />
                    <path d="M9 12h6" />
                    <path d="M9 16h4" />

                </svg>

                Monitoring Transaksi

            </div>


            <h1
                class="mt-3 text-2xl
                       font-black tracking-tight
                       text-[#172554]
                       lg:text-3xl">

                Kelola Pesanan

            </h1>


            <p class="mt-2 max-w-2xl
                       text-sm leading-6
                       text-slate-500">

                Pantau seluruh transaksi antara pembeli
                dan penjual di KampusMart.

            </p>

        </section>



        {{-- ===================================================== --}}
        {{-- STATISTICS --}}
        {{-- ===================================================== --}}

        <div class="mb-6 grid gap-4
                   sm:grid-cols-2
                   xl:grid-cols-4">


            {{-- TOTAL --}}

            <section
                class="relative overflow-hidden
                       rounded-3xl border
                       border-[#DFD2C7]
                       bg-white p-5
                       shadow-sm">

                <div class="absolute inset-x-0 top-0
                           h-1 bg-[#F97516]">
                </div>


                <div class="flex items-start
                           justify-between gap-4">

                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase tracking-wide
                                   text-[#998274]">

                            Total Pesanan

                        </p>

                        <p
                            class="mt-5 text-3xl
                                   font-black
                                   text-[#172554]">

                            {{ number_format($totalOrders) }}

                        </p>

                        <p class="mt-2 text-xs
                                   text-slate-400">

                            Seluruh transaksi

                        </p>

                    </div>


                    <div
                        class="flex size-11
                               items-center justify-center
                               rounded-xl
                               bg-[#F97516]
                               text-white">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <path d="M6 3h12v18H6z" />
                            <path d="M9 8h6" />
                            <path d="M9 12h6" />
                            <path d="M9 16h4" />

                        </svg>

                    </div>

                </div>

            </section>



            {{-- PROCESSING --}}

            <section
                class="relative overflow-hidden
                       rounded-3xl border
                       border-[#EBCFC2]
                       bg-white p-5
                       shadow-sm">

                <div class="absolute inset-x-0 top-0
                           h-1 bg-[#F97516]">
                </div>


                <div class="flex items-start
                           justify-between gap-4">

                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase tracking-wide
                                   text-[#F97516]">

                            Sedang Diproses

                        </p>

                        <p
                            class="mt-5 text-3xl
                                   font-black
                                   text-[#F97516]">

                            {{ number_format($processingOrders) }}

                        </p>

                        <p class="mt-2 text-xs
                                   text-slate-400">

                            Ditangani seller

                        </p>

                    </div>


                    <div
                        class="flex size-11
                               items-center justify-center
                               rounded-xl
                               bg-[#F97516]
                               text-white">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <path d="M4 12a8 8 0 0 1 13.6-5.7" />
                            <path d="M18 3v4h-4" />
                            <path d="M20 12a8 8 0 0 1-13.6 5.7" />
                            <path d="M6 21v-4h4" />

                        </svg>

                    </div>

                </div>

            </section>



            {{-- COMPLETED --}}

            <section
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

                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase tracking-wide
                                   text-[#65795E]">

                            Selesai

                        </p>

                        <p
                            class="mt-5 text-3xl
                                   font-black
                                   text-[#65795E]">

                            {{ number_format($completedOrders) }}

                        </p>

                        <p class="mt-2 text-xs
                                   text-slate-400">

                            Transaksi selesai

                        </p>

                    </div>


                    <div
                        class="flex size-11
                               items-center justify-center
                               rounded-xl
                               bg-[#718268]
                               text-white">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                            <path d="m5 12 4 4L19 6" />

                        </svg>

                    </div>

                </div>

            </section>



            {{-- CANCELLED --}}

            <section
                class="relative overflow-hidden
                       rounded-3xl border
                       border-[#ECD2CF]
                       bg-white p-5
                       shadow-sm">

                <div class="absolute inset-x-0 top-0
                            h-1 bg-[#F97516]">
                </div>

                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-[#F97516]">
                            Ditolak/Dibatalkan
                        </p>

                        <p class="mt-5 text-3xl font-black text-[#F97516]">
                            {{ number_format($cancelledOrders) }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Stok dikembalikan
                        </p>
                    </div>

                    <div class="flex size-11 items-center justify-center rounded-xl bg-[#F97516] text-white">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M6 6l12 12M18 6 6 18" />
                        </svg>
                    </div>
                </div>

            </section>

        </div>



        {{-- ===================================================== --}}
        {{-- ORDER TABLE --}}
        {{-- ===================================================== --}}

        <section
            class="overflow-hidden
                   rounded-3xl
                   border border-[#DFD2C7]
                   bg-white shadow-sm">


            {{-- ================================================= --}}
            {{-- FILTER --}}
            {{-- ================================================= --}}

            <div class="border-b border-[#E7DBD1]
                       bg-[#FFF7ED]
                       p-5">


                {{-- STATUS FILTER --}}

                <div class="flex flex-wrap gap-2">

                    <a href="{{ route('admin.orders.index') }}"
                        class="rounded-xl px-4 py-2
                               text-sm font-semibold
                               transition
                               {{ !request('status') ? 'bg-[#F97516] text-white shadow-sm' : 'bg-white text-[#7C695C] hover:bg-[#FFF7ED]' }}">

                        Semua

                    </a>


                    <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}"
                        class="rounded-xl px-4 py-2
                               text-sm font-semibold
                               transition
                               {{ request('status') === 'processing'
                                   ? 'bg-[#F97516] text-white shadow-sm'
                                   : 'bg-white text-[#7C695C] hover:bg-[#FFF7ED] hover:text-[#F97516]' }}">

                        Diproses

                    </a>


                    <a href="{{ route('admin.orders.index', ['status' => 'sold']) }}"
                        class="rounded-xl px-4 py-2
                               text-sm font-semibold
                               transition
                               {{ request('status') === 'sold'
                                   ? 'bg-[#718268] text-white shadow-sm'
                                   : 'bg-white text-[#7C695C] hover:bg-[#FFF7ED] hover:text-[#65795E]' }}">

                        Selesai

                    </a>


                    <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}"
                        class="rounded-xl px-4 py-2
                               text-sm font-semibold
                               transition
                               {{ request('status') === 'cancelled'
                                   ? 'bg-[#F97516] text-white shadow-sm'
                                   : 'bg-white text-[#7C695C] hover:bg-[#FFF7ED] hover:text-[#F97516]' }}">

                        Ditolak/Dibatalkan

                    </a>


                </div>



                {{-- SEARCH --}}

                <form action="{{ route('admin.orders.index') }}" method="GET"
                    class="mt-4
                           flex max-w-2xl
                           flex-col gap-2
                           sm:flex-row">

                    @if (request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif


                    <div class="relative flex-1">

                        <svg class="absolute left-4 top-1/2
                                   size-4 -translate-y-1/2
                                   text-[#A28A7A]"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                            <circle cx="11" cy="11" r="7" />
                            <path d="m20 20-3.5-3.5" />

                        </svg>


                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nomor pesanan, pembeli, atau seller..."
                            class="h-11 w-full
                                   rounded-xl border
                                   border-[#DFD2C7]
                                   bg-white pl-11 pr-4
                                   text-sm text-[#172554]
                                   outline-none
                                   placeholder:text-[#B3A195]
                                   focus:border-[#F97516]
                                   focus:ring-4
                                   focus:ring-[#FFF7ED]">

                    </div>


                    <button type="submit"
                        class="inline-flex h-11
                               items-center justify-center
                               gap-2 rounded-xl
                               bg-[#F97516] px-5
                               text-sm font-bold
                               text-white transition
                               hover:bg-[#172554]">

                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                            <circle cx="11" cy="11" r="7" />
                            <path d="m20 20-3.5-3.5" />

                        </svg>

                        Cari

                    </button>

                </form>

            </div>



            {{-- ================================================= --}}
            {{-- TABLE --}}
            {{-- ================================================= --}}

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1150px]">

                    <thead class="bg-[#FFF7ED]">

                        <tr
                            class="text-left text-xs
                                   font-bold uppercase
                                   tracking-wide
                                   text-[#907A6C]">

                            <th class="px-5 py-4">Pesanan</th>
                            <th class="px-5 py-4">Pembeli</th>
                            <th class="px-5 py-4">Penjual</th>
                            <th class="px-5 py-4">Barang</th>
                            <th class="px-5 py-4">Total</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4">Tanggal</th>
                            <th class="px-5 py-4 text-right">Aksi</th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-[#EEE5DE]">

                        @forelse ($orders as $order)
                            @php
                                $statusClass = match ($order->status) {
                                    'processing' => 'border-[#EBCFC2] bg-[#FFF7ED] text-[#F97516]',
                                    'sold' => 'border-[#D3DFCE] bg-[#FFF7ED] text-[#65795E]',
                                    'cancelled' => 'border-[#ECD2CF] bg-[#FFF7ED] text-[#F97516]',

                                    default => 'border-slate-200 bg-slate-100 text-slate-600',
                                };

                                $statusDot = match ($order->status) {
                                    'processing' => 'bg-[#F97516]',
                                    'sold' => 'bg-[#718268]',
                                    'cancelled' => 'bg-[#F97516]',
                                    default => 'bg-slate-400',
                                };

                                $statusLabel = match ($order->status) {
                                    'processing' => 'Diproses',
                                    'sold' => 'Selesai',
                                    'cancelled' => 'Ditolak/Dibatalkan',
                                    default => ucfirst($order->status),
                                };
                            @endphp


                            <tr class="text-sm transition
                                       hover:bg-[#FFF7ED]">


                                {{-- ORDER --}}

                                <td class="px-5 py-4">

                                    <p class="font-bold
                                               text-[#172554]">

                                        {{ $order->order_number }}

                                    </p>

                                    <p class="mt-1 text-xs
                                               text-slate-400">

                                        ID #{{ $order->id }}

                                    </p>

                                </td>



                                {{-- BUYER --}}

                                <td class="px-5 py-4">

                                    <p class="font-semibold
                                               text-[#172554]">

                                        {{ $order->buyer_name }}

                                    </p>

                                    <p class="mt-1 text-xs
                                               text-slate-400">

                                        {{ $order->buyer_phone ?? '-' }}

                                    </p>

                                </td>



                                {{-- SELLER --}}

                                <td class="px-5 py-4">

                                    <p class="font-semibold
                                               text-[#172554]">

                                        {{ $order->seller?->sellerProfile?->store_name ?? ($order->seller?->name ?? '-') }}

                                    </p>

                                    <p class="mt-1 text-xs
                                               text-slate-400">

                                        {{ $order->seller?->name ?? '-' }}

                                    </p>

                                </td>



                                {{-- ITEM --}}

                                <td class="px-5 py-4">

                                    <span
                                        class="inline-flex items-center gap-2
                                               rounded-lg bg-[#FFF7ED]
                                               px-2.5 py-1.5
                                               text-xs font-semibold
                                               text-[#6F6259]">

                                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.8">

                                            <path d="M6 7h12l1 14H5L6 7Z" />
                                            <path d="M9 7a3 3 0 0 1 6 0" />

                                        </svg>

                                        {{ $order->items->sum('quantity') }}
                                        barang

                                    </span>

                                </td>



                                {{-- TOTAL --}}

                                <td class="px-5 py-4">

                                    <span class="font-bold
                                               text-[#172554]">

                                        Rp{{ number_format($order->subtotal, 0, ',', '.') }}

                                    </span>

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



                                {{-- DATE --}}

                                <td class="px-5 py-4">

                                    <p class="font-medium text-slate-600">
                                        {{ $order->created_at->format('d M Y') }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $order->created_at->format('H:i') }}
                                    </p>

                                </td>



                                {{-- ACTION --}}

                                <td class="px-5 py-4">

                                    <div class="flex justify-end">

                                        <a href="{{ route('admin.orders.show', $order) }}" title="Lihat Detail"
                                            class="inline-flex
                                                   size-9 items-center
                                                   justify-center
                                                   rounded-xl
                                                   text-[#8B7465]
                                                   transition
                                                   hover:bg-[#FFF7ED]
                                                   hover:text-[#F97516]">

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

                                <td colspan="8" class="px-6 py-16">

                                    <div class="text-center">

                                        <div
                                            class="mx-auto flex size-16
                                                   items-center justify-center
                                                   rounded-2xl
                                                   bg-[#FFF7ED]
                                                   text-[#F97516]">

                                            <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.7">

                                                <path d="M6 3h12v18H6z" />
                                                <path d="M9 8h6" />
                                                <path d="M9 12h6" />

                                            </svg>

                                        </div>

                                        <p
                                            class="mt-4 font-bold
                                                   text-[#172554]">

                                            Belum ada pesanan

                                        </p>

                                        <p
                                            class="mt-2 text-sm
                                                   text-slate-500">

                                            Transaksi buyer dan seller
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

            @if ($orders->hasPages())
                <div
                    class="border-t border-[#E7DBD1]
                           bg-[#FFF7ED]
                           px-5 py-4">

                    {{ $orders->links() }}

                </div>
            @endif

        </section>

    </div>

@endsection
