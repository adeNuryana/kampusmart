@extends('layouts.buyer')

@section('title', 'Produk - KampusMart')

@section('content')

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="mb-7">

            <p class="text-sm font-semibold text-violet-600">
                Marketplace
            </p>

            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 md:text-3xl">
                Semua Produk
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Temukan berbagai produk dari seller KampusMart.
            </p>

        </div>


        {{-- FILTER --}}
        <div class="mb-7 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <form action="{{ route('buyer.products.index') }}" method="GET">

                <div class="grid gap-4 lg:grid-cols-12">

                    {{-- SEARCH --}}
                    <div class="lg:col-span-5">

                        <label for="search" class="mb-2 block text-sm font-medium text-slate-700">
                            Cari Produk
                        </label>

                        <div class="relative">

                            <svg class="absolute left-4 top-1/2 size-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="7" />
                                <path d="m20 20-3.5-3.5" />
                            </svg>

                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="Cari nama produk..."
                                class="h-11 w-full rounded-xl
                                   border border-slate-200
                                   bg-white pl-11 pr-4
                                   text-sm outline-none
                                   transition
                                   focus:border-violet-400
                                   focus:ring-4
                                   focus:ring-violet-100">

                        </div>

                    </div>


                    {{-- CATEGORY --}}
                    <div class="lg:col-span-3">

                        <label for="category" class="mb-2 block text-sm font-medium text-slate-700">
                            Kategori
                        </label>

                        <select name="category" id="category"
                            class="h-11 w-full rounded-xl
                               border border-slate-200
                               bg-white px-4
                               text-sm outline-none
                               focus:border-violet-400
                               focus:ring-4
                               focus:ring-violet-100">

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


                    {{-- SORT --}}
                    <div class="lg:col-span-2">

                        <label for="sort" class="mb-2 block text-sm font-medium text-slate-700">
                            Urutkan
                        </label>

                        <select name="sort" id="sort"
                            class="h-11 w-full rounded-xl
                               border border-slate-200
                               bg-white px-4
                               text-sm outline-none
                               focus:border-violet-400
                               focus:ring-4
                               focus:ring-violet-100">

                            <option value="newest" @selected(request('sort') === 'newest')>
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


                    {{-- BUTTON --}}
                    <div class="flex items-end gap-2 lg:col-span-2">

                        <button type="submit"
                            class="h-11 flex-1 rounded-xl
                               bg-violet-600 px-4
                               text-sm font-semibold
                               text-white transition
                               hover:bg-violet-700">
                            Terapkan
                        </button>


                        <a href="{{ route('buyer.products.index') }}" title="Reset Filter"
                            class="inline-flex size-11
                               items-center justify-center
                               rounded-xl border
                               border-slate-200
                               text-slate-500
                               transition
                               hover:bg-slate-50">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M3 12a9 9 0 1 0 3-6.7" />
                                <path d="M3 4v6h6" />
                            </svg>
                        </a>

                    </div>

                </div>

            </form>

        </div>


        {{-- RESULT INFO --}}
        <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

            <p class="text-sm text-slate-500">

                Menampilkan

                <span class="font-semibold text-slate-800">
                    {{ $products->total() }}
                </span>

                produk

                @if (request('search'))
                    untuk

                    <span class="font-semibold text-slate-800">
                        "{{ request('search') }}"
                    </span>
                @endif

            </p>

        </div>


        {{-- PRODUCT GRID --}}
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            @forelse ($products as $product)
                <article
                    class="group overflow-hidden
                       rounded-2xl border
                       border-slate-200 bg-white
                       shadow-sm transition
                       duration-200
                       hover:-translate-y-1
                       hover:shadow-lg">

                    {{-- IMAGE --}}
                    <a href="{{ route('buyer.products.show', $product) }}">
                        <div class="relative aspect-square overflow-hidden bg-slate-100">

                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="h-full w-full object-cover
                                   transition duration-300
                                   group-hover:scale-105">
                            @else
                                <div class="flex h-full w-full items-center justify-center">

                                    <svg class="size-14 text-slate-300" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.4">
                                        <rect x="3" y="3" width="18" height="18" rx="2" />

                                        <circle cx="8.5" cy="8.5" r="1.5" />

                                        <path d="m21 15-5-5L5 21" />
                                    </svg>

                                </div>
                            @endif


                            {{-- STOCK --}}
                            @if ($product->stock <= 5)
                                <span
                                    class="absolute left-3 top-3
                                   rounded-lg bg-amber-50
                                   px-2.5 py-1
                                   text-xs font-semibold
                                   text-amber-700 shadow-sm">
                                    Sisa {{ $product->stock }}
                                </span>
                            @endif

                        </div>
                    </a>


                    {{-- CONTENT --}}
                    <div class="p-4">

                        {{-- CATEGORY --}}
                        <p class="text-xs font-semibold text-violet-600">
                            {{ $product->category?->name ?? 'Tanpa Kategori' }}
                        </p>


                        {{-- NAME --}}
                        <a href="{{ route('buyer.products.show', $product) }}" class="block">
                            <h2
                                class="mt-1 line-clamp-2
                               min-h-[48px]
                               font-semibold leading-6
                               text-slate-900">
                                {{ $product->name }}
                            </h2>
                        </a>


                            {{-- PRICE --}}
                            <p class="mt-3 text-lg font-bold text-slate-900">

                                Rp
                                {{ number_format($product->price, 0, ',', '.') }}

                            </p>


                            {{-- STOCK TEXT --}}
                            <p class="mt-1 text-xs text-slate-400">
                                Stok {{ $product->stock }}
                            </p>


                            {{-- SELLER --}}
                            <div
                                class="mt-4 flex items-center
                               gap-3 border-t
                               border-slate-100 pt-4">

                                @if ($product->user?->sellerProfile?->photo)
                                    <img src="{{ asset('storage/' . $product->user->sellerProfile->photo) }}"
                                        alt="{{ $product->user->name }}"
                                        class="size-9 shrink-0
                                       rounded-full
                                       object-cover">
                                @else
                                    <div
                                        class="flex size-9 shrink-0
                                       items-center
                                       justify-center
                                       rounded-full
                                       bg-violet-100
                                       text-xs font-bold
                                       text-violet-700">

                                        {{ strtoupper(substr($product->user?->name ?? 'S', 0, 1)) }}

                                    </div>
                                @endif


                                <div class="min-w-0">

                                    <p class="truncate text-sm font-medium text-slate-700">

                                        {{ $product->user?->sellerProfile?->store_name ?? ($product->user?->name ?? 'Seller') }}

                                    </p>

                                    <p class="text-xs text-slate-400">
                                        Penjual
                                    </p>

                                </div>

                            </div>

                    </div>

                </article>


            @empty

                <div
                    class="col-span-full rounded-2xl
                       border border-dashed
                       border-slate-300 bg-white
                       px-6 py-16 text-center">

                    <div
                        class="mx-auto flex size-16
                           items-center justify-center
                           rounded-2xl bg-slate-100">

                        <svg class="size-8 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5">
                            <path d="M6 7h12l1 14H5L6 7Z" />
                            <path d="M9 7a3 3 0 0 1 6 0" />
                        </svg>

                    </div>


                    <h3 class="mt-4 font-semibold text-slate-900">
                        Produk tidak ditemukan
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Coba ubah kata pencarian atau filter kategori.
                    </p>


                    <a href="{{ route('buyer.products.index') }}"
                        class="mt-5 inline-flex h-10
                           items-center justify-center
                           rounded-xl bg-violet-600
                           px-4 text-sm font-semibold
                           text-white hover:bg-violet-700">
                        Reset Filter
                    </a>

                </div>
            @endforelse

        </div>


        {{-- PAGINATION --}}
        @if ($products->hasPages())
            <div class="mt-8">

                {{ $products->links() }}

            </div>
        @endif

    </div>

@endsection
