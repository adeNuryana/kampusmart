@extends('layouts.seller')

@section('title', 'Detail Pesanan')

@section('content')

<div class="mx-auto max-w-5xl">

    {{-- HEADER --}}
    <div class="mb-7">

        <a
            href="{{ route('seller.orders.index') }}"
            class="inline-flex items-center gap-2
                   text-sm font-medium text-slate-500
                   hover:text-violet-600"
        >
            ← Kembali ke Pesanan
        </a>


        <div
            class="mt-5 flex flex-col gap-4
                   sm:flex-row sm:items-end
                   sm:justify-between"
        >

            <div>

                <p
                    class="text-sm font-semibold
                           text-violet-600"
                >
                    {{ $order->order_number }}
                </p>

                <h1
                    class="mt-1 text-2xl
                           font-bold tracking-tight
                           text-slate-900 lg:text-3xl"
                >
                    Detail Pesanan
                </h1>

                <p class="mt-2 text-sm text-slate-500">

                    Dibuat pada

                    {{ $order->created_at
                        ->format('d M Y, H:i') }}

                </p>

            </div>

        </div>

    </div>


    @if (session('success'))

        <div
            class="mb-5 rounded-xl border
                   border-green-200
                   bg-green-50 px-4 py-3
                   text-sm text-green-700"
        >
            {{ session('success') }}
        </div>

    @endif


    @error('status')

        <div
            class="mb-5 rounded-xl border
                   border-red-200 bg-red-50
                   px-4 py-3 text-sm
                   text-red-700"
        >
            {{ $message }}
        </div>

    @enderror


    <div class="grid gap-6 lg:grid-cols-3">

        {{-- LEFT --}}
        <div class="space-y-6 lg:col-span-2">

            {{-- BUYER --}}
            <div
                class="rounded-2xl border
                       border-slate-200
                       bg-white p-6 shadow-sm"
            >

                <h2 class="font-semibold text-slate-900">
                    Informasi Pembeli
                </h2>


                <div
                    class="mt-5 grid gap-5
                           sm:grid-cols-2"
                >

                    <div>

                        <p
                            class="text-xs font-semibold
                                   uppercase tracking-wide
                                   text-slate-400"
                        >
                            Nama
                        </p>

                        <p
                            class="mt-1 text-sm
                                   font-medium text-slate-800"
                        >
                            {{ $order->buyer_name }}
                        </p>

                    </div>


                    <div>

                        <p
                            class="text-xs font-semibold
                                   uppercase tracking-wide
                                   text-slate-400"
                        >
                            Nomor Telepon
                        </p>

                        <p
                            class="mt-1 text-sm
                                   text-slate-700"
                        >
                            {{ $order->buyer_phone ?? '-' }}
                        </p>

                    </div>

                </div>


                @if ($order->notes)

                    <div
                        class="mt-5 border-t
                               border-slate-100 pt-5"
                    >

                        <p
                            class="text-xs font-semibold
                                   uppercase tracking-wide
                                   text-slate-400"
                        >
                            Catatan Pembeli
                        </p>

                        <p
                            class="mt-2 whitespace-pre-line
                                   text-sm leading-6
                                   text-slate-600"
                        >
                            {{ $order->notes }}
                        </p>

                    </div>

                @endif

            </div>


            {{-- ITEMS --}}
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

                            {{-- IMAGE --}}
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

        </div>


        {{-- RIGHT --}}
        <div class="space-y-6">

            {{-- TOTAL --}}
            <div
                class="rounded-2xl border
                       border-slate-200
                       bg-white p-6 shadow-sm"
            >

                <h2 class="font-semibold text-slate-900">
                    Ringkasan Pesanan
                </h2>


                <div
                    class="mt-5 flex
                           items-center justify-between"
                >

                    <span class="text-sm text-slate-500">
                        Total Barang
                    </span>

                    <span
                        class="text-sm font-semibold
                               text-slate-700"
                    >
                        {{ $order->items->sum('quantity') }}
                    </span>

                </div>


                <div
                    class="mt-5 border-t
                           border-slate-200 pt-5"
                >

                    <p class="text-sm text-slate-500">
                        Total Pesanan
                    </p>

                    <p
                        class="mt-1 text-2xl
                               font-bold text-violet-600"
                    >

                        Rp {{ number_format(
                            $order->subtotal,
                            0,
                            ',',
                            '.'
                        ) }}

                    </p>

                </div>

            </div>


            {{-- STATUS ACTION --}}
            <div
                class="rounded-2xl border
                       border-slate-200
                       bg-white p-6 shadow-sm"
            >

                <h2 class="font-semibold text-slate-900">
                    Status Pesanan
                </h2>


                <p class="mt-2 text-sm text-slate-500">

                    Status saat ini:

                    <strong class="text-slate-800">
                        {{ match ($order->status) {
                            'pending' => 'Menunggu',
                            'confirmed' => 'Dikonfirmasi',
                            'processing' => 'Diproses',
                            'completed' => 'Selesai',
                            'cancelled' => 'Dibatalkan',
                            default => $order->status,
                        } }}
                    </strong>

                </p>


                {{-- PENDING --}}
                @if ($order->status === 'pending')

                    <div class="mt-5 space-y-3">

                        <form
                            action="{{ route(
                                'seller.orders.status',
                                $order
                            ) }}"
                            method="POST"
                        >

                            @csrf
                            @method('PATCH')

                            <input
                                type="hidden"
                                name="status"
                                value="confirmed"
                            >

                            <button
                                type="submit"
                                class="h-11 w-full
                                       rounded-xl
                                       bg-violet-600
                                       text-sm font-semibold
                                       text-white transition
                                       hover:bg-violet-700"
                            >
                                Terima Pesanan
                            </button>

                        </form>


                        <form
                            action="{{ route(
                                'seller.orders.status',
                                $order
                            ) }}"
                            method="POST"
                        >

                            @csrf
                            @method('PATCH')

                            <input
                                type="hidden"
                                name="status"
                                value="cancelled"
                            >

                            <button
                                type="submit"
                                onclick="return confirm(
                                    'Batalkan pesanan ini? Stok produk akan dikembalikan.'
                                )"
                                class="h-11 w-full
                                       rounded-xl
                                       bg-red-50
                                       text-sm font-semibold
                                       text-red-600
                                       transition
                                       hover:bg-red-100"
                            >
                                Batalkan Pesanan
                            </button>

                        </form>

                    </div>


                {{-- CONFIRMED --}}
                @elseif ($order->status === 'confirmed')

                    <div class="mt-5 space-y-3">

                        <form
                            action="{{ route(
                                'seller.orders.status',
                                $order
                            ) }}"
                            method="POST"
                        >

                            @csrf
                            @method('PATCH')

                            <input
                                type="hidden"
                                name="status"
                                value="processing"
                            >

                            <button
                                type="submit"
                                class="h-11 w-full
                                       rounded-xl
                                       bg-violet-600
                                       text-sm font-semibold
                                       text-white
                                       hover:bg-violet-700"
                            >
                                Proses Pesanan
                            </button>

                        </form>


                        <form
                            action="{{ route(
                                'seller.orders.status',
                                $order
                            ) }}"
                            method="POST"
                        >

                            @csrf
                            @method('PATCH')

                            <input
                                type="hidden"
                                name="status"
                                value="cancelled"
                            >

                            <button
                                type="submit"
                                onclick="return confirm(
                                    'Batalkan pesanan ini?'
                                )"
                                class="h-11 w-full
                                       rounded-xl
                                       bg-red-50
                                       text-sm font-semibold
                                       text-red-600
                                       hover:bg-red-100"
                            >
                                Batalkan
                            </button>

                        </form>

                    </div>


                {{-- PROCESSING --}}
                @elseif ($order->status === 'processing')

                    <div class="mt-5 space-y-3">

                        <form
                            action="{{ route(
                                'seller.orders.status',
                                $order
                            ) }}"
                            method="POST"
                        >

                            @csrf
                            @method('PATCH')

                            <input
                                type="hidden"
                                name="status"
                                value="completed"
                            >

                            <button
                                type="submit"
                                onclick="return confirm(
                                    'Tandai pesanan ini sebagai selesai?'
                                )"
                                class="h-11 w-full
                                       rounded-xl
                                       bg-green-600
                                       text-sm font-semibold
                                       text-white
                                       hover:bg-green-700"
                            >
                                Selesaikan Pesanan
                            </button>

                        </form>


                        <form
                            action="{{ route(
                                'seller.orders.status',
                                $order
                            ) }}"
                            method="POST"
                        >

                            @csrf
                            @method('PATCH')

                            <input
                                type="hidden"
                                name="status"
                                value="cancelled"
                            >

                            <button
                                type="submit"
                                onclick="return confirm(
                                    'Batalkan pesanan ini?'
                                )"
                                class="h-11 w-full
                                       rounded-xl
                                       bg-red-50
                                       text-sm font-semibold
                                       text-red-600
                                       hover:bg-red-100"
                            >
                                Batalkan
                            </button>

                        </form>

                    </div>


                {{-- TERMINAL --}}
                @elseif ($order->status === 'completed')

                    <div
                        class="mt-5 rounded-xl
                               bg-green-50 px-4 py-3
                               text-sm font-medium
                               text-green-700"
                    >
                        Pesanan telah selesai.
                    </div>


                @elseif ($order->status === 'cancelled')

                    <div
                        class="mt-5 rounded-xl
                               bg-red-50 px-4 py-3
                               text-sm font-medium
                               text-red-700"
                    >
                        Pesanan telah dibatalkan.
                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection
