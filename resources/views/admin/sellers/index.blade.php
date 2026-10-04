@extends('layouts.admin')

@section('title', 'Kelola Penjual')

@section('content')

    <div class="mx-auto max-w-[1400px]">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section class="mb-6 flex flex-col gap-4
                   sm:flex-row sm:items-center sm:justify-between">

            <div>

                <div
                    class="inline-flex items-center gap-2
                           rounded-full bg-[#FFF7ED]
                           px-3 py-1.5 text-xs font-bold
                           text-[#F97516]">

                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M4 10v10h16V10" />
                        <path d="M3 10l2-6h14l2 6" />
                        <path d="M8 20v-6h8v6" />
                    </svg>

                    Manajemen Seller

                </div>

                <h1
                    class="mt-3 text-2xl font-black
                           tracking-tight text-[#172554]
                           lg:text-3xl">
                    Kelola Penjual
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Kelola akun penjual dan toko yang terdaftar di KampusMart.
                </p>

            </div>

            <a href="{{ route('admin.sellers.create') }}"
                class="inline-flex h-11 items-center justify-center gap-2
                       rounded-xl bg-[#F97516] px-5
                       text-sm font-bold text-white shadow-sm
                       transition hover:bg-[#F97516] hover:shadow-md">

                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14" />
                    <path d="M5 12h14" />
                </svg>

                Tambah Penjual
            </a>

        </section>


        {{-- ===================================================== --}}
        {{-- ALERT --}}
        {{-- ===================================================== --}}

        @if (session('success'))
            <div
                class="mb-5 flex items-start gap-3
                       rounded-2xl border border-[#D3DFCE]
                       bg-[#FFF7ED] px-4 py-3.5
                       text-[#65795E]">

                <div
                    class="flex size-8 shrink-0 items-center justify-center
                           rounded-lg bg-[#718268] text-white">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m5 12 4 4L19 6" />
                    </svg>

                </div>

                <div>
                    <p class="text-sm font-bold">Berhasil</p>
                    <p class="mt-0.5 text-xs">
                        {{ session('success') }}
                    </p>
                </div>

            </div>
        @endif


        {{-- ===================================================== --}}
        {{-- TABLE CARD --}}
        {{-- ===================================================== --}}

        <section
            class="overflow-hidden rounded-3xl
                   border border-[#DFD2C7]
                   bg-white shadow-sm">

            {{-- FILTER --}}
            <form method="GET" action="{{ route('admin.sellers.index') }}"
                class="flex flex-col gap-4
                       border-b border-[#E7DBD1]
                       bg-[#FFF7ED] p-5
                       lg:flex-row lg:items-center">

                <div class="flex flex-wrap gap-2">

                    <a href="{{ route('admin.sellers.index') }}"
                        class="rounded-xl px-4 py-2
                               text-sm font-semibold transition
                               {{ !request('status')
                                   ? 'bg-[#F97516] text-white shadow-sm'
                                   : 'bg-white text-[#7C695C] hover:bg-[#FFF7ED] hover:text-[#F97516]' }}">
                        Semua
                    </a>

                    <a href="{{ route('admin.sellers.index', ['status' => 'active']) }}"
                        class="rounded-xl px-4 py-2
                               text-sm font-semibold transition
                               {{ request('status') === 'active'
                                   ? 'bg-[#718268] text-white shadow-sm'
                                   : 'bg-white text-[#7C695C] hover:bg-[#FFF7ED] hover:text-[#65795E]' }}">
                        Aktif
                    </a>

                    <a href="{{ route('admin.sellers.index', ['status' => 'inactive']) }}"
                        class="rounded-xl px-4 py-2
                               text-sm font-semibold transition
                               {{ request('status') === 'inactive'
                                   ? 'bg-[#F97516] text-white shadow-sm'
                                   : 'bg-white text-[#7C695C] hover:bg-[#FFF7ED] hover:text-[#F97516]' }}">
                        Nonaktif
                    </a>

                </div>


                <div class="relative lg:ml-auto lg:w-[380px]">

                    <svg class="absolute left-4 top-1/2 size-4
                               -translate-y-1/2 text-[#A28A7A]"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <circle cx="11" cy="11" r="7" />
                        <path d="m20 20-3.5-3.5" />

                    </svg>

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari penjual atau nama toko..."
                        class="h-11 w-full rounded-xl
                               border border-[#DFD2C7]
                               bg-white pl-11 pr-4
                               text-sm text-[#172554]
                               outline-none transition
                               placeholder:text-[#B3A195]
                               focus:border-[#F97516]
                               focus:ring-4 focus:ring-[#FFF7ED]">

                    @if (request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif

                </div>

            </form>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[950px]">

                    <thead class="bg-[#FFF7ED]">

                        <tr
                            class="text-left text-xs font-bold uppercase
                                   tracking-wide text-[#907A6C]">

                            <th class="px-5 py-4">Penjual</th>
                            <th class="px-5 py-4">Nama Toko</th>
                            <th class="px-5 py-4">WhatsApp</th>
                            <th class="px-5 py-4">Tanggal Daftar</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4 text-right">Aksi</th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-[#EEE5DE]">

                        @forelse ($sellers as $seller)
                            <tr class="text-sm transition
                                       hover:bg-[#FFF7ED]">

                                {{-- SELLER --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        @if ($seller->sellerProfile?->photo)
                                            <img src="{{ asset('storage/' . $seller->sellerProfile->photo) }}"
                                                alt="{{ $seller->name }}"
                                                class="size-11 rounded-xl
                                                       border border-[#E4D8CF]
                                                       object-cover">
                                        @else
                                            <div
                                                class="flex size-11 shrink-0
                                                       items-center justify-center
                                                       rounded-xl bg-[#F97516]
                                                       text-sm font-black
                                                       uppercase text-white">

                                                {{ strtoupper(substr($seller->name, 0, 1)) }}

                                            </div>
                                        @endif


                                        <div class="min-w-0">

                                            <p
                                                class="font-bold
                                                       text-[#172554]">
                                                {{ $seller->name }}
                                            </p>

                                            <p
                                                class="mt-0.5 max-w-[220px]
                                                       truncate text-xs
                                                       text-slate-500">
                                                {{ $seller->email }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- STORE --}}
                                <td
                                    class="px-5 py-4
                                           font-semibold text-[#172554]">

                                    {{ $seller->sellerProfile?->store_name ?? '-' }}

                                </td>


                                {{-- WHATSAPP --}}
                                <td class="px-5 py-4 text-slate-600">
                                    {{ $seller->sellerProfile?->whatsapp ?? '-' }}
                                </td>


                                {{-- CREATED --}}
                                <td class="px-5 py-4 text-slate-600">
                                    {{ $seller->created_at->format('d M Y') }}
                                </td>


                                {{-- STATUS --}}
                                <td class="px-5 py-4">

                                    @if ($seller->status === 'active')
                                        <span
                                            class="inline-flex items-center gap-2
                                                   rounded-full border border-[#D3DFCE]
                                                   bg-[#FFF7ED] px-3 py-1.5
                                                   text-xs font-bold text-[#65795E]">

                                            <span class="size-1.5 rounded-full bg-[#718268]"></span>

                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-2
                                                   rounded-full border border-[#ECD2CF]
                                                   bg-[#FFF7ED] px-3 py-1.5
                                                   text-xs font-bold text-[#F97516]">

                                            <span class="size-1.5 rounded-full bg-[#F97516]"></span>

                                            Nonaktif
                                        </span>
                                    @endif

                                </td>


                                {{-- ACTION --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center justify-end gap-1.5">

                                        <a href="{{ route('admin.sellers.show', $seller) }}" title="Lihat Detail"
                                            class="inline-flex size-9
                                                   items-center justify-center
                                                   rounded-xl text-[#8B7465]
                                                   transition hover:bg-[#FFF7ED]
                                                   hover:text-[#F97516]">

                                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">
                                                <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>

                                        </a>


                                        <a href="{{ route('admin.sellers.edit', $seller) }}" title="Edit Penjual"
                                            class="inline-flex size-9
                                                   items-center justify-center
                                                   rounded-xl text-[#A87A37]
                                                   transition hover:bg-[#FFF7ED]">

                                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">
                                                <path d="M12 20h9" />
                                                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z" />
                                            </svg>

                                        </a>


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
                                                class="inline-flex size-9
                                                       items-center justify-center
                                                       rounded-xl transition
                                                       {{ $seller->status === 'active' ? 'text-[#F97516] hover:bg-[#FFF7ED]' : 'text-[#65795E] hover:bg-[#FFF7ED]' }}">

                                                @if ($seller->status === 'active')
                                                    <svg class="size-4.5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.8">

                                                        <circle cx="12" cy="12" r="9" />
                                                        <path d="m7 7 10 10" />

                                                    </svg>
                                                @else
                                                    <svg class="size-4.5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">

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

                                <td colspan="6" class="px-6 py-16">

                                    <div class="text-center">

                                        <div
                                            class="mx-auto flex size-16
                                                   items-center justify-center
                                                   rounded-2xl bg-[#FFF7ED]
                                                   text-[#F97516]">

                                            <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.7">

                                                <path d="M4 10v10h16V10" />
                                                <path d="M3 10l2-6h14l2 6" />
                                                <path d="M8 20v-6h8v6" />

                                            </svg>

                                        </div>

                                        <p
                                            class="mt-4 font-bold
                                                   text-[#172554]">
                                            Belum ada penjual
                                        </p>

                                        <p
                                            class="mt-2 text-sm
                                                   text-slate-500">
                                            Tambahkan akun penjual pertama KampusMart.
                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            @if ($sellers->hasPages())
                <div class="border-t border-[#E7DBD1]
                           bg-[#FFF7ED] px-5 py-4">

                    {{ $sellers->links() }}

                </div>
            @endif

        </section>

    </div>

@endsection
