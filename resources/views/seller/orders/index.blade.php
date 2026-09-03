@extends('layouts.seller')

@section('title', 'Pesanan Masuk')

@section('content')

    <div class="mx-auto max-w-[1400px]">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section class="mb-6">

            <div
                class="inline-flex items-center gap-2
                       rounded-full bg-[#FBEAE2]
                       px-3 py-1.5
                       text-xs font-bold
                       text-[#A95E43]">

                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                    <path d="M6 3h12v18H6z" />
                    <path d="M9 8h6" />
                    <path d="M9 12h6" />

                </svg>

                Manajemen Pesanan

            </div>


            <h1
                class="mt-3 text-2xl
                       font-black tracking-tight
                       text-[#332B26]
                       lg:text-3xl">

                Pesanan Masuk

            </h1>


            <p class="mt-2 max-w-2xl
                       text-sm leading-6
                       text-slate-500">

                Pantau dan proses pesanan yang masuk ke tokomu.

            </p>

        </section>



        {{-- ===================================================== --}}
        {{-- SUCCESS --}}
        {{-- ===================================================== --}}

        @if (session('success'))
            <div
                class="mb-5 flex items-start gap-3
                       rounded-2xl
                       border border-[#D3DFCE]
                       bg-[#EEF3EA]
                       px-4 py-3.5">

                <div
                    class="flex size-8 shrink-0
                           items-center justify-center
                           rounded-lg
                           bg-[#718268]
                           text-white">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <path d="m5 12 4 4L19 6" />

                    </svg>

                </div>


                <div>

                    <p class="text-sm font-bold
                               text-[#65795E]">

                        Berhasil

                    </p>

                    <p class="mt-0.5 text-xs
                               text-[#65795E]">

                        {{ session('success') }}

                    </p>

                </div>

            </div>
        @endif



        {{-- ===================================================== --}}
        {{-- ERROR --}}
        {{-- ===================================================== --}}

        @error('status')
            <div
                class="mb-5 flex items-start gap-3
                       rounded-2xl
                       border border-[#ECD2CF]
                       bg-[#FAEDEC]
                       px-4 py-3.5">

                <div
                    class="flex size-8 shrink-0
                           items-center justify-center
                           rounded-lg
                           bg-[#A65954]
                           text-white">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <circle cx="12" cy="12" r="9" />
                        <path d="M12 8v5" />
                        <path d="M12 17h.01" />

                    </svg>

                </div>

                <p class="pt-1 text-sm
                           font-medium
                           text-[#A65954]">

                    {{ $message }}

                </p>

            </div>
        @enderror



        {{-- ===================================================== --}}
        {{-- TABLE CARD --}}
        {{-- ===================================================== --}}

        <section
            class="overflow-hidden
                   rounded-3xl
                   border border-[#DFD2C7]
                   bg-white shadow-sm">


            {{-- ================================================= --}}
            {{-- FILTER --}}
            {{-- ================================================= --}}

            <div
                class="border-b
                       border-[#E7DBD1]
                       bg-[#FAF7F2]
                       p-5">


                {{-- STATUS FILTER --}}
                <div class="flex flex-wrap gap-2">

                    <a href="{{ route('seller.orders.index') }}"
                        class="inline-flex items-center gap-2
                               rounded-xl border
                               px-4 py-2
                               text-sm font-bold
                               transition
                               {{ !request('status')
                                   ? 'border-[#EBCFC2] bg-[#FBEAE2] text-[#A95E43]'
                                   : 'border-transparent text-[#6F6259] hover:bg-[#F5ECE6]' }}">

                        Semua

                    </a>


                    <a href="{{ route('seller.orders.index', ['status' => 'pending']) }}"
                        class="inline-flex items-center gap-2
                               rounded-xl border
                               px-4 py-2
                               text-sm font-bold
                               transition
                               {{ request('status') === 'pending'
                                   ? 'border-[#E8D8B9] bg-[#FAF2DF] text-[#A87A37]'
                                   : 'border-transparent text-[#6F6259] hover:bg-[#F5ECE6]' }}">

                        <span class="size-1.5 rounded-full bg-[#C89B55]"></span>

                        Menunggu

                    </a>


                    <a href="{{ route('seller.orders.index', ['status' => 'confirmed']) }}"
                        class="inline-flex items-center gap-2
                               rounded-xl border
                               px-4 py-2
                               text-sm font-bold
                               transition
                               {{ request('status') === 'confirmed'
                                   ? 'border-[#DFD2C7] bg-[#F1E6DE] text-[#4371d1]'
                                   : 'border-transparent text-[#6F6259] hover:bg-[#F5ECE6]' }}">

                        <span class="size-1.5 rounded-full bg-[#4371d1]"></span>

                        Dikonfirmasi

                    </a>


                    <a href="{{ route('seller.orders.index', ['status' => 'processing']) }}"
                        class="inline-flex items-center gap-2
                               rounded-xl border
                               px-4 py-2
                               text-sm font-bold
                               transition
                               {{ request('status') === 'processing'
                                   ? 'border-[#EBCFC2] bg-[#FBEAE2] text-[#A95E43]'
                                   : 'border-transparent text-[#6F6259] hover:bg-[#F5ECE6]' }}">

                        <span class="size-1.5 rounded-full bg-[#C8795A]"></span>

                        Diproses

                    </a>


                    <a href="{{ route('seller.orders.index', ['status' => 'completed']) }}"
                        class="inline-flex items-center gap-2
                               rounded-xl border
                               px-4 py-2
                               text-sm font-bold
                               transition
                               {{ request('status') === 'completed'
                                   ? 'border-[#D3DFCE] bg-[#EEF3EA] text-[#65795E]'
                                   : 'border-transparent text-[#6F6259] hover:bg-[#F5ECE6]' }}">

                        <span class="size-1.5 rounded-full bg-[#718268]"></span>

                        Selesai

                    </a>


                    <a href="{{ route('seller.orders.index', ['status' => 'cancelled']) }}"
                        class="inline-flex items-center gap-2
                               rounded-xl border
                               px-4 py-2
                               text-sm font-bold
                               transition
                               {{ request('status') === 'cancelled'
                                   ? 'border-[#ECD2CF] bg-[#FAEDEC] text-[#A65954]'
                                   : 'border-transparent text-[#6F6259] hover:bg-[#F5ECE6]' }}">

                        <span class="size-1.5 rounded-full bg-[#A65954]"></span>

                        Dibatalkan

                    </a>

                </div>



                {{-- SEARCH --}}
                <form action="{{ route('seller.orders.index') }}" method="GET"
                    class="mt-4 flex flex-col gap-3
                           sm:flex-row">

                    @if (request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif


                    <div class="relative max-w-lg flex-1">

                        <svg class="pointer-events-none
                                   absolute left-4 top-1/2
                                   size-4 -translate-y-1/2
                                   text-[#A28A7A]"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                            <circle cx="11" cy="11" r="7" />
                            <path d="m20 20-3.5-3.5" />

                        </svg>


                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nomor pesanan atau pembeli..."
                            class="h-11 w-full
                                   rounded-xl border
                                   border-[#DFD2C7]
                                   bg-white pl-11 pr-4
                                   text-sm text-[#4D4038]
                                   outline-none transition
                                   placeholder:text-[#B3A195]
                                   focus:border-[#C8795A]
                                   focus:ring-4
                                   focus:ring-[#FBEAE2]">

                    </div>


                    <button type="submit"
                        class="inline-flex h-11
                               items-center justify-center
                               gap-2 rounded-xl
                               bg-[#4371d1]
                               px-5 text-sm
                               font-bold text-white
                               transition
                               hover:bg-[#0a1d45]">

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

                <table class="w-full min-w-[1050px]">

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
                                Status
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

                        @forelse ($orders as $order)
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
                                    'sold' => 'Sudah Terjual',
                                    'cancelled' => 'Dibatalkan',
                                    default => ucfirst($order->status),
                                };
                            @endphp


                            <tr class="text-sm transition
                                       hover:bg-[#FBF7F3]">


                                {{-- ORDER --}}
                                <td class="px-5 py-4">

                                    <p class="font-bold
                                               text-[#332B26]">

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
                                               text-[#4D4038]">

                                        {{ $order->buyer_name }}

                                    </p>


                                    <p class="mt-1 text-xs
                                               text-slate-400">

                                        {{ $order->buyer_phone ?? '-' }}

                                    </p>

                                </td>



                                {{-- ITEMS --}}
                                <td class="px-5 py-4">

                                    <span
                                        class="inline-flex items-center
                                               gap-2 rounded-lg
                                               bg-[#F4EAE2]
                                               px-2.5 py-1.5
                                               text-xs font-bold
                                               text-[#4371d1]">

                                        {{ $order->items->sum('quantity') }}

                                        barang

                                    </span>

                                </td>



                                {{-- TOTAL --}}
                                <td class="px-5 py-4">

                                    <span
                                        class="whitespace-nowrap
                                               font-bold
                                               text-[#332B26]">

                                        Rp{{ number_format($order->subtotal, 0, ',', '.') }}

                                    </span>

                                </td>



                                {{-- STATUS --}}
                                <td class="px-5 py-4">

                                    <span
                                        class="inline-flex items-center
                                               gap-2 rounded-full
                                               border px-3 py-1.5
                                               text-xs font-bold
                                               {{ $statusClass }}">

                                        <span
                                            class="size-1.5 rounded-full
                                                   {{ $statusDot }}">
                                        </span>

                                        {{ $statusLabel }}

                                    </span>

                                </td>



                                {{-- DATE --}}
                                <td class="px-5 py-4">

                                    <p class="font-medium
                                               text-[#6F6259]">

                                        {{ $order->created_at->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') }}

                                    </p>


                                    <p class="mt-1 text-xs
                                               text-slate-400">

                                        {{ $order->created_at->timezone('Asia/Jakarta')->format('H:i') }}
                                        WIB

                                    </p>

                                </td>



                                {{-- ACTION --}}
                                <td class="px-5 py-4">

                                    <div class="flex justify-end">

                                        <a href="{{ route('seller.orders.show', $order) }}"
                                            title="Detail Pesanan"
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

                                <td colspan="7" class="px-6 py-16">

                                    <div class="text-center">

                                        <div
                                            class="mx-auto flex
                                                   size-16 items-center
                                                   justify-center
                                                   rounded-2xl
                                                   bg-[#FBEAE2]
                                                   text-[#A95E43]">

                                            <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.7">

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
                                            class="mt-2 text-sm
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



            {{-- ================================================= --}}
            {{-- PAGINATION --}}
            {{-- ================================================= --}}

            @if ($orders->hasPages())
                <div
                    class="border-t
                           border-[#E7DBD1]
                           bg-[#FAF7F2]
                           px-5 py-4">

                    {{ $orders->links() }}

                </div>
            @endif

        </section>

    </div>

@endsection
