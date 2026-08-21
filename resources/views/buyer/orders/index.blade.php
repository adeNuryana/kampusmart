@extends('layouts.public')

@section('title', 'Pesanan Saya - KampusMart')

@section('content')

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
                   py-6
                   pb-28
                   sm:px-5
                   sm:py-8
                   md:pb-10">


            {{-- ===================================================== --}}
            {{-- HEADER --}}
            {{-- ===================================================== --}}

            <section
                class="relative
                       mb-5
                       overflow-hidden
                       rounded-3xl
                       border
                       border-[#E6D8CD]
                       bg-gradient-to-br
                       from-white
                       via-[#FBF8F5]
                       to-[#F4EAE2]
                       p-5
                       shadow-sm
                       sm:p-6">


                {{-- DECORATION --}}

                <div
                    class="pointer-events-none
                           absolute
                           -right-20
                           -top-20
                           size-52
                           rounded-full
                           bg-[#C8795A]/10
                           blur-3xl">
                </div>


                <div
                    class="pointer-events-none
                           absolute
                           -bottom-20
                           left-1/3
                           size-44
                           rounded-full
                           bg-[#C89B55]/10
                           blur-3xl">
                </div>


                <div class="relative">

                    <div
                        class="inline-flex
                               items-center
                               gap-2
                               rounded-full
                               bg-[#F4EAE2]
                               px-3
                               py-1.5
                               text-xs
                               font-bold
                               text-[#6F4E37]">

                        <i class="fa-solid fa-receipt"></i>

                        Transaksi

                    </div>


                    <h1
                        class="mt-3
                               text-2xl
                               font-black
                               tracking-tight
                               text-slate-900
                               sm:text-3xl">

                        Pesanan Saya

                    </h1>


                    <p
                        class="mt-2
                               max-w-2xl
                               text-sm
                               leading-6
                               text-slate-500">

                        Pantau seluruh transaksi, status pesanan,
                        dan riwayat pembelianmu di KampusMart.

                    </p>

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
                           border-[#D1DEC9]
                           bg-[#EEF3EA]
                           px-4
                           py-3
                           text-sm
                           text-[#65795E]">


                    <div
                        class="flex
                               size-8
                               shrink-0
                               items-center
                               justify-center
                               rounded-lg
                               bg-[#DCE8D6]">

                        <i class="fa-solid fa-circle-check"></i>

                    </div>


                    <div>

                        <p class="font-semibold">
                            Berhasil
                        </p>

                        <p class="mt-0.5 text-xs">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>
            @endif



            {{-- ===================================================== --}}
            {{-- ORDER LIST --}}
            {{-- ===================================================== --}}

            <div class="space-y-4">


                @forelse ($orders as $order)

                    @php

                        /*
                        |--------------------------------------------------------------------------
                        | Status
                        |--------------------------------------------------------------------------
                        */

                        $statusClass = match ($order->status) {
                            'pending' => 'bg-[#FAF2DF] text-[#A87A37] border-[#ECD7AF]',

                            'confirmed' => 'bg-[#F4EAE2] text-[#6F4E37] border-[#E4D0C0]',

                            'processing' => 'bg-[#FBEAE2] text-[#A95E43] border-[#F1D4C2]',

                            'completed' => 'bg-[#EEF3EA] text-[#65795E] border-[#D1DEC9]',

                            'cancelled' => 'bg-[#FAEDEC] text-[#A65954] border-[#E9C9C5]',

                            default => 'bg-slate-100 text-slate-600 border-slate-200',
                        };

                        $statusLabel = match ($order->status) {
                            'pending' => 'Menunggu',

                            'confirmed' => 'Dikonfirmasi',

                            'processing' => 'Diproses',

                            'completed' => 'Selesai',

                            'cancelled' => 'Dibatalkan',

                            default => ucfirst($order->status),
                        };

                        $statusIcon = match ($order->status) {
                            'pending' => 'fa-clock',

                            'confirmed' => 'fa-circle-check',

                            'processing' => 'fa-box',

                            'completed' => 'fa-check-double',

                            'cancelled' => 'fa-circle-xmark',

                            default => 'fa-circle',
                        };

                        /*
                        |--------------------------------------------------------------------------
                        | Seller
                        |--------------------------------------------------------------------------
                        */

                        $storeName = $order->seller?->sellerProfile?->store_name ?? ($order->seller?->name ?? 'Seller');

                        $storePhoto = $order->seller?->sellerProfile?->photo;

                        /*
                        |--------------------------------------------------------------------------
                        | Items
                        |--------------------------------------------------------------------------
                        */

                        $totalItems = $order->items->sum('quantity');

                    @endphp



                    <article
                        class="group
                               overflow-hidden
                               rounded-3xl
                               border
                               border-[#E5D8CE]
                               bg-white
                               shadow-sm
                               transition
                               duration-300
                               hover:border-[#DCC9BB]
                               hover:shadow-lg">


                        {{-- ================================================= --}}
                        {{-- ORDER HEADER --}}
                        {{-- ================================================= --}}

                        <div
                            class="flex
                                   flex-col
                                   gap-4
                                   border-b
                                   border-[#EFE4DC]
                                   bg-gradient-to-r
                                   from-[#FBF8F5]
                                   via-white
                                   to-[#F7EFE9]
                                   p-4
                                   sm:flex-row
                                   sm:items-center
                                   sm:justify-between
                                   sm:p-5">


                            <div
                                class="flex
                                       min-w-0
                                       items-center
                                       gap-3">


                                <div
                                    class="flex
                                           size-11
                                           shrink-0
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-gradient-to-br
                                           from-[#5B3B2B]
                                           via-[#6F4E37]
                                           to-[#8B6245]
                                           text-white
                                           shadow-sm">

                                    <i class="fa-solid fa-receipt"></i>

                                </div>


                                <div class="min-w-0">

                                    <p
                                        class="text-[10px]
                                               font-semibold
                                               uppercase
                                               tracking-wider
                                               text-[#A38B7B]">

                                        Nomor Pesanan

                                    </p>


                                    <p
                                        class="mt-1
                                               truncate
                                               text-sm
                                               font-black
                                               text-slate-900
                                               sm:text-base">

                                        {{ $order->order_number }}

                                    </p>

                                </div>

                            </div>



                            {{-- STATUS --}}

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
                                       {{ $statusClass }}">

                                <i
                                    class="fa-solid
                                           {{ $statusIcon }}
                                           text-[10px]">
                                </i>

                                {{ $statusLabel }}

                            </span>

                        </div>



                        {{-- ================================================= --}}
                        {{-- CONTENT --}}
                        {{-- ================================================= --}}

                        <div class="p-4 sm:p-5">


                            <div
                                class="grid
                                       gap-5
                                       lg:grid-cols-[minmax(0,1fr)_220px]">


                                {{-- ================================================= --}}
                                {{-- LEFT --}}
                                {{-- ================================================= --}}

                                <div>


                                    {{-- SELLER --}}

                                    <div
                                        class="flex
                                               items-center
                                               gap-3">


                                        @if ($storePhoto)
                                            <img src="{{ asset('storage/' . $storePhoto) }}"
                                                alt="{{ $storeName }}"
                                                class="size-11
                                                       shrink-0
                                                       rounded-full
                                                       border
                                                       border-[#E5D8CE]
                                                       object-cover">
                                        @else
                                            <div
                                                class="flex
                                                       size-11
                                                       shrink-0
                                                       items-center
                                                       justify-center
                                                       rounded-full
                                                       bg-gradient-to-br
                                                       from-[#F4EAE2]
                                                       to-[#E6D3C5]
                                                       text-sm
                                                       font-black
                                                       text-[#6F4E37]">

                                                {{ strtoupper(substr($storeName, 0, 1)) }}

                                            </div>
                                        @endif


                                        <div class="min-w-0">

                                            <p
                                                class="text-[10px]
                                                       font-semibold
                                                       uppercase
                                                       tracking-wider
                                                       text-slate-400">

                                                Penjual

                                            </p>


                                            <p
                                                class="mt-1
                                                       truncate
                                                       text-sm
                                                       font-bold
                                                       text-slate-800">

                                                {{ $storeName }}

                                            </p>

                                        </div>

                                    </div>



                                    {{-- ITEMS INFO --}}

                                    <div
                                        class="mt-5
                                               rounded-2xl
                                               border
                                               border-[#EEE4DC]
                                               bg-[#FCF9F7]
                                               p-4">


                                        <div
                                            class="mb-3
                                                   flex
                                                   items-center
                                                   justify-between
                                                   gap-3">


                                            <div
                                                class="flex
                                                       items-center
                                                       gap-2">

                                                <div
                                                    class="flex
                                                           size-8
                                                           items-center
                                                           justify-center
                                                           rounded-lg
                                                           bg-[#F4EAE2]
                                                           text-xs
                                                           text-[#6F4E37]">

                                                    <i
                                                        class="fa-solid
                                                               fa-box">
                                                    </i>

                                                </div>


                                                <span
                                                    class="text-xs
                                                           font-semibold
                                                           text-slate-600">

                                                    Produk Pesanan

                                                </span>

                                            </div>


                                            <span
                                                class="rounded-full
                                                       bg-white
                                                       px-2.5
                                                       py-1
                                                       text-[10px]
                                                       font-bold
                                                       text-[#6F4E37]
                                                       shadow-sm">

                                                {{ $totalItems }}
                                                barang

                                            </span>

                                        </div>



                                        {{-- PRODUCT PREVIEW --}}

                                        <div class="space-y-2">


                                            @foreach ($order->items->take(2) as $item)
                                                <div
                                                    class="flex
                                                           items-center
                                                           justify-between
                                                           gap-3">


                                                    <p
                                                        class="min-w-0
                                                               truncate
                                                               text-sm
                                                               text-slate-600">

                                                        {{ $item->product_name }}

                                                    </p>


                                                    <span
                                                        class="shrink-0
                                                               text-xs
                                                               font-semibold
                                                               text-[#8B6245]">

                                                        × {{ $item->quantity }}

                                                    </span>

                                                </div>
                                            @endforeach


                                            @if ($order->items->count() > 2)
                                                <div
                                                    class="border-t
                                                           border-dashed
                                                           border-[#DED0C5]
                                                           pt-2">

                                                    <p
                                                        class="text-[10px]
                                                               font-medium
                                                               text-slate-400">

                                                        +

                                                        {{ $order->items->count() - 2 }}

                                                        produk lainnya

                                                    </p>

                                                </div>
                                            @endif

                                        </div>

                                    </div>

                                </div>



                                {{-- ================================================= --}}
                                {{-- RIGHT / TOTAL --}}
                                {{-- ================================================= --}}

                                <div
                                    class="flex
                                           flex-col
                                           justify-between
                                           gap-4
                                           rounded-2xl
                                           border
                                           border-[#E8D8CC]
                                           bg-gradient-to-br
                                           from-[#FBF4EF]
                                           via-[#F8EEE7]
                                           to-[#F2E2D7]
                                           p-4">


                                    <div>

                                        <p
                                            class="text-xs
                                                   font-medium
                                                   text-[#9A806F]">

                                            Total Pesanan

                                        </p>


                                        <p
                                            class="mt-1
                                                   text-xl
                                                   font-black
                                                   tracking-tight
                                                   text-[#5B3B2B]">

                                            Rp{{ number_format($order->subtotal, 0, ',', '.') }}

                                        </p>

                                    </div>



                                    <div
                                        class="border-t
                                               border-[#E1D2C7]
                                               pt-3">


                                        <div
                                            class="flex
                                                   items-center
                                                   gap-2
                                                   text-[10px]
                                                   text-slate-500">

                                            <i
                                                class="fa-regular
                                                       fa-calendar
                                                       text-[#C8795A]">
                                            </i>

                                            {{ $order->created_at->format('d M Y, H:i') }}

                                        </div>

                                    </div>

                                </div>

                            </div>



                            {{-- ================================================= --}}
                            {{-- BOTTOM ACTION --}}
                            {{-- ================================================= --}}

                            <div
                                class="mt-5
                                       flex
                                       flex-col
                                       gap-3
                                       border-t
                                       border-[#F0E7E0]
                                       pt-4
                                       sm:flex-row
                                       sm:items-center
                                       sm:justify-between">


                                <div
                                    class="flex
                                           items-center
                                           gap-2
                                           text-xs
                                           text-slate-400">

                                    <i
                                        class="fa-solid
                                               fa-shield-halved
                                               text-[#7F9275]">
                                    </i>

                                    Pesanan tercatat di KampusMart

                                </div>


                                @if (Route::has('buyer.orders.show'))
                                    <a href="{{ route('buyer.orders.show', $order) }}"
                                        class="group
                                               inline-flex
                                               items-center
                                               justify-center
                                               gap-2
                                               rounded-xl
                                               border
                                               border-[#DCC9BB]
                                               bg-white
                                               px-4
                                               py-2.5
                                               text-xs
                                               font-bold
                                               text-[#6F4E37]
                                               transition
                                               hover:bg-[#FBF4EF]">

                                        Lihat Detail

                                        <i
                                            class="fa-solid
                                                   fa-arrow-right
                                                   text-[10px]
                                                   transition
                                                   group-hover:translate-x-1">
                                        </i>

                                    </a>
                                @endif

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
                               rounded-3xl
                               border
                               border-dashed
                               border-[#DCC9BB]
                               bg-white
                               px-6
                               py-16
                               text-center">


                        <div
                            class="pointer-events-none
                                   absolute
                                   left-1/2
                                   top-8
                                   size-52
                                   -translate-x-1/2
                                   rounded-full
                                   bg-[#C89B55]/10
                                   blur-3xl">
                        </div>


                        <div class="relative">


                            <div
                                class="mx-auto
                                       flex
                                       size-20
                                       items-center
                                       justify-center
                                       rounded-3xl
                                       bg-gradient-to-br
                                       from-[#F4EAE2]
                                       to-[#E9D8CB]
                                       text-3xl
                                       text-[#6F4E37]
                                       shadow-sm">

                                <i class="fa-solid fa-receipt"></i>

                            </div>


                            <h2
                                class="mt-5
                                       text-lg
                                       font-black
                                       text-slate-900">

                                Belum ada pesanan

                            </h2>


                            <p
                                class="mx-auto
                                       mt-2
                                       max-w-md
                                       text-sm
                                       leading-6
                                       text-slate-500">

                                Pesanan yang kamu buat akan tampil
                                di halaman ini dan bisa dipantau
                                statusnya.

                            </p>


                            <a href="{{ route('buyer.products.index') }}"
                                class="mt-6
                                       inline-flex
                                       h-11
                                       items-center
                                       justify-center
                                       gap-2
                                       rounded-xl
                                       bg-gradient-to-r
                                       from-[#5B3B2B]
                                       via-[#6F4E37]
                                       to-[#8B6245]
                                       px-5
                                       text-sm
                                       font-bold
                                       text-white
                                       shadow-lg
                                       shadow-[#6F4E37]/20
                                       transition
                                       duration-300
                                       hover:-translate-y-0.5
                                       hover:shadow-xl">

                                <i class="fa-solid fa-bag-shopping"></i>

                                Mulai Belanja

                            </a>

                        </div>

                    </section>

                @endforelse

            </div>



            {{-- ===================================================== --}}
            {{-- PAGINATION --}}
            {{-- ===================================================== --}}

            @if ($orders->hasPages())
                <div
                    class="mt-8
                           rounded-2xl
                           border
                           border-[#E5D8CE]
                           bg-white
                           px-4
                           py-3
                           shadow-sm">

                    {{ $orders->links() }}

                </div>
            @endif

        </main>

    </div>

@endsection
