@extends('layouts.buyer')

@section('title', 'Checkout - KampusMart')

@section('content')

<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <div class="mb-7">

        <a
            href="{{ route('buyer.cart.index') }}"
            class="inline-flex items-center gap-2
                   text-sm font-medium text-slate-500
                   transition hover:text-violet-600"
        >
            ← Kembali ke Keranjang
        </a>

        <p class="mt-5 text-sm font-semibold text-violet-600">
            Checkout
        </p>

        <h1
            class="mt-1 text-2xl font-bold
                   tracking-tight text-slate-900
                   md:text-3xl"
        >
            Buat Pesanan
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Pastikan data pembeli dan pesanan sudah benar.
        </p>

    </div>


    {{-- ERROR --}}
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


    <form
        action="{{ route('buyer.checkout.store') }}"
        method="POST"
    >

        @csrf


        {{-- SELLER ID --}}
        <input
            type="hidden"
            name="seller_id"
            value="{{ $seller->id }}"
        >


        <div
            class="grid gap-6
                   lg:grid-cols-[1fr_360px]"
        >

            {{-- ==========================
                LEFT
            =========================== --}}
            <div class="space-y-6">

                {{-- SELLER --}}
                <div
                    class="rounded-2xl
                           border border-slate-200
                           bg-white p-5 shadow-sm"
                >

                    <p
                        class="mb-4 text-xs
                               font-semibold uppercase
                               tracking-wide
                               text-slate-400"
                    >
                        Penjual
                    </p>


                    <div class="flex items-center gap-4">

                        @if ($seller->sellerProfile?->photo)

                            <img
                                src="{{ asset(
                                    'storage/' .
                                    $seller->sellerProfile->photo
                                ) }}"
                                alt="{{
                                    $seller->sellerProfile?->store_name
                                    ?? $seller->name
                                }}"
                                class="size-14 rounded-full
                                       object-cover"
                            >

                        @else

                            <div
                                class="flex size-14
                                       items-center justify-center
                                       rounded-full
                                       bg-violet-100
                                       text-lg font-bold
                                       text-violet-700"
                            >
                                {{ strtoupper(
                                    substr(
                                        $seller->sellerProfile?->store_name
                                        ?? $seller->name,
                                        0,
                                        1
                                    )
                                ) }}
                            </div>

                        @endif


                        <div>

                            <h2
                                class="font-semibold
                                       text-slate-900"
                            >
                                {{
                                    $seller->sellerProfile?->store_name
                                    ?? $seller->name
                                }}
                            </h2>

                            <p
                                class="mt-1 text-sm
                                       text-slate-500"
                            >
                                {{ $seller->name }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- PRODUCTS --}}
                <div
                    class="overflow-hidden
                           rounded-2xl
                           border border-slate-200
                           bg-white shadow-sm"
                >

                    <div
                        class="border-b border-slate-100
                               px-5 py-4"
                    >
                        <h2
                            class="font-semibold
                                   text-slate-900"
                        >
                            Produk Pesanan
                        </h2>

                        <p
                            class="mt-1 text-sm
                                   text-slate-500"
                        >
                            {{ $cartItems->count() }}
                            jenis produk dari toko ini.
                        </p>
                    </div>


                    <div class="divide-y divide-slate-100">

                        @foreach ($cartItems as $item)

                            @php
                                $product = $item->product;

                                $itemSubtotal =
                                    $product->price *
                                    $item->quantity;
                            @endphp


                            <div
                                class="flex gap-4
                                       px-5 py-5"
                            >

                                {{-- IMAGE --}}
                                @if ($product->image)

                                    <img
                                        src="{{ asset(
                                            'storage/' .
                                            $product->image
                                        ) }}"
                                        alt="{{ $product->name }}"
                                        class="size-20
                                               shrink-0
                                               rounded-xl
                                               object-cover"
                                    >

                                @else

                                    <div
                                        class="flex size-20
                                               shrink-0
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


                                {{-- INFO --}}
                                <div class="min-w-0 flex-1">

                                    <p
                                        class="font-semibold
                                               text-slate-900"
                                    >
                                        {{ $product->name }}
                                    </p>

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
                                               text-slate-500"
                                    >
                                        {{ $item->quantity }}
                                        ×
                                        Rp {{ number_format(
                                            $product->price,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </p>

                                </div>


                                {{-- SUBTOTAL --}}
                                <div class="text-right">

                                    <p
                                        class="font-semibold
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

                            </div>

                        @endforeach

                    </div>

                </div>


                {{-- BUYER DATA --}}
                <div
                    class="rounded-2xl
                           border border-slate-200
                           bg-white shadow-sm"
                >

                    <div
                        class="border-b border-slate-100
                               px-5 py-4"
                    >

                        <h2
                            class="font-semibold
                                   text-slate-900"
                        >
                            Data Pembeli
                        </h2>

                        <p
                            class="mt-1 text-sm
                                   text-slate-500"
                        >
                            Data ini akan ikut dikirim ke penjual.
                        </p>

                    </div>


                    <div class="grid gap-5 p-5 sm:grid-cols-2">

                        {{-- NAME --}}
                        <div>

                            <label
                                for="buyer_name"
                                class="mb-2 block
                                       text-sm font-medium
                                       text-slate-700"
                            >
                                Nama Pembeli
                            </label>

                            <input
                                type="text"
                                name="buyer_name"
                                id="buyer_name"
                                value="{{ old(
                                    'buyer_name',
                                    auth()->user()->name
                                ) }}"
                                class="h-11 w-full
                                       rounded-xl
                                       border border-slate-200
                                       px-4 text-sm
                                       outline-none
                                       focus:border-violet-400
                                       focus:ring-4
                                       focus:ring-violet-100"
                            >

                        </div>


                        {{-- PHONE --}}
                        <div>

                            <label
                                for="buyer_phone"
                                class="mb-2 block
                                       text-sm font-medium
                                       text-slate-700"
                            >
                                WhatsApp Pembeli
                            </label>

                            <input
                                type="text"
                                name="buyer_phone"
                                id="buyer_phone"
                                value="{{ old(
                                    'buyer_phone',
                                    auth()->user()->phone
                                ) }}"
                                placeholder="081234567890"
                                class="h-11 w-full
                                       rounded-xl
                                       border border-slate-200
                                       px-4 text-sm
                                       outline-none
                                       focus:border-violet-400
                                       focus:ring-4
                                       focus:ring-violet-100"
                            >

                        </div>


                        {{-- NOTES --}}
                        <div class="sm:col-span-2">

                            <label
                                for="notes"
                                class="mb-2 block
                                       text-sm font-medium
                                       text-slate-700"
                            >
                                Catatan
                                <span class="font-normal text-slate-400">
                                    (opsional)
                                </span>
                            </label>

                            <textarea
                                name="notes"
                                id="notes"
                                rows="4"
                                placeholder="Contoh: Sambal dipisah, ambil pukul 12.00..."
                                class="w-full rounded-xl
                                       border border-slate-200
                                       px-4 py-3 text-sm
                                       outline-none
                                       focus:border-violet-400
                                       focus:ring-4
                                       focus:ring-violet-100"
                            >{{ old('notes') }}</textarea>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ==========================
                SUMMARY
            =========================== --}}
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
                        Ringkasan Pesanan
                    </h2>


                    <div class="mt-5 space-y-4">

                        <div
                            class="flex
                                   justify-between
                                   text-sm"
                        >

                            <span class="text-slate-500">
                                Jumlah Produk
                            </span>

                            <span
                                class="font-medium
                                       text-slate-800"
                            >
                                {{ $cartItems->sum('quantity') }}
                            </span>

                        </div>


                        <div
                            class="flex
                                   justify-between
                                   text-sm"
                        >

                            <span class="text-slate-500">
                                Subtotal
                            </span>

                            <span
                                class="font-medium
                                       text-slate-800"
                            >
                                Rp {{ number_format(
                                    $subtotal,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </span>

                        </div>


                        <div
                            class="border-t
                                   border-slate-100 pt-4"
                        >

                            <div
                                class="flex items-end
                                       justify-between gap-4"
                            >

                                <span
                                    class="font-semibold
                                           text-slate-700"
                                >
                                    Total
                                </span>

                                <span
                                    class="text-2xl
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


                    {{-- INFO WA --}}
                    <div
                        class="mt-5 rounded-xl
                               border border-green-100
                               bg-green-50 p-4"
                    >

                        <div class="flex gap-3">

                            <div
                                class="flex size-9
                                       shrink-0
                                       items-center
                                       justify-center
                                       rounded-lg
                                       bg-green-100
                                       text-green-700"
                            >
                                <svg
                                    class="size-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        d="M21 11.5a8.4 8.4 0 0 1-9 8.4
                                           9.4 9.4 0 0 1-4-.9L3 20.5
                                           l1.5-4a8.5 8.5 0 1 1
                                           16.5-5Z"
                                    />
                                </svg>
                            </div>


                            <p
                                class="text-xs leading-5
                                       text-green-700"
                            >
                                Setelah pesanan dibuat,
                                WhatsApp penjual akan langsung
                                terbuka dengan format pesanan
                                yang sudah disiapkan.
                            </p>

                        </div>

                    </div>


                    {{-- SUBMIT --}}
                    <button
                        type="submit"
                        class="mt-5 inline-flex
                               h-12 w-full
                               items-center
                               justify-center
                               gap-2 rounded-xl
                               bg-violet-600
                               text-sm font-semibold
                               text-white
                               transition
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

                    </button>


                    <p
                        class="mt-3 text-center
                               text-xs leading-5
                               text-slate-400"
                    >
                        Pesanan akan tersimpan sebelum
                        WhatsApp dibuka.
                    </p>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection
