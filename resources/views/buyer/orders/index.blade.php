@extends('layouts.buyer')

@section('title', 'Pesanan Saya - KampusMart')

@section('content')

<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <div class="mb-7">

        <p class="text-sm font-semibold text-violet-600">
            Transaksi
        </p>

        <h1
            class="mt-1 text-2xl font-bold
                   tracking-tight text-slate-900
                   md:text-3xl"
        >
            Pesanan Saya
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Pantau seluruh transaksi yang sudah dibuat.
        </p>

    </div>


    @if (session('success'))

        <div
            class="mb-6 rounded-xl border
                   border-green-200
                   bg-green-50 px-4 py-3
                   text-sm text-green-700"
        >
            {{ session('success') }}
        </div>

    @endif


    <div class="space-y-4">

        @forelse ($orders as $order)

            <div
                class="rounded-2xl border
                       border-slate-200
                       bg-white shadow-sm"
            >

                {{-- HEADER ORDER --}}
                <div
                    class="flex flex-col gap-3
                           border-b border-slate-100
                           p-5
                           sm:flex-row
                           sm:items-center
                           sm:justify-between"
                >

                    <div>

                        <p
                            class="text-xs font-medium
                                   text-slate-400"
                        >
                            Nomor Pesanan
                        </p>

                        <p
                            class="mt-1 font-semibold
                                   text-slate-900"
                        >
                            {{ $order->order_number }}
                        </p>

                    </div>


                    @php
                        $statusClass = match ($order->status) {
                            'pending' =>
                                'bg-amber-50 text-amber-700',

                            'confirmed' =>
                                'bg-blue-50 text-blue-700',

                            'processing' =>
                                'bg-violet-50 text-violet-700',

                            'completed' =>
                                'bg-green-50 text-green-700',

                            'cancelled' =>
                                'bg-red-50 text-red-700',

                            default =>
                                'bg-slate-100 text-slate-600',
                        };

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
                        class="w-fit rounded-full
                               px-3 py-1.5
                               text-xs font-semibold
                               {{ $statusClass }}"
                    >
                        {{ $statusLabel }}
                    </span>

                </div>


                {{-- CONTENT --}}
                <div class="p-5">

                    <div
                        class="flex flex-col gap-5
                               md:flex-row
                               md:items-end
                               md:justify-between"
                    >

                        <div>

                            <p
                                class="text-xs font-medium
                                       uppercase tracking-wide
                                       text-slate-400"
                            >
                                Penjual
                            </p>

                            <p
                                class="mt-1 text-sm
                                       font-semibold
                                       text-slate-800"
                            >
                                {{
                                    $order->seller
                                        ?->sellerProfile
                                        ?->store_name
                                    ?? $order->seller?->name
                                    ?? '-'
                                }}
                            </p>


                            <p
                                class="mt-4 text-xs
                                       text-slate-400"
                            >
                                {{ $order->items->sum('quantity') }}
                                barang
                            </p>


                            @foreach ($order->items->take(2) as $item)

                                <p
                                    class="mt-1 text-sm
                                           text-slate-600"
                                >
                                    {{ $item->product_name }}
                                    × {{ $item->quantity }}
                                </p>

                            @endforeach


                            @if ($order->items->count() > 2)

                                <p
                                    class="mt-1 text-xs
                                           text-slate-400"
                                >
                                    + {{ $order->items->count() - 2 }}
                                    produk lainnya
                                </p>

                            @endif

                        </div>


                        <div class="md:text-right">

                            <p
                                class="text-xs
                                       text-slate-400"
                            >
                                Total Pesanan
                            </p>

                            <p
                                class="mt-1 text-xl
                                       font-bold
                                       text-slate-900"
                            >
                                Rp {{ number_format(
                                    $order->subtotal,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </p>

                            <p
                                class="mt-2 text-xs
                                       text-slate-400"
                            >
                                {{ $order->created_at
                                    ->format('d M Y, H:i') }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


        @empty

            <div
                class="rounded-2xl border
                       border-dashed
                       border-slate-300
                       bg-white px-6
                       py-16 text-center"
            >

                <h2 class="font-semibold text-slate-900">
                    Belum ada pesanan
                </h2>

                <p class="mt-2 text-sm text-slate-500">
                    Pesanan yang kamu buat akan muncul di sini.
                </p>


                <a
                    href="{{ route('buyer.products.index') }}"
                    class="mt-5 inline-flex
                           h-11 items-center
                           justify-center
                           rounded-xl
                           bg-violet-600
                           px-5 text-sm
                           font-semibold
                           text-white
                           hover:bg-violet-700"
                >
                    Mulai Belanja
                </a>

            </div>

        @endforelse

    </div>


    @if ($orders->hasPages())

        <div class="mt-8">
            {{ $orders->links() }}
        </div>

    @endif

</div>

@endsection
