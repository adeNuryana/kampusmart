@extends('layouts.buyer')

@section('title', 'Keranjang - KampusMart')

@section('content')

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="mb-7">

            <p class="text-sm font-semibold text-violet-600">
                Belanja
            </p>

            <h1
                class="mt-1 text-2xl font-bold
                   tracking-tight text-slate-900
                   md:text-3xl">
                Keranjang Belanja
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Periksa kembali produk sebelum melanjutkan transaksi.
            </p>

        </div>


        {{-- SUCCESS --}}
        @if (session('success'))
            <div
                class="mb-6 rounded-xl border
                   border-green-200 bg-green-50
                   px-4 py-3 text-sm
                   text-green-700">
                {{ session('success') }}
            </div>
        @endif


        @if ($cartItems->isNotEmpty())

            <div class="grid gap-6 lg:grid-cols-3">

                {{-- CART ITEMS --}}
                <div class="space-y-4 lg:col-span-2">

                    @foreach ($cartItems as $item)
                        @php
                            $product = $item->product;
                        @endphp


                        @if ($product)
                            <div
                                class="rounded-2xl border
                                   border-slate-200
                                   bg-white p-5 shadow-sm">

                                <div class="flex flex-col gap-5
                                       sm:flex-row">

                                    {{-- IMAGE --}}
                                    <a href="{{ route('buyer.products.show', $product) }}"
                                        class="shrink-0">

                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="size-28
                                                   rounded-xl
                                                   object-cover">
                                        @else
                                            <div
                                                class="flex size-28
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-slate-100">

                                                <svg class="size-9
                                                       text-slate-300"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5">
                                                    <rect x="3" y="3" width="18" height="18" rx="2" />

                                                    <circle cx="8.5" cy="8.5" r="1.5" />

                                                    <path d="m21 15-5-5L5 21" />
                                                </svg>

                                            </div>
                                        @endif

                                    </a>


                                    {{-- CONTENT --}}
                                    <div class="min-w-0 flex-1">

                                        <p
                                            class="text-xs font-semibold
                                               text-violet-600">
                                            {{ $product->category?->name ?? 'Produk' }}
                                        </p>


                                        <a href="{{ route('buyer.products.show', $product) }}"
                                            class="mt-1 block">

                                            <h2
                                                class="font-semibold
                                                   text-slate-900
                                                   transition
                                                   hover:text-violet-600">
                                                {{ $product->name }}
                                            </h2>

                                        </a>


                                        <p
                                            class="mt-2 text-lg
                                               font-bold text-slate-900">
                                            Rp
                                            {{ number_format($product->price, 0, ',', '.') }}
                                        </p>


                                        <p
                                            class="mt-1 text-xs
                                               text-slate-400">
                                            Stok tersedia:
                                            {{ $product->stock }}
                                        </p>


                                        {{-- ACTION --}}
                                        <div
                                            class="mt-4 flex flex-wrap
                                               items-center gap-3">

                                            {{-- UPDATE QUANTITY --}}
                                            <form
                                                action="{{ route('buyer.cart.update', $item) }}"
                                                method="POST" class="flex items-center gap-2">

                                                @csrf
                                                @method('PATCH')


                                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                    min="1" max="{{ $product->stock }}"
                                                    class="h-10 w-20
                                                       rounded-xl border
                                                       border-slate-200
                                                       text-center
                                                       text-sm font-semibold
                                                       outline-none
                                                       focus:border-violet-400
                                                       focus:ring-4
                                                       focus:ring-violet-100">


                                                <button type="submit"
                                                    class="h-10 rounded-xl
                                                       bg-slate-100
                                                       px-4 text-sm
                                                       font-semibold
                                                       text-slate-700
                                                       transition
                                                       hover:bg-slate-200">
                                                    Update
                                                </button>

                                            </form>


                                            {{-- DELETE --}}
                                            <form
                                                action="{{ route('buyer.cart.destroy', $item) }}"
                                                method="POST">

                                                @csrf
                                                @method('DELETE')


                                                <button type="submit"
                                                    onclick="return confirm(
                                                    'Hapus produk ini dari keranjang?'
                                                )"
                                                    class="h-10 rounded-xl
                                                       px-4 text-sm
                                                       font-semibold
                                                       text-red-500
                                                       transition
                                                       hover:bg-red-50">
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>

                                    </div>


                                    {{-- TOTAL ITEM --}}
                                    <div class="sm:text-right">

                                        <p class="text-xs text-slate-400">
                                            Total
                                        </p>

                                        <p
                                            class="mt-1 whitespace-nowrap
                                               font-bold text-slate-900">
                                            Rp
                                            {{ number_format($product->price * $item->quantity, 0, ',', '.') }}
                                        </p>

                                    </div>

                                </div>

                            </div>
                        @endif
                    @endforeach

                </div>


                {{-- SUMMARY --}}
                <div>

                    <div
                        class="sticky top-24 rounded-2xl
                           border border-slate-200
                           bg-white p-6 shadow-sm">

                        <h2 class="font-semibold text-slate-900">
                            Ringkasan Belanja
                        </h2>


                        <div class="mt-5 flex items-center
                               justify-between">

                            <span class="text-sm text-slate-500">
                                Total Barang
                            </span>

                            <span class="text-sm font-semibold
                                   text-slate-700">
                                {{ $cartItems->sum('quantity') }}
                            </span>

                        </div>


                        <div class="mt-5 border-t
                               border-slate-200 pt-5">

                            <div class="flex items-end
                                   justify-between gap-4">

                                <span class="text-sm font-medium
                                       text-slate-600">
                                    Subtotal
                                </span>

                                <span class="text-xl font-bold
                                       text-slate-900">
                                    Rp
                                    {{ number_format($subtotal, 0, ',', '.') }}
                                </span>

                            </div>

                        </div>


                        {{-- CHECKOUT --}}
                        <a href="{{ route('buyer.checkout.index') }}"
                            class="mt-6 inline-flex
           h-12 w-full
           items-center justify-center
           rounded-xl
           bg-violet-600 px-5
           text-sm font-semibold
           text-white transition
           hover:bg-violet-700">
                            Lanjut Checkout
                        </a>


                        <a href="{{ route('buyer.products.index') }}"
                            class="mt-3 inline-flex
                               h-11 w-full
                               items-center
                               justify-center
                               rounded-xl
                               text-sm font-semibold
                               text-slate-500
                               transition
                               hover:bg-slate-50">
                            Lanjut Belanja
                        </a>

                    </div>

                </div>

            </div>
        @else
            {{-- EMPTY --}}
            <div
                class="rounded-3xl border
                   border-dashed border-slate-300
                   bg-white px-6 py-20 text-center">

                <div
                    class="mx-auto flex size-20
                       items-center justify-center
                       rounded-2xl bg-violet-50">

                    <svg class="size-10 text-violet-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path d="M3 4h2l2 11h10l2-7H6" />
                        <circle cx="9" cy="19" r="1" />
                        <circle cx="17" cy="19" r="1" />
                    </svg>

                </div>


                <h2 class="mt-5 text-xl font-bold
                       text-slate-900">
                    Keranjang masih kosong
                </h2>


                <p
                    class="mx-auto mt-2
                       max-w-md text-sm
                       leading-6 text-slate-500">
                    Temukan produk yang kamu butuhkan dan tambahkan ke keranjang.
                </p>


                <a href="{{ route('buyer.products.index') }}"
                    class="mt-6 inline-flex h-11
                       items-center justify-center
                       rounded-xl bg-violet-600
                       px-5 text-sm font-semibold
                       text-white transition
                       hover:bg-violet-700">
                    Mulai Belanja
                </a>

            </div>

        @endif

    </div>

@endsection
