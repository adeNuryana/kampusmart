@extends('layouts.admin')

@section('title', 'Kelola Penjual')

@section('content')

    <div class="mx-auto max-w-[1400px]">

        {{-- HEADER --}}
        <div class="mb-7 flex flex-col gap-4
               sm:flex-row sm:items-center
               sm:justify-between">

            <div>
                <h1 class="text-2xl font-bold
                       tracking-tight lg:text-3xl">
                    Kelola Penjual
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Kelola akun penjual dan toko
                    yang terdaftar di KampusMart.
                </p>
            </div>


            <a href="{{ route('admin.sellers.create') }}"
                class="inline-flex h-11 items-center
                   justify-center gap-2 rounded-xl
                   bg-violet-600 px-5
                   text-sm font-semibold text-white
                   transition hover:bg-violet-700">
                <span class="text-xl leading-none">+</span>

                Tambah Penjual
            </a>

        </div>


        {{-- ALERT --}}
        @if (session('success'))
            <div
                class="mb-5 rounded-xl border
                   border-green-200 bg-green-50
                   px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif


        {{-- TABLE CARD --}}
        <div class="overflow-hidden rounded-2xl
               border border-slate-200
               bg-white shadow-sm">

            {{-- FILTER --}}
            <form method="GET" action="{{ route('admin.sellers.index') }}"
                class="flex flex-col gap-4
                   border-b border-slate-200
                   p-5 lg:flex-row
                   lg:items-center">

                <div class="flex flex-wrap gap-2">

                    <a href="{{ route('admin.sellers.index') }}"
                        class="rounded-xl px-4 py-2
                           text-sm font-medium
                           {{ !request('status') ? 'bg-violet-100 text-violet-700' : 'text-slate-600 hover:bg-slate-50' }}">
                        Semua
                    </a>


                    <a href="{{ route('admin.sellers.index', ['status' => 'active']) }}"
                        class="rounded-xl px-4 py-2
                           text-sm font-medium
                           {{ request('status') === 'active' ? 'bg-violet-100 text-violet-700' : 'text-slate-600 hover:bg-slate-50' }}">
                        Aktif
                    </a>


                    <a href="{{ route('admin.sellers.index', ['status' => 'inactive']) }}"
                        class="rounded-xl px-4 py-2
                           text-sm font-medium
                           {{ request('status') === 'inactive' ? 'bg-violet-100 text-violet-700' : 'text-slate-600 hover:bg-slate-50' }}">
                        Nonaktif
                    </a>

                </div>


                <div class="relative lg:ml-auto lg:w-[360px]">

                    <svg class="absolute left-4 top-1/2
                           size-5 -translate-y-1/2
                           text-slate-400"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="7" />
                        <path d="m20 20-3.5-3.5" />
                    </svg>

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari penjual atau nama toko..."
                        class="h-11 w-full rounded-xl
                           border border-slate-200
                           pl-11 pr-4 text-sm
                           outline-none
                           focus:border-violet-400
                           focus:ring-4
                           focus:ring-violet-100">

                </div>

            </form>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[950px]">

                    <thead class="bg-slate-50">

                        <tr
                            class="text-left text-xs
                           font-semibold uppercase
                           tracking-wide text-slate-500">

                            <th class="px-5 py-4">Penjual</th>
                            <th class="px-5 py-4">Nama Toko</th>
                            <th class="px-5 py-4">WhatsApp</th>
                            <th class="px-5 py-4">Tanggal Daftar</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4 text-right">Aksi</th>
                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($sellers as $seller)
                            <tr class="text-sm">
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        @if ($seller->sellerProfile?->photo)
                                            <img src="{{ asset('storage/' . $seller->sellerProfile->photo) }}"
                                                alt="{{ $seller->name }}"
                                                class="size-12 rounded-full border border-slate-200 object-cover">
                                        @else
                                            <div
                                                class="flex size-12 items-center justify-center
                       rounded-full bg-slate-100
                       text-sm font-bold text-slate-500">
                                                {{ strtoupper(substr($seller->name, 0, 1)) }}
                                            </div>
                                        @endif


                                        <div>

                                            <p class="font-semibold text-slate-900">
                                                {{ $seller->name }}
                                            </p>

                                            <p class="mt-0.5 text-sm text-slate-500">
                                                {{ $seller->email }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                <td class="px-5 py-4">

                                    {{ $seller->sellerProfile?->store_name ?? '-' }}

                                </td>


                                <td class="px-5 py-4 text-slate-600">

                                    {{ $seller->sellerProfile?->whatsapp ?? '-' }}

                                </td>


                                <td class="px-5 py-4 text-slate-600">

                                    {{ $seller->created_at->format('d M Y') }}

                                </td>


                                <td class="px-5 py-4">

                                    @if ($seller->status === 'active')
                                        <span
                                            class="rounded-full
                                           bg-green-100
                                           px-3 py-1
                                           text-xs font-medium
                                           text-green-700">
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="rounded-full
                                           bg-slate-100
                                           px-3 py-1
                                           text-xs font-medium
                                           text-slate-600">
                                            Nonaktif
                                        </span>
                                    @endif

                                </td>


                                <td class="px-5 py-4">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('admin.sellers.show', $seller) }}" title="Lihat Detail"
                                            class="inline-flex size-9 items-center
                   justify-center rounded-lg
                   text-slate-500 transition
                   hover:bg-violet-50
                   hover:text-violet-600">
                                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">
                                                <path d="M2 12s3.5-6 10-6
                               10 6 10 6-3.5 6-10 6
                              S2 12 2 12Z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                        </a>


                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.sellers.edit', $seller) }}" title="Edit Penjual"
                                            class="inline-flex size-9 items-center
                   justify-center rounded-lg
                   text-slate-500 transition
                   hover:bg-violet-50
                   hover:text-violet-600">
                                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">
                                                <path d="M12 20h9" />

                                                <path d="M16.5 3.5
                               a2.1 2.1 0 0 1 3 3
                               L8 18l-4 1 1-4Z" />
                                            </svg>
                                        </a>


                                        {{-- STATUS --}}
                                        <form action="{{ route('admin.sellers.status', $seller) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden" name="status"
                                                value="{{ $seller->status === 'active' ? 'inactive' : 'active' }}">

                                            <button type="submit"
                                                title="{{ $seller->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}"
                                                onclick="return confirm(
                    '{{ $seller->status === 'active' ? 'Nonaktifkan akun penjual ini?' : 'Aktifkan akun penjual ini?' }}'
                )"
                                                class="inline-flex size-9 items-center
                       justify-center rounded-lg
                       transition
                       {{ $seller->status === 'active' ? 'text-red-500 hover:bg-red-50' : 'text-green-600 hover:bg-green-50' }}">

                                                @if ($seller->status === 'active')
                                                    <svg class="size-5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.8">
                                                        <circle cx="12" cy="12" r="9" />
                                                        <path d="m7 7 10 10" />
                                                    </svg>
                                                @else
                                                    <svg class="size-5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.8">
                                                        <path d="m5 12 4 4L19 6" />
                                                    </svg>
                                                @endif

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="px-6 py-16 text-center">
                                    <p class="font-semibold
                                       text-slate-700">
                                        Belum ada penjual
                                    </p>

                                    <p class="mt-2 text-sm
                                       text-slate-500">
                                        Tambahkan akun penjual
                                        pertama KampusMart.
                                    </p>
                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if ($sellers->hasPages())
                <div class="border-t border-slate-200
                       px-5 py-4">
                    {{ $sellers->links() }}
                </div>
            @endif

        </div>

    </div>

@endsection
