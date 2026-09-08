@extends('layouts.public')

@section('title', 'Pesanan Saya - KampusMart')

@section('content')

    <div
        class="min-h-screen
               bg-gradient-to-br
               from-[#F8FAFC]
               via-[#F7F9FD]
               to-[#EEF3FB]">

        <main
            class="mx-auto
                   max-w-7xl
                   px-4
                   py-6
                   pb-28
                   sm:px-5
                   sm:py-8
                   md:pb-10">


            {{-- ===================================================== --}}
            {{-- TOP NAV --}}
            {{-- ===================================================== --}}

            <div class="mb-5">

                <a
                    href="{{ route('buyer.dashboard') }}"
                    class="inline-flex
                           items-center
                           gap-2
                           rounded-xl
                           px-3
                           py-2
                           text-sm
                           font-semibold
                           text-slate-500
                           transition
                           hover:bg-white
                           hover:text-[#315ebc]
                           hover:shadow-sm"
                >
                    <i class="fa-solid fa-arrow-left text-xs"></i>

                    Dashboard
                </a>

            </div>


            {{-- ===================================================== --}}
            {{-- HEADER --}}
            {{-- ===================================================== --}}

            <section
                class="relative
                       mb-6
                       overflow-hidden
                       rounded-[28px]
                       border
                       border-white/70
                       bg-gradient-to-br
                       from-[#0a1d45]
                       via-[#244d9f]
                       to-[#4371d1]
                       px-5
                       py-6
                       text-white
                       shadow-xl
                       shadow-[#315ebc]/10
                       sm:px-7
                       sm:py-8"
            >

                <div
                    class="pointer-events-none
                           absolute
                           -right-20
                           -top-20
                           size-64
                           rounded-full
                           bg-white/10
                           blur-3xl"
                ></div>

                <div
                    class="pointer-events-none
                           -bottom-24
                           absolute
                           left-1/3
                           size-56
                           rounded-full
                           bg-[#7EA2F2]/20
                           blur-3xl"
                ></div>

                <div
                    class="relative
                           flex
                           flex-col
                           gap-5
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
                                   border
                                   border-white/10
                                   bg-white/10
                                   px-3
                                   py-1.5
                                   text-xs
                                   font-semibold
                                   text-blue-50
                                   backdrop-blur"
                        >
                            <i class="fa-solid fa-receipt text-[10px]"></i>
                            Transaksi Buyer
                        </span>

                        <h1
                            class="mt-4
                                   text-2xl
                                   font-black
                                   tracking-tight
                                   sm:text-3xl"
                        >
                            Pesanan Saya
                        </h1>

                        <p
                            class="mt-2
                                   max-w-2xl
                                   text-sm
                                   leading-6
                                   text-blue-100/90"
                        >
                            Pantau produk yang dipesan, jumlah barang, metode pembayaran,
                            total transaksi, dan status pesanan dalam satu tempat.
                        </p>

                    </div>

                    <div
                        class="rounded-2xl
                               border
                               border-white/10
                               bg-white/10
                               px-4
                               py-3
                               backdrop-blur"
                    >
                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-blue-100">
                            Total Pesanan
                        </p>

                        <p class="mt-1 text-2xl font-black">
                            {{ $orders->total() }}
                        </p>
                    </div>

                </div>

            </section>


            {{-- ===================================================== --}}
            {{-- SUCCESS --}}
            {{-- ===================================================== --}}

            @if (session('success'))

                <div
                    class="mb-5
                           flex
                           items-start
                           gap-3
                           rounded-2xl
                           border
                           border-emerald-200
                           bg-emerald-50
                           px-4
                           py-3.5
                           text-sm
                           text-emerald-700"
                >
                    <div
                        class="flex
                               size-9
                               shrink-0
                               items-center
                               justify-center
                               rounded-xl
                               bg-emerald-100"
                    >
                        <i class="fa-solid fa-circle-check"></i>
                    </div>

                    <div>
                        <p class="font-bold">Berhasil</p>
                        <p class="mt-0.5 text-xs leading-5">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>

            @endif


            {{-- ===================================================== --}}
            {{-- ERROR --}}
            {{-- ===================================================== --}}

            @if ($errors->any())

                <div
                    class="mb-5
                           rounded-2xl
                           border
                           border-rose-200
                           bg-rose-50
                           px-4
                           py-3.5
                           text-sm
                           text-rose-700"
                >
                    <div class="flex items-start gap-3">

                        <div
                            class="flex
                                   size-9
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-rose-100"
                        >
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>

                        <div>
                            <p class="font-bold">Terjadi masalah</p>

                            <ul class="mt-1 space-y-1 text-xs">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>

            @endif


            {{-- ===================================================== --}}
            {{-- ORDER LIST --}}
            {{-- ===================================================== --}}

            <div class="space-y-4">

                @forelse ($orders as $order)

                    @php
                        $status = strtolower($order->status ?? '');

                        $statusClass = match ($status) {
                            'pending' => 'border-amber-200 bg-amber-50 text-amber-700',
                            'confirmed' => 'border-blue-200 bg-blue-50 text-blue-700',
                            'processing' => 'border-orange-200 bg-orange-50 text-orange-700',
                            'completed' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
                            'cancelled' => 'border-rose-200 bg-rose-50 text-rose-700',
                            default => 'border-slate-200 bg-slate-50 text-slate-600',
                        };

                        $statusLabel = match ($status) {
                            'pending' => 'Menunggu',
                            'confirmed' => 'Dikonfirmasi',
                            'processing' => 'Diproses',
                            'completed' => 'Selesai',
                            'cancelled' => 'Dibatalkan',
                            default => ucfirst($status ?: 'Pesanan'),
                        };

                        $statusIcon = match ($status) {
                            'pending' => 'fa-clock',
                            'confirmed' => 'fa-circle-check',
                            'processing' => 'fa-box',
                            'completed' => 'fa-check-double',
                            'cancelled' => 'fa-circle-xmark',
                            default => 'fa-circle',
                        };

                        $storeName = $order->seller?->sellerProfile?->store_name
                            ?? ($order->seller?->name ?? 'Seller');

                        $storePhoto = $order->seller?->sellerProfile?->photo;

                        $paymentLabel = match ($order->payment_method) {
                            'transfer' => 'Transfer',
                            'cash' => 'Cash / Tunai',
                            default => 'Belum ditentukan',
                        };

                        $paymentIcon = match ($order->payment_method) {
                            'transfer' => 'fa-building-columns',
                            'cash' => 'fa-money-bill-wave',
                            default => 'fa-wallet',
                        };

                        $totalItems = $order->items->sum('quantity');
                    @endphp


                    <article
                        class="group
                               overflow-hidden
                               rounded-[26px]
                               border
                               border-slate-200/80
                               bg-white
                               shadow-sm
                               transition
                               duration-300
                               hover:-translate-y-0.5
                               hover:border-blue-200
                               hover:shadow-xl
                               hover:shadow-blue-950/5"
                    >

                        {{-- ================================================= --}}
                        {{-- CARD HEADER --}}
                        {{-- ================================================= --}}

                        <div
                            class="flex
                                   flex-col
                                   gap-4
                                   border-b
                                   border-slate-100
                                   bg-gradient-to-r
                                   from-white
                                   via-white
                                   to-blue-50/40
                                   px-4
                                   py-4
                                   sm:flex-row
                                   sm:items-center
                                   sm:justify-between
                                   sm:px-5"
                        >

                            <div class="flex min-w-0 items-center gap-3">

                                <div
                                    class="flex
                                           size-11
                                           shrink-0
                                           items-center
                                           justify-center
                                           rounded-2xl
                                           bg-[#0a1d45]
                                           text-white
                                           shadow-sm"
                                >
                                    <i class="fa-solid fa-receipt text-sm"></i>
                                </div>

                                <div class="min-w-0">

                                    <div
                                        class="flex
                                               flex-wrap
                                               items-center
                                               gap-x-2
                                               gap-y-1"
                                    >
                                        <p
                                            class="truncate
                                                   text-sm
                                                   font-black
                                                   text-slate-900
                                                   sm:text-base"
                                        >
                                            {{ $order->order_number }}
                                        </p>

                                        <span class="hidden text-slate-300 sm:inline">•</span>

                                        <p class="text-[11px] font-medium text-slate-400">
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>

                                    <div class="mt-1.5 flex items-center gap-2">

                                        <i class="fa-solid fa-store text-[10px] text-[#4371d1]"></i>

                                        <p
                                            class="truncate
                                                   text-xs
                                                   font-semibold
                                                   text-slate-500"
                                        >
                                            {{ $storeName }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                            <span
                                class="inline-flex
                                       w-fit
                                       shrink-0
                                       items-center
                                       gap-2
                                       rounded-full
                                       border
                                       px-3
                                       py-1.5
                                       text-xs
                                       font-bold
                                       {{ $statusClass }}"
                            >
                                <i class="fa-solid {{ $statusIcon }} text-[10px]"></i>
                                {{ $statusLabel }}
                            </span>

                        </div>


                        {{-- ================================================= --}}
                        {{-- PRODUCT CONTENT --}}
                        {{-- ================================================= --}}

                        <div class="p-4 sm:p-5">

                            <div
                                class="grid
                                       gap-5
                                       lg:grid-cols-[minmax(0,1fr)_300px]"
                            >

                                {{-- LEFT --}}
                                <div class="min-w-0">

                                    <div
                                        class="mb-3
                                               flex
                                               items-center
                                               justify-between
                                               gap-3"
                                    >
                                        <div>
                                            <p
                                                class="text-[10px]
                                                       font-bold
                                                       uppercase
                                                       tracking-[0.16em]
                                                       text-slate-400"
                                            >
                                                Produk Pesanan
                                            </p>

                                            <p class="mt-1 text-xs text-slate-500">
                                                {{ $totalItems }} item dalam pesanan ini
                                            </p>
                                        </div>

                                        <span
                                            class="rounded-full
                                                   bg-blue-50
                                                   px-2.5
                                                   py-1
                                                   text-[10px]
                                                   font-bold
                                                   text-[#315ebc]"
                                        >
                                            {{ $order->items->count() }} produk
                                        </span>
                                    </div>


                                    <div class="space-y-2.5">

                                        @foreach ($order->items as $item)

                                            @php
                                                $productImage = $item->product?->image;

                                                if ($productImage) {
                                                    $productImageUrl = \Illuminate\Support\Str::startsWith(
                                                        $productImage,
                                                        ['http://', 'https://']
                                                    )
                                                        ? $productImage
                                                        : asset('storage/' . $productImage);
                                                } else {
                                                    $productImageUrl = null;
                                                }
                                            @endphp

                                            <div
                                                class="flex
                                                       items-center
                                                       gap-3
                                                       rounded-2xl
                                                       border
                                                       border-slate-100
                                                       bg-slate-50/70
                                                       p-3
                                                       transition
                                                       group-hover:border-slate-200"
                                            >

                                                {{-- IMAGE --}}
                                                @if ($productImageUrl)

                                                    <img
                                                        src="{{ $productImageUrl }}"
                                                        alt="{{ $item->product_name }}"
                                                        class="size-14
                                                               shrink-0
                                                               rounded-xl
                                                               object-cover
                                                               sm:size-16"
                                                    >

                                                @else

                                                    <div
                                                        class="flex
                                                               size-14
                                                               shrink-0
                                                               items-center
                                                               justify-center
                                                               rounded-xl
                                                               bg-white
                                                               text-slate-300
                                                               shadow-sm
                                                               sm:size-16"
                                                    >
                                                        <i class="fa-regular fa-image text-lg"></i>
                                                    </div>

                                                @endif


                                                {{-- INFO --}}
                                                <div class="min-w-0 flex-1">

                                                    <p
                                                        class="line-clamp-2
                                                               text-sm
                                                               font-bold
                                                               leading-5
                                                               text-slate-800"
                                                    >
                                                        {{ $item->product_name }}
                                                    </p>

                                                    <div
                                                        class="mt-1.5
                                                               flex
                                                               flex-wrap
                                                               items-center
                                                               gap-x-3
                                                               gap-y-1
                                                               text-[11px]
                                                               text-slate-500"
                                                    >
                                                        <span>
                                                            {{ $item->quantity }} ×
                                                            Rp{{ number_format($item->price, 0, ',', '.') }}
                                                        </span>

                                                        <span class="hidden text-slate-300 sm:inline">•</span>

                                                        <span class="font-semibold text-slate-700">
                                                            Subtotal
                                                            Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                                        </span>
                                                    </div>

                                                </div>

                                                <div
                                                    class="hidden
                                                           shrink-0
                                                           text-right
                                                           sm:block"
                                                >
                                                    <p class="text-[10px] text-slate-400">
                                                        Jumlah
                                                    </p>

                                                    <p
                                                        class="mt-0.5
                                                               text-base
                                                               font-black
                                                               text-[#315ebc]"
                                                    >
                                                        {{ $item->quantity }}
                                                    </p>
                                                </div>

                                            </div>

                                        @endforeach

                                    </div>

                                </div>


                                {{-- RIGHT --}}
                                <aside
                                    class="rounded-2xl
                                           border
                                           border-slate-200
                                           bg-gradient-to-br
                                           from-slate-50
                                           to-blue-50/50
                                           p-4"
                                >

                                    <p
                                        class="text-[10px]
                                               font-bold
                                               uppercase
                                               tracking-[0.16em]
                                               text-slate-400"
                                    >
                                        Ringkasan
                                    </p>


                                    {{-- TOTAL --}}
                                    <div class="mt-4">

                                        <p class="text-xs font-medium text-slate-500">
                                            Total Bayar
                                        </p>

                                        <p
                                            class="mt-1
                                                   text-2xl
                                                   font-black
                                                   tracking-tight
                                                   text-[#0a1d45]"
                                        >
                                            Rp{{ number_format($order->subtotal, 0, ',', '.') }}
                                        </p>

                                    </div>


                                    {{-- PAYMENT --}}
                                    <div
                                        class="mt-4
                                               flex
                                               items-center
                                               gap-3
                                               rounded-xl
                                               border
                                               border-white
                                               bg-white
                                               p-3
                                               shadow-sm"
                                    >

                                        <div
                                            class="flex
                                                   size-9
                                                   shrink-0
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-blue-50
                                                   text-[#315ebc]"
                                        >
                                            <i class="fa-solid {{ $paymentIcon }} text-sm"></i>
                                        </div>

                                        <div class="min-w-0">

                                            <p class="text-[10px] font-medium text-slate-400">
                                                Metode Pembayaran
                                            </p>

                                            <p
                                                class="mt-0.5
                                                       truncate
                                                       text-sm
                                                       font-bold
                                                       text-slate-800"
                                            >
                                                {{ $paymentLabel }}
                                            </p>

                                        </div>

                                    </div>


                                    {{-- ITEM COUNT --}}
                                    <div
                                        class="mt-3
                                               flex
                                               items-center
                                               justify-between
                                               gap-3
                                               rounded-xl
                                               border
                                               border-white
                                               bg-white
                                               px-3
                                               py-2.5
                                               shadow-sm"
                                    >
                                        <span class="text-xs text-slate-500">
                                            Total Item
                                        </span>

                                        <span
                                            class="rounded-full
                                                   bg-slate-100
                                                   px-2.5
                                                   py-1
                                                   text-xs
                                                   font-bold
                                                   text-slate-700"
                                        >
                                            {{ $totalItems }}
                                        </span>
                                    </div>

                                </aside>

                            </div>


                            {{-- ================================================= --}}
                            {{-- ACTIONS --}}
                            {{-- ================================================= --}}

                            <div
                                class="mt-5
                                       flex
                                       flex-col
                                       gap-3
                                       border-t
                                       border-slate-100
                                       pt-4
                                       sm:flex-row
                                       sm:items-center
                                       sm:justify-between"
                            >

                                <div
                                    class="flex
                                           items-center
                                           gap-2
                                           text-xs
                                           text-slate-400"
                                >
                                    <i class="fa-solid fa-shield-halved text-emerald-500"></i>
                                    Pesanan tercatat di KampusMart
                                </div>


                                <div
                                    class="flex
                                           flex-col
                                           gap-2
                                           sm:flex-row"
                                >

                                    

                                    @if (Route::has('buyer.orders.show'))

                                        <a
                                            href="{{ route('buyer.orders.show', $order) }}"
                                            class="inline-flex
                                                   items-center
                                                   justify-center
                                                   gap-2
                                                   rounded-xl
                                                   border
                                                   border-slate-200
                                                   bg-white
                                                   px-4
                                                   py-2.5
                                                   text-xs
                                                   font-bold
                                                   text-slate-700
                                                   transition
                                                   hover:border-blue-200
                                                   hover:bg-blue-50
                                                   hover:text-[#315ebc]"
                                        >
                                            Lihat Detail

                                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                        </a>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </article>


                @empty

                    {{-- ================================================= --}}
                    {{-- EMPTY STATE --}}
                    {{-- ================================================= --}}

                    <section
                        class="relative
                               overflow-hidden
                               rounded-[28px]
                               border
                               border-dashed
                               border-slate-300
                               bg-white
                               px-6
                               py-16
                               text-center
                               shadow-sm"
                    >

                        <div
                            class="mx-auto
                                   flex
                                   size-20
                                   items-center
                                   justify-center
                                   rounded-3xl
                                   bg-blue-50
                                   text-3xl
                                   text-[#315ebc]"
                        >
                            <i class="fa-solid fa-bag-shopping"></i>
                        </div>

                        <h2 class="mt-5 text-lg font-black text-slate-900">
                            Belum ada pesanan
                        </h2>

                        <p
                            class="mx-auto
                                   mt-2
                                   max-w-md
                                   text-sm
                                   leading-6
                                   text-slate-500"
                        >
                            Pesanan yang kamu buat akan tampil di sini lengkap
                            dengan produk, total pembayaran, dan statusnya.
                        </p>

                        <a
                            href="{{ route('buyer.products.index') }}"
                            class="mt-6
                                   inline-flex
                                   h-11
                                   items-center
                                   justify-center
                                   gap-2
                                   rounded-xl
                                   bg-[#315ebc]
                                   px-5
                                   text-sm
                                   font-bold
                                   text-white
                                   shadow-lg
                                   shadow-blue-600/15
                                   transition
                                   hover:-translate-y-0.5
                                   hover:bg-[#244d9f]"
                        >
                            <i class="fa-solid fa-bag-shopping"></i>
                            Mulai Belanja
                        </a>

                    </section>

                @endforelse

            </div>


            {{-- ===================================================== --}}
            {{-- PAGINATION --}}
            {{-- ===================================================== --}}

            @if ($orders->hasPages())

                <div
                    class="mt-7
                           flex
                           flex-col
                           gap-4
                           rounded-2xl
                           border
                           border-slate-200
                           bg-white
                           px-4
                           py-4
                           shadow-sm
                           sm:flex-row
                           sm:items-center
                           sm:justify-between"
                >

                    {{-- INFO --}}
                    <p class="text-center text-xs text-slate-500 sm:text-left">

                        Menampilkan

                        <span class="font-bold text-slate-800">
                            {{ $orders->firstItem() }}
                        </span>

                        -

                        <span class="font-bold text-slate-800">
                            {{ $orders->lastItem() }}
                        </span>

                        dari

                        <span class="font-bold text-[#315ebc]">
                            {{ $orders->total() }}
                        </span>

                        pesanan

                    </p>


                    {{-- BUTTONS --}}
                    <div class="flex flex-wrap items-center justify-center gap-1.5">

                        {{-- PREVIOUS --}}
                        @if ($orders->onFirstPage())

                            <span
                                class="flex
                                       size-9
                                       cursor-not-allowed
                                       items-center
                                       justify-center
                                       rounded-xl
                                       border
                                       border-slate-200
                                       bg-slate-50
                                       text-xs
                                       text-slate-300"
                            >
                                <i class="fa-solid fa-chevron-left"></i>
                            </span>

                        @else

                            <a
                                href="{{ $orders->previousPageUrl() }}"
                                class="flex
                                       size-9
                                       items-center
                                       justify-center
                                       rounded-xl
                                       border
                                       border-slate-200
                                       bg-white
                                       text-xs
                                       text-slate-600
                                       transition
                                       hover:border-blue-200
                                       hover:bg-blue-50
                                       hover:text-[#315ebc]"
                            >
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>

                        @endif


                        {{-- PAGE NUMBERS --}}
                        @foreach (
                            $orders->getUrlRange(
                                max(1, $orders->currentPage() - 2),
                                min($orders->lastPage(), $orders->currentPage() + 2)
                            ) as $page => $url
                        )

                            @if ($page === $orders->currentPage())

                                <span
                                    class="flex
                                           size-9
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#315ebc]
                                           text-xs
                                           font-bold
                                           text-white
                                           shadow-md
                                           shadow-blue-600/15"
                                >
                                    {{ $page }}
                                </span>

                            @else

                                <a
                                    href="{{ $url }}"
                                    class="flex
                                           size-9
                                           items-center
                                           justify-center
                                           rounded-xl
                                           border
                                           border-slate-200
                                           bg-white
                                           text-xs
                                           font-semibold
                                           text-slate-600
                                           transition
                                           hover:border-blue-200
                                           hover:bg-blue-50
                                           hover:text-[#315ebc]"
                                >
                                    {{ $page }}
                                </a>

                            @endif

                        @endforeach


                        {{-- NEXT --}}
                        @if ($orders->hasMorePages())

                            <a
                                href="{{ $orders->nextPageUrl() }}"
                                class="flex
                                       size-9
                                       items-center
                                       justify-center
                                       rounded-xl
                                       border
                                       border-slate-200
                                       bg-white
                                       text-xs
                                       text-slate-600
                                       transition
                                       hover:border-blue-200
                                       hover:bg-blue-50
                                       hover:text-[#315ebc]"
                            >
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>

                        @else

                            <span
                                class="flex
                                       size-9
                                       cursor-not-allowed
                                       items-center
                                       justify-center
                                       rounded-xl
                                       border
                                       border-slate-200
                                       bg-slate-50
                                       text-xs
                                       text-slate-300"
                            >
                                <i class="fa-solid fa-chevron-right"></i>
                            </span>

                        @endif

                    </div>

                </div>

            @endif

        </main>

    </div>

@endsection
