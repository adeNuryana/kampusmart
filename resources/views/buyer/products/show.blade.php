@extends('layouts.public')

@section('title', $product->name . ' - MarketKu')

@section('content')

    @php

        /*
        |--------------------------------------------------------------------------
        | PRODUCT IMAGE
        |--------------------------------------------------------------------------
        */

        $productImage = $product->image ?? ($product->photo ?? ($product->thumbnail ?? null));

        if ($productImage) {
            $imageUrl = \Illuminate\Support\Str::startsWith($productImage, ['http://', 'https://'])
                ? $productImage
                : asset('storage/' . $productImage);
        } else {
            $imageUrl = null;
        }

        /*
        |--------------------------------------------------------------------------
        | SELLER
        |--------------------------------------------------------------------------
        */

        $seller = $product->user;

        $sellerProfile = $seller?->sellerProfile;

        /*
        |--------------------------------------------------------------------------
        | SELLER PHOTO
        |--------------------------------------------------------------------------
        */

        $sellerPhoto = $sellerProfile?->photo;

        if ($sellerPhoto) {
            $sellerPhotoUrl = \Illuminate\Support\Str::startsWith($sellerPhoto, ['http://', 'https://'])
                ? $sellerPhoto
                : asset('storage/' . $sellerPhoto);
        } else {
            $sellerPhotoUrl = null;
        }

        /*
        |--------------------------------------------------------------------------
        | SELLER LOCATION
        |--------------------------------------------------------------------------
        */

        $sellerLocation = $sellerProfile?->city ?? ($sellerProfile?->address ?? null);

    @endphp



    <div x-data="{
        quantity: 1,
        maxStock: {{ (int) ($product->stock ?? 0) }}
    }"
        class="min-h-screen
               bg-gradient-to-br
               from-[#FBF8F5]
               via-[#FAF5F1]
               to-[#F4EAE2]">


        <main
            class="mx-auto
                   max-w-7xl
                   px-4
                   py-5
                   pb-28
                   sm:px-5
                   md:py-8
                   md:pb-12">


            {{-- ===================================================== --}}
            {{-- BREADCRUMB --}}
            {{-- ===================================================== --}}

            <nav
                class="mb-5
                       hidden
                       items-center
                       gap-2
                       text-sm
                       text-slate-500
                       md:flex">


                <a href="{{ route('home') }}" class="transition
                           hover:text-[#6F4E37]">

                    Home

                </a>


                <i
                    class="fa-solid
                           fa-chevron-right
                           text-[9px]
                           text-[#CBB8AA]">
                </i>


                @if ($product->category)
                    <span class="text-[#8B6245]">

                        {{ $product->category->name }}

                    </span>


                    <i
                        class="fa-solid
                               fa-chevron-right
                               text-[9px]
                               text-[#CBB8AA]">
                    </i>
                @endif


                <span
                    class="max-w-xs
                           truncate
                           font-medium
                           text-slate-700">

                    {{ $product->name }}

                </span>

            </nav>



            {{-- ===================================================== --}}
            {{-- PRODUCT DETAIL --}}
            {{-- ===================================================== --}}

            <section
                class="relative
                       overflow-hidden
                       rounded-3xl
                       border
                       border-[#E8DAD0]
                       bg-white
                       shadow-xl
                       shadow-[#6F4E37]/5">


                {{-- DECORATION --}}

                <div
                    class="pointer-events-none
                           absolute
                           -right-24
                           -top-24
                           size-64
                           rounded-full
                           bg-[#C89B55]/10
                           blur-3xl">
                </div>


                <div class="grid
                           lg:grid-cols-[1fr_1.1fr]">


                    {{-- ================================================= --}}
                    {{-- PRODUCT IMAGE --}}
                    {{-- ================================================= --}}

                    <div
                        class="relative
                               border-b
                               border-[#EFE4DC]
                               p-4
                               sm:p-6
                               lg:border-b-0
                               lg:border-r">


                        <div
                            class="relative
                                   aspect-square
                                   overflow-hidden
                                   rounded-2xl
                                   bg-gradient-to-br
                                   from-[#F5EEE9]
                                   via-[#FAF6F3]
                                   to-[#EFE5DD]">


                            @if ($imageUrl)
                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}"
                                    class="size-full
                                           object-cover
                                           transition
                                           duration-500
                                           hover:scale-[1.02]">
                            @else
                                <div
                                    class="flex
                                           size-full
                                           flex-col
                                           items-center
                                           justify-center
                                           text-[#BDA99A]">


                                    <div
                                        class="flex
                                               size-20
                                               items-center
                                               justify-center
                                               rounded-3xl
                                               bg-white/70
                                               shadow-sm">

                                        <i
                                            class="fa-regular
                                                   fa-image
                                                   text-5xl">
                                        </i>

                                    </div>


                                    <p class="mt-4
                                               text-sm">

                                        Foto produk belum tersedia

                                    </p>

                                </div>
                            @endif



                            {{-- CATEGORY BADGE --}}

                            @if ($product->category)
                                <span
                                    class="absolute
                                           left-3
                                           top-3
                                           rounded-full
                                           border
                                           border-white/50
                                           bg-white/90
                                           px-3 py-1.5
                                           text-xs
                                           font-semibold
                                           text-[#6F4E37]
                                           shadow-sm
                                           backdrop-blur">

                                    <i
                                        class="fa-solid
                                               fa-layer-group
                                               mr-1
                                               text-[#C8795A]">
                                    </i>

                                    {{ $product->category->name }}

                                </span>
                            @endif

                        </div>



                        {{-- THUMBNAIL --}}

                        @if ($imageUrl)
                            <div
                                class="mt-3
                                       flex
                                       gap-2">

                                <button type="button"
                                    class="size-16
                                           overflow-hidden
                                           rounded-xl
                                           border-2
                                           border-[#8B6245]
                                           bg-white
                                           p-0.5
                                           shadow-sm">

                                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}"
                                        class="size-full
                                               rounded-lg
                                               object-cover">

                                </button>

                            </div>
                        @endif

                    </div>



                    {{-- ================================================= --}}
                    {{-- PRODUCT INFO --}}
                    {{-- ================================================= --}}

                    <div
                        class="relative
                               p-4
                               sm:p-6
                               lg:p-8">


                        {{-- BADGES --}}

                        <div
                            class="flex
                                   flex-wrap
                                   items-center
                                   gap-2">


                            @if ($product->category)
                                <span
                                    class="rounded-full
                                           bg-[#F4EAE2]
                                           px-3 py-1
                                           text-[11px]
                                           font-semibold
                                           text-[#6F4E37]">

                                    <i
                                        class="fa-solid
                                               fa-layer-group
                                               mr-1">
                                    </i>

                                    {{ $product->category->name }}

                                </span>
                            @endif



                            @if (($product->stock ?? 0) > 0)
                                <span
                                    class="rounded-full
                                           bg-[#EEF3EA]
                                           px-3 py-1
                                           text-[11px]
                                           font-semibold
                                           text-[#65795E]">

                                    <i
                                        class="fa-solid
                                               fa-circle-check
                                               mr-1">
                                    </i>

                                    Tersedia

                                </span>
                            @else
                                <span
                                    class="rounded-full
                                           bg-[#FAEDEC]
                                           px-3 py-1
                                           text-[11px]
                                           font-semibold
                                           text-[#A65954]">

                                    <i
                                        class="fa-solid
                                               fa-circle-xmark
                                               mr-1">
                                    </i>

                                    Stok Habis

                                </span>
                            @endif

                        </div>



                        {{-- PRODUCT NAME --}}

                        <h1
                            class="mt-4
                                   text-2xl
                                   font-black
                                   leading-tight
                                   tracking-tight
                                   text-slate-900
                                   sm:text-3xl">

                            {{ $product->name }}

                        </h1>



                        {{-- META --}}

                        <div
                            class="mt-4
                                   flex
                                   flex-wrap
                                   items-center
                                   gap-3
                                   text-xs
                                   text-slate-500
                                   sm:text-sm">


                            <span
                                class="flex
                                       items-center
                                       gap-1.5">

                                <i
                                    class="fa-solid
                                           fa-box
                                           text-[#C89B55]">
                                </i>

                                Stok
                                {{ $product->stock ?? 0 }}

                            </span>


                            <span class="text-[#D9CAC0]">

                                |

                            </span>


                            <span
                                class="flex
                                       items-center
                                       gap-1.5">

                                <i
                                    class="fa-solid
                                           fa-store
                                           text-[#C8795A]">
                                </i>

                                {{ $seller?->name ?? 'Seller' }}

                            </span>

                        </div>



                        {{-- ================================================= --}}
                        {{-- PRICE --}}
                        {{-- ================================================= --}}

                        <div
                            class="relative
                                   mt-6
                                   overflow-hidden
                                   rounded-2xl
                                   border
                                   border-[#E8D8CC]
                                   bg-gradient-to-br
                                   from-[#FBF4EF]
                                   via-[#F8EEE7]
                                   to-[#F2E2D7]
                                   p-4
                                   sm:p-5">


                            <div
                                class="pointer-events-none
                                       absolute
                                       -right-8
                                       -top-8
                                       size-24
                                       rounded-full
                                       bg-[#C8795A]/10">
                            </div>


                            <div class="relative">

                                <p
                                    class="text-xs
                                           font-medium
                                           text-[#9A806F]">

                                    Harga Produk

                                </p>


                                <div
                                    class="mt-1
                                           flex
                                           items-baseline
                                           gap-1">

                                    <span
                                        class="text-sm
                                               font-bold
                                               text-[#8B6245]">

                                        Rp

                                    </span>


                                    <span
                                        class="text-2xl
                                               font-black
                                               tracking-tight
                                               text-[#5B3B2B]
                                               sm:text-3xl">

                                        {{ number_format($product->price ?? 0, 0, ',', '.') }}

                                    </span>

                                </div>

                            </div>

                        </div>



                        {{-- ================================================= --}}
                        {{-- DESCRIPTION --}}
                        {{-- ================================================= --}}

                        <div class="mt-6">

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
                                           text-[#8B6245]">

                                    <i
                                        class="fa-solid
                                               fa-align-left
                                               text-xs">
                                    </i>

                                </div>


                                <h2 class="font-bold
                                           text-slate-900">

                                    Deskripsi Produk

                                </h2>

                            </div>


                            <div
                                class="mt-3
                                       whitespace-pre-line
                                       text-sm
                                       leading-7
                                       text-slate-600">

                                {{ $product->description ?: 'Seller belum memberikan deskripsi untuk produk ini.' }}

                            </div>

                        </div>



                        {{-- ================================================= --}}
                        {{-- QUANTITY --}}
                        {{-- ================================================= --}}

                        <div
                            class="mt-7
                                   rounded-2xl
                                   border
                                   border-[#E9DCD2]
                                   bg-[#FCF8F5]
                                   p-4
                                   sm:p-5">


                            <div
                                class="flex
                                       items-center
                                       justify-between
                                       gap-4">


                                <div>

                                    <p
                                        class="text-sm
                                               font-semibold
                                               text-slate-800">

                                        Jumlah Pembelian

                                    </p>


                                    <p
                                        class="mt-1
                                               text-xs
                                               text-slate-500">

                                        Stok tersedia:

                                        <strong class="text-[#6F4E37]">

                                            {{ $product->stock ?? 0 }}

                                        </strong>

                                    </p>

                                </div>



                                {{-- COUNTER --}}

                                <div
                                    class="flex
                                           items-center
                                           overflow-hidden
                                           rounded-xl
                                           border
                                           border-[#E1D2C7]
                                           bg-white
                                           shadow-sm">


                                    <button type="button"
                                        @click="
                                            if (quantity > 1) {
                                                quantity--
                                            }
                                        "
                                        :disabled="quantity <= 1"
                                        class="flex
                                               size-10
                                               items-center
                                               justify-center
                                               text-[#6F4E37]
                                               transition
                                               hover:bg-[#F6EEE8]
                                               disabled:cursor-not-allowed
                                               disabled:text-slate-300">

                                        <i
                                            class="fa-solid
                                                   fa-minus
                                                   text-xs">
                                        </i>

                                    </button>


                                    <input type="number" name="quantity" x-model.number="quantity" min="1"
                                        :max="maxStock" readonly
                                        class="h-10
                                               w-12
                                               border-x
                                               border-[#E9DCD2]
                                               bg-white
                                               text-center
                                               text-sm
                                               font-bold
                                               text-[#5B3B2B]
                                               outline-none">


                                    <button type="button"
                                        @click="
                                            if (
                                                quantity <
                                                maxStock
                                            ) {
                                                quantity++
                                            }
                                        "
                                        :disabled="quantity >=
                                            maxStock"
                                        class="flex
                                               size-10
                                               items-center
                                               justify-center
                                               text-[#6F4E37]
                                               transition
                                               hover:bg-[#F6EEE8]
                                               disabled:cursor-not-allowed
                                               disabled:text-slate-300">

                                        <i
                                            class="fa-solid
                                                   fa-plus
                                                   text-xs">
                                        </i>

                                    </button>

                                </div>

                            </div>



                            {{-- TOTAL --}}

                            <div
                                class="mt-4
                                       flex
                                       items-center
                                       justify-between
                                       border-t
                                       border-[#E9DCD2]
                                       pt-4">


                                <span class="text-sm
                                           text-slate-500">

                                    Total

                                </span>


                                <span
                                    class="text-lg
                                           font-black
                                           text-[#5B3B2B]"
                                    x-text="
                                        new Intl.NumberFormat(
                                            'id-ID',
                                            {
                                                style: 'currency',
                                                currency: 'IDR',
                                                minimumFractionDigits: 0
                                            }
                                        ).format(
                                            quantity *
                                            {{ (float) ($product->price ?? 0) }}
                                        )
                                    ">
                                </span>

                            </div>



                            {{-- ================================================= --}}
                            {{-- ACTION --}}
                            {{-- ================================================= --}}

                            @if (($product->stock ?? 0) > 0)
                                <div
                                    class="mt-5
                                           hidden
                                           grid-cols-2
                                           gap-3
                                           sm:grid">


                                    @auth

                                        {{-- ADD CART --}}

                                        <form method="POST" action="{{ route('buyer.cart.store', $product) }}">

                                            @csrf


                                            <input type="hidden" name="quantity" :value="quantity">


                                            <button type="submit"
                                                class="flex
                                                       w-full
                                                       items-center
                                                       justify-center
                                                       gap-2
                                                       rounded-xl
                                                       border-2
                                                       border-[#6F4E37]
                                                       bg-white
                                                       px-4 py-3
                                                       text-sm
                                                       font-bold
                                                       text-[#6F4E37]
                                                       transition
                                                       hover:bg-[#F7EEE8]">

                                                <i
                                                    class="fa-solid
                                                           fa-cart-plus">
                                                </i>

                                                Tambah Keranjang

                                            </button>

                                        </form>



                                        {{-- BUY NOW --}}

                                        <button type="button"
                                            class="flex
                                                   items-center
                                                   justify-center
                                                   gap-2
                                                   rounded-xl
                                                   bg-gradient-to-r
                                                   from-[#5B3B2B]
                                                   via-[#6F4E37]
                                                   to-[#8B6245]
                                                   px-4 py-3
                                                   text-sm
                                                   font-bold
                                                   text-white
                                                   shadow-lg
                                                   shadow-[#6F4E37]/20
                                                   transition
                                                   hover:-translate-y-0.5
                                                   hover:shadow-xl">

                                            <i
                                                class="fa-solid
                                                       fa-bag-shopping">
                                            </i>

                                            Beli Sekarang

                                        </button>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="col-span-2
                                                   flex
                                                   w-full
                                                   items-center
                                                   justify-center
                                                   gap-2
                                                   rounded-xl
                                                   bg-gradient-to-r
                                                   from-[#5B3B2B]
                                                   via-[#6F4E37]
                                                   to-[#8B6245]
                                                   px-4 py-3
                                                   text-sm
                                                   font-bold
                                                   text-white
                                                   shadow-lg
                                                   shadow-[#6F4E37]/20
                                                   transition
                                                   hover:-translate-y-0.5
                                                   hover:shadow-xl">

                                            <i
                                                class="fa-solid
                                                       fa-right-to-bracket">
                                            </i>

                                            Masuk untuk Membeli

                                        </a>

                                    @endauth

                                </div>
                            @else
                                <div
                                    class="mt-5
                                           rounded-xl
                                           border
                                           border-[#EBCBC7]
                                           bg-[#FAEDEC]
                                           px-4 py-3
                                           text-center
                                           text-sm
                                           font-semibold
                                           text-[#A65954]">

                                    <i
                                        class="fa-solid
                                               fa-circle-exclamation
                                               mr-1">
                                    </i>

                                    Produk sedang habis

                                </div>
                            @endif

                        </div>

                    </div>

                </div>

            </section>



            {{-- ===================================================== --}}
            {{-- SELLER INFORMATION --}}
            {{-- ===================================================== --}}

            <section
                class="relative
           mt-5
           overflow-hidden
           rounded-3xl
           border
           border-[#E4DED6]
           bg-gradient-to-br
           from-white
           via-[#FBF8F5]
           to-[#F1F5ED]
           p-4
           shadow-sm
           sm:p-6">


                {{-- DECORATION --}}

                <div
                    class="pointer-events-none
               absolute
               -bottom-16
               -right-16
               size-40
               rounded-full
               bg-[#7F9275]/10
               blur-3xl">
                </div>


                <div
                    class="relative
               flex
               flex-col
               gap-5
               sm:flex-row
               sm:items-center
               sm:justify-between">


                    {{-- ================================================= --}}
                    {{-- SELLER INFO --}}
                    {{-- ================================================= --}}

                    <div class="flex
                   min-w-0
                   items-center
                   gap-4">


                        {{-- SELLER PHOTO --}}

                        @if ($sellerPhotoUrl)
                            <img src="{{ $sellerPhotoUrl }}" alt="{{ $seller?->name }}"
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
                           from-[#E7EEDF]
                           to-[#D5E1CF]
                           text-xl
                           text-[#65795E]
                           shadow-sm
                           sm:size-16">

                                <i class="fa-solid fa-store"></i>

                            </div>
                        @endif



                        {{-- SELLER DETAILS --}}

                        <div class="min-w-0">

                            <p
                                class="text-[10px]
                           font-semibold
                           uppercase
                           tracking-wider
                           text-[#9A806F]">

                                Dijual oleh

                            </p>


                            <h3
                                class="mt-1
                           truncate
                           text-base
                           font-bold
                           text-slate-900
                           sm:text-lg">

                                {{ $seller?->name ?? 'Seller' }}

                            </h3>


                            @if ($sellerLocation)
                                <p
                                    class="mt-1
                               text-xs
                               text-slate-500">

                                    <i
                                        class="fa-solid
                                   fa-location-dot
                                   mr-1
                                   text-[#C8795A]">
                                    </i>

                                    {{ $sellerLocation }}

                                </p>
                            @endif

                        </div>

                    </div>



                    {{-- ================================================= --}}
                    {{-- ACTION KHUSUS BUYER LOGIN --}}
                    {{-- ================================================= --}}

                    @auth

                        @if (auth()->user()->role === 'buyer')
                            <div class="shrink-0">

                                <button type="button"
                                    class="inline-flex
                               w-full
                               items-center
                               justify-center
                               gap-2
                               rounded-xl
                               bg-gradient-to-r
                               from-[#6F4E37]
                               to-[#8B6245]
                               px-5
                               py-2.5
                               text-sm
                               font-semibold
                               text-white
                               shadow-sm
                               transition
                               duration-300
                               hover:-translate-y-0.5
                               hover:shadow-lg
                               sm:w-auto">

                                    <i class="fa-solid
                                   fa-store">
                                    </i>

                                    Kunjungi Toko

                                </button>

                            </div>
                        @endif

                    @endauth

                </div>

            </section>



          {{-- ===================================================== --}}
{{-- PRODUCTS FROM SELLER --}}
{{-- ===================================================== --}}

@if ($sellerProducts->isNotEmpty())

    <section
        class="relative
               mt-5
               overflow-hidden
               rounded-3xl
               border
               border-[#E5D8CE]
               bg-gradient-to-br
               from-white
               via-[#FBF8F5]
               to-[#F4EAE2]
               shadow-sm">


        {{-- DECORATION --}}

        <div
            class="pointer-events-none
                   absolute
                   -right-20
                   -top-20
                   size-52
                   rounded-full
                   bg-[#6F4E37]/10
                   blur-3xl">
        </div>


        {{-- HEADER --}}

        <div
            class="relative
                   flex
                   items-center
                   justify-between
                   gap-4
                   p-5
                   sm:p-6">


            <div
                class="flex
                       min-w-0
                       items-center
                       gap-3">


                <div
                    class="flex
                           size-10
                           shrink-0
                           items-center
                           justify-center
                           rounded-xl
                           bg-gradient-to-br
                           from-[#5B3B2B]
                           via-[#6F4E37]
                           to-[#9A6948]
                           text-white
                           shadow-lg
                           shadow-[#6F4E37]/20">

                    <i class="fa-solid fa-store"></i>

                </div>


                <div class="min-w-0">

                    <h2
                        class="text-lg
                               font-bold
                               text-slate-900
                               sm:text-xl">

                        Produk dari Toko Ini

                    </h2>


                    <p
                        class="mt-1
                               truncate
                               text-xs
                               text-slate-500
                               sm:text-sm">

                        Produk lain dari

                        <span
                            class="font-semibold
                                   text-[#6F4E37]">

                            {{ $seller?->name ?? 'Seller' }}

                        </span>

                    </p>

                </div>

            </div>


            {{-- HANYA BUYER LOGIN --}}

            @auth

                @if (auth()->user()->role === 'buyer')

                    <button
                        type="button"
                        class="hidden
                               shrink-0
                               items-center
                               gap-2
                               rounded-xl
                               border
                               border-[#DCC9BB]
                               bg-white
                               px-4
                               py-2.5
                               text-sm
                               font-semibold
                               text-[#6F4E37]
                               transition
                               hover:bg-[#F7EEE8]
                               sm:inline-flex">

                        Lihat Semua

                        <i
                            class="fa-solid
                                   fa-arrow-right
                                   text-xs">
                        </i>

                    </button>

                @endif

            @endauth

        </div>


        {{-- PRODUCT GRID --}}

        <div
            class="relative
                   grid
                   grid-cols-2
                   gap-3
                   px-5
                   pb-5
                   sm:grid-cols-3
                   sm:gap-4
                   sm:px-6
                   sm:pb-6
                   lg:grid-cols-5">


            @foreach ($sellerProducts as $index => $sellerProduct)

                @php

                    $sellerProductImage =
                        $sellerProduct->image
                        ?? $sellerProduct->photo
                        ?? $sellerProduct->thumbnail
                        ?? null;


                    if ($sellerProductImage) {

                        $sellerProductImageUrl =
                            \Illuminate\Support\Str::startsWith(
                                $sellerProductImage,
                                [
                                    'http://',
                                    'https://',
                                ]
                            )
                                ? $sellerProductImage
                                : asset(
                                    'storage/' .
                                    $sellerProductImage
                                );

                    } else {

                        $sellerProductImageUrl = null;

                    }


                    $sellerProductThemes = [

                        [
                            'bar' =>
                                'from-[#6F4E37] via-[#8B6245] to-[#C89B55]',

                            'badge' =>
                                'bg-[#F4EAE2] text-[#6F4E37]',
                        ],

                        [
                            'bar' =>
                                'from-[#C8795A] via-[#B56F52] to-[#A95E43]',

                            'badge' =>
                                'bg-[#FBEAE2] text-[#A95E43]',
                        ],

                        [
                            'bar' =>
                                'from-[#7F9275] via-[#879A7D] to-[#65795E]',

                            'badge' =>
                                'bg-[#EEF3EA] text-[#65795E]',
                        ],

                        [
                            'bar' =>
                                'from-[#C89B55] via-[#D1A963] to-[#AC7D38]',

                            'badge' =>
                                'bg-[#FAF2DF] text-[#A87A37]',
                        ],

                        [
                            'bar' =>
                                'from-[#B97972] via-[#C98C84] to-[#9B5F59]',

                            'badge' =>
                                'bg-[#F8EDEC] text-[#9C625D]',
                        ],

                    ];


                    $sellerProductTheme =
                        $sellerProductThemes[
                            $index %
                            count($sellerProductThemes)
                        ];

                @endphp


                <a
                    href="{{ route(
                        'buyer.products.show',
                        $sellerProduct
                    ) }}"
                    class="group
                           overflow-hidden
                           rounded-2xl
                           border
                           border-white
                           bg-white/95
                           shadow-sm
                           transition
                           duration-300
                           hover:-translate-y-1.5
                           hover:border-[#E0CFC2]
                           hover:shadow-xl
                           hover:shadow-[#6F4E37]/10">


                    {{-- COLOR ACCENT --}}

                    <div
                        class="h-1
                               bg-gradient-to-r
                               {{ $sellerProductTheme['bar'] }}">
                    </div>


                    {{-- IMAGE --}}

                    <div
                        class="relative
                               aspect-square
                               overflow-hidden
                               bg-[#F4EFEB]">


                        @if ($sellerProductImageUrl)

                            <img
                                src="{{ $sellerProductImageUrl }}"
                                alt="{{ $sellerProduct->name }}"
                                loading="lazy"
                                class="size-full
                                       object-cover
                                       transition
                                       duration-500
                                       group-hover:scale-105">

                        @else

                            <div
                                class="flex
                                       size-full
                                       items-center
                                       justify-center
                                       bg-gradient-to-br
                                       from-[#F5EFEB]
                                       to-[#EEE4DC]">

                                <i
                                    class="fa-regular
                                           fa-image
                                           text-4xl
                                           text-[#C7B4A7]">
                                </i>

                            </div>

                        @endif


                        {{-- CATEGORY --}}

                        @if ($sellerProduct->category)

                            <span
                                class="absolute
                                       bottom-2
                                       left-2
                                       max-w-[85%]
                                       truncate
                                       rounded-lg
                                       px-2
                                       py-1
                                       text-[9px]
                                       font-semibold
                                       shadow-sm
                                       {{ $sellerProductTheme['badge'] }}">

                                {{ $sellerProduct->category->name }}

                            </span>

                        @endif

                    </div>


                    {{-- CONTENT --}}

                    <div class="p-3 sm:p-4">

                        <h3
                            class="line-clamp-2
                                   min-h-10
                                   text-xs
                                   font-semibold
                                   leading-5
                                   text-slate-700
                                   transition
                                   group-hover:text-[#6F4E37]
                                   sm:text-sm">

                            {{ $sellerProduct->name }}

                        </h3>


                        <p
                            class="mt-2
                                   bg-gradient-to-r
                                   from-[#5B3B2B]
                                   to-[#A66D4B]
                                   bg-clip-text
                                   text-sm
                                   font-black
                                   text-transparent
                                   sm:text-lg">

                            Rp{{ number_format(
                                $sellerProduct->price ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}

                        </p>


                        <div
                            class="mt-3
                                   flex
                                   items-center
                                   justify-between
                                   gap-2">


                            <span
                                class="rounded-md
                                       bg-[#FAF6F3]
                                       px-2
                                       py-1
                                       text-[9px]
                                       text-slate-500
                                       sm:text-[10px]">

                                Stok
                                {{ $sellerProduct->stock ?? 0 }}

                            </span>


                            @if (($sellerProduct->stock ?? 0) > 0)

                                <span
                                    class="text-[9px]
                                           font-semibold
                                           text-[#65795E]
                                           sm:text-[10px]">

                                    <i
                                        class="fa-solid
                                               fa-circle-check
                                               mr-1">
                                    </i>

                                    Tersedia

                                </span>

                            @else

                                <span
                                    class="text-[9px]
                                           font-semibold
                                           text-[#A65954]
                                           sm:text-[10px]">

                                    Habis

                                </span>

                            @endif

                        </div>

                    </div>

                </a>

            @endforeach

        </div>


        {{-- MOBILE --}}
        {{-- HANYA BUYER LOGIN --}}

        @auth

            @if (auth()->user()->role === 'buyer')

                <div
                    class="relative
                           px-5
                           pb-5
                           sm:hidden">

                    <button
                        type="button"
                        class="flex
                               w-full
                               items-center
                               justify-center
                               gap-2
                               rounded-xl
                               border
                               border-[#DCC9BB]
                               bg-white
                               px-4
                               py-3
                               text-sm
                               font-semibold
                               text-[#6F4E37]
                               transition
                               hover:bg-[#F7EEE8]">

                        Lihat Semua Produk Toko

                        <i
                            class="fa-solid
                                   fa-arrow-right
                                   text-xs">
                        </i>

                    </button>

                </div>

            @endif

        @endauth

    </section>

@endif



{{-- ===================================================== --}}
{{-- RELATED PRODUCTS --}}
{{-- ===================================================== --}}

@if ($relatedProducts->isNotEmpty())

    <section
        class="relative
               mt-5
               overflow-hidden
               rounded-3xl
               border
               border-[#E7D9CF]
               bg-gradient-to-br
               from-white
               via-[#FBF6F2]
               to-[#F7EEE8]
               shadow-sm">


        {{-- DECORATION --}}

        <div
            class="pointer-events-none
                   absolute
                   -left-16
                   -top-16
                   size-40
                   rounded-full
                   bg-[#C89B55]/10
                   blur-3xl">
        </div>


        {{-- HEADER --}}

        <div
            class="relative
                   p-5
                   sm:p-6">

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
                           bg-gradient-to-br
                           from-[#C89B55]
                           to-[#A97957]
                           text-white
                           shadow-lg
                           shadow-[#C89B55]/20">

                    <i
                        class="fa-solid
                               fa-boxes-stacked">
                    </i>

                </div>


                <div>

                    <h2
                        class="text-xl
                               font-bold
                               text-slate-900
                               sm:text-2xl">

                        Produk Serupa

                    </h2>


                    <p
                        class="mt-1
                               text-sm
                               text-slate-500">

                        Produk lain dari kategori

                        <span
                            class="font-medium
                                   text-[#8B6245]">

                            {{ $product->category?->name }}

                        </span>

                    </p>

                </div>

            </div>

        </div>


        {{-- PRODUCT GRID --}}

        <div
            class="relative
                   grid
                   grid-cols-2
                   gap-3
                   px-5
                   pb-5
                   sm:grid-cols-3
                   sm:gap-4
                   sm:px-6
                   sm:pb-6
                   lg:grid-cols-5">


            @foreach ($relatedProducts as $index => $relatedProduct)

                @php

                    $relatedImage =
                        $relatedProduct->image
                        ?? $relatedProduct->photo
                        ?? $relatedProduct->thumbnail
                        ?? null;


                    if ($relatedImage) {

                        $relatedImageUrl =
                            \Illuminate\Support\Str::startsWith(
                                $relatedImage,
                                [
                                    'http://',
                                    'https://',
                                ]
                            )
                                ? $relatedImage
                                : asset(
                                    'storage/' .
                                    $relatedImage
                                );

                    } else {

                        $relatedImageUrl = null;

                    }


                    $relatedColors = [

                        [
                            'bar' =>
                                'from-[#6F4E37] to-[#A66D4B]',
                            'badge' =>
                                'bg-[#F4EAE2] text-[#6F4E37]',
                        ],

                        [
                            'bar' =>
                                'from-[#C8795A] to-[#A95E43]',
                            'badge' =>
                                'bg-[#FBEAE2] text-[#A95E43]',
                        ],

                        [
                            'bar' =>
                                'from-[#7F9275] to-[#647A5D]',
                            'badge' =>
                                'bg-[#EEF3EA] text-[#65795E]',
                        ],

                        [
                            'bar' =>
                                'from-[#C89B55] to-[#AC7D38]',
                            'badge' =>
                                'bg-[#FAF2DF] text-[#A87A37]',
                        ],

                        [
                            'bar' =>
                                'from-[#B97972] to-[#9B5F59]',
                            'badge' =>
                                'bg-[#F8EDEC] text-[#9C625D]',
                        ],

                    ];


                    $relatedTheme =
                        $relatedColors[
                            $index %
                            count($relatedColors)
                        ];

                @endphp


                <a
                    href="{{ route(
                        'buyer.products.show',
                        $relatedProduct
                    ) }}"
                    class="group
                           overflow-hidden
                           rounded-2xl
                           border
                           border-white
                           bg-white/95
                           shadow-sm
                           transition
                           duration-300
                           hover:-translate-y-1.5
                           hover:border-[#E3D3C7]
                           hover:shadow-xl
                           hover:shadow-[#6F4E37]/10">


                    <div
                        class="h-1
                               bg-gradient-to-r
                               {{ $relatedTheme['bar'] }}">
                    </div>


                    {{-- IMAGE --}}

                    <div
                        class="relative
                               aspect-square
                               overflow-hidden
                               bg-[#F4EFEB]">


                        @if ($relatedImageUrl)

                            <img
                                src="{{ $relatedImageUrl }}"
                                alt="{{ $relatedProduct->name }}"
                                loading="lazy"
                                class="size-full
                                       object-cover
                                       transition
                                       duration-500
                                       group-hover:scale-105">

                        @else

                            <div
                                class="flex
                                       size-full
                                       items-center
                                       justify-center
                                       bg-gradient-to-br
                                       from-[#F5EFEB]
                                       to-[#EEE4DC]">

                                <i
                                    class="fa-regular
                                           fa-image
                                           text-4xl
                                           text-[#C7B4A7]">
                                </i>

                            </div>

                        @endif


                        @if ($relatedProduct->category)

                            <span
                                class="absolute
                                       bottom-2
                                       left-2
                                       max-w-[85%]
                                       truncate
                                       rounded-lg
                                       px-2 py-1
                                       text-[9px]
                                       font-semibold
                                       {{ $relatedTheme['badge'] }}">

                                {{ $relatedProduct->category->name }}

                            </span>

                        @endif

                    </div>


                    {{-- CONTENT --}}

                    <div class="p-3 sm:p-4">

                        <h3
                            class="line-clamp-2
                                   min-h-10
                                   text-xs
                                   font-semibold
                                   leading-5
                                   text-slate-700
                                   transition
                                   group-hover:text-[#6F4E37]
                                   sm:text-sm">

                            {{ $relatedProduct->name }}

                        </h3>


                        <p
                            class="mt-2
                                   bg-gradient-to-r
                                   from-[#5B3B2B]
                                   to-[#A66D4B]
                                   bg-clip-text
                                   text-sm
                                   font-black
                                   text-transparent
                                   sm:text-lg">

                            Rp{{ number_format(
                                $relatedProduct->price ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}

                        </p>


                        <div
                            class="mt-3
                                   flex
                                   items-center
                                   justify-between
                                   gap-2
                                   text-[10px]
                                   text-slate-500">


                            <span
                                class="rounded-md
                                       bg-[#FAF6F3]
                                       px-2 py-1">

                                Stok
                                {{ $relatedProduct->stock ?? 0 }}

                            </span>


                            <span
                                class="max-w-20
                                       truncate">

                                <i
                                    class="fa-solid
                                           fa-store
                                           mr-1
                                           text-[#A97957]">
                                </i>

                                {{ $relatedProduct->user?->name }}

                            </span>

                        </div>

                    </div>

                </a>

            @endforeach

        </div>

    </section>

@endif
        </main>

                        {{-- ========================================================= --}}
                        {{-- MOBILE BUY BAR --}}
                        {{-- ========================================================= --}}

                        @if (($product->stock ?? 0) > 0)
                            <div
                                class="fixed
                       inset-x-0
                       bottom-0
                       z-50
                       border-t
                       border-[#E5D8CE]
                       bg-white/95
                       p-3
                       shadow-[0_-6px_30px_rgba(111,78,55,0.08)]
                       backdrop-blur-xl
                       sm:hidden">


                                <div
                                    class="mx-auto
                           flex
                           max-w-md
                           gap-2">


                                    @auth

                                        {{-- CART --}}

                                        <form method="POST" action="{{ route('buyer.cart.store', $product) }}">

                                            @csrf


                                            <input type="hidden" name="quantity" :value="quantity">


                                            <button type="submit"
                                                class="flex
                                       size-12
                                       shrink-0
                                       items-center
                                       justify-center
                                       rounded-xl
                                       border-2
                                       border-[#6F4E37]
                                       bg-white
                                       text-[#6F4E37]
                                       transition
                                       active:scale-95">

                                                <i class="fa-solid
                                           fa-cart-plus">
                                                </i>

                                            </button>

                                        </form>



                                        {{-- BUY NOW --}}

                                        <button type="button"
                                            class="flex
                                   flex-1
                                   items-center
                                   justify-center
                                   gap-2
                                   rounded-xl
                                   bg-gradient-to-r
                                   from-[#5B3B2B]
                                   via-[#6F4E37]
                                   to-[#8B6245]
                                   px-4 py-3
                                   text-sm
                                   font-bold
                                   text-white
                                   shadow-lg
                                   shadow-[#6F4E37]/20
                                   transition
                                   active:scale-[0.98]">

                                            <i class="fa-solid
                                       fa-bag-shopping">
                                            </i>

                                            Beli Sekarang

                                        </button>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="flex
                                   flex-1
                                   items-center
                                   justify-center
                                   gap-2
                                   rounded-xl
                                   bg-gradient-to-r
                                   from-[#5B3B2B]
                                   via-[#6F4E37]
                                   to-[#8B6245]
                                   px-4 py-3
                                   text-sm
                                   font-bold
                                   text-white
                                   shadow-lg
                                   shadow-[#6F4E37]/20">

                                            <i class="fa-solid
                                       fa-right-to-bracket">
                                            </i>

                                            Masuk untuk Membeli

                                        </a>

                                    @endauth

                                </div>

                            </div>
                        @endif

                    </div>

                @endsection
