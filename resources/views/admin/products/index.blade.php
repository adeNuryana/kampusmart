@extends('layouts.admin')

@section('title', 'Produk')

@section('content')

    <div class="mx-auto max-w-[1400px] space-y-6">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section>

            <div
                class="inline-flex
                       items-center
                       gap-2
                       rounded-full
                       bg-[#EEF3EA]
                       px-3
                       py-1.5
                       text-xs
                       font-bold
                       text-[#65795E]">

                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                    <path d="M6 7h12l1 14H5L6 7Z" />
                    <path d="M9 7a3 3 0 0 1 6 0" />

                </svg>

                Manajemen Produk

            </div>


            <h1
                class="mt-3
                       text-2xl
                       font-black
                       tracking-tight
                       text-[#332B26]
                       lg:text-3xl">

                Produk

            </h1>


            <p
                class="mt-2
                       max-w-2xl
                       text-sm
                       leading-6
                       text-slate-500">

                Pantau dan kelola seluruh produk
                yang terdaftar dari seller KampusMart.

            </p>

        </section>



        {{-- ===================================================== --}}
        {{-- STATISTIC --}}
        {{-- ===================================================== --}}

        <section class="grid gap-4
                   sm:grid-cols-2
                   lg:grid-cols-4">


            {{-- TOTAL PRODUCT --}}

            <div
                class="relative
                       overflow-hidden
                       rounded-3xl
                       border
                       border-[#DFD2C7]
                       bg-white
                       p-5
                       shadow-sm">

                <div
                    class="absolute
                           inset-x-0
                           top-0
                           h-1
                           bg-[#4371d1]">
                </div>


                <div
                    class="flex
                           items-start
                           justify-between
                           gap-4">


                    <div>

                        <p
                            class="text-xs
                                   font-bold
                                   uppercase
                                   tracking-wide
                                   text-[#998274]">

                            Total Produk

                        </p>


                        <p
                            class="mt-5
                                   text-3xl
                                   font-black
                                   text-[#332B26]">

                            {{ number_format($products->total()) }}

                        </p>


                        <p
                            class="mt-2
                                   text-xs
                                   text-slate-400">

                            Produk terdaftar

                        </p>

                    </div>


                    <div
                        class="flex
                               size-11
                               shrink-0
                               items-center
                               justify-center
                               rounded-xl
                               bg-[#4371d1]
                               text-white">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <path d="M6 7h12l1 14H5L6 7Z" />
                            <path d="M9 7a3 3 0 0 1 6 0" />

                        </svg>

                    </div>

                </div>

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- FILTER --}}
        {{-- ===================================================== --}}

        <section
            class="overflow-hidden
                   rounded-3xl
                   border
                   border-[#DFD2C7]
                   bg-white
                   shadow-sm">


            {{-- FILTER HEADER --}}

            <div
                class="border-b
                       border-[#E7DBD1]
                       bg-[#FAF7F2]
                       px-5
                       py-4">

                <div class="flex
                           items-center
                           gap-3">

                    <div
                        class="flex
                               size-9
                               items-center
                               justify-center
                               rounded-xl
                               bg-[#F1E6DE]
                               text-[#4371d1]">

                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <path d="M4 6h16" />
                            <path d="M7 12h10" />
                            <path d="M10 18h4" />

                        </svg>

                    </div>


                    <div>

                        <p
                            class="text-sm
                                   font-bold
                                   text-[#332B26]">

                            Filter Produk

                        </p>

                        <p
                            class="mt-0.5
                                   text-xs
                                   text-slate-500">

                            Cari produk berdasarkan nama,
                            kategori, atau status.

                        </p>

                    </div>

                </div>

            </div>



            {{-- FILTER FORM --}}

            <form action="{{ route('admin.products.index') }}" method="GET" class="p-5">

                <div class="grid
                           gap-4
                           lg:grid-cols-12">


                    {{-- SEARCH --}}

                    <div class="lg:col-span-5">

                        <label for="search"
                            class="mb-2
                                   block
                                   text-sm
                                   font-semibold
                                   text-[#4D4038]">

                            Cari Produk

                        </label>


                        <div class="relative">

                            <svg class="absolute
                                       left-4
                                       top-1/2
                                       size-4
                                       -translate-y-1/2
                                       text-[#A28A7A]"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                <circle cx="11" cy="11" r="7" />
                                <path d="m20 20-3.5-3.5" />

                            </svg>


                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="Cari nama produk..."
                                class="h-11
                                       w-full
                                       rounded-xl
                                       border
                                       border-[#DFD2C7]
                                       bg-white
                                       pl-11
                                       pr-4
                                       text-sm
                                       text-[#4D4038]
                                       outline-none
                                       transition
                                       placeholder:text-[#B3A195]
                                       focus:border-[#A97957]
                                       focus:ring-4
                                       focus:ring-[#F1E6DE]">

                        </div>

                    </div>



                    {{-- CATEGORY --}}

                    <div class="lg:col-span-3">

                        <label for="category"
                            class="mb-2
                                   block
                                   text-sm
                                   font-semibold
                                   text-[#4D4038]">

                            Kategori

                        </label>


                        <select name="category" id="category"
                            class="h-11
                                   w-full
                                   rounded-xl
                                   border
                                   border-[#DFD2C7]
                                   bg-white
                                   px-4
                                   text-sm
                                   text-[#4D4038]
                                   outline-none
                                   transition
                                   focus:border-[#A97957]
                                   focus:ring-4
                                   focus:ring-[#F1E6DE]">

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



                    {{-- STATUS --}}

                    <div class="lg:col-span-2">

                        <label for="status"
                            class="mb-2
                                   block
                                   text-sm
                                   font-semibold
                                   text-[#4D4038]">

                            Status

                        </label>


                        <select name="status" id="status"
                            class="h-11
                                   w-full
                                   rounded-xl
                                   border
                                   border-[#DFD2C7]
                                   bg-white
                                   px-4
                                   text-sm
                                   text-[#4D4038]
                                   outline-none
                                   transition
                                   focus:border-[#A97957]
                                   focus:ring-4
                                   focus:ring-[#F1E6DE]">

                            <option value="">
                                Semua
                            </option>

                            <option value="active" @selected(request('status') === 'active')>

                                Aktif

                            </option>

                            <option value="inactive" @selected(request('status') === 'inactive')>

                                Nonaktif

                            </option>

                        </select>

                    </div>



                    {{-- ACTION --}}

                    <div
                        class="flex
                               items-end
                               gap-2
                               lg:col-span-2">

                        <button type="submit"
                            class="inline-flex
                                   h-11
                                   flex-1
                                   items-center
                                   justify-center
                                   gap-2
                                   rounded-xl
                                   bg-[#4371d1]
                                   px-4
                                   text-sm
                                   font-bold
                                   text-white
                                   transition
                                   hover:bg-[#0a1d45]">

                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                                <path d="M4 6h16" />
                                <path d="M7 12h10" />
                                <path d="M10 18h4" />

                            </svg>

                            Filter

                        </button>


                        <a href="{{ route('admin.products.index') }}" title="Reset Filter"
                            class="inline-flex
                                   size-11
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-xl
                                   border
                                   border-[#DFD2C7]
                                   bg-white
                                   text-[#8B7465]
                                   transition
                                   hover:bg-[#F3EAE3]
                                   hover:text-[#0a1d45]">

                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                <path d="M4 4v6h6" />

                                <path d="M5.5 15a7.5 7.5 0 1 0
                                           .5-7.5L4 10" />

                            </svg>

                        </a>

                    </div>

                </div>

            </form>

        </section>



        {{-- ===================================================== --}}
        {{-- PRODUCT TABLE --}}
        {{-- ===================================================== --}}

        <section
            class="overflow-hidden
                   rounded-3xl
                   border
                   border-[#DFD2C7]
                   bg-white
                   shadow-sm">


            {{-- TABLE HEADER INFO --}}

            <div
                class="flex
                       flex-col
                       gap-2
                       border-b
                       border-[#E7DBD1]
                       bg-[#FAF7F2]
                       px-5
                       py-4
                       sm:flex-row
                       sm:items-center
                       sm:justify-between">

                <div>

                    <h2
                        class="text-sm
                               font-bold
                               text-[#332B26]">

                        Daftar Produk

                    </h2>

                    <p class="mt-0.5
                               text-xs
                               text-slate-500">

                        Produk seller yang tersedia di KampusMart.

                    </p>

                </div>


                <span
                    class="inline-flex
                           w-fit
                           items-center
                           rounded-full
                           bg-[#F1E6DE]
                           px-3
                           py-1.5
                           text-xs
                           font-bold
                           text-[#4371d1]">

                    {{ number_format($products->total()) }}
                    produk

                </span>

            </div>



            {{-- TABLE --}}

            <div class="overflow-x-auto">

                <table class="w-full min-w-[1050px]">

                    <thead class="bg-[#F8F3ED]">

                        <tr
                            class="text-left
                                   text-xs
                                   font-bold
                                   uppercase
                                   tracking-wide
                                   text-[#907A6C]">

                            <th class="px-5 py-4">
                                Produk
                            </th>

                            <th class="px-5 py-4">
                                Seller
                            </th>

                            <th class="px-5 py-4">
                                Kategori
                            </th>

                            <th class="px-5 py-4">
                                Harga
                            </th>

                            <th class="px-5 py-4">
                                Stok
                            </th>

                            <th class="px-5 py-4">
                                Status
                            </th>

                            <th class="px-5 py-4 text-right">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y
                               divide-[#EEE5DE]">

                        @forelse ($products as $product)
                            <tr
                                class="text-sm
                                       transition
                                       hover:bg-[#FBF7F3]">


                                {{-- PRODUCT --}}

                                <td class="px-5 py-4">

                                    <div
                                        class="flex
                                               items-center
                                               gap-3">

                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="size-14
                                                       shrink-0
                                                       rounded-xl
                                                       border
                                                       border-[#E7DBD1]
                                                       object-cover">
                                        @else
                                            <div
                                                class="flex
                                                       size-14
                                                       shrink-0
                                                       items-center
                                                       justify-center
                                                       rounded-xl
                                                       bg-[#FAF7F2]
                                                       text-[#A28A7A]">

                                                <svg class="size-6" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.7">

                                                    <rect x="3" y="3" width="18" height="18" rx="2" />

                                                    <circle cx="8.5" cy="8.5" r="1.5" />

                                                    <path d="m21 15-5-5L5 21" />

                                                </svg>

                                            </div>
                                        @endif


                                        <div class="min-w-0">

                                            <p
                                                class="max-w-[250px]
                                                       truncate
                                                       font-bold
                                                       text-[#332B26]">

                                                {{ $product->name }}

                                            </p>

                                            <p
                                                class="mt-1
                                                       text-xs
                                                       text-slate-400">

                                                ID #{{ $product->id }}

                                            </p>

                                        </div>

                                    </div>

                                </td>



                                {{-- SELLER --}}

                                <td class="px-5 py-4">

                                    <div>

                                        <p
                                            class="font-semibold
                                                   text-[#4D4038]">

                                            {{ $product->user?->sellerProfile?->store_name ?? '-' }}

                                        </p>


                                        <div
                                            class="mt-1
                                                   inline-flex
                                                   items-center
                                                   gap-1.5
                                                   text-xs
                                                   text-slate-400">

                                            <span
                                                class="size-1.5
                                                       rounded-full
                                                       bg-[#C8795A]">
                                            </span>

                                            {{ $product->user?->name ?? '-' }}

                                        </div>

                                    </div>

                                </td>



                                {{-- CATEGORY --}}

                                <td class="px-5 py-4">

                                    <span
                                        class="inline-flex
                                               rounded-lg
                                               bg-[#F1E6DE]
                                               px-3
                                               py-1.5
                                               text-xs
                                               font-semibold
                                               text-[#4371d1]">

                                        {{ $product->category?->name ?? '-' }}

                                    </span>

                                </td>



                                {{-- PRICE --}}

                                <td
                                    class="whitespace-nowrap
                                           px-5
                                           py-4">

                                    <span class="font-bold
                                               text-[#332B26]">

                                        Rp{{ number_format($product->price, 0, ',', '.') }}

                                    </span>

                                </td>



                                {{-- STOCK --}}

                                <td class="px-5 py-4">

                                    @if ($product->stock <= 0)
                                        <span
                                            class="inline-flex
                                                   items-center
                                                   gap-2
                                                   rounded-full
                                                   bg-[#FAEDEC]
                                                   px-3
                                                   py-1.5
                                                   text-xs
                                                   font-bold
                                                   text-[#A65954]">

                                            <span
                                                class="size-1.5
                                                       rounded-full
                                                       bg-[#A65954]">
                                            </span>

                                            Habis

                                        </span>
                                    @elseif ($product->stock <= 5)
                                        <span
                                            class="inline-flex
                                                   items-center
                                                   gap-2
                                                   rounded-full
                                                   bg-[#FAF2DF]
                                                   px-3
                                                   py-1.5
                                                   text-xs
                                                   font-bold
                                                   text-[#A87A37]">

                                            {{ $product->stock }}
                                            tersisa

                                        </span>
                                    @else
                                        <span
                                            class="font-semibold
                                                   text-[#4D4038]">

                                            {{ $product->stock }}

                                        </span>
                                    @endif

                                </td>



                                {{-- STATUS --}}

                                <td class="px-5 py-4">

                                    @if ($product->status === 'active')
                                        <span
                                            class="inline-flex
                                                   items-center
                                                   gap-2
                                                   rounded-full
                                                   border
                                                   border-[#D3DFCE]
                                                   bg-[#EEF3EA]
                                                   px-3
                                                   py-1.5
                                                   text-xs
                                                   font-bold
                                                   text-[#65795E]">

                                            <span
                                                class="size-1.5
                                                       rounded-full
                                                       bg-[#718268]">
                                            </span>

                                            Aktif

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex
                                                   items-center
                                                   gap-2
                                                   rounded-full
                                                   border
                                                   border-[#ECD2CF]
                                                   bg-[#FAEDEC]
                                                   px-3
                                                   py-1.5
                                                   text-xs
                                                   font-bold
                                                   text-[#A65954]">

                                            <span
                                                class="size-1.5
                                                       rounded-full
                                                       bg-[#A65954]">
                                            </span>

                                            Nonaktif

                                        </span>
                                    @endif

                                </td>



                                {{-- ACTION --}}

                                <td class="px-5 py-4">

                                    <div class="flex
                                               justify-end">

                                        <button type="button" title="Aksi Produk"
                                            class="inline-flex
                                                   size-9
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   text-[#8B7465]
                                                   transition
                                                   hover:bg-[#F1E6DE]
                                                   hover:text-[#4371d1]">

                                            <svg class="size-5" viewBox="0 0 24 24" fill="currentColor">

                                                <circle cx="5" cy="12" r="1.5" />

                                                <circle cx="12" cy="12" r="1.5" />

                                                <circle cx="19" cy="12" r="1.5" />

                                            </svg>

                                        </button>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="7" class="px-6 py-16">

                                    <div class="text-center">

                                        <div
                                            class="mx-auto
                                                   flex
                                                   size-16
                                                   items-center
                                                   justify-center
                                                   rounded-2xl
                                                   bg-[#EEF3EA]
                                                   text-[#65795E]">

                                            <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.7">

                                                <path d="M6 7h12l1 14H5L6 7Z" />

                                                <path d="M9 7a3 3 0 0 1 6 0" />

                                            </svg>

                                        </div>


                                        <h3
                                            class="mt-4
                                                   font-bold
                                                   text-[#4D4038]">

                                            Belum ada produk

                                        </h3>


                                        <p
                                            class="mt-2
                                                   text-sm
                                                   text-slate-500">

                                            Produk yang dibuat oleh seller
                                            akan muncul di halaman ini.

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

            @if ($products->hasPages())
                <div
                    class="border-t
                           border-[#E7DBD1]
                           bg-[#FAF7F2]
                           px-5
                           py-4">

                    {{ $products->links() }}

                </div>
            @endif

        </section>

    </div>

@endsection
