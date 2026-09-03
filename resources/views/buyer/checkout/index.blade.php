@extends('layouts.public')

@section('title', 'Checkout - KampusMart')

@section('content')

    @php

        $storeName = $seller->sellerProfile?->store_name ?? ($seller->name ?? 'Penjual');

        $storePhoto = $seller->sellerProfile?->photo;

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


                <div
                    class="pointer-events-none
                           absolute
                           -right-20
                           -top-20
                           size-52
                           rounded-full
                           bg-[#C89B55]/10
                           blur-3xl">
                </div>


                <div class="relative">


                    {{-- BACK --}}

                    <a href="{{ route('buyer.cart.index') }}"
                        class="inline-flex
                               items-center
                               gap-2
                               text-xs
                               font-semibold
                               text-[#4371d1]
                               transition
                               hover:text-[#0a1d45]
                               sm:text-sm">

                        <span
                            class="flex
                                   size-7
                                   items-center
                                   justify-center
                                   rounded-lg
                                   bg-[#F4EAE2]">

                            <i
                                class="fa-solid
                                       fa-arrow-left
                                       text-[10px]">
                            </i>

                        </span>

                        Kembali ke Keranjang

                    </a>



                    <div
                        class="mt-5
                               flex
                               flex-col
                               gap-5
                               sm:flex-row
                               sm:items-end
                               sm:justify-between">


                        <div>

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
                                       text-[#4371d1]">

                                <i class="fa-solid fa-bag-shopping"></i>

                                Checkout

                            </div>


                            <h1
                                class="mt-3
                                       text-2xl
                                       font-black
                                       tracking-tight
                                       text-slate-900
                                       sm:text-3xl">

                                Buat Pesanan

                            </h1>


                            <p
                                class="mt-2
                                       max-w-xl
                                       text-sm
                                       leading-6
                                       text-slate-500">

                                Pastikan produk, jumlah, dan data pembeli
                                sudah benar sebelum membuat pesanan.

                            </p>

                        </div>



                        {{-- STEP --}}

                        <div
                            class="flex
                                   shrink-0
                                   items-center
                                   gap-2
                                   text-[10px]
                                   font-semibold
                                   sm:text-xs">


                            <div
                                class="flex
                                       items-center
                                       gap-2
                                       text-[#65795E]">

                                <span
                                    class="flex
                                           size-7
                                           items-center
                                           justify-center
                                           rounded-full
                                           bg-[#7F9275]
                                           text-white">

                                    <i
                                        class="fa-solid
                                               fa-check
                                               text-[9px]">
                                    </i>

                                </span>

                                Keranjang

                            </div>


                            <div
                                class="h-px
                                       w-6
                                       bg-[#DCC9BB]">
                            </div>


                            <div
                                class="flex
                                       items-center
                                       gap-2
                                       text-[#4371d1]">

                                <span
                                    class="flex
                                           size-7
                                           items-center
                                           justify-center
                                           rounded-full
                                           bg-[#4371d1]
                                           text-white">

                                    2

                                </span>

                                Checkout

                            </div>

                        </div>

                    </div>

                </div>

            </section>



            {{-- ===================================================== --}}
            {{-- VALIDATION ERROR --}}
            {{-- ===================================================== --}}

            @if ($errors->any())

                <div
                    class="mb-5
                           rounded-2xl
                           border
                           border-[#E9C9C5]
                           bg-[#FAEDEC]
                           px-4
                           py-4
                           text-sm
                           text-[#A65954]">


                    <div
                        class="mb-2
                               flex
                               items-center
                               gap-2
                               font-semibold">

                        <i class="fa-solid fa-circle-exclamation"></i>

                        Data checkout belum lengkap

                    </div>


                    <ul
                        class="list-disc
                               space-y-1
                               pl-5
                               text-xs">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif



            {{-- ===================================================== --}}
            {{-- FORM --}}
            {{-- ===================================================== --}}

            <form action="{{ route('buyer.checkout.store') }}" method="POST">

                @csrf


                {{-- SELLER ID --}}

                <input type="hidden" name="seller_id" value="{{ $seller->id }}">



                <div
                    class="grid
                           gap-5
                           lg:grid-cols-[minmax(0,1fr)_340px]">


                    {{-- ================================================= --}}
                    {{-- LEFT CONTENT --}}
                    {{-- ================================================= --}}

                    <div class="space-y-5">


                        {{-- ================================================= --}}
                        {{-- SELLER --}}
                        {{-- ================================================= --}}

                        <section
                            class="relative
                                   overflow-hidden
                                   rounded-3xl
                                   border
                                   border-[#E5D8CE]
                                   bg-white
                                   p-5
                                   shadow-sm">


                            <div
                                class="pointer-events-none
                                       absolute
                                       -right-14
                                       -top-14
                                       size-36
                                       rounded-full
                                       bg-[#7F9275]/10
                                       blur-3xl">
                            </div>


                            <div class="relative">


                                <div
                                    class="mb-4
                                           flex
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
                                               text-[#4371d1]">

                                        <i class="fa-solid fa-store"></i>

                                    </div>


                                    <p
                                        class="text-xs
                                               font-bold
                                               uppercase
                                               tracking-wider
                                               text-[#9A806F]">

                                        Penjual

                                    </p>

                                </div>



                                <div
                                    class="flex
                                           items-center
                                           gap-4">


                                    {{-- STORE PHOTO --}}

                                    @if ($storePhoto)
                                        <img src="{{ asset('storage/' . $storePhoto) }}"
                                            alt="{{ $storeName }}"
                                            class="size-14
                                                   shrink-0
                                                   rounded-full
                                                   border-2
                                                   border-white
                                                   object-cover
                                                   shadow-md
                                                   sm:size-16">
                                    @else
                                        <div
                                            class="flex
                                                   size-14
                                                   shrink-0
                                                   items-center
                                                   justify-center
                                                   rounded-full
                                                   bg-gradient-to-br
                                                   from-[#0a1d45]
                                                   via-[#4371d1]
                                                   to-[#4371d1]
                                                   text-lg
                                                   font-black
                                                   text-white
                                                   shadow-md
                                                   sm:size-16">

                                            {{ strtoupper(substr($storeName, 0, 1)) }}

                                        </div>
                                    @endif



                                    {{-- SELLER INFO --}}

                                    <div class="min-w-0">

                                        <h2
                                            class="truncate
                                                   text-base
                                                   font-bold
                                                   text-slate-900
                                                   sm:text-lg">

                                            {{ $storeName }}

                                        </h2>


                                        <p
                                            class="mt-1
                                                   truncate
                                                   text-xs
                                                   text-slate-500
                                                   sm:text-sm">

                                            {{ $seller->name }}

                                        </p>


                                        <span
                                            class="mt-2
                                                   inline-flex
                                                   items-center
                                                   gap-1.5
                                                   rounded-full
                                                   bg-[#EEF3EA]
                                                   px-2.5
                                                   py-1
                                                   text-[9px]
                                                   font-semibold
                                                   text-[#65795E]
                                                   sm:text-[10px]">

                                            <i class="fa-solid fa-circle-check"></i>

                                            Seller KampusMart

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </section>



                        {{-- ================================================= --}}
                        {{-- PRODUCTS --}}
                        {{-- ================================================= --}}

                        <section
                            class="overflow-hidden
                                   rounded-3xl
                                   border
                                   border-[#E5D8CE]
                                   bg-white
                                   shadow-sm">


                            {{-- HEADER --}}

                            <div
                                class="flex
                                       items-center
                                       justify-between
                                       gap-4
                                       border-b
                                       border-[#EFE4DC]
                                       bg-gradient-to-r
                                       from-[#FBF8F5]
                                       to-white
                                       px-5
                                       py-4">


                                <div>

                                    <h2 class="font-bold
                                               text-slate-900">

                                        Produk Pesanan

                                    </h2>


                                    <p
                                        class="mt-1
                                               text-xs
                                               text-slate-500">

                                        {{ $cartItems->count() }}
                                        jenis produk dari toko ini.

                                    </p>

                                </div>


                                <div
                                    class="flex
                                           size-10
                                           shrink-0
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#F4EAE2]
                                           text-[#4371d1]">

                                    <i class="fa-solid fa-box"></i>

                                </div>

                            </div>



                            {{-- PRODUCT LIST --}}

                            <div class="divide-y
                                       divide-[#F0E7E0]">


                                @foreach ($cartItems as $item)
                                    @php

                                        $product = $item->product;

                                        $itemSubtotal = $product->price * $item->quantity;

                                    @endphp


                                    <article
                                        class="group
                                               p-4
                                               transition
                                               hover:bg-[#FCF9F7]
                                               sm:p-5">


                                        <div
                                            class="flex
                                                   gap-3
                                                   sm:gap-4">


                                            {{-- IMAGE --}}

                                            <a href="{{ route('buyer.products.show', $product) }}"
                                                class="shrink-0">


                                                @if ($product->image)
                                                    <div
                                                        class="size-20
                                                               overflow-hidden
                                                               rounded-2xl
                                                               bg-[#F4EFEB]
                                                               sm:size-24">

                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            alt="{{ $product->name }}"
                                                            class="size-full
                                                                   object-cover
                                                                   transition
                                                                   duration-500
                                                                   group-hover:scale-105">

                                                    </div>
                                                @else
                                                    <div
                                                        class="flex
                                                               size-20
                                                               items-center
                                                               justify-center
                                                               rounded-2xl
                                                               bg-gradient-to-br
                                                               from-[#F5EFEB]
                                                               to-[#EEE4DC]
                                                               text-[#C7B4A7]
                                                               sm:size-24">

                                                        <i
                                                            class="fa-regular
                                                                   fa-image
                                                                   text-3xl">
                                                        </i>

                                                    </div>
                                                @endif

                                            </a>



                                            {{-- INFO --}}

                                            <div
                                                class="min-w-0
                                                       flex-1">


                                                <a href="{{ route('buyer.products.show', $product) }}"
                                                    class="line-clamp-2
                                                           text-sm
                                                           font-bold
                                                           leading-5
                                                           text-slate-800
                                                           transition
                                                           hover:text-[#4371d1]
                                                           sm:text-base">

                                                    {{ $product->name }}

                                                </a>


                                                <span
                                                    class="mt-1.5
                                                           inline-flex
                                                           rounded-md
                                                           bg-[#FAF6F3]
                                                           px-2
                                                           py-1
                                                           text-[9px]
                                                           font-medium
                                                           text-slate-500
                                                           sm:text-[10px]">

                                                    {{ $product->category?->name ?? 'Tanpa kategori' }}

                                                </span>


                                                <p
                                                    class="mt-2
                                                           text-xs
                                                           text-slate-500
                                                           sm:text-sm">

                                                    <span
                                                        class="font-semibold
                                                               text-[#4371d1]">

                                                        {{ $item->quantity }}

                                                    </span>

                                                    ×

                                                    Rp{{ number_format($product->price, 0, ',', '.') }}

                                                </p>

                                            </div>



                                            {{-- SUBTOTAL --}}

                                            <div
                                                class="shrink-0
                                                       text-right">

                                                <p
                                                    class="hidden
                                                           text-[10px]
                                                           text-slate-400
                                                           sm:block">

                                                    Subtotal

                                                </p>


                                                <p
                                                    class="mt-1
                                                           text-sm
                                                           font-black
                                                           text-[#0a1d45]
                                                           sm:text-base">

                                                    Rp{{ number_format($itemSubtotal, 0, ',', '.') }}

                                                </p>

                                            </div>

                                        </div>

                                    </article>
                                @endforeach

                            </div>


                            {{-- PRODUCT FOOTER --}}

                            <div
                                class="flex
                                       items-center
                                       justify-between
                                       gap-4
                                       border-t
                                       border-[#EFE4DC]
                                       bg-[#FCF9F7]
                                       px-5
                                       py-4">


                                <span class="text-xs
                                           text-slate-500">

                                    Total item

                                </span>


                                <span
                                    class="rounded-full
                                           bg-[#F4EAE2]
                                           px-3
                                           py-1.5
                                           text-xs
                                           font-bold
                                           text-[#4371d1]">

                                    {{ $cartItems->sum('quantity') }}
                                    item

                                </span>

                            </div>

                        </section>



                        {{-- ================================================= --}}
                        {{-- BUYER DATA --}}
                        {{-- ================================================= --}}

                        <section
                            class="overflow-hidden
                                   rounded-3xl
                                   border
                                   border-[#E5D8CE]
                                   bg-white
                                   shadow-sm">


                            {{-- HEADER --}}

                            <div
                                class="border-b
                                       border-[#EFE4DC]
                                       bg-gradient-to-r
                                       from-[#FBF8F5]
                                       to-white
                                       px-5
                                       py-4">


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
                                               bg-[#F4EAE2]
                                               text-[#4371d1]">

                                        <i class="fa-regular fa-user"></i>

                                    </div>


                                    <div>

                                        <h2
                                            class="font-bold
                                                   text-slate-900">

                                            Data Pembeli

                                        </h2>


                                        <p
                                            class="mt-1
                                                   text-xs
                                                   text-slate-500">

                                            Data ini akan ikut dikirim
                                            bersama informasi pesanan.

                                        </p>

                                    </div>

                                </div>

                            </div>



                            {{-- FORM BODY --}}

                            <div
                                class="grid
                                       gap-5
                                       p-5
                                       sm:grid-cols-2">


                                {{-- NAME --}}

                                <div>

                                    <label for="buyer_name"
                                        class="mb-2
                                               block
                                               text-sm
                                               font-semibold
                                               text-slate-700">

                                        Nama Pembeli

                                    </label>


                                    <div class="relative">

                                        <div
                                            class="pointer-events-none
                                                   absolute
                                                   inset-y-0
                                                   left-0
                                                   flex
                                                   w-11
                                                   items-center
                                                   justify-center
                                                   text-[#A68A77]">

                                            <i
                                                class="fa-regular
                                                       fa-user
                                                       text-sm">
                                            </i>

                                        </div>


                                        <input type="text" name="buyer_name" id="buyer_name"
                                            value="{{ old('buyer_name', auth()->user()->name) }}"
                                            required
                                            class="h-11
                                                   w-full
                                                   rounded-xl
                                                   border
                                                   border-[#E5D5C9]
                                                   bg-white
                                                   pl-11
                                                   pr-4
                                                   text-sm
                                                   outline-none
                                                   transition
                                                   focus:border-[#A97957]
                                                   focus:ring-4
                                                   focus:ring-[#F5E9DF]">

                                    </div>

                                </div>



                                {{-- PHONE --}}

                                <div>

                                    <label for="buyer_phone"
                                        class="mb-2
                                               block
                                               text-sm
                                               font-semibold
                                               text-slate-700">

                                        WhatsApp Pembeli

                                    </label>


                                    <div class="relative">

                                        <div
                                            class="pointer-events-none
                                                   absolute
                                                   inset-y-0
                                                   left-0
                                                   flex
                                                   w-11
                                                   items-center
                                                   justify-center
                                                   text-[#65795E]">

                                            <i
                                                class="fa-brands
                                                       fa-whatsapp
                                                       text-base">
                                            </i>

                                        </div>


                                        <input type="tel" name="buyer_phone" id="buyer_phone"
                                            value="{{ old('buyer_phone', auth()->user()->phone) }}"
                                            placeholder="081234567890" inputmode="numeric" required
                                            class="h-11
                                                   w-full
                                                   rounded-xl
                                                   border
                                                   border-[#E5D5C9]
                                                   bg-white
                                                   pl-11
                                                   pr-4
                                                   text-sm
                                                   outline-none
                                                   transition
                                                   placeholder:text-slate-400
                                                   focus:border-[#A97957]
                                                   focus:ring-4
                                                   focus:ring-[#F5E9DF]">

                                    </div>


                                    <p
                                        class="mt-1.5
                                               text-[10px]
                                               text-slate-400">

                                        Pastikan nomor dapat dihubungi.

                                    </p>

                                </div>



                                {{-- NOTES --}}

                                <div class="sm:col-span-2">

                                    <label for="notes"
                                        class="mb-2
                                               block
                                               text-sm
                                               font-semibold
                                               text-slate-700">

                                        Catatan

                                        <span
                                            class="font-normal
                                                   text-slate-400">

                                            (opsional)

                                        </span>

                                    </label>


                                    <textarea name="notes" id="notes" rows="4" maxlength="500"
                                        placeholder="Contoh: Sambal dipisah, ambil pukul 12.00..."
                                        class="w-full
                                               resize-none
                                               rounded-xl
                                               border
                                               border-[#E5D5C9]
                                               bg-white
                                               px-4
                                               py-3
                                               text-sm
                                               leading-6
                                               outline-none
                                               transition
                                               placeholder:text-slate-400
                                               focus:border-[#A97957]
                                               focus:ring-4
                                               focus:ring-[#F5E9DF]">{{ old('notes') }}</textarea>


                                    <p
                                        class="mt-1.5
                                               text-[10px]
                                               text-slate-400">

                                        Tambahkan informasi khusus
                                        untuk penjual jika diperlukan.

                                    </p>

                                </div>

                            </div>

                        </section>

                    </div>



                    {{-- ================================================= --}}
                    {{-- ORDER SUMMARY --}}
                    {{-- ================================================= --}}

                    <aside>

                        <div
                            class="sticky
                                   top-24
                                   overflow-hidden
                                   rounded-3xl
                                   border
                                   border-[#E5D8CE]
                                   bg-white
                                   shadow-sm">


                            {{-- SUMMARY HEADER --}}

                            <div
                                class="relative
                                       overflow-hidden
                                       bg-gradient-to-br
                                       from-[#0a1d45]
                                       via-[#4371d1]
                                       to-[#4371d1]
                                       p-5
                                       text-white">


                                <div
                                    class="pointer-events-none
                                           absolute
                                           -right-12
                                           -top-12
                                           size-32
                                           rounded-full
                                           bg-[#E3B66D]/15">
                                </div>


                                <div
                                    class="relative
                                           flex
                                           items-center
                                           gap-3">


                                    <div
                                        class="flex
                                               size-10
                                               shrink-0
                                               items-center
                                               justify-center
                                               rounded-xl
                                               bg-white/10
                                               backdrop-blur">

                                        <i class="fa-solid fa-receipt"></i>

                                    </div>


                                    <div>

                                        <h2 class="font-bold">
                                            Ringkasan Pesanan
                                        </h2>

                                        <p
                                            class="mt-0.5
                                                   text-[10px]
                                                   text-[#E8D6CA]">

                                            {{ $storeName }}

                                        </p>

                                    </div>

                                </div>

                            </div>



                            {{-- BODY --}}

                            <div class="p-5">


                                <div class="space-y-4
                                           text-sm">


                                    {{-- QUANTITY --}}

                                    <div
                                        class="flex
                                               items-center
                                               justify-between
                                               gap-3">


                                        <div
                                            class="flex
                                                   items-center
                                                   gap-2
                                                   text-slate-500">


                                            <div
                                                class="flex
                                                       size-8
                                                       items-center
                                                       justify-center
                                                       rounded-lg
                                                       bg-[#F4EAE2]
                                                       text-xs
                                                       text-[#4371d1]">

                                                <i class="fa-solid fa-box"></i>

                                            </div>

                                            Jumlah Item

                                        </div>


                                        <span
                                            class="font-bold
                                                   text-slate-800">

                                            {{ $cartItems->sum('quantity') }}

                                        </span>

                                    </div>



                                    {{-- SUBTOTAL --}}

                                    <div
                                        class="flex
                                               items-center
                                               justify-between
                                               gap-3">

                                        <span class="text-slate-500">
                                            Subtotal
                                        </span>

                                        <span
                                            class="font-semibold
                                                   text-slate-800">

                                            Rp{{ number_format($subtotal, 0, ',', '.') }}

                                        </span>

                                    </div>



                                    {{-- DIVIDER --}}

                                    <div
                                        class="border-t
                                               border-dashed
                                               border-[#DDCEC2]">
                                    </div>



                                    {{-- TOTAL --}}

                                    <div
                                        class="flex
                                               items-end
                                               justify-between
                                               gap-3">


                                        <div>

                                            <p
                                                class="text-sm
                                                       font-semibold
                                                       text-slate-700">

                                                Total

                                            </p>

                                            <p
                                                class="mt-1
                                                       text-[10px]
                                                       text-slate-400">

                                                Total pesanan saat ini

                                            </p>

                                        </div>


                                        <span
                                            class="text-2xl
                                                   font-black
                                                   tracking-tight
                                                   text-[#0a1d45]">

                                            Rp{{ number_format($subtotal, 0, ',', '.') }}

                                        </span>

                                    </div>

                                </div>



                                {{-- ========================================= --}}
                                {{-- WHATSAPP INFO --}}
                                {{-- ========================================= --}}

                                <div
                                    class="mt-5
                                           rounded-2xl
                                           border
                                           border-[#D3DFCE]
                                           bg-gradient-to-br
                                           from-[#F1F5ED]
                                           to-[#E7EFE3]
                                           p-4">


                                    <div
                                        class="flex
                                               items-start
                                               gap-3">


                                        <div
                                            class="flex
                                                   size-9
                                                   shrink-0
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-[#7F9275]
                                                   text-white">

                                            <i
                                                class="fa-brands
                                                       fa-whatsapp
                                                       text-lg">
                                            </i>

                                        </div>


                                        <div>

                                            <p
                                                class="text-xs
                                                       font-bold
                                                       text-[#65795E]">

                                                Lanjut melalui WhatsApp

                                            </p>


                                            <p
                                                class="mt-1
                                                       text-xs
                                                       leading-5
                                                       text-slate-600">

                                                Setelah pesanan berhasil
                                                dibuat, WhatsApp penjual
                                                akan terbuka dengan format
                                                pesanan yang sudah disiapkan.

                                            </p>

                                        </div>

                                    </div>

                                </div>



                                {{-- ========================================= --}}
                                {{-- SUBMIT --}}
                                {{-- ========================================= --}}

                                <button type="submit"
                                    class="group
                                           mt-5
                                           flex
                                           h-12
                                           w-full
                                           items-center
                                           justify-center
                                           gap-2
                                           rounded-xl
                                           bg-gradient-to-r
                                           from-[#0a1d45]
                                           via-[#4371d1]
                                           to-[#4371d1]
                                           px-5
                                           text-sm
                                           font-bold
                                           text-white
                                           shadow-lg
                                           shadow-[#4371d1]/20
                                           transition
                                           duration-300
                                           hover:-translate-y-0.5
                                           hover:shadow-xl
                                           focus:outline-none
                                           focus:ring-4
                                           focus:ring-[#EAD9CD]">

                                    <i class="fa-solid fa-bag-shopping"></i>

                                    Buat Pesanan

                                    <i
                                        class="fa-solid
                                               fa-arrow-right
                                               text-xs
                                               transition
                                               group-hover:translate-x-1">
                                    </i>

                                </button>



                                {{-- SECURITY INFO --}}

                                <div
                                    class="mt-4
                                           flex
                                           items-center
                                           justify-center
                                           gap-2
                                           text-[10px]
                                           text-slate-400">

                                    <i
                                        class="fa-solid
                                               fa-shield-halved
                                               text-[#7F9275]">
                                    </i>

                                    Pesanan disimpan sebelum
                                    WhatsApp dibuka.

                                </div>

                            </div>

                        </div>

                    </aside>

                </div>

            </form>

        </main>

    </div>

@endsection
