@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')

<div class="mx-auto max-w-6xl">

    {{-- HEADER --}}
    <div class="mb-7">

        <a
            href="{{ route('admin.orders.index') }}"
            class="inline-flex items-center gap-2
                   text-sm font-medium
                   text-slate-500
                   hover:text-violet-600"
        >
            ← Kembali ke Pesanan
        </a>


        <div class="mt-5">

            <p class="text-sm font-semibold text-violet-600">
                {{ $order->order_number }}
            </p>

            <h1
                class="mt-1 text-2xl font-bold
                       tracking-tight text-slate-900
                       lg:text-3xl"
            >
                Detail Pesanan
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                {{ $order->created_at->format('d M Y, H:i') }}
            </p>

        </div>

    </div>


    <div class="grid gap-6 lg:grid-cols-3">

        {{-- LEFT --}}
        <div class="space-y-6 lg:col-span-2">

            {{-- BUYER + SELLER --}}
            <div class="grid gap-6 md:grid-cols-2">

                {{-- BUYER --}}
                <div
                    class="rounded-2xl border
                           border-slate-200
                           bg-white p-6 shadow-sm"
                >

                    <p
                        class="text-xs font-semibold
                               uppercase tracking-wide
                               text-slate-400"
                    >
                        Pembeli
                    </p>

                    <h2 class="mt-2 font-bold text-slate-900">
                        {{ $order->buyer_name }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $order->buyer?->email ?? '-' }}
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $order->buyer_phone ?? '-' }}
                    </p>

                </div>


                {{-- SELLER --}}
                <div
                    class="rounded-2xl border
                           border-slate-200
                           bg-white p-6 shadow-sm"
                >

                    <p
                        class="text-xs font-semibold
                               uppercase tracking-wide
                               text-slate-400"
                    >
                        Penjual
                    </p>

                    <h2 class="mt-2 font-bold text-slate-900">

                        {{
                            $order->seller
                                ?->sellerProfile
                                ?->store_name
                            ?? $order->seller?->name
                            ?? '-'
                        }}

                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $order->seller?->name ?? '-' }}
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $order->seller?->email ?? '-' }}
                    </p>

                </div>

            </div>


            {{-- PRODUCTS --}}
            <div
                class="overflow-hidden rounded-2xl
                       border border-slate-200
                       bg-white shadow-sm"
            >

                <div
                    class="border-b border-slate-100
                           p-6"
                >

                    <h2 class="font-semibold text-slate-900">
                        Produk Pesanan
                    </h2>

                </div>


                <div class="divide-y divide-slate-100">

                    @foreach ($order->items as $item)

                        <div class="flex gap-4 p-6">

                            @if ($item->product?->image)

                                <img
                                    src="{{ asset(
                                        'storage/' .
                                        $item->product->image
                                    ) }}"
                                    alt="{{ $item->product_name }}"
                                    class="size-20 shrink-0
                                           rounded-xl object-cover"
                                >

                            @else

                                <div
                                    class="flex size-20
                                           shrink-0 items-center
                                           justify-center
                                           rounded-xl bg-slate-100
                                           text-slate-400"
                                >
                                    —
                                </div>

                            @endif


                            <div class="min-w-0 flex-1">

                                <p class="font-semibold text-slate-900">
                                    {{ $item->product_name }}
                                </p>

                                <p class="mt-2 text-sm text-slate-500">

                                    {{ $item->quantity }}

                                    ×

                                    Rp {{ number_format(
                                        $item->price,
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
                                    $item->subtotal,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </p>

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- NOTES --}}
            @if ($order->notes)

                <div
                    class="rounded-2xl border
                           border-slate-200
                           bg-white p-6 shadow-sm"
                >

                    <h2 class="font-semibold text-slate-900">
                        Catatan Pembeli
                    </h2>

                    <p
                        class="mt-3 whitespace-pre-line
                               text-sm leading-6
                               text-slate-600"
                    >
                        {{ $order->notes }}
                    </p>

                </div>

            @endif

        </div>


        {{-- RIGHT --}}
        <div>

            <div
                class="sticky top-24 rounded-2xl
                       border border-slate-200
                       bg-white p-6 shadow-sm"
            >

                <h2 class="font-semibold text-slate-900">
                    Ringkasan Transaksi
                </h2>


                <div class="mt-5 space-y-4">

                    <div class="flex justify-between gap-4">

                        <span class="text-sm text-slate-500">
                            Nomor Pesanan
                        </span>

                        <span
                            class="text-right text-sm
                                   font-semibold
                                   text-slate-800"
                        >
                            {{ $order->order_number }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-sm text-slate-500">
                            Total Barang
                        </span>

                        <span
                            class="text-sm font-semibold
                                   text-slate-800"
                        >
                            {{ $order->items->sum('quantity') }}
                        </span>

                    </div>


                    <div class="flex justify-between gap-4">

                        <span class="text-sm text-slate-500">
                            Status
                        </span>

                        @php
                            $statusLabel = match ($order->status) {
                                'pending' => 'Menunggu',
                                'confirmed' => 'Dikonfirmasi',
                                'processing' => 'Diproses',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                                default => ucfirst($order->status),
                            };
                        @endphp

                        <span
                            class="text-sm font-semibold
                                   text-slate-800"
                        >
                            {{ $statusLabel }}
                        </span>

                    </div>

                </div>


                <div
                    class="mt-5 border-t
                           border-slate-200 pt-5"
                >

                    <p class="text-sm text-slate-500">
                        Total Transaksi
                    </p>

                    <p
                        class="mt-1 text-2xl font-bold
                               text-violet-600"
                    >

                        Rp {{ number_format(
                            $order->subtotal,
                            0,
                            ',',
                            '.'
                        ) }}

                    </p>

                </div>


                <div
                    class="mt-6 rounded-xl
                           bg-slate-50 px-4 py-3"
                >

                    <p
                        class="text-xs leading-5
                               text-slate-500"
                    >
                        Admin hanya memantau transaksi. Proses penerimaan, pemrosesan, dan penyelesaian pesanan dilakukan oleh seller.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
