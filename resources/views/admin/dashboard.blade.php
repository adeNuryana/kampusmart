@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <div class="mx-auto max-w-[1400px]">

        {{-- PAGE HEADER --}}
        <div class="mb-8">

            <h2 class="text-2xl font-bold tracking-tight
                   text-slate-900 lg:text-3xl">
                Dashboard
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Pantau aktivitas dan kelola platform KampusMart.
            </p>

        </div>


        {{-- STAT CARDS --}}
        <div class="grid gap-4
               sm:grid-cols-2
               xl:grid-cols-4">

            {{-- BUYERS --}}
            <div class="rounded-2xl border border-slate-200
                   bg-white p-5 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p
                            class="text-xs font-semibold uppercase
                               tracking-[0.08em]
                               text-slate-500">
                            Total Pembeli
                        </p>

                        <p class="mt-8 text-3xl font-bold
                               text-slate-900">
                            {{ number_format($totalBuyers) }}
                        </p>

                    </div>


                    <div
                        class="flex size-12 items-center
                           justify-center rounded-2xl
                           bg-violet-50 text-violet-600">
                        <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="12" cy="8" r="3" />
                            <path d="M5 20c0-4 3-7 7-7s7 3 7 7" />
                        </svg>
                    </div>

                </div>

            </div>


            {{-- SELLERS --}}
            <div class="rounded-2xl border border-slate-200
                   bg-white p-5 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p
                            class="text-xs font-semibold uppercase
                               tracking-[0.08em]
                               text-slate-500">
                            Total Penjual
                        </p>

                        <p class="mt-8 text-3xl font-bold
                               text-slate-900">
                            {{ number_format($totalSellers) }}
                        </p>

                    </div>


                    <div
                        class="flex size-12 items-center
                           justify-center rounded-2xl
                           bg-violet-50 text-violet-600">
                        <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M4 10v10h16V10" />
                            <path d="M3 10l2-6h14l2 6" />
                        </svg>
                    </div>

                </div>

            </div>


            {{-- ACTIVE SELLER --}}
            <div class="rounded-2xl border border-slate-200
                   bg-white p-5 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p
                            class="text-xs font-semibold uppercase
                               tracking-[0.08em]
                               text-slate-500">
                            Penjual Aktif
                        </p>

                        <p class="mt-8 text-3xl font-bold
                               text-slate-900">
                            {{ number_format($activeSellers) }}
                        </p>

                        <p class="mt-2 text-xs text-green-600">
                            Akun dapat digunakan
                        </p>

                    </div>


                    <div
                        class="flex size-12 items-center
                           justify-center rounded-2xl
                           bg-green-50 text-green-600">
                        ✓
                    </div>

                </div>

            </div>


            {{-- INACTIVE --}}
            <div class="rounded-2xl border
                   border-red-100 bg-red-50/50
                   p-5 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p
                            class="text-xs font-semibold uppercase
                               tracking-[0.08em]
                               text-red-600">
                            Penjual Nonaktif
                        </p>

                        <p class="mt-8 text-3xl font-bold
                               text-red-700">
                            {{ number_format($inactiveSellers) }}
                        </p>

                        <p class="mt-2 text-xs text-red-600">
                            Perlu ditinjau
                        </p>

                    </div>

                    <div
                        class="flex size-12 items-center
                           justify-center rounded-2xl
                           bg-red-100 text-red-600">
                        !
                    </div>

                </div>

            </div>

        </div>


        {{-- MIDDLE SECTION --}}
        <div class="mt-6 grid gap-6
               xl:grid-cols-[minmax(0,2fr)_340px]">

            {{-- CHART --}}
            <section class="rounded-2xl border border-slate-200
                   bg-white p-6 shadow-sm">

                <div>

                    <h3 class="text-lg font-semibold">
                        Pertumbuhan Pengguna
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Gambaran pengguna baru KampusMart.
                    </p>

                </div>


                <div
                    class="mt-8 flex h-[270px]
                       items-end gap-5
                       border-b border-slate-200
                       px-3">

                    @php
                        $bars = [38, 55, 31, 68, 58, 82];
                    @endphp

                    @foreach ($bars as $index => $height)
                        <div class="flex h-full flex-1
                               flex-col justify-end">

                            <div class="mx-auto w-full max-w-12
                                   rounded-t-md bg-violet-500
                                   transition hover:bg-violet-600"
                                style="height: {{ $height }}%"></div>

                            <p
                                class="mt-3 whitespace-nowrap
                                   text-center text-xs
                                   text-slate-500">
                                M{{ $index + 1 }}
                            </p>

                        </div>
                    @endforeach

                </div>

            </section>


            {{-- ACTION --}}
            <section class="rounded-2xl border border-slate-200
                   bg-white p-6 shadow-sm">

                <h3 class="text-lg font-semibold">
                    Memerlukan Tindakan
                </h3>

                <div class="mt-5 space-y-3">

                    @if ($inactiveSellers > 0)
                        <div class="rounded-xl border
                               border-slate-200 p-4">

                            <p class="font-semibold text-slate-800">
                                Akun Penjual Nonaktif
                            </p>

                            <p class="mt-1 text-sm
                                   text-slate-500">
                                {{ $inactiveSellers }}
                                akun penjual tidak aktif.
                            </p>

                            <button type="button"
                                class="mt-4 rounded-lg
                                   bg-violet-600 px-4 py-2
                                   text-xs font-semibold
                                   text-white
                                   hover:bg-violet-700">
                                Tinjau
                            </button>

                        </div>
                    @else
                        <div
                            class="rounded-xl bg-green-50
                               px-4 py-5 text-sm
                               text-green-700">
                            Tidak ada akun penjual yang
                            membutuhkan tindakan.
                        </div>
                    @endif


                    <div class="rounded-xl border
                           border-slate-200 p-4">

                        <p class="font-semibold">
                            Kelola Penjual
                        </p>

                        <p class="mt-1 text-sm
                               leading-6 text-slate-500">
                            Tambahkan akun penjual baru
                            melalui halaman Kelola Penjual.
                        </p>

                    </div>

                </div>

            </section>

        </div>


        {{-- ACTIVITY --}}
        <section
            class="mt-6 overflow-hidden
           rounded-2xl border
           border-slate-200
           bg-white shadow-sm">

            {{-- Header --}}
            <div
                class="flex items-center justify-between
               border-b border-slate-200
               px-6 py-5">

                <div>
                    <h3 class="text-lg font-semibold text-slate-900">
                        Aktivitas Terbaru
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Aktivitas terbaru buyer, seller, dan admin
                    </p>
                </div>

                <span
                    class="rounded-lg bg-violet-50
                   px-3 py-1.5 text-sm font-semibold
                   text-violet-600">
                    KampusMart
                </span>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full min-w-[750px]">

                    <thead class="bg-slate-50">

                        <tr
                            class="text-left text-xs font-semibold
                           uppercase tracking-wide
                           text-slate-500">

                            <th class="px-6 py-4">
                                Waktu
                            </th>

                            <th class="px-6 py-4">
                                Aktivitas
                            </th>

                            <th class="px-6 py-4">
                                Pengguna / Entitas
                            </th>

                            <th class="px-6 py-4">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100
                       text-sm">

                        @forelse ($recentActivities as $activity)
                            @php
                                /*
                        |--------------------------------------------------------------------------
                        | Nama pengguna
                        |--------------------------------------------------------------------------
                        |
                        | Kalau seller, tampilkan nama toko.
                        | Kalau buyer/admin, tampilkan nama user.
                        |
                        */

                                $user = $activity->user;

                                $actorName = match ($user?->role) {
                                    'seller' => $user?->sellerProfile?->store_name ?? ($user?->name ?? 'Seller'),

                                    default => $user?->name ?? 'Pengguna',
                                };

                                /*
                        |--------------------------------------------------------------------------
                        | Label Role
                        |--------------------------------------------------------------------------
                        */

                                $roleLabel = match ($user?->role) {
                                    'seller' => 'Seller',
                                    'buyer' => 'Buyer',
                                    'admin' => 'Admin',
                                    'superadmin' => 'Super Admin',
                                    default => 'Pengguna',
                                };

                                /*
                        |--------------------------------------------------------------------------
                        | Warna Role
                        |--------------------------------------------------------------------------
                        */

                                $roleClass = match ($user?->role) {
                                    'seller' => 'bg-amber-50 text-amber-700',
                                    'buyer' => 'bg-blue-50 text-blue-700',
                                    'admin', 'superadmin' => 'bg-violet-50 text-violet-700',
                                    default => 'bg-slate-100 text-slate-600',
                                };

                                /*
                        |--------------------------------------------------------------------------
                        | Icon / Warna Aktivitas
                        |--------------------------------------------------------------------------
                        */

                                $activityClass = match ($activity->action) {
                                    'order_created' => 'bg-blue-50 text-blue-600',

                                    'order_sold' => 'bg-emerald-50 text-emerald-600',

                                    'product_created' => 'bg-green-50 text-green-600',

                                    'product_updated' => 'bg-amber-50 text-amber-600',

                                    'product_deleted' => 'bg-red-50 text-red-600',

                                    'seller_profile_updated', 'buyer_profile_updated' => 'bg-violet-50 text-violet-600',

                                    'seller_created' => 'bg-cyan-50 text-cyan-600',

                                    'seller_updated' => 'bg-indigo-50 text-indigo-600',

                                    'seller_deleted' => 'bg-red-50 text-red-600',

                                    'category_created' => 'bg-green-50 text-green-600',

                                    'category_updated' => 'bg-amber-50 text-amber-600',

                                    'category_deleted' => 'bg-red-50 text-red-600',

                                    default => 'bg-slate-100 text-slate-600',
                                };
                            @endphp


                            <tr class="transition-colors
                               hover:bg-slate-50/70">

                                {{-- Waktu --}}
                                <td class="whitespace-nowrap
                                   px-6 py-4">

                                    <p class="font-medium text-slate-700">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $activity->created_at->format('d M Y, H:i') }}
                                    </p>

                                </td>


                                {{-- Aktivitas --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-start gap-3">

                                        {{-- Icon --}}
                                        <div
                                            class="flex h-9 w-9 shrink-0
                                           items-center justify-center
                                           rounded-xl
                                           {{ $activityClass }}">

                                            @switch($activity->action)
                                                {{-- Pesanan --}}
                                                @case('order_created')
                                                    <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">
                                                        <circle cx="9" cy="20" r="1" />
                                                        <circle cx="19" cy="20" r="1" />
                                                        <path d="M3 4h2l2.4 11.2a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 8H6" />
                                                    </svg>
                                                @break

                                                {{-- Produk tambah --}}
                                                @case('product_created')
                                                    <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">
                                                        <path d="M12 5v14" />
                                                        <path d="M5 12h14" />
                                                    </svg>
                                                @break

                                                {{-- Edit --}}
                                                @case('product_updated')
                                                @case('seller_updated')

                                                @case('category_updated')
                                                    <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">
                                                        <path d="M12 20h9" />
                                                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z" />
                                                    </svg>
                                                @break

                                                {{-- Hapus --}}
                                                @case('product_deleted')
                                                @case('seller_deleted')

                                                @case('category_deleted')
                                                    <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">
                                                        <path d="M3 6h18" />
                                                        <path d="M8 6V4h8v2" />
                                                        <path d="M19 6l-1 14H6L5 6" />
                                                        <path d="M10 11v5" />
                                                        <path d="M14 11v5" />
                                                    </svg>
                                                @break

                                                {{-- Profil --}}
                                                @case('seller_profile_updated')
                                                @case('buyer_profile_updated')
                                                    <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">
                                                        <circle cx="12" cy="8" r="4" />
                                                        <path d="M4 21a8 8 0 0 1 16 0" />
                                                    </svg>
                                                @break

                                                {{-- Terjual --}}
                                                @case('order_sold')
                                                    <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">
                                                        <path d="m5 12 4 4L19 6" />
                                                    </svg>
                                                @break

                                                {{-- Default --}}

                                                @default
                                                    <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">
                                                        <circle cx="12" cy="12" r="9" />
                                                        <path d="M12 8v4" />
                                                        <path d="M12 16h.01" />
                                                    </svg>
                                            @endswitch

                                        </div>


                                        {{-- Description --}}
                                        <div class="min-w-0">

                                            <p
                                                class="font-medium
                                               text-slate-800">
                                                {{ ucfirst($activity->description) }}
                                            </p>

                                            <p
                                                class="mt-1 text-xs
                                               text-slate-400">
                                                {{ str_replace('_', ' ', $activity->action) }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Pengguna --}}
                                <td class="px-6 py-4">

                                    <div>

                                        <p class="font-semibold
                                           text-slate-800">
                                            {{ $actorName }}
                                        </p>

                                        <span
                                            class="mt-1 inline-flex
                                           rounded-md px-2 py-0.5
                                           text-[11px] font-semibold
                                           {{ $roleClass }}">
                                            {{ $roleLabel }}
                                        </span>

                                    </div>

                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-4">

                                    <span
                                        class="inline-flex items-center gap-1.5
                                       rounded-full bg-emerald-50
                                       px-3 py-1 text-xs font-semibold
                                       text-emerald-700">

                                        <span
                                            class="h-1.5 w-1.5
                                           rounded-full
                                           bg-emerald-500"></span>

                                        Berhasil

                                    </span>

                                </td>

                            </tr>


                            @empty

                                <tr>

                                    <td colspan="4" class="px-6 py-14">

                                        <div class="text-center">

                                            <div
                                                class="mx-auto flex h-12 w-12
                                           items-center justify-center
                                           rounded-2xl bg-slate-100
                                           text-slate-400">
                                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="M12 8v4l3 3" />
                                                    <circle cx="12" cy="12" r="9" />
                                                </svg>
                                            </div>

                                            <p
                                                class="mt-4 font-semibold
                                           text-slate-700">
                                                Belum ada aktivitas
                                            </p>

                                            <p class="mt-1 text-sm
                                           text-slate-400">
                                                Aktivitas pengguna akan
                                                ditampilkan di sini.
                                            </p>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

        </div>

    @endsection
