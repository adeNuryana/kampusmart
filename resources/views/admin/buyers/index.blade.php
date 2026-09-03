@extends('layouts.admin')

@section('title', 'Kelola Pembeli')

@section('content')

    <div class="mx-auto max-w-[1400px]">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section
            class="mb-6
                   flex
                   flex-col
                   gap-4
                   sm:flex-row
                   sm:items-center
                   sm:justify-between">

            <div>

                <div
                    class="inline-flex
                           items-center
                           gap-2
                           rounded-full
                           bg-[#F1E6DE]
                           px-3
                           py-1.5
                           text-xs
                           font-bold
                           text-[#4371d1]">

                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                        <circle cx="9" cy="8" r="3" />
                        <path d="M3 20c0-4 2.7-7 6-7s6 3 6 7" />
                        <path d="M16 4.5a3 3 0 0 1 0 5.5" />
                        <path d="M17 13c2.4.7 4 3.2 4 6" />

                    </svg>

                    Manajemen Pengguna

                </div>

                <h1
                    class="mt-3
                           text-2xl
                           font-black
                           tracking-tight
                           text-[#332B26]
                           lg:text-3xl">

                    Kelola Pembeli

                </h1>

                <p class="mt-2
                           text-sm
                           text-slate-500">

                    Kelola akun pembeli yang terdaftar
                    di KampusMart.

                </p>

            </div>


            {{-- ADD BUYER --}}

            <a href="{{ route('admin.buyers.create') }}"
                class="inline-flex
                       h-11
                       items-center
                       justify-center
                       gap-2
                       rounded-xl
                       bg-[#4371d1]
                       px-5
                       text-sm
                       font-bold
                       text-white
                       shadow-sm
                       transition
                       hover:bg-[#0a1d45]
                       hover:shadow-md">

                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                    <path d="M12 5v14" />
                    <path d="M5 12h14" />

                </svg>

                Tambah Pembeli

            </a>

        </section>



        {{-- ===================================================== --}}
        {{-- SUCCESS ALERT --}}
        {{-- ===================================================== --}}

        @if (session('success'))
            <div
                class="mb-5
                       flex
                       items-start
                       gap-3
                       rounded-2xl
                       border
                       border-[#D3DFCE]
                       bg-[#EEF3EA]
                       px-4
                       py-3.5
                       text-sm
                       text-[#65795E]">

                <div
                    class="flex
                           size-8
                           shrink-0
                           items-center
                           justify-center
                           rounded-lg
                           bg-[#718268]
                           text-white">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <path d="m5 12 4 4L19 6" />

                    </svg>

                </div>

                <div class="pt-1">

                    <p class="font-semibold">
                        Berhasil
                    </p>

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
            class="overflow-hidden
                   rounded-3xl
                   border
                   border-[#DFD2C7]
                   bg-white
                   shadow-sm">


            {{-- ================================================= --}}
            {{-- FILTER --}}
            {{-- ================================================= --}}

            <form method="GET" action="{{ route('admin.buyers.index') }}"
                class="flex
                       flex-col
                       gap-4
                       border-b
                       border-[#E7DBD1]
                       bg-[#FAF7F2]
                       p-5
                       lg:flex-row
                       lg:items-center">


                {{-- STATUS --}}

                <div class="flex
                           flex-wrap
                           gap-2">


                    <a href="{{ route('admin.buyers.index') }}"
                        class="rounded-xl
                               px-4
                               py-2
                               text-sm
                               font-semibold
                               transition
                               {{ !request('status')
                                   ? 'bg-[#4371d1] text-white shadow-sm'
                                   : 'bg-white text-[#7C695C] hover:bg-[#F1E6DE] hover:text-[#4371d1]' }}">

                        Semua

                    </a>


                    <a href="{{ route('admin.buyers.index', ['status' => 'active']) }}"
                        class="rounded-xl
                               px-4
                               py-2
                               text-sm
                               font-semibold
                               transition
                               {{ request('status') === 'active'
                                   ? 'bg-[#718268] text-white shadow-sm'
                                   : 'bg-white text-[#7C695C] hover:bg-[#EEF3EA] hover:text-[#65795E]' }}">

                        Aktif

                    </a>


                    <a href="{{ route('admin.buyers.index', ['status' => 'inactive']) }}"
                        class="rounded-xl
                               px-4
                               py-2
                               text-sm
                               font-semibold
                               transition
                               {{ request('status') === 'inactive'
                                   ? 'bg-[#A65954] text-white shadow-sm'
                                   : 'bg-white text-[#7C695C] hover:bg-[#FAEDEC] hover:text-[#A65954]' }}">

                        Nonaktif

                    </a>

                </div>



                {{-- SEARCH --}}

                <div class="relative
                           lg:ml-auto
                           lg:w-[380px]">

                    <svg class="absolute
                               left-4
                               top-1/2
                               size-4
                               -translate-y-1/2
                               text-[#A28A7A]"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <circle cx="11" cy="11" r="7" />
                        <path d="m20 20-3.5-3.5" />

                    </svg>


                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, email, atau telepon..."
                        class="h-11
                               w-full
                               rounded-xl
                               border
                               border-[#DFD2C7]
                               bg-white
                               pl-11
                               pr-4
                               text-sm
                               text-[#4D4038]
                               outline-none
                               transition
                               placeholder:text-[#B3A195]
                               focus:border-[#A97957]
                               focus:ring-4
                               focus:ring-[#F1E6DE]">


                    @if (request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif

                </div>

            </form>



            {{-- ================================================= --}}
            {{-- TABLE --}}
            {{-- ================================================= --}}

            <div class="overflow-x-auto">

                <table class="w-full min-w-[900px]">

                    <thead class="bg-[#F8F3ED]">

                        <tr
                            class="text-left
                                   text-xs
                                   font-bold
                                   uppercase
                                   tracking-wide
                                   text-[#907A6C]">

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


                    <tbody class="divide-y
                               divide-[#EEE5DE]">

                        @forelse ($buyers as $buyer)
                            <tr
                                class="text-sm
                                       transition
                                       hover:bg-[#FBF7F3]">


                                {{-- BUYER --}}

                                <td class="px-5 py-4">

                                    <div
                                        class="flex
                                               items-center
                                               gap-3">


                                        <div
                                            class="flex
                                                   size-11
                                                   shrink-0
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-[#4371d1]
                                                   text-sm
                                                   font-black
                                                   uppercase
                                                   text-white">

                                            {{ strtoupper(substr($buyer->name, 0, 1)) }}

                                        </div>


                                        <div class="min-w-0">

                                            <p
                                                class="font-bold
                                                       text-[#332B26]">

                                                {{ $buyer->name }}

                                            </p>

                                            <p
                                                class="mt-0.5
                                                       max-w-[240px]
                                                       truncate
                                                       text-xs
                                                       text-slate-500">

                                                {{ $buyer->email }}

                                            </p>

                                        </div>

                                    </div>

                                </td>



                                {{-- PHONE --}}

                                <td
                                    class="px-5
                                           py-4
                                           text-slate-600">

                                    {{ $buyer->phone ?? '-' }}

                                </td>



                                {{-- CREATED --}}

                                <td
                                    class="px-5
                                           py-4
                                           text-slate-600">

                                    {{ $buyer->created_at->format('d M Y') }}

                                </td>



                                {{-- STATUS --}}

                                <td class="px-5 py-4">

                                    @if ($buyer->status === 'active')
                                        <span
                                            class="inline-flex
                                                   items-center
                                                   gap-2
                                                   rounded-full
                                                   border
                                                   border-[#D3DFCE]
                                                   bg-[#EEF3EA]
                                                   px-3
                                                   py-1.5
                                                   text-xs
                                                   font-bold
                                                   text-[#65795E]">

                                            <span
                                                class="size-1.5
                                                       rounded-full
                                                       bg-[#718268]">
                                            </span>

                                            Aktif

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex
                                                   items-center
                                                   gap-2
                                                   rounded-full
                                                   border
                                                   border-[#ECD2CF]
                                                   bg-[#FAEDEC]
                                                   px-3
                                                   py-1.5
                                                   text-xs
                                                   font-bold
                                                   text-[#A65954]">

                                            <span
                                                class="size-1.5
                                                       rounded-full
                                                       bg-[#A65954]">
                                            </span>

                                            Nonaktif

                                        </span>
                                    @endif

                                </td>



                                {{-- ACTION --}}

                                <td class="px-5 py-4">

                                    <div
                                        class="flex
                                               items-center
                                               justify-end
                                               gap-1.5">


                                        {{-- DETAIL --}}

                                        <a href="{{ route('admin.buyers.show', $buyer) }}" title="Lihat Detail"
                                            class="inline-flex
                                                   size-9
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   text-[#8B7465]
                                                   transition
                                                   hover:bg-[#F1E6DE]
                                                   hover:text-[#4371d1]">

                                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path d="M2 12s3.5-6 10-6
                                                           10 6 10 6-3.5 6-10 6
                                                           S2 12 2 12Z" />

                                                <circle cx="12" cy="12" r="3" />

                                            </svg>

                                        </a>



                                        {{-- EDIT --}}

                                        <a href="{{ route('admin.buyers.edit', $buyer) }}" title="Edit Pembeli"
                                            class="inline-flex
                                                   size-9
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   text-[#A87A37]
                                                   transition
                                                   hover:bg-[#FAF2DF]">

                                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
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
                                                class="inline-flex
                                                       size-9
                                                       items-center
                                                       justify-center
                                                       rounded-xl
                                                       transition
                                                       {{ $buyer->status === 'active' ? 'text-[#A65954] hover:bg-[#FAEDEC]' : 'text-[#65795E] hover:bg-[#EEF3EA]' }}">


                                                @if ($buyer->status === 'active')
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

                                <td colspan="5" class="px-6 py-16">

                                    <div class="text-center">


                                        <div
                                            class="mx-auto
                                                   flex
                                                   size-16
                                                   items-center
                                                   justify-center
                                                   rounded-2xl
                                                   bg-[#F1E6DE]
                                                   text-[#4371d1]">

                                            <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.7">

                                                <circle cx="12" cy="8" r="4" />

                                                <path d="M4 21a8 8 0 0 1 16 0" />

                                            </svg>

                                        </div>


                                        <p
                                            class="mt-4
                                                   font-bold
                                                   text-[#4D4038]">

                                            Belum ada pembeli

                                        </p>


                                        <p
                                            class="mt-2
                                                   text-sm
                                                   text-slate-500">

                                            Akun pembeli yang mendaftar
                                            akan muncul di sini.

                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>



            {{-- ================================================= --}}
            {{-- PAGINATION --}}
            {{-- ================================================= --}}

            @if ($buyers->hasPages())
                <div
                    class="border-t
                           border-[#E7DBD1]
                           bg-[#FAF7F2]
                           px-5
                           py-4">

                    {{ $buyers->links() }}

                </div>
            @endif

        </section>

    </div>

@endsection
