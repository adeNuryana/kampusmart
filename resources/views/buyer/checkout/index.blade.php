@extends('layouts.buyer')

@section('title', 'Checkout - KampusMart')

@section('content')

<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <div class="mb-7">

        <a
            href="{{ route('buyer.cart.index') }}"
            class="inline-flex items-center gap-2
                   text-sm font-medium
                   text-slate-500
                   transition
                   hover:text-violet-600"
        >
            ← Kembali ke Keranjang
        </a>


        <h1
            class="mt-5 text-2xl font-bold
                   tracking-tight text-slate-900
                   md:text-3xl"
        >
            Checkout
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Periksa informasi pembeli dan pesanan sebelum melanjutkan.
        </p>

    </div>


    @if ($errors->has('cart'))

        <div
            class="mb-6 rounded-xl
                   border border-red-200
                   bg-red-50 px-4 py-3
                   text-sm text-red-700"
        >
            {{ $errors->first('cart') }}
        </div>

    @endif


    @if ($cartItems->isEmpty())

        <div
            class="rounded-2xl border
                   border-dashed border-slate-300
                   bg-white px-6 py-16
                   text-center"
        >

            <h2 class="font-semibold text-slate-900">
                Tidak ada produk untuk checkout
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Tambahkan produk ke keranjang terlebih dahulu.
            </p>


            <a
                href="{{ route('buyer.products.index') }}"
                class="mt-5 inline-flex h-11
                       items-center justify-center
                       rounded-xl bg-violet-600
                       px-5 text-sm font-semibold
                       text-white hover:bg-violet-700"
            >
                Cari Produk
            </a>

        </div>

    @else

        <form
            action="{{ route('buyer.checkout.store') }}"
            method="POST"
        >

            @csrf


            <div class="grid gap-6 lg:grid-cols-3">

                {{-- LEFT --}}
                <div class="space-y-6 lg:col-span-2">

                    {{-- DATA PEMBELI --}}
                    <div
                        class="rounded-2xl border
                               border-slate-200
                               bg-white shadow-sm"
                    >

                        <div
                            class="border-b border-slate-100 p-6"
                        >

                            <h2 class="font-semibold text-slate-900">
                                Informasi Pembeli
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Informasi ini digunakan seller untuk memproses pesanan.
                            </p>

                        </div>


                        <div class="grid gap-5 p-6 md:grid-cols-2">

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
                                    id="buyer_name"
                                    name="buyer_name"
                                    value="{{ old(
                                        'buyer_name',
                                        auth()->user()->name
                                    ) }}"
                                    class="h-11 w-full
                                           rounded-xl border
                                           border-slate-200
                                           px-4 text-sm
                                           outline-none
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >

                                @error('buyer_name')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- PHONE --}}
                            <div>

                                <label
                                    for="buyer_phone"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    Nomor Telepon
                                </label>

                                <input
                                    type="text"
                                    id="buyer_phone"
                                    name="buyer_phone"
                                    value="{{ old(
                                        'buyer_phone',
                                        auth()->user()->phone
                                    ) }}"
                                    placeholder="081234567890"
                                    class="h-11 w-full
                                           rounded-xl border
                                           border-slate-200
                                           px-4 text-sm
                                           outline-none
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >

                                @error('buyer_phone')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- NOTES --}}
                            <div class="md:col-span-2">

                                <label
                                    for="notes"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    Catatan
                                </label>

                                <textarea
                                    name="notes"
                                    id="notes"
                                    rows="4"
                                    placeholder="Contoh: Hubungi saya melalui WhatsApp..."
                                    class="w-full rounded-xl
                                           border border-slate-200
                                           px-4 py-3 text-sm
                                           outline-none
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >{{ old('notes') }}</textarea>

                                @error('notes')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- PRODUCTS --}}
                    <div
                        class="rounded-2xl border
                               border-slate-200
                               bg-white shadow-sm"
                    >

                        <div
                            class="border-b border-slate-100 p-6"
                        >

                            <h2 class="font-semibold text-slate-900">
                                Produk yang Dibeli
                            </h2>

                        </div>


                        <div class="divide-y divide-slate-100">

                            @foreach ($cartItems as $item)

                                @if ($item->product)

                                    <div class="flex gap-4 p-6">

                                        @if ($item->product->image)

                                            <img
                                                src="{{ asset(
                                                    'storage/' .
                                                    $item->product->image
                                                ) }}"
                                                alt="{{ $item->product->name }}"
                                                class="size-20
                                                       shrink-0 rounded-xl
                                                       object-cover"
                                            >

                                        @else

                                            <div
                                                class="flex size-20
                                                       shrink-0
                                                       items-center
                                                       justify-center
                                                       rounded-xl
                                                       bg-slate-100
                                                       text-slate-400"
                                            >
                                                —
                                            </div>

                                        @endif


                                        <div class="min-w-0 flex-1">

                                            <p
                                                class="font-semibold
                                                       text-slate-900"
                                            >
                                                {{ $item->product->name }}
                                            </p>


                                            <p
                                                class="mt-1 text-xs
                                                       text-slate-500"
                                            >
                                                {{
                                                    $item->product
                                                        ->user
                                                        ?->sellerProfile
                                                        ?->store_name
                                                    ?? $item->product
                                                        ->user
                                                        ?->name
                                                }}
                                            </p>


                                            <p class="mt-2 text-sm text-slate-500">

                                                {{ $item->quantity }}
                                                ×

                                                Rp {{ number_format(
                                                    $item->product->price,
                                                    0,
                                                    ',',
                                                    '.'
                                                ) }}

                                            </p>

                                        </div>


                                        <p
                                            class="whitespace-nowrap
                                                   font-semibold
                                                   text-slate-900"
                                        >
                                            Rp {{ number_format(
                                                $item->product->price
                                                * $item->quantity,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </p>

                                    </div>

                                @endif

                            @endforeach

                        </div>

                    </div>

                </div>


                {{-- SUMMARY --}}
                <div>

                    <div
                        class="sticky top-24
                               rounded-2xl border
                               border-slate-200
                               bg-white p-6
                               shadow-sm"
                    >

                        <h2 class="font-semibold text-slate-900">
                            Ringkasan Pesanan
                        </h2>


                        <div
                            class="mt-5 flex
                                   items-center
                                   justify-between"
                        >

                            <span class="text-sm text-slate-500">
                                Total Barang
                            </span>

                            <span
                                class="text-sm
                                       font-semibold
                                       text-slate-700"
                            >
                                {{ $cartItems->sum('quantity') }}
                            </span>

                        </div>


                        <div
                            class="mt-5 border-t
                                   border-slate-200
                                   pt-5"
                        >

                            <div
                                class="flex items-end
                                       justify-between
                                       gap-4"
                            >

                                <span
                                    class="text-sm
                                           font-medium
                                           text-slate-600"
                                >
                                    Total
                                </span>


                                <span
                                    class="text-xl
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


                        <button
                            type="submit"
                            onclick="return confirm(
                                'Buat pesanan sekarang?'
                            )"
                            class="mt-6 inline-flex
                                   h-12 w-full
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-violet-600
                                   px-5 text-sm
                                   font-semibold
                                   text-white
                                   transition
                                   hover:bg-violet-700"
                        >
                            Buat Pesanan
                        </button>


                        <p
                            class="mt-3 text-center
                                   text-xs leading-5
                                   text-slate-400"
                        >
                            Stok akan diperiksa kembali saat pesanan dibuat.
                        </p>

                    </div>

                </div>

            </div>

        </form>

    @endif

</div>

@endsection
