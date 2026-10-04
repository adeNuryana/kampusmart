@extends('layouts.public')

@section('title', 'Produk - KampusMart')

@section('content')

    <div
        class="min-h-screen
               bg-[#FFF7ED]


               ">


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
            <div class="mb-5">

                <a href="{{ route('buyer.dashboard') }}"
                    class="inline-flex items-center gap-2
                           text-sm font-semibold
                           text-slate-500
                           transition
                           hover:text-[#F97516]">
                    <i class="fa-solid fa-arrow-left"></i>

                    Dashboard
                </a>

            </div>
            <section
                class="relative
                       mb-5
                       overflow-hidden
                       rounded-3xl
                       border
                       border-[#E6D8CD]
                       bg-[#FFF7ED]



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
                           bg-[#FACC15]/10
                           blur-3xl">
                </div>


                <div
                    class="pointer-events-none
                           absolute
                           -bottom-20
                           left-1/3
                           size-44
                           rounded-full
                           bg-[#F97516]/10
                           blur-3xl">
                </div>


                <div class="relative">

                    <div
                        class="inline-flex
                               items-center
                               gap-2
                               rounded-full
                               bg-[#FFF7ED]
                               px-3
                               py-1.5
                               text-xs
                               font-bold
                               text-[#F97516]">

                        <i class="fa-solid fa-store"></i>

                        Marketplace

                    </div>


                    <h1
                        class="mt-3
                               text-2xl
                               font-black
                               tracking-tight
                               text-slate-900
                               sm:text-3xl">

                        Semua Produk

                    </h1>


                    <p
                        class="mt-2
                               max-w-2xl
                               text-sm
                               leading-6
                               text-slate-500">

                        Temukan berbagai produk dari seller KampusMart
                        dan pilih produk yang sesuai dengan kebutuhanmu.

                    </p>

                </div>

            </section>



            {{-- ===================================================== --}}
            {{-- FILTER --}}
            {{-- ===================================================== --}}

            <section
                class="mb-5
                       overflow-hidden
                       rounded-3xl
                       border
                       border-[#E5D8CE]
                       bg-white
                       shadow-sm">


                {{-- FILTER HEADER --}}

                <div
                    class="flex
                           items-center
                           justify-between
                           gap-4
                           border-b
                           border-[#EFE4DC]
                           bg-[#FFF7ED]


                           px-5
                           py-4">


                    <div class="flex
                               items-center
                               gap-3">


                        <div
                            class="flex
                                   size-9
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-[#FFF7ED]
                                   text-[#F97516]">

                            <i class="fa-solid fa-sliders"></i>

                        </div>


                        <div>

                            <h2
                                class="text-sm
                                       font-bold
                                       text-slate-800">

                                Filter Produk

                            </h2>

                            <p
                                class="mt-0.5
                                       hidden
                                       text-xs
                                       text-slate-400
                                       sm:block">

                                Cari dan urutkan produk dengan lebih mudah.

                            </p>

                        </div>

                    </div>


                    @if (request('search') || request('category') || (request('sort') && request('sort') !== 'newest'))
                        <a href="{{ route('buyer.products.index') }}"
                            class="text-xs
                                   font-semibold
                                   text-[#F97516]
                                   transition
                                   hover:text-[#87443F]">

                            <i
                                class="fa-solid
                                       fa-xmark
                                       mr-1">
                            </i>

                            Hapus Filter

                        </a>
                    @endif

                </div>



                <form action="{{ route('buyer.products.index') }}" method="GET" class="p-5">


                    <div class="grid
                               gap-4
                               lg:grid-cols-12">


                        {{-- ================================================= --}}
                        {{-- SEARCH --}}
                        {{-- ================================================= --}}

                        <div class="lg:col-span-5">

                            <label for="search"
                                class="mb-2
                                       block
                                       text-sm
                                       font-semibold
                                       text-slate-700">

                                Cari Produk

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
                                        class="fa-solid
                                               fa-magnifying-glass
                                               text-sm">
                                    </i>

                                </div>


                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    placeholder="Cari nama produk..."
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
                                           focus:border-[#F97516]
                                           focus:ring-4
                                           focus:ring-[#FFF7ED]">

                            </div>

                        </div>



                        {{-- ================================================= --}}
                        {{-- CATEGORY --}}
                        {{-- ================================================= --}}

                        <div class="lg:col-span-3">

                            <label for="category"
                                class="mb-2
                                       block
                                       text-sm
                                       font-semibold
                                       text-slate-700">

                                Kategori

                            </label>


                            <select name="category" id="category"
                                class="h-11
                                       w-full
                                       rounded-xl
                                       border
                                       border-[#E5D5C9]
                                       bg-white
                                       px-4
                                       text-sm
                                       text-slate-700
                                       outline-none
                                       transition
                                       focus:border-[#F97516]
                                       focus:ring-4
                                       focus:ring-[#FFF7ED]">

                                <option value="">
                                    Semua Kategori
                                </option>


                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(request('category') == $category->id)>

                                        {{ $category->name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>



                        {{-- ================================================= --}}
                        {{-- SORT --}}
                        {{-- ================================================= --}}

                        <div class="lg:col-span-2">

                            <label for="sort"
                                class="mb-2
                                       block
                                       text-sm
                                       font-semibold
                                       text-slate-700">

                                Urutkan

                            </label>


                            <select name="sort" id="sort"
                                class="h-11
                                       w-full
                                       rounded-xl
                                       border
                                       border-[#E5D5C9]
                                       bg-white
                                       px-4
                                       text-sm
                                       text-slate-700
                                       outline-none
                                       transition
                                       focus:border-[#F97516]
                                       focus:ring-4
                                       focus:ring-[#FFF7ED]">


                                <option value="newest" @selected(request('sort') === 'newest' || !request('sort'))>

                                    Terbaru

                                </option>


                                <option value="price_low" @selected(request('sort') === 'price_low')>

                                    Harga Terendah

                                </option>


                                <option value="price_high" @selected(request('sort') === 'price_high')>

                                    Harga Tertinggi

                                </option>


                                <option value="name" @selected(request('sort') === 'name')>

                                    Nama A-Z

                                </option>

                            </select>

                        </div>



                        {{-- ================================================= --}}
                        {{-- BUTTON --}}
                        {{-- ================================================= --}}

                        <div
                            class="flex
                                   items-end
                                   gap-2
                                   lg:col-span-2">


                            <button type="submit"
                                class="flex
                                       h-11
                                       flex-1
                                       items-center
                                       justify-center
                                       gap-2
                                       rounded-xl
                                       bg-[#172554]



                                       px-4
                                       text-sm
                                       font-bold
                                       text-white
                                       shadow-sm
                                       transition
                                       duration-300
                                       hover:-translate-y-0.5
                                       hover:shadow-lg">

                                <i
                                    class="fa-solid
                                           fa-filter
                                           text-xs">
                                </i>

                                Terapkan

                            </button>


                            <a href="{{ route('buyer.products.index') }}" title="Reset Filter"
                                class="flex
                                       size-11
                                       shrink-0
                                       items-center
                                       justify-center
                                       rounded-xl
                                       border
                                       border-[#E5D5C9]
                                       bg-white
                                       text-[#F97516]
                                       transition
                                       hover:border-[#D6BBA8]
                                       hover:bg-[#FBF4EF]
                                       hover:text-[#172554]">

                                <i class="fa-solid
                                           fa-rotate-left">
                                </i>

                            </a>

                        </div>

                    </div>

                </form>

            </section>



            {{-- ===================================================== --}}
            {{-- RESULT INFO --}}
            {{-- ===================================================== --}}

            <div
                class="mb-5
                       flex
                       flex-col
                       gap-3
                       sm:flex-row
                       sm:items-center
                       sm:justify-between">


                <div
                    class="flex
                           items-center
                           gap-2
                           text-sm
                           text-slate-500">


                    <div
                        class="flex
                               size-8
                               shrink-0
                               items-center
                               justify-center
                               rounded-lg
                               bg-[#FFF7ED]
                               text-xs
                               text-[#F97516]">

                        <i class="fa-solid fa-boxes-stacked"></i>

                    </div>


                    <p>

                        Menampilkan

                        <span class="font-bold
                                   text-[#F97516]">

                            {{ $products->total() }}

                        </span>

                        produk


                        @if (request('search'))
                            untuk

                            <span class="font-semibold
                                       text-slate-800">

                                "{{ request('search') }}"

                            </span>
                        @endif

                    </p>

                </div>



                @if (request('category'))

                    @php

                        $activeCategory = $categories->firstWhere('id', request('category'));

                    @endphp


                    @if ($activeCategory)
                        <span
                            class="inline-flex
                                   w-fit
                                   items-center
                                   gap-2
                                   rounded-full
                                   bg-[#FFF7ED]
                                   px-3
                                   py-1.5
                                   text-xs
                                   font-semibold
                                   text-[#65795E]">

                            <i class="fa-solid fa-layer-group"></i>

                            {{ $activeCategory->name }}

                        </span>
                    @endif

                @endif

            </div>



            {{-- ===================================================== --}}
            {{-- PRODUCT GRID --}}
            {{-- ===================================================== --}}

            <div
                class="grid
                       grid-cols-2
                       gap-3
                       sm:grid-cols-2
                       sm:gap-4
                       lg:grid-cols-3
                       xl:grid-cols-4">


                @forelse ($products as $index => $product)
                    @php

                        $storeName = $product->user?->sellerProfile?->store_name ?? ($product->user?->name ?? 'Seller');

                        $storePhoto = $product->user?->sellerProfile?->photo;

                        $themes = [
                            [
                                'bar' => 'bg-[#F97516]',

                                'category' => 'bg-[#FFF7ED] text-[#F97516]',
                            ],

                            [
                                'bar' => 'bg-[#F97516]',

                                'category' => 'bg-[#FFF7ED] text-[#F97516]',
                            ],

                            [
                                'bar' => 'bg-[#172554]',

                                'category' => 'bg-[#FFF7ED] text-[#65795E]',
                            ],

                            [
                                'bar' => 'bg-[#FACC15]',

                                'category' => 'bg-[#FFF7ED] text-[#A87A37]',
                            ],
                        ];

                        $theme = $themes[$index % count($themes)];

                    @endphp



                    <article
                        class="group
                               relative
                               overflow-hidden
                               rounded-2xl
                               border
                               border-[#E9DED6]
                               bg-white
                               shadow-sm
                               transition
                               duration-300
                               hover:-translate-y-1.5
                               hover:border-[#DCC9BB]
                               hover:shadow-xl
                               hover:shadow-[#F97516]/10">


                        {{-- TOP ACCENT --}}

                        <div
                            class="h-1
                                   bg-[#172554]
                                   {{ $theme['bar'] }}">
                        </div>



                        {{-- ================================================= --}}
                        {{-- IMAGE --}}
                        {{-- ================================================= --}}

                        <a href="{{ route('buyer.products.show', $product) }}" class="block">


                            <div
                                class="relative
                                       aspect-square
                                       overflow-hidden
                                       bg-[#FFF7ED]

                                       ">


                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
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
                                               justify-center">

                                        <div
                                            class="flex
                                                   size-16
                                                   items-center
                                                   justify-center
                                                   rounded-2xl
                                                   bg-white/60
                                                   text-[#C7B4A7]
                                                   shadow-sm">

                                            <i
                                                class="fa-regular
                                                       fa-image
                                                       text-3xl">
                                            </i>

                                        </div>

                                    </div>
                                @endif



                                {{-- ========================================= --}}
                                {{-- STOCK WARNING --}}
                                {{-- ========================================= --}}

                                @if ($product->stock <= 5)
                                    <span
                                        class="absolute
                                               left-2
                                               top-2
                                               inline-flex
                                               items-center
                                               gap-1
                                               rounded-lg
                                               border
                                               border-[#EAD6A9]
                                               bg-[#FFF7ED]/95
                                               px-2
                                               py-1
                                               text-[9px]
                                               font-bold
                                               text-[#A87A37]
                                               shadow-sm
                                               backdrop-blur
                                               sm:left-3
                                               sm:top-3
                                               sm:px-2.5
                                               sm:text-xs">

                                        <i
                                            class="fa-solid
                                                   fa-fire
                                                   text-[8px]">
                                        </i>

                                        Sisa {{ $product->stock }}

                                    </span>
                                @endif



                                {{-- CATEGORY ON IMAGE --}}

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
                                           {{ $theme['category'] }}">

                                    {{ $product->category?->name ?? 'Tanpa Kategori' }}

                                </span>

                            </div>

                        </a>



                        {{-- ================================================= --}}
                        {{-- CONTENT --}}
                        {{-- ================================================= --}}

                        <div class="p-3 sm:p-4">


                            {{-- NAME --}}

                            <a href="{{ route('buyer.products.show', $product) }}" class="block">


                                <h2
                                    class="line-clamp-2
                                           min-h-10
                                           text-xs
                                           font-bold
                                           leading-5
                                           text-slate-800
                                           transition
                                           group-hover:text-[#F97516]
                                           sm:min-h-12
                                           sm:text-sm
                                           sm:leading-6">

                                    {{ $product->name }}

                                </h2>

                            </a>



                            {{-- PRICE --}}

                            <p
                                class="mt-2
                                       bg-[#172554]


                                       bg-clip-text
                                       text-sm
                                       font-black
                                       text-transparent
                                       sm:mt-3
                                       sm:text-lg">

                                Rp{{ number_format($product->price, 0, ',', '.') }}

                            </p>



                            {{-- STOCK --}}

                            <div
                                class="mt-2
                                       flex
                                       items-center
                                       justify-between
                                       gap-2">


                                <span
                                    class="text-[9px]
                                           text-slate-400
                                           sm:text-[10px]">

                                    Stok
                                    {{ $product->stock }}

                                </span>


                                @if ($product->stock > 5)
                                    <span
                                        class="inline-flex
                                               items-center
                                               gap-1
                                               text-[9px]
                                               font-semibold
                                               text-[#65795E]
                                               sm:text-[10px]">

                                        <i
                                            class="fa-solid
                                                   fa-circle-check">
                                        </i>

                                        Tersedia

                                    </span>
                                @else
                                    <span
                                        class="text-[9px]
                                               font-semibold
                                               text-[#A87A37]
                                               sm:text-[10px]">

                                        Stok terbatas

                                    </span>
                                @endif

                            </div>



                            {{-- ================================================= --}}
                            {{-- SELLER --}}
                            {{-- ================================================= --}}

                            <div
                                class="mt-3
                                       flex
                                       items-center
                                       gap-2
                                       border-t
                                       border-[#F0E7E0]
                                       pt-3
                                       sm:mt-4
                                       sm:gap-3
                                       sm:pt-4">


                                @if ($storePhoto)
                                    <img src="{{ asset('storage/' . $storePhoto) }}" alt="{{ $storeName }}"
                                        class="size-8
                                               shrink-0
                                               rounded-full
                                               border
                                               border-[#E8DAD0]
                                               object-cover
                                               sm:size-9">
                                @else
                                    <div
                                        class="flex
                                               size-8
                                               shrink-0
                                               items-center
                                               justify-center
                                               rounded-full
                                               bg-[#FFF7ED]


                                               text-[10px]
                                               font-black
                                               text-[#F97516]
                                               sm:size-9
                                               sm:text-xs">

                                        {{ strtoupper(substr($storeName, 0, 1)) }}

                                    </div>
                                @endif



                                <div class="min-w-0">

                                    <p
                                        class="truncate
                                               text-[10px]
                                               font-semibold
                                               text-slate-700
                                               sm:text-sm">

                                        {{ $storeName }}

                                    </p>


                                    <p
                                        class="mt-0.5
                                               hidden
                                               text-[10px]
                                               text-slate-400
                                               sm:block">

                                        Penjual

                                    </p>

                                </div>


                                <i
                                    class="fa-solid
                                           fa-chevron-right
                                           ml-auto
                                           text-[8px]
                                           text-[#C7B4A7]
                                           transition
                                           group-hover:translate-x-0.5
                                           group-hover:text-[#F97516]">
                                </i>

                            </div>

                        </div>

                    </article>


                @empty

                    {{-- ================================================= --}}
                    {{-- EMPTY RESULT --}}
                    {{-- ================================================= --}}

                    <div
                        class="col-span-full
                               relative
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
                                   bg-[#FACC15]/10
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
                                       bg-[#FFF7ED]


                                       text-3xl
                                       text-[#F97516]
                                       shadow-sm">

                                <i class="fa-solid
                                           fa-bag-shopping">
                                </i>

                            </div>


                            <h3
                                class="mt-5
                                       text-lg
                                       font-black
                                       text-slate-900">

                                Produk tidak ditemukan

                            </h3>


                            <p
                                class="mx-auto
                                       mt-2
                                       max-w-md
                                       text-sm
                                       leading-6
                                       text-slate-500">

                                Coba gunakan kata pencarian lain,
                                ubah kategori, atau reset filter
                                untuk melihat semua produk.

                            </p>


                            <a href="{{ route('buyer.products.index') }}"
                                class="mt-6
                                       inline-flex
                                       h-11
                                       items-center
                                       justify-center
                                       gap-2
                                       rounded-xl
                                       bg-[#172554]



                                       px-5
                                       text-sm
                                       font-bold
                                       text-white
                                       shadow-lg
                                       shadow-[#F97516]/20
                                       transition
                                       hover:-translate-y-0.5
                                       hover:shadow-xl">

                                <i class="fa-solid
                                           fa-rotate-left">
                                </i>

                                Reset Filter

                            </a>

                        </div>

                    </div>
                @endforelse

            </div>



            {{-- ===================================================== --}}
            {{-- PAGINATION --}}
            {{-- ===================================================== --}}

            @if ($products->hasPages())
                <div
                    class="mt-8
                           rounded-2xl
                           border
                           border-[#E5D8CE]
                           bg-white
                           px-4
                           py-3
                           shadow-sm">

                    {{ $products->links() }}

                </div>
            @endif

        </main>

    </div>

@endsection
