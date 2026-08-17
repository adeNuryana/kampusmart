@extends('layouts.seller')

@section('title', 'Pesanan Masuk')

@section('content')

<div class="mx-auto max-w-[1400px]">

    {{-- HEADER --}}
    <div class="mb-7">

        <h1
            class="text-2xl font-bold
                   tracking-tight text-slate-900
                   lg:text-3xl"
        >
            Pesanan Masuk
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Kelola pesanan yang masuk ke tokomu.
        </p>

    </div>


    {{-- SUCCESS --}}
    @if (session('success'))

        <div
            class="mb-5 rounded-xl border
                   border-green-200 bg-green-50
                   px-4 py-3 text-sm
                   text-green-700"
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


    {{-- TABLE CARD --}}
    <div
        class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white shadow-sm"
    >

        {{-- FILTER --}}
        <div
            class="border-b border-slate-200
                   p-5"
        >

            {{-- STATUS --}}
            <div class="flex flex-wrap gap-2">

                <a
                    href="{{ route('seller.orders.index') }}"
                    class="rounded-xl px-4 py-2
                           text-sm font-medium transition
                           {{ !request('status')
                                ? 'bg-violet-100 text-violet-700'
                                : 'text-slate-600 hover:bg-slate-50' }}"
                >
                    Semua
                </a>


                <a
                    href="{{ route(
                        'seller.orders.index',
                        ['status' => 'pending']
                    ) }}"
                    class="rounded-xl px-4 py-2
                           text-sm font-medium transition
                           {{ request('status') === 'pending'
                                ? 'bg-amber-100 text-amber-700'
                                : 'text-slate-600 hover:bg-slate-50' }}"
                >
                    Menunggu
                </a>


                <a
                    href="{{ route(
                        'seller.orders.index',
                        ['status' => 'confirmed']
                    ) }}"
                    class="rounded-xl px-4 py-2
                           text-sm font-medium transition
                           {{ request('status') === 'confirmed'
                                ? 'bg-blue-100 text-blue-700'
                                : 'text-slate-600 hover:bg-slate-50' }}"
                >
                    Dikonfirmasi
                </a>


                <a
                    href="{{ route(
                        'seller.orders.index',
                        ['status' => 'processing']
                    ) }}"
                    class="rounded-xl px-4 py-2
                           text-sm font-medium transition
                           {{ request('status') === 'processing'
                                ? 'bg-violet-100 text-violet-700'
                                : 'text-slate-600 hover:bg-slate-50' }}"
                >
                    Diproses
                </a>


                <a
                    href="{{ route(
                        'seller.orders.index',
                        ['status' => 'completed']
                    ) }}"
                    class="rounded-xl px-4 py-2
                           text-sm font-medium transition
                           {{ request('status') === 'completed'
                                ? 'bg-green-100 text-green-700'
                                : 'text-slate-600 hover:bg-slate-50' }}"
                >
                    Selesai
                </a>


                <a
                    href="{{ route(
                        'seller.orders.index',
                        ['status' => 'cancelled']
                    ) }}"
                    class="rounded-xl px-4 py-2
                           text-sm font-medium transition
                           {{ request('status') === 'cancelled'
                                ? 'bg-red-100 text-red-700'
                                : 'text-slate-600 hover:bg-slate-50' }}"
                >
                    Dibatalkan
                </a>

            </div>


            {{-- SEARCH --}}
            <form
                action="{{ route('seller.orders.index') }}"
                method="GET"
                class="mt-4 flex gap-3"
            >

                @if (request('status'))

                    <input
                        type="hidden"
                        name="status"
                        value="{{ request('status') }}"
                    >

                @endif


                <div class="relative max-w-lg flex-1">

                    <svg
                        class="absolute left-4 top-1/2
                               size-5 -translate-y-1/2
                               text-slate-400"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <circle cx="11" cy="11" r="7" />
                        <path d="m20 20-3.5-3.5" />
                    </svg>


                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nomor pesanan atau pembeli..."
                        class="h-11 w-full
                               rounded-xl border
                               border-slate-200
                               pl-11 pr-4 text-sm
                               outline-none
                               focus:border-violet-400
                               focus:ring-4
                               focus:ring-violet-100"
                    >

                </div>


                <button
                    type="submit"
                    class="h-11 rounded-xl
                           bg-slate-900 px-5
                           text-sm font-semibold
                           text-white transition
                           hover:bg-slate-800"
                >
                    Cari
                </button>

            </form>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1050px]">

                <thead class="bg-slate-50">

                    <tr
                        class="text-left text-xs
                               font-semibold uppercase
                               tracking-wide
                               text-slate-500"
                    >

                        <th class="px-5 py-4">
                            Pesanan
                        </th>

                        <th class="px-5 py-4">
                            Pembeli
                        </th>

                        <th class="px-5 py-4">
                            Barang
                        </th>

                        <th class="px-5 py-4">
                            Total
                        </th>

                        <th class="px-5 py-4">
                            Status
                        </th>

                        <th class="px-5 py-4">
                            Tanggal
                        </th>

                        <th class="px-5 py-4 text-right">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse ($orders as $order)

                        <tr
                            class="text-sm transition
                                   hover:bg-slate-50/70"
                        >

                            {{-- ORDER --}}
                            <td class="px-5 py-4">

                                <p class="font-semibold text-slate-900">
                                    {{ $order->order_number }}
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    ID #{{ $order->id }}
                                </p>

                            </td>


                            {{-- BUYER --}}
                            <td class="px-5 py-4">

                                <p class="font-medium text-slate-800">
                                    {{ $order->buyer_name }}
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    {{ $order->buyer_phone ?? '-' }}
                                </p>

                            </td>


                            {{-- ITEMS --}}
                            <td class="px-5 py-4">

                                <span class="font-medium text-slate-700">
                                    {{ $order->items->sum('quantity') }}
                                    barang
                                </span>

                            </td>


                            {{-- TOTAL --}}
                            <td class="px-5 py-4">

                                <span
                                    class="font-semibold
                                           text-slate-900"
                                >
                                    Rp {{ number_format(
                                        $order->subtotal,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </span>

                            </td>


                            {{-- STATUS --}}
                            <td class="px-5 py-4">

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

                                        'pending' =>
                                            'Menunggu',

                                        'confirmed' =>
                                            'Dikonfirmasi',

                                        'processing' =>
                                            'Diproses',

                                        'completed' =>
                                            'Selesai',

                                        'cancelled' =>
                                            'Dibatalkan',

                                        default =>
                                            ucfirst($order->status),
                                    };

                                @endphp


                                <span
                                    class="inline-flex
                                           rounded-full
                                           px-3 py-1.5
                                           text-xs font-semibold
                                           {{ $statusClass }}"
                                >
                                    {{ $statusLabel }}
                                </span>

                            </td>


                            {{-- DATE --}}
                            <td class="px-5 py-4 text-slate-600">

                                {{ $order->created_at
                                    ->format('d M Y') }}

                                <p class="mt-1 text-xs text-slate-400">

                                    {{ $order->created_at
                                        ->format('H:i') }}

                                </p>

                            </td>


                            {{-- ACTION --}}
                            <td class="px-5 py-4">

                                <div class="flex justify-end">

                                    <a
                                        href="{{ route(
                                            'seller.orders.show',
                                            $order
                                        ) }}"
                                        title="Detail Pesanan"
                                        class="inline-flex
                                               size-9 items-center
                                               justify-center
                                               rounded-lg
                                               text-slate-500
                                               transition
                                               hover:bg-violet-50
                                               hover:text-violet-600"
                                    >

                                        <svg
                                            class="size-5"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path
                                                d="M2 12s3.5-6 10-6
                                                   10 6 10 6-3.5 6-10 6
                                                   S2 12 2 12Z"
                                            />

                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="3"
                                            />
                                        </svg>

                                    </a>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-16
                                       text-center"
                            >

                                <p
                                    class="font-semibold
                                           text-slate-700"
                                >
                                    Belum ada pesanan
                                </p>

                                <p
                                    class="mt-2 text-sm
                                           text-slate-500"
                                >
                                    Pesanan dari pembeli akan muncul di sini.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if ($orders->hasPages())

            <div
                class="border-t border-slate-200
                       px-5 py-4"
            >
                {{ $orders->links() }}
            </div>

        @endif

    </div>

</div>

@endsection
