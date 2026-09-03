@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')

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


    <div class="mx-auto max-w-6xl">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section class="mb-6">

            <a href="{{ route('admin.orders.index') }}"
                class="inline-flex items-center gap-2
                       text-sm font-semibold
                       text-[#8B7465]
                       transition
                       hover:text-[#4371d1]">

                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                    <path d="m15 18-6-6 6-6" />

                </svg>

                Kembali ke Pesanan

            </a>


            <div
                class="mt-5 flex flex-col
                       gap-4 sm:flex-row
                       sm:items-end
                       sm:justify-between">

                <div>

                    <div
                        class="inline-flex items-center
                               gap-2 rounded-full
                               bg-[#F1E6DE]
                               px-3 py-1.5
                               text-xs font-bold
                               text-[#4371d1]">

                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <path d="M6 3h12v18H6z" />
                            <path d="M9 8h6" />
                            <path d="M9 12h6" />

                        </svg>

                        {{ $order->order_number }}

                    </div>


                    <h1
                        class="mt-3 text-2xl
                               font-black tracking-tight
                               text-[#332B26]
                               lg:text-3xl">

                        Detail Pesanan

                    </h1>


                    <p class="mt-2 text-sm
                               text-slate-500">

                        Dibuat pada
                        {{ $order->created_at->format('d M Y, H:i') }}

                    </p>

                </div>


                <span
                    class="inline-flex w-fit
                           items-center gap-2
                           rounded-full border
                           px-3.5 py-2
                           text-xs font-bold
                           {{ $statusClass }}">

                    <span
                        class="size-1.5
                               rounded-full
                               {{ $statusDot }}">
                    </span>

                    {{ $statusLabel }}

                </span>

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- CONTENT --}}
        {{-- ===================================================== --}}

        <div class="grid gap-6 lg:grid-cols-3">


            {{-- ================================================= --}}
            {{-- LEFT --}}
            {{-- ================================================= --}}

            <div class="space-y-6 lg:col-span-2">


                {{-- BUYER + SELLER --}}

                <div class="grid gap-5 md:grid-cols-2">


                    {{-- BUYER --}}

                    <section
                        class="overflow-hidden
                               rounded-3xl border
                               border-[#DFD2C7]
                               bg-white shadow-sm">

                        <div
                            class="border-b
                                   border-[#E7DBD1]
                                   bg-[#FAF7F2]
                                   p-5">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex size-10
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#4371d1]
                                           text-white">

                                    <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">

                                        <circle cx="12" cy="8" r="3.5" />
                                        <path d="M5 20c0-4 3-7 7-7s7 3 7 7" />

                                    </svg>

                                </div>


                                <div>

                                    <p
                                        class="text-[10px]
                                               font-bold uppercase
                                               tracking-[0.12em]
                                               text-[#A28A7A]">

                                        Pembeli

                                    </p>

                                    <p
                                        class="mt-1 text-sm
                                               font-bold
                                               text-[#332B26]">

                                        Informasi Pembeli

                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="p-5">

                            <h2 class="font-bold
                                       text-[#332B26]">

                                {{ $order->buyer_name }}

                            </h2>


                            <div class="mt-4 space-y-3
                                       text-sm text-slate-500">

                                <div class="flex items-center gap-2">

                                    <svg class="size-4 shrink-0
                                               text-[#A28A7A]"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                        <rect x="3" y="5" width="18" height="14" rx="2" />

                                        <path d="m3 7 9 6 9-6" />

                                    </svg>

                                    <span class="break-all">
                                        {{ $order->buyer?->email ?? '-' }}
                                    </span>

                                </div>


                                <div class="flex items-center gap-2">

                                    <svg class="size-4 shrink-0
                                               text-[#A28A7A]"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                        <path d="M6 3h4l2 5-3 2
                                                   a14 14 0 0 0 5 5
                                                   l2-3 5 2v4
                                                   c0 1.7-1.3 3-3 3
                                                   C9.7 21 3 14.3 3 6
                                                   c0-1.7 1.3-3 3-3Z" />

                                    </svg>

                                    {{ $order->buyer_phone ?? '-' }}

                                </div>

                            </div>

                        </div>

                    </section>



                    {{-- SELLER --}}

                    <section
                        class="overflow-hidden
                               rounded-3xl border
                               border-[#DFD2C7]
                               bg-white shadow-sm">

                        <div
                            class="border-b
                                   border-[#E7DBD1]
                                   bg-[#FAF7F2]
                                   p-5">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex size-10
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#C8795A]
                                           text-white">

                                    <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">

                                        <path d="M4 10v10h16V10" />
                                        <path d="M3 10l2-6h14l2 6" />
                                        <path d="M8 20v-6h8v6" />

                                    </svg>

                                </div>


                                <div>

                                    <p
                                        class="text-[10px]
                                               font-bold uppercase
                                               tracking-[0.12em]
                                               text-[#A28A7A]">

                                        Penjual

                                    </p>

                                    <p
                                        class="mt-1 text-sm
                                               font-bold
                                               text-[#332B26]">

                                        Informasi Toko

                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="p-5">

                            <h2 class="font-bold
                                       text-[#332B26]">

                                {{ $order->seller?->sellerProfile?->store_name ?? ($order->seller?->name ?? '-') }}

                            </h2>


                            <p
                                class="mt-2 text-sm
                                       font-medium
                                       text-slate-600">

                                {{ $order->seller?->name ?? '-' }}

                            </p>


                            <p
                                class="mt-1 break-all
                                       text-sm
                                       text-slate-500">

                                {{ $order->seller?->email ?? '-' }}

                            </p>

                        </div>

                    </section>

                </div>



                {{-- ================================================= --}}
                {{-- PRODUCTS --}}
                {{-- ================================================= --}}

                <section
                    class="overflow-hidden
                           rounded-3xl border
                           border-[#DFD2C7]
                           bg-white shadow-sm">

                    <div
                        class="border-b
                               border-[#E7DBD1]
                               bg-[#FAF7F2]
                               p-5 sm:p-6">

                        <div class="flex items-center
                                   justify-between gap-4">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex size-10
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#4371d1]
                                           text-white">

                                    <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">

                                        <path d="M6 7h12l1 14H5L6 7Z" />
                                        <path d="M9 7a3 3 0 0 1 6 0" />

                                    </svg>

                                </div>


                                <div>

                                    <h2 class="font-bold
                                               text-[#332B26]">

                                        Produk Pesanan

                                    </h2>

                                    <p class="mt-1 text-xs
                                               text-slate-500">

                                        Daftar produk dalam transaksi.

                                    </p>

                                </div>

                            </div>


                            <span
                                class="rounded-full
                                       bg-[#F1E6DE]
                                       px-3 py-1.5
                                       text-xs font-bold
                                       text-[#4371d1]">

                                {{ $order->items->sum('quantity') }}
                                barang

                            </span>

                        </div>

                    </div>



                    <div class="divide-y divide-[#EEE5DE]">

                        @foreach ($order->items as $item)
                            <div
                                class="flex flex-col gap-4
                                       p-5 sm:flex-row
                                       sm:items-center
                                       sm:p-6">


                                @if ($item->product?->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                        alt="{{ $item->product_name }}"
                                        class="size-20 shrink-0
                                               rounded-2xl
                                               border border-[#E7DBD1]
                                               object-cover">
                                @else
                                    <div
                                        class="flex size-20
                                               shrink-0 items-center
                                               justify-center
                                               rounded-2xl
                                               bg-[#FAF7F2]
                                               text-[#A28A7A]">

                                        <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.5">

                                            <path d="M6 7h12l1 14H5L6 7Z" />
                                            <path d="M9 7a3 3 0 0 1 6 0" />

                                        </svg>

                                    </div>
                                @endif


                                <div class="min-w-0 flex-1">

                                    <p class="font-bold
                                               text-[#332B26]">

                                        {{ $item->product_name }}

                                    </p>


                                    <p class="mt-2 text-sm
                                               text-slate-500">

                                        {{ $item->quantity }}
                                        ×
                                        Rp{{ number_format($item->price, 0, ',', '.') }}

                                    </p>

                                </div>


                                <div class="sm:text-right">

                                    <p class="text-xs
                                               text-slate-400">

                                        Subtotal

                                    </p>

                                    <p
                                        class="mt-1 whitespace-nowrap
                                               font-bold
                                               text-[#332B26]">

                                        Rp{{ number_format($item->subtotal, 0, ',', '.') }}

                                    </p>

                                </div>

                            </div>
                        @endforeach

                    </div>

                </section>



                {{-- ================================================= --}}
                {{-- NOTES --}}
                {{-- ================================================= --}}

                @if ($order->notes)
                    <section
                        class="overflow-hidden
                               rounded-3xl border
                               border-[#E8D8B9]
                               bg-white shadow-sm">

                        <div
                            class="border-b
                                   border-[#E8D8B9]
                                   bg-[#FAF2DF]
                                   p-5">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex size-9
                                           items-center justify-center
                                           rounded-xl
                                           bg-[#C89B55]
                                           text-white">

                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">

                                        <path d="M4 5h16v12H8l-4 4Z" />

                                    </svg>

                                </div>


                                <h2 class="font-bold
                                           text-[#6F5130]">

                                    Catatan Pembeli

                                </h2>

                            </div>

                        </div>


                        <p
                            class="whitespace-pre-line
                                   p-5 text-sm
                                   leading-6
                                   text-slate-600">

                            {{ $order->notes }}

                        </p>

                    </section>
                @endif

            </div>



            {{-- ================================================= --}}
            {{-- RIGHT SUMMARY --}}
            {{-- ================================================= --}}

            <div>

                <section
                    class="sticky top-24
                           overflow-hidden
                           rounded-3xl
                           border border-[#DFD2C7]
                           bg-white shadow-sm">


                    <div
                        class="border-b
                               border-[#E7DBD1]
                               bg-[#FAF7F2]
                               p-5">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex size-10
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-[#4371d1]
                                       text-white">

                                <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <path d="M6 3h12v18H6z" />
                                    <path d="M9 8h6" />
                                    <path d="M9 12h6" />

                                </svg>

                            </div>


                            <div>

                                <h2 class="font-bold
                                           text-[#332B26]">

                                    Ringkasan Transaksi

                                </h2>

                                <p class="mt-1 text-xs
                                           text-slate-500">

                                    Informasi utama pesanan.

                                </p>

                            </div>

                        </div>

                    </div>



                    <div class="p-5">

                        <div class="space-y-4">

                            <div class="flex justify-between
                                       gap-4">

                                <span class="text-sm
                                           text-slate-500">

                                    Nomor Pesanan

                                </span>

                                <span
                                    class="text-right
                                           text-sm font-bold
                                           text-[#332B26]">

                                    {{ $order->order_number }}

                                </span>

                            </div>


                            <div class="flex justify-between
                                       gap-4">

                                <span class="text-sm
                                           text-slate-500">

                                    Total Barang

                                </span>

                                <span class="text-sm font-bold
                                           text-[#332B26]">

                                    {{ $order->items->sum('quantity') }}

                                </span>

                            </div>


                            <div
                                class="flex items-center
                                       justify-between
                                       gap-4">

                                <span class="text-sm
                                           text-slate-500">

                                    Status

                                </span>


                                <span
                                    class="inline-flex
                                           items-center gap-2
                                           rounded-full border
                                           px-3 py-1.5
                                           text-xs font-bold
                                           {{ $statusClass }}">

                                    <span
                                        class="size-1.5
                                               rounded-full
                                               {{ $statusDot }}">
                                    </span>

                                    {{ $statusLabel }}

                                </span>

                            </div>

                        </div>



                        {{-- TOTAL --}}

                        <div
                            class="mt-5 border-t
                                   border-[#E7DBD1]
                                   pt-5">

                            <p class="text-sm
                                       text-slate-500">

                                Total Transaksi

                            </p>

                            <p
                                class="mt-1 text-2xl
                                       font-black
                                       tracking-tight
                                       text-[#4371d1]">

                                Rp{{ number_format($order->subtotal, 0, ',', '.') }}

                            </p>

                        </div>



                        {{-- INFO --}}

                        <div
                            class="mt-6
                                   rounded-2xl
                                   border border-[#E7DBD1]
                                   bg-[#FAF7F2]
                                   p-4">

                            <div class="flex
                                       items-start gap-3">

                                <div
                                    class="flex size-8
                                           shrink-0
                                           items-center
                                           justify-center
                                           rounded-lg
                                           bg-[#F1E6DE]
                                           text-[#4371d1]">

                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">

                                        <circle cx="12" cy="12" r="9" />

                                        <path d="M12 11v5" />
                                        <path d="M12 8h.01" />

                                    </svg>

                                </div>


                                <p
                                    class="text-xs
                                           leading-5
                                           text-[#7C695C]">

                                    Admin hanya memantau transaksi.
                                    Penerimaan, pemrosesan, dan
                                    penyelesaian pesanan dilakukan
                                    oleh seller.

                                </p>

                            </div>

                        </div>

                    </div>

                </section>

            </div>

        </div>

    </div>

@endsection
