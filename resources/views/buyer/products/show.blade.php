@extends('layouts.buyer')

@section('title', $product->name . ' - KampusMart')

@section('content')

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- BREADCRUMB --}}
        <nav class="mb-6 flex flex-wrap items-center gap-2 text-sm">

            <a href="{{ route('buyer.dashboard') }}" class="text-slate-500 transition hover:text-violet-600">
                Beranda
            </a>

            <span class="text-slate-300">
                /
            </span>

            <a href="{{ route('buyer.products.index') }}" class="text-slate-500 transition hover:text-violet-600">
                Produk
            </a>

            <span class="text-slate-300">
                /
            </span>

            <span class="max-w-[250px] truncate font-medium text-slate-700">
                {{ $product->name }}
            </span>

        </nav>


        {{-- PRODUCT DETAIL --}}
        <div class="grid gap-8 lg:grid-cols-2">

            {{-- LEFT : IMAGE --}}
            <div>

                <div
                    class="overflow-hidden rounded-3xl
                       border border-slate-200
                       bg-white shadow-sm">

                    <div class="aspect-square bg-slate-100">

                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="h-full w-full object-cover">
                        @else
                            <div class="flex h-full w-full
                                   items-center justify-center">

                                <svg class="size-24 text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />

                                    <circle cx="8.5" cy="8.5" r="1.5" />

                                    <path d="m21 15-5-5L5 21" />
                                </svg>

                            </div>
                        @endif

                    </div>

                </div>

            </div>


            {{-- RIGHT : INFORMATION --}}
            <div>

                {{-- CATEGORY --}}
                <a href="{{ route('buyer.products.index', [
                    'category' => $product->category_id,
                ]) }}"
                    class="inline-flex rounded-lg
                       bg-violet-50 px-3 py-1.5
                       text-xs font-semibold
                       text-violet-700 transition
                       hover:bg-violet-100">
                    {{ $product->category?->name ?? 'Tanpa Kategori' }}
                </a>


                {{-- NAME --}}
                <h1
                    class="mt-4 text-3xl font-bold
                       leading-tight tracking-tight
                       text-slate-900 md:text-4xl">
                    {{ $product->name }}
                </h1>


                {{-- PRICE --}}
                <p class="mt-5 text-3xl font-bold
                       tracking-tight text-violet-600">
                    Rp
                    {{ number_format($product->price, 0, ',', '.') }}
                </p>


                {{-- STOCK --}}
                <div class="mt-5 flex flex-wrap items-center gap-3">

                    @if ($product->stock <= 5)
                        <span
                            class="inline-flex items-center gap-2
                               rounded-xl bg-amber-50
                               px-3 py-2 text-sm
                               font-semibold text-amber-700">

                            <span class="size-2 rounded-full bg-amber-500"></span>

                            Sisa {{ $product->stock }} produk

                        </span>
                    @else
                        <span
                            class="inline-flex items-center gap-2
                               rounded-xl bg-green-50
                               px-3 py-2 text-sm
                               font-semibold text-green-700">

                            <span class="size-2 rounded-full bg-green-500"></span>

                            Stok tersedia

                        </span>
                    @endif


                    <span class="text-sm text-slate-500">

                        Stok:
                        <strong class="font-semibold text-slate-700">
                            {{ $product->stock }}
                        </strong>

                    </span>

                </div>


                {{-- DESCRIPTION --}}
                <div class="mt-7 border-t border-slate-200 pt-7">

                    <h2 class="font-semibold text-slate-900">
                        Deskripsi Produk
                    </h2>

                    <p class="mt-3 whitespace-pre-line
                           text-sm leading-7 text-slate-600">
                        {{ $product->description ?: 'Belum ada deskripsi produk.' }}
                    </p>

                </div>


                {{-- QUANTITY --}}
                <form action="{{ route('buyer.cart.store', $product) }}" method="POST">

                    @csrf


                    {{-- QUANTITY --}}
                    <div class="mt-7 border-t border-slate-200 pt-7">

                        <label for="quantity" class="mb-3 block text-sm
                   font-semibold text-slate-800">
                            Jumlah
                        </label>


                        <div class="flex items-center gap-3">

                            <button type="button" id="decreaseQuantity"
                                class="inline-flex size-11
                       items-center justify-center
                       rounded-xl border
                       border-slate-200 bg-white
                       text-lg font-semibold
                       text-slate-600
                       transition hover:bg-slate-50">
                                −
                            </button>


                            <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 1) }}"
                                min="1" max="{{ $product->stock }}"
                                class="h-11 w-20 rounded-xl
                       border border-slate-200
                       text-center text-sm
                       font-semibold outline-none
                       focus:border-violet-400
                       focus:ring-4
                       focus:ring-violet-100">


                            <button type="button" id="increaseQuantity"
                                class="inline-flex size-11
                       items-center justify-center
                       rounded-xl border
                       border-slate-200 bg-white
                       text-lg font-semibold
                       text-slate-600
                       transition hover:bg-slate-50">
                                +
                            </button>

                        </div>


                        @error('quantity')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- ACTION --}}
                    <div class="mt-7">

                        <button type="submit"
                            class="inline-flex h-12 w-full
                   items-center justify-center
                   gap-2 rounded-xl
                   bg-violet-600 px-5
                   text-sm font-semibold
                   text-white transition
                   hover:bg-violet-700">

                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M3 4h2l2 11h10l2-7H6" />
                                <circle cx="9" cy="19" r="1" />
                                <circle cx="17" cy="19" r="1" />
                            </svg>

                            Tambah ke Keranjang

                        </button>

                    </div>

                </form>

                {{-- BELI --}}
                <button type="button"
                    class="inline-flex h-12
                           items-center justify-center
                           rounded-xl bg-violet-600
                           px-5 text-sm
                           font-semibold text-white
                           transition hover:bg-violet-700">
                    Beli Sekarang
                </button>

            </div>


            {{-- INFO --}}
            <div class="mt-5 rounded-xl
                       bg-slate-50 px-4 py-3">

                <p class="text-xs leading-5 text-slate-500">
                    Pastikan jumlah dan produk sudah sesuai sebelum melanjutkan transaksi.
                </p>

            </div>

        </div>

    </div>


    {{-- SELLER --}}
    <section class="mt-10">

        <div class="rounded-2xl border
                   border-slate-200 bg-white
                   p-6 shadow-sm">

            <div class="flex flex-col gap-5
                       sm:flex-row sm:items-center">

                {{-- SELLER PHOTO --}}
                @if ($product->user?->sellerProfile?->photo)
                    <img src="{{ asset('storage/' . $product->user->sellerProfile->photo) }}"
                        alt="{{ $product->user->name }}"
                        class="size-16 shrink-0
                               rounded-full border
                               border-slate-200 object-cover">
                @else
                    <div
                        class="flex size-16 shrink-0
                               items-center justify-center
                               rounded-full bg-violet-100
                               text-xl font-bold
                               text-violet-700">

                        {{ strtoupper(substr($product->user?->name ?? 'S', 0, 1)) }}

                    </div>
                @endif


                <div class="min-w-0 flex-1">

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Dijual oleh
                    </p>


                    <h2 class="mt-1 text-lg font-bold text-slate-900">

                        {{ $product->user?->sellerProfile?->store_name ?? ($product->user?->name ?? 'Seller') }}

                    </h2>


                    <p class="mt-1 text-sm text-slate-500">
                        {{ $product->user?->name }}
                    </p>

                </div>


                {{-- WHATSAPP --}}
                @if ($product->user?->sellerProfile?->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $product->user->sellerProfile->whatsapp) }}"
                        target="_blank" rel="noopener noreferrer"
                        class="inline-flex h-11
                               items-center justify-center
                               gap-2 rounded-xl
                               border border-slate-200
                               px-4 text-sm
                               font-semibold text-slate-600
                               transition
                               hover:bg-slate-50">

                        Hubungi Penjual

                    </a>
                @endif

            </div>


            @if ($product->user?->sellerProfile?->description)
                <p
                    class="mt-5 border-t
                           border-slate-100 pt-5
                           text-sm leading-6
                           text-slate-600">
                    {{ $product->user->sellerProfile->description }}
                </p>
            @endif

        </div>

    </section>


    {{-- RELATED PRODUCT --}}
    @if ($relatedProducts->isNotEmpty())

        <section class="mt-12">

            <div class="flex items-end justify-between gap-4">

                <div>

                    <h2 class="text-xl font-bold text-slate-900 md:text-2xl">
                        Produk Terkait
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Produk lain dari kategori yang sama.
                    </p>

                </div>


                <a href="{{ route('buyer.products.index', [
                    'category' => $product->category_id,
                ]) }}"
                    class="text-sm font-semibold
                           text-violet-600
                           hover:text-violet-700">
                    Lihat Semua
                </a>

            </div>


            <div class="mt-6 grid gap-5
                       sm:grid-cols-2
                       lg:grid-cols-4">

                @foreach ($relatedProducts as $relatedProduct)
                    <a href="{{ route('buyer.products.show', $relatedProduct) }}"
                        class="group overflow-hidden
                               rounded-2xl border
                               border-slate-200
                               bg-white shadow-sm
                               transition
                               hover:-translate-y-1
                               hover:shadow-lg">

                        <div class="aspect-square overflow-hidden bg-slate-100">

                            @if ($relatedProduct->image)
                                <img src="{{ asset('storage/' . $relatedProduct->image) }}"
                                    alt="{{ $relatedProduct->name }}"
                                    class="h-full w-full
                                           object-cover
                                           transition
                                           duration-300
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

                        </div>


                        <div class="p-4">

                            <p class="text-xs font-semibold text-violet-600">
                                {{ $relatedProduct->category?->name }}
                            </p>

                            <h3
                                class="mt-1 line-clamp-2
                                       min-h-[48px]
                                       font-semibold
                                       text-slate-900">
                                {{ $relatedProduct->name }}
                            </h3>


                            <p class="mt-3 text-lg font-bold text-slate-900">

                                Rp
                                {{ number_format($relatedProduct->price, 0, ',', '.') }}

                            </p>

                        </div>

                    </a>
                @endforeach

            </div>

        </section>

    @endif

    </div>


    <script>
        const quantityInput = document.getElementById('quantity');

        const decreaseButton =
            document.getElementById('decreaseQuantity');

        const increaseButton =
            document.getElementById('increaseQuantity');

        const maxStock = {{ $product->stock }};


        decreaseButton?.addEventListener('click', function() {

            let quantity = parseInt(quantityInput.value) || 1;

            if (quantity > 1) {
                quantityInput.value = quantity - 1;
            }

        });


        increaseButton?.addEventListener('click', function() {

            let quantity = parseInt(quantityInput.value) || 1;

            if (quantity < maxStock) {
                quantityInput.value = quantity + 1;
            }

        });


        quantityInput?.addEventListener('change', function() {

            let quantity = parseInt(this.value) || 1;

            if (quantity < 1) {
                quantity = 1;
            }

            if (quantity > maxStock) {
                quantity = maxStock;
            }

            this.value = quantity;

        });
    </script>

@endsection
