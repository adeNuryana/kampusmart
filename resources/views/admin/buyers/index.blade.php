@extends('layouts.admin')

@section('title', 'Kelola Pembeli')

@section('content')

    <div class="mx-auto max-w-[1400px]">

        {{-- HEADER --}}
        <div class="mb-7 flex flex-col gap-4
            sm:flex-row sm:items-center
            sm:justify-between">

            <div>

                <h1 class="text-2xl font-bold tracking-tight text-slate-900 lg:text-3xl">
                    Kelola Pembeli
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Kelola akun pembeli yang terdaftar di KampusMart.
                </p>

            </div>


            <a href="{{ route('admin.buyers.create') }}"
                class="inline-flex h-11 items-center
               justify-center gap-2 rounded-xl
               bg-violet-600 px-5
               text-sm font-semibold text-white
               transition hover:bg-violet-700">

                <span class="text-xl leading-none">
                    +
                </span>

                Tambah Pembeli

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
            <form method="GET" action="{{ route('admin.buyers.index') }}"
                class="flex flex-col gap-4
                   border-b border-slate-200
                   p-5 lg:flex-row
                   lg:items-center">

                {{-- STATUS FILTER --}}
                <div class="flex flex-wrap gap-2">

                    {{-- SEMUA --}}
                    <a href="{{ route('admin.buyers.index') }}"
                        class="rounded-xl px-4 py-2
                           text-sm font-medium transition
                           {{ !request('status') ? 'bg-violet-100 text-violet-700' : 'text-slate-600 hover:bg-slate-50' }}">
                        Semua
                    </a>


                    {{-- AKTIF --}}
                    <a href="{{ route('admin.buyers.index', ['status' => 'active']) }}"
                        class="rounded-xl px-4 py-2
                           text-sm font-medium transition
                           {{ request('status') === 'active' ? 'bg-violet-100 text-violet-700' : 'text-slate-600 hover:bg-slate-50' }}">
                        Aktif
                    </a>


                    {{-- NONAKTIF --}}
                    <a href="{{ route('admin.buyers.index', ['status' => 'inactive']) }}"
                        class="rounded-xl px-4 py-2
                           text-sm font-medium transition
                           {{ request('status') === 'inactive' ? 'bg-violet-100 text-violet-700' : 'text-slate-600 hover:bg-slate-50' }}">
                        Nonaktif
                    </a>

                </div>


                {{-- SEARCH --}}
                <div class="relative lg:ml-auto lg:w-[360px]">

                    <svg class="absolute left-4 top-1/2
                           size-5 -translate-y-1/2
                           text-slate-400"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="7" />
                        <path d="m20 20-3.5-3.5" />
                    </svg>


                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, email, atau telepon..."
                        class="h-11 w-full rounded-xl
                           border border-slate-200
                           pl-11 pr-4 text-sm
                           outline-none transition
                           focus:border-violet-400
                           focus:ring-4
                           focus:ring-violet-100">

                    {{-- Pertahankan status saat search --}}
                    @if (request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif

                </div>

            </form>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[900px]">

                    <thead class="bg-slate-50">

                        <tr
                            class="text-left text-xs font-semibold
                               uppercase tracking-wide
                               text-slate-500">

                            <th class="px-5 py-4">
                                Pembeli
                            </th>

                            <th class="px-5 py-4">
                                Telepon
                            </th>

                            <th class="px-5 py-4">
                                Tanggal Daftar
                            </th>

                            <th class="px-5 py-4">
                                Status
                            </th>

                            <th class="px-5 py-4 text-right">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($buyers as $buyer)
                            <tr class="text-sm transition
                                   hover:bg-slate-50/70">

                                {{-- PEMBELI --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        {{-- Avatar --}}
                                        <div
                                            class="flex size-12 shrink-0
                                               items-center justify-center
                                               rounded-full bg-violet-100
                                               text-sm font-bold
                                               text-violet-700">
                                            {{ strtoupper(substr($buyer->name, 0, 1)) }}
                                        </div>


                                        <div class="min-w-0">

                                            <p class="font-semibold text-slate-900">
                                                {{ $buyer->name }}
                                            </p>

                                            <p
                                                class="mt-0.5 max-w-[240px]
                                                   truncate text-sm
                                                   text-slate-500">
                                                {{ $buyer->email }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- PHONE --}}
                                <td class="px-5 py-4 text-slate-600">

                                    {{ $buyer->phone ?? '-' }}

                                </td>


                                {{-- CREATED --}}
                                <td class="px-5 py-4 text-slate-600">

                                    {{ $buyer->created_at->format('d M Y') }}

                                </td>


                                {{-- STATUS --}}
                                <td class="px-5 py-4">

                                    @if ($buyer->status === 'active')
                                        <span
                                            class="inline-flex items-center
                                               gap-1.5 rounded-full
                                               bg-green-100 px-3 py-1
                                               text-xs font-medium
                                               text-green-700">

                                            <span
                                                class="size-1.5 rounded-full
                                                   bg-green-500"></span>

                                            Aktif

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center
                                               gap-1.5 rounded-full
                                               bg-slate-100 px-3 py-1
                                               text-xs font-medium
                                               text-slate-600">

                                            <span
                                                class="size-1.5 rounded-full
                                                   bg-slate-400"></span>

                                            Nonaktif

                                        </span>
                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center justify-end gap-2">
                                        {{-- DETAIL --}}
                                        <a href="{{ route('admin.buyers.show', $buyer) }}" title="Lihat Detail"
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
                                        <a href="{{ route('admin.buyers.edit', $buyer) }}" title="Edit Pembeli"
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
                                        <form action="{{ route('admin.buyers.status', $buyer) }}" method="POST">

                                            @csrf
                                            @method('PATCH')


                                            <input type="hidden" name="status"
                                                value="{{ $buyer->status === 'active' ? 'inactive' : 'active' }}">


                                            <button type="submit"
                                                title="{{ $buyer->status === 'active' ? 'Nonaktifkan Pembeli' : 'Aktifkan Pembeli' }}"
                                                onclick="return confirm(
                                                '{{ $buyer->status === 'active' ? 'Nonaktifkan akun pembeli ini?' : 'Aktifkan akun pembeli ini?' }}'
                                            )"
                                                class="inline-flex size-9
                                                   items-center justify-center
                                                   rounded-lg transition
                                                   {{ $buyer->status === 'active' ? 'text-red-500 hover:bg-red-50' : 'text-green-600 hover:bg-green-50' }}">

                                                @if ($buyer->status === 'active')
                                                    {{-- NONAKTIFKAN --}}
                                                    <svg class="size-5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.8">
                                                        <circle cx="12" cy="12" r="9" />

                                                        <path d="m7 7 10 10" />
                                                    </svg>
                                                @else
                                                    {{-- AKTIFKAN --}}
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

                                <td colspan="5" class="px-6 py-16 text-center">

                                    <div
                                        class="mx-auto flex size-16
                                           items-center justify-center
                                           rounded-2xl bg-slate-100">

                                        <svg class="size-8 text-slate-400" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.5">
                                            <circle cx="12" cy="8" r="4" />

                                            <path d="M4 21a8 8 0 0 1 16 0" />
                                        </svg>

                                    </div>


                                    <p
                                        class="mt-4 font-semibold
                                           text-slate-700">
                                        Belum ada pembeli
                                    </p>

                                    <p class="mt-2 text-sm
                                           text-slate-500">
                                        Akun pembeli yang mendaftar akan muncul di sini.
                                    </p>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if ($buyers->hasPages())
                <div class="border-t border-slate-200
                       px-5 py-4">
                    {{ $buyers->links() }}
                </div>
            @endif

        </div>

    </div>

@endsection
