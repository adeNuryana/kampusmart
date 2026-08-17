@extends('layouts.buyer')

@section('title', 'KampusMart')

@section('content')

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">


        {{-- HERO --}}
        <section
            class="relative overflow-hidden rounded-3xl
               bg-gradient-to-br from-violet-600
               via-violet-600 to-indigo-700
               px-6 py-10 text-white
               md:px-10 md:py-14">

            <div class="relative z-10 max-w-2xl">

                <span
                    class="inline-flex rounded-full
                       bg-white/15 px-3 py-1.5
                       text-xs font-semibold
                       backdrop-blur">
                    Marketplace Mahasiswa
                </span>


                <h1
                    class="mt-5 text-3xl font-bold
                       leading-tight tracking-tight
                       md:text-5xl">
                    Cari kebutuhan kampus
                    dengan lebih mudah.
                </h1>


                <p
                    class="mt-4 max-w-xl text-sm
                       leading-6 text-violet-100
                       md:text-base">
                    Temukan berbagai produk dari penjual
                    terpercaya di lingkungan kampus.
                </p>




                <form action="{{ route('buyer.products.index') }}" method="GET"
                    class="mt-7 flex max-w-xl rounded-2xl bg-white p-2">

                    <div class="relative flex-1">

                        <svg class="absolute left-4 top-1/2
                   size-5 -translate-y-1/2
                   text-slate-400"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7" />
                            <path d="m20 20-3.5-3.5" />
                        </svg>


                        <input type="text" name="search" placeholder="Cari buku, laptop, makanan..."
                            class="h-11 w-full rounded-xl
                   pl-11 pr-4 text-sm
                   text-slate-800 outline-none">

                    </div>


                    <button type="submit"
                        class="rounded-xl bg-slate-900
               px-5 text-sm font-semibold
               text-white transition
               hover:bg-slate-800">
                        Cari
                    </button>

                </form>



            </div>


            {{-- DECORATION --}}
            <div class="absolute -right-16 -top-16
                   size-72 rounded-full
                   bg-white/10">
            </div>

            <div
                class="absolute -bottom-24 right-32
                   size-64 rounded-full
                   bg-indigo-400/20">
            </div>

        </section>


        {{-- CATEGORY --}}
        <section class="mt-10">

            <div class="flex items-end justify-between">

                <div>

                    <h2
                        class="text-xl font-bold
                           tracking-tight text-slate-900
                           md:text-2xl">
                        Kategori
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Temukan produk berdasarkan kategori.
                    </p>

                </div>

            </div>


            <div class="mt-5 flex gap-3
                   overflow-x-auto pb-2">

                @forelse ($categories as $category)
                    <a href="{{ route('buyer.products.index', [
                        'category' => $category->id,
                    ]) }}"
                        class="whitespace-nowrap rounded-xl
           border border-slate-200
           bg-white px-5 py-3
           text-sm font-medium
           text-slate-700 shadow-sm
           transition
           hover:border-violet-200
           hover:bg-violet-50
           hover:text-violet-700">
                        {{ $category->name }}
                    </a>

                @empty

                    <p class="text-sm text-slate-500">
                        Belum ada kategori.
                    </p>
                @endforelse

            </div>

        </section>


        {{-- PRODUCT --}}
        <section class="mt-10">

            <div class="flex items-end justify-between gap-4">

                <div>

                    <h2
                        class="text-xl font-bold
                           tracking-tight text-slate-900
                           md:text-2xl">
                        Produk Terbaru
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Produk terbaru dari penjual KampusMart.
                    </p>

                </div>


                <a href="{{ route('buyer.products.index') }}"
                    class="text-sm font-semibold
           text-violet-600
           transition hover:text-violet-700">
                    Lihat Semua
                </a>

            </div>


            <div class="mt-6 grid gap-5
                   sm:grid-cols-2
                   lg:grid-cols-4">

                @forelse ($products as $product)
                    <article
                        class="group overflow-hidden
                           rounded-2xl border
                           border-slate-200 bg-white
                           shadow-sm transition
                           hover:-translate-y-1
                           hover:shadow-lg
                           hover:shadow-slate-200/70">

                        {{-- IMAGE --}}
                        <div class="relative aspect-square
                               overflow-hidden bg-slate-100">

                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="h-full w-full object-cover
                                       transition duration-300
                                       group-hover:scale-105">
                            @else
                                <div
                                    class="flex h-full w-full
                                       items-center justify-center">

                                    <svg class="size-12 text-slate-300" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5">
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


                        {{-- CONTENT --}}
                        <div class="p-4">

                            {{-- CATEGORY --}}
                            <p class="text-xs font-medium
                                   text-violet-600">
                                {{ $product->category?->name ?? 'Produk' }}
                            </p>


                            {{-- NAME --}}
                            <a href="{{ route('buyer.products.show', $product) }}" class="block">
                                <h3
                                    class="mt-1 line-clamp-2
                                   min-h-[48px]
                                   font-semibold
                                   leading-6 text-slate-900">
                                    {{ $product->name }}
                                </h3>
                            </a>

                            {{-- PRICE --}}
                            <p class="mt-3 text-lg font-bold
                                   text-slate-900">
                                Rp
                                {{ number_format($product->price, 0, ',', '.') }}
                            </p>


                            {{-- SELLER --}}
                            <div
                                class="mt-4 flex items-center
                                   gap-2 border-t
                                   border-slate-100 pt-4">

                                <div
                                    class="flex size-8
                                       items-center justify-center
                                       rounded-full bg-violet-100
                                       text-xs font-bold
                                       text-violet-700">
                                    {{ strtoupper(substr($product->user?->name ?? 'S', 0, 1)) }}
                                </div>


                                <div class="min-w-0">

                                    <p
                                        class="truncate text-xs
                                           font-medium
                                           text-slate-700">
                                        {{ $product->user?->sellerProfile?->store_name ?? ($product->user?->name ?? 'Penjual') }}
                                    </p>

                                    <p class="text-[11px] text-slate-400">
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
                            Belum ada produk
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Produk dari seller akan muncul di sini.
                        </p>

                    </div>
                @endforelse

            </div>

        </section>

    </div>

@endsection
