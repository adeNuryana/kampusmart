@extends('layouts.buyer')

@section('title', 'Keranjang - KampusMart')

@section('content')

<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <div class="mb-7">

        <p class="text-sm font-semibold text-violet-600">
            Belanja
        </p>

        <h1
            class="mt-1 text-2xl font-bold
                   tracking-tight text-slate-900
                   md:text-3xl"
        >
            Keranjang Saya
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Produk dikelompokkan berdasarkan penjual.
            Kamu dapat membuat pesanan satu penjual terlebih dahulu.
        </p>

    </div>


    {{-- ALERT SUCCESS --}}
    @if (session('success'))

        <div
            class="mb-5 rounded-xl
                   border border-green-200
                   bg-green-50 px-4 py-3
                   text-sm font-medium
                   text-green-700"
        >
            {{ session('success') }}
        </div>

    @endif


    {{-- ALERT ERROR --}}
    @if (session('error'))

        <div
            class="mb-5 rounded-xl
                   border border-red-200
                   bg-red-50 px-4 py-3
                   text-sm font-medium
                   text-red-700"
        >
            {{ session('error') }}
        </div>

    @endif


    {{-- VALIDATION --}}
    @if ($errors->any())

        <div
            class="mb-5 rounded-xl
                   border border-red-200
                   bg-red-50 px-4 py-3
                   text-sm text-red-700"
        >

            <ul class="list-disc space-y-1 pl-5">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    @if ($sellerGroups->isEmpty())

        {{-- EMPTY CART --}}
        <div
            class="rounded-2xl border
                   border-slate-200
                   bg-white px-6 py-16
                   text-center shadow-sm"
        >

            <div
                class="mx-auto flex size-16
                       items-center justify-center
                       rounded-2xl bg-violet-50
                       text-violet-600"
            >

                <svg
                    class="size-8"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
                >
                    <path d="M3 4h2l2 11h10l2-7H6" />
                    <circle cx="9" cy="19" r="1" />
                    <circle cx="17" cy="19" r="1" />
                </svg>

            </div>


            <h2
                class="mt-5 text-lg
                       font-bold text-slate-900"
            >
                Keranjang masih kosong
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Tambahkan produk terlebih dahulu untuk mulai berbelanja.
            </p>


            <a
                href="{{ route('buyer.products.index') }}"
                class="mt-6 inline-flex h-11
                       items-center justify-center
                       rounded-xl bg-violet-600
                       px-5 text-sm font-semibold
                       text-white transition
                       hover:bg-violet-700"
            >
                Cari Produk
            </a>

        </div>


    @else

        <div class="grid gap-7 lg:grid-cols-[1fr_300px]">

            {{-- ==============================
                SELLER GROUP
            =============================== --}}
            <div class="space-y-6">

                @foreach ($sellerGroups as $sellerId => $items)

                    @php
                        $firstItem = $items->first();

                        $seller =
                            $firstItem?->product?->user;

                        $storeName =
                            $seller?->sellerProfile?->store_name
                            ?? $seller?->name
                            ?? 'Penjual';

                        $storePhoto =
                            $seller?->sellerProfile?->photo;

                        $sellerSubtotal =
                            $sellerSubtotals[$sellerId] ?? 0;
                    @endphp


                    <div
                        class="overflow-hidden
                               rounded-2xl
                               border border-slate-200
                               bg-white shadow-sm"
                    >

                        {{-- ==============================
                            SELLER HEADER
                        =============================== --}}
                        <div
                            class="flex items-center
                                   justify-between gap-4
                                   border-b border-slate-100
                                   bg-slate-50/60
                                   px-5 py-4"
                        >

                            <div class="flex items-center gap-3">

                                @if ($storePhoto)

                                    <img
                                        src="{{ asset(
                                            'storage/' . $storePhoto
                                        ) }}"
                                        alt="{{ $storeName }}"
                                        class="size-11
                                               rounded-full
                                               object-cover"
                                    >

                                @else

                                    <div
                                        class="flex size-11
                                               items-center
                                               justify-center
                                               rounded-full
                                               bg-violet-100
                                               font-bold
                                               text-violet-700"
                                    >
                                        {{ strtoupper(
                                            substr(
                                                $storeName,
                                                0,
                                                1
                                            )
                                        ) }}
                                    </div>

                                @endif


                                <div>

                                    <p
                                        class="text-sm
                                               font-semibold
                                               text-slate-900"
                                    >
                                        {{ $storeName }}
                                    </p>

                                    <p
                                        class="mt-1 text-xs
                                               text-slate-400"
                                    >
                                        {{ $seller?->name ?? '-' }}
                                    </p>

                                </div>

                            </div>


                            <span
                                class="rounded-full
                                       bg-violet-50
                                       px-3 py-1.5
                                       text-xs font-semibold
                                       text-violet-700"
                            >
                                {{ $items->count() }} produk
                            </span>

                        </div>


                        {{-- ==============================
                            PRODUCTS
                        =============================== --}}
                        <div class="divide-y divide-slate-100">

                            @foreach ($items as $item)

                                @php
                                    $product =
                                        $item->product;

                                    $itemSubtotal =
                                        $product->price *
                                        $item->quantity;
                                @endphp


                                <div
                                    class="flex flex-col
                                           gap-4 px-5 py-5
                                           sm:flex-row
                                           sm:items-center"
                                >

                                    {{-- IMAGE --}}
                                    <a
                                        href="{{ route(
                                            'buyer.products.show',
                                            $product
                                        ) }}"
                                        class="shrink-0"
                                    >

                                        @if ($product->image)

                                            <img
                                                src="{{ asset(
                                                    'storage/' .
                                                    $product->image
                                                ) }}"
                                                alt="{{ $product->name }}"
                                                class="size-20
                                                       rounded-xl
                                                       object-cover"
                                            >

                                        @else

                                            <div
                                                class="flex size-20
                                                       items-center
                                                       justify-center
                                                       rounded-xl
                                                       bg-slate-100"
                                            >

                                                <svg
                                                    class="size-8
                                                           text-slate-300"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                >
                                                    <rect
                                                        x="3"
                                                        y="3"
                                                        width="18"
                                                        height="18"
                                                        rx="2"
                                                    />

                                                    <path
                                                        d="m21 15-5-5L5 21"
                                                    />
                                                </svg>

                                            </div>

                                        @endif

                                    </a>


                                    {{-- PRODUCT INFO --}}
                                    <div class="min-w-0 flex-1">

                                        <a
                                            href="{{ route(
                                                'buyer.products.show',
                                                $product
                                            ) }}"
                                            class="font-semibold
                                                   text-slate-900
                                                   transition
                                                   hover:text-violet-600"
                                        >
                                            {{ $product->name }}
                                        </a>


                                        <p
                                            class="mt-1 text-xs
                                                   text-slate-400"
                                        >
                                            {{
                                                $product
                                                    ->category
                                                    ?->name
                                                ?? 'Tanpa kategori'
                                            }}
                                        </p>


                                        <p
                                            class="mt-2 text-sm
                                                   font-semibold
                                                   text-violet-600"
                                        >
                                            Rp {{ number_format(
                                                $product->price,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </p>


                                        <p
                                            class="mt-1 text-xs
                                                   text-slate-400"
                                        >
                                            Stok:
                                            {{ $product->stock }}
                                        </p>

                                    </div>


                                    {{-- QUANTITY --}}
                                    <div>

                                        <form
                                            action="{{ route(
                                                'buyer.cart.update',
                                                $item
                                            ) }}"
                                            method="POST"
                                            class="flex items-center gap-2"
                                        >

                                            @csrf
                                            @method('PATCH')


                                            <input
                                                type="number"
                                                name="quantity"
                                                value="{{ $item->quantity }}"
                                                min="1"
                                                max="{{ $product->stock }}"
                                                class="h-10 w-20
                                                       rounded-xl
                                                       border border-slate-200
                                                       px-3 text-center
                                                       text-sm
                                                       outline-none
                                                       focus:border-violet-400
                                                       focus:ring-4
                                                       focus:ring-violet-100"
                                            >


                                            <button
                                                type="submit"
                                                title="Update jumlah"
                                                class="inline-flex size-10
                                                       items-center
                                                       justify-center
                                                       rounded-xl
                                                       border border-slate-200
                                                       text-slate-500
                                                       transition
                                                       hover:bg-slate-50
                                                       hover:text-violet-600"
                                            >

                                                <svg
                                                    class="size-4"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >
                                                    <path
                                                        d="M20 7h-9"
                                                    />

                                                    <path
                                                        d="M20 7l-3-3"
                                                    />

                                                    <path
                                                        d="M20 7l-3 3"
                                                    />

                                                    <path
                                                        d="M4 17h9"
                                                    />

                                                    <path
                                                        d="m4 17 3-3"
                                                    />

                                                    <path
                                                        d="m4 17 3 3"
                                                    />
                                                </svg>

                                            </button>

                                        </form>

                                    </div>


                                    {{-- ITEM TOTAL --}}
                                    <div class="sm:w-32 sm:text-right">

                                        <p
                                            class="text-xs
                                                   text-slate-400"
                                        >
                                            Subtotal
                                        </p>

                                        <p
                                            class="mt-1
                                                   font-bold
                                                   text-slate-900"
                                        >
                                            Rp {{ number_format(
                                                $itemSubtotal,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </p>

                                    </div>


                                    {{-- DELETE --}}
                                    <form
                                        action="{{ route(
                                            'buyer.cart.destroy',
                                            $item
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Hapus produk ini dari keranjang?'
                                        )"
                                    >

                                        @csrf
                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            title="Hapus Produk"
                                            class="inline-flex size-10
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   text-slate-400
                                                   transition
                                                   hover:bg-red-50
                                                   hover:text-red-600"
                                        >

                                            <svg
                                                class="size-5"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path d="M3 6h18" />
                                                <path d="M8 6V4h8v2" />
                                                <path d="M19 6l-1 15H6L5 6" />
                                                <path d="M10 11v5" />
                                                <path d="M14 11v5" />
                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            @endforeach

                        </div>


                        {{-- ==============================
                            SELLER FOOTER
                        =============================== --}}
                        <div
                            class="flex flex-col gap-4
                                   border-t border-slate-100
                                   bg-slate-50/50
                                   px-5 py-5
                                   sm:flex-row
                                   sm:items-center
                                   sm:justify-between"
                        >

                            <div>

                                <p
                                    class="text-xs
                                           text-slate-400"
                                >
                                    Total dari {{ $storeName }}
                                </p>

                                <p
                                    class="mt-1 text-xl
                                           font-bold
                                           text-slate-900"
                                >
                                    Rp {{ number_format(
                                        $sellerSubtotal,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </p>

                            </div>


                            <a
                                href="{{ route(
                                    'buyer.checkout.index',
                                    $sellerId
                                ) }}"
                                class="inline-flex h-11
                                       items-center
                                       justify-center
                                       gap-2 rounded-xl
                                       bg-violet-600
                                       px-5 text-sm
                                       font-semibold
                                       text-white transition
                                       hover:bg-violet-700"
                            >

                                Buat Pesanan

                                <svg
                                    class="size-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path d="m9 18 6-6-6-6" />
                                </svg>

                            </a>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- ==============================
                SUMMARY
            =============================== --}}
            <div>

                <div
                    class="sticky top-24
                           rounded-2xl
                           border border-slate-200
                           bg-white p-5
                           shadow-sm"
                >

                    <h2
                        class="font-semibold
                               text-slate-900"
                    >
                        Ringkasan Keranjang
                    </h2>


                    <div
                        class="mt-5 space-y-3
                               text-sm"
                    >

                        <div
                            class="flex items-center
                                   justify-between"
                        >

                            <span class="text-slate-500">
                                Jumlah Toko
                            </span>

                            <span
                                class="font-medium
                                       text-slate-800"
                            >
                                {{ $sellerGroups->count() }}
                            </span>

                        </div>


                        <div
                            class="flex items-center
                                   justify-between"
                        >

                            <span class="text-slate-500">
                                Total Produk
                            </span>

                            <span
                                class="font-medium
                                       text-slate-800"
                            >
                                {{ $cartItems->sum('quantity') }}
                            </span>

                        </div>


                        <div
                            class="border-t
                                   border-slate-100
                                   pt-4"
                        >

                            <div
                                class="flex items-center
                                       justify-between"
                            >

                                <span
                                    class="font-medium
                                           text-slate-700"
                                >
                                    Total Keranjang
                                </span>

                                <span
                                    class="text-lg
                                           font-bold
                                           text-violet-600"
                                >
                                    Rp {{ number_format(
                                        $subtotal,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </span>

                            </div>

                        </div>

                    </div>


                    <div
                        class="mt-5 rounded-xl
                               bg-violet-50 p-4"
                    >

                        <p
                            class="text-xs
                                   leading-5
                                   text-violet-700"
                        >
                            Checkout dilakukan satu toko
                            dalam satu pesanan. Produk dari
                            toko lain tetap berada di keranjang.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    @endif

</div>

@endsection
