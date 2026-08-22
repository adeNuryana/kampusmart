@extends('layouts.admin')

@section('title', 'Kategori Produk')

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
                           rounded-full bg-[#F4EAE2]
                           px-3 py-1.5
                           text-xs font-bold text-[#6F4E37]">

                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                        <rect x="3" y="3" width="7" height="7" rx="1.5" />
                        <circle cx="17.5" cy="6.5" r="3.5" />
                        <path d="m7 14-4 7h8l-4-7Z" />
                        <rect x="14" y="14" width="7" height="7" rx="1.5" />

                    </svg>

                    Manajemen Kategori

                </div>


                <h1
                    class="mt-3 text-2xl
                           font-black tracking-tight
                           text-[#332B26]
                           lg:text-3xl">

                    Kategori Produk

                </h1>


                <p
                    class="mt-2 max-w-2xl
                           text-sm leading-6
                           text-slate-500">

                    Kelola kategori yang digunakan seller untuk
                    mengelompokkan produk di KampusMart.

                </p>

            </div>


            <a href="{{ route('admin.categories.create') }}"
                class="inline-flex h-11
                       items-center justify-center
                       gap-2 rounded-xl
                       bg-[#6F4E37] px-5
                       text-sm font-bold text-white
                       shadow-sm transition
                       hover:bg-[#5B3B2B]
                       hover:shadow-md">

                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                    <path d="M12 5v14" />
                    <path d="M5 12h14" />

                </svg>

                Tambah Kategori

            </a>

        </section>


        {{-- ===================================================== --}}
        {{-- ALERT SUCCESS --}}
        {{-- ===================================================== --}}

        @if (session('success'))
            <div
                class="mb-5 flex items-start gap-3
                       rounded-2xl border border-[#D3DFCE]
                       bg-[#EEF3EA] px-4 py-3.5
                       text-[#65795E]">

                <div
                    class="flex size-8 shrink-0
                           items-center justify-center
                           rounded-lg bg-[#718268]
                           text-white">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <path d="m5 12 4 4L19 6" />

                    </svg>

                </div>

                <div>
                    <p class="text-sm font-bold">
                        Berhasil
                    </p>

                    <p class="mt-0.5 text-xs">
                        {{ session('success') }}
                    </p>
                </div>

            </div>
        @endif


        {{-- ===================================================== --}}
        {{-- ALERT ERROR --}}
        {{-- ===================================================== --}}

        @if (session('error'))
            <div
                class="mb-5 flex items-start gap-3
                       rounded-2xl border border-[#ECD2CF]
                       bg-[#FAEDEC] px-4 py-3.5
                       text-[#A65954]">

                <div
                    class="flex size-8 shrink-0
                           items-center justify-center
                           rounded-lg bg-[#A65954]
                           text-white">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <circle cx="12" cy="12" r="9" />
                        <path d="M12 8v5" />
                        <path d="M12 17h.01" />

                    </svg>

                </div>

                <div>
                    <p class="text-sm font-bold">
                        Gagal
                    </p>

                    <p class="mt-0.5 text-xs">
                        {{ session('error') }}
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


            {{-- SEARCH --}}
            <form action="{{ route('admin.categories.index') }}" method="GET"
                class="flex flex-col gap-4
                       border-b border-[#E7DBD1]
                       bg-[#FAF7F2] p-5
                       sm:flex-row
                       sm:items-center
                       sm:justify-between">


                <div class="relative w-full sm:max-w-sm">

                    <svg class="absolute left-4 top-1/2
                               size-4 -translate-y-1/2
                               text-[#A28A7A]"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <circle cx="11" cy="11" r="7" />
                        <path d="m20 20-3.5-3.5" />

                    </svg>


                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..."
                        class="h-11 w-full
                               rounded-xl border
                               border-[#DFD2C7]
                               bg-white pl-11 pr-4
                               text-sm text-[#4D4038]
                               outline-none transition
                               placeholder:text-[#B3A195]
                               focus:border-[#A97957]
                               focus:ring-4
                               focus:ring-[#F1E6DE]">

                </div>


                <div class="flex gap-2">

                    <button type="submit"
                        class="inline-flex h-11
                               items-center justify-center
                               gap-2 rounded-xl
                               bg-[#6F4E37] px-5
                               text-sm font-bold
                               text-white transition
                               hover:bg-[#5B3B2B]">

                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                            <circle cx="11" cy="11" r="7" />
                            <path d="m20 20-3.5-3.5" />

                        </svg>

                        Cari

                    </button>


                    @if (request('search'))
                        <a href="{{ route('admin.categories.index') }}" title="Reset"
                            class="inline-flex size-11
                                   items-center justify-center
                                   rounded-xl border
                                   border-[#DFD2C7]
                                   bg-white text-[#8B7465]
                                   transition
                                   hover:bg-[#F3EAE3]
                                   hover:text-[#493124]">

                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                <path d="M4 4v6h6" />
                                <path d="M5.5 15a7.5 7.5 0 1 0 .5-7.5L4 10" />

                            </svg>

                        </a>
                    @endif

                </div>

            </form>


            {{-- ================================================= --}}
            {{-- TABLE --}}
            {{-- ================================================= --}}

            <div class="overflow-x-auto">

                <table class="w-full min-w-[800px]">

                    <thead class="bg-[#F8F3ED]">

                        <tr
                            class="text-left text-xs
                                   font-bold uppercase
                                   tracking-wide text-[#907A6C]">

                            <th class="px-5 py-4">
                                Icon
                            </th>

                            <th class="px-5 py-4">
                                Nama Kategori
                            </th>

                            <th class="px-5 py-4">
                                Jumlah Produk
                            </th>

                            <th class="px-5 py-4">
                                Status
                            </th>

                            <th class="px-5 py-4 text-right">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-[#EEE5DE]">

                        @forelse ($categories as $category)
                            <tr class="text-sm transition
                                       hover:bg-[#FBF7F3]">


                                {{-- ICON --}}
                                <td class="px-5 py-4">

                                    <div
                                        class="flex size-11
                                               items-center justify-center
                                               rounded-xl
                                               bg-[#F4EAE2]
                                               text-xl">

                                        @switch($category->icon)
                                            @case('food')
                                                🍴
                                            @break

                                            @case('drink')
                                                ☕
                                            @break

                                            @case('book')
                                                📚
                                            @break

                                            @case('electronic')
                                                💻
                                            @break

                                            @case('fashion')
                                                👕
                                            @break

                                            @case('service')
                                                🛠
                                            @break

                                            @default
                                                <svg class="size-5 text-[#6F4E37]" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.8">

                                                    <rect x="4" y="4" width="6" height="6" rx="1" />
                                                    <rect x="14" y="4" width="6" height="6" rx="1" />
                                                    <rect x="4" y="14" width="6" height="6" rx="1" />
                                                    <rect x="14" y="14" width="6" height="6" rx="1" />

                                                </svg>
                                        @endswitch

                                    </div>

                                </td>


                                {{-- NAME --}}
                                <td class="px-5 py-4">

                                    <p class="font-bold
                                               text-[#332B26]">

                                        {{ $category->name }}

                                    </p>

                                    <p
                                        class="mt-1
                                               font-mono
                                               text-xs
                                               text-slate-400">

                                        {{ $category->slug }}

                                    </p>

                                </td>


                                {{-- PRODUCT COUNT --}}
                                <td class="px-5 py-4">

                                    <span
                                        class="inline-flex
                                               items-center gap-2
                                               rounded-lg
                                               bg-[#FAF7F2]
                                               px-3 py-1.5
                                               text-xs font-semibold
                                               text-[#6F6259]">

                                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.8">

                                            <path d="M6 7h12l1 14H5L6 7Z" />
                                            <path d="M9 7a3 3 0 0 1 6 0" />

                                        </svg>

                                        {{ $category->products_count }}
                                        produk

                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td class="px-5 py-4">

                                    @if ($category->status === 'active')
                                        <span
                                            class="inline-flex items-center
                                                   gap-2 rounded-full
                                                   border border-[#D3DFCE]
                                                   bg-[#EEF3EA]
                                                   px-3 py-1.5
                                                   text-xs font-bold
                                                   text-[#65795E]">

                                            <span
                                                class="size-1.5 rounded-full
                                                       bg-[#718268]">
                                            </span>

                                            Aktif

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center
                                                   gap-2 rounded-full
                                                   border border-[#ECD2CF]
                                                   bg-[#FAEDEC]
                                                   px-3 py-1.5
                                                   text-xs font-bold
                                                   text-[#A65954]">

                                            <span
                                                class="size-1.5 rounded-full
                                                       bg-[#A65954]">
                                            </span>

                                            Nonaktif

                                        </span>
                                    @endif

                                </td>


                                {{-- ACTION --}}
                                <td class="px-5 py-4">

                                    <div
                                        class="flex items-center
                                               justify-end gap-1.5">

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.categories.edit', $category) }}" title="Edit kategori"
                                            class="inline-flex size-9
                                                   items-center justify-center
                                                   rounded-xl
                                                   text-[#A87A37]
                                                   transition
                                                   hover:bg-[#FAF2DF]">

                                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1.8">

                                                <path d="M12 20h9" />

                                                <path d="M16.5 3.5
                                                           a2.1 2.1 0 0 1 3 3
                                                           L8 18l-4 1 1-4Z" />

                                            </svg>

                                        </a>


                                        {{-- STATUS --}}
                                        <form action="{{ route('admin.categories.status', $category) }}" method="POST">

                                            @csrf
                                            @method('PATCH')


                                            <button type="submit"
                                                title="{{ $category->status === 'active' ? 'Nonaktifkan kategori' : 'Aktifkan kategori' }}"
                                                onclick="return confirm(
                                                    '{{ $category->status === 'active' ? 'Nonaktifkan kategori ini?' : 'Aktifkan kategori ini?' }}'
                                                )"
                                                class="inline-flex size-9
                                                       items-center justify-center
                                                       rounded-xl transition
                                                       {{ $category->status === 'active' ? 'text-[#A65954] hover:bg-[#FAEDEC]' : 'text-[#65795E] hover:bg-[#EEF3EA]' }}">

                                                @if ($category->status === 'active')
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


                                        {{-- DELETE --}}
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">

                                            @csrf
                                            @method('DELETE')


                                            <button type="submit" title="Hapus kategori"
                                                onclick="return confirm(
                                                    'Yakin ingin menghapus kategori {{ $category->name }}?'
                                                )"
                                                class="inline-flex size-9
                                                       items-center justify-center
                                                       rounded-xl
                                                       text-[#A65954]
                                                       transition
                                                       hover:bg-[#FAEDEC]">

                                                <svg class="size-4.5" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.8">

                                                    <path d="M4 7h16" />
                                                    <path d="M10 11v6" />
                                                    <path d="M14 11v6" />
                                                    <path d="M6 7l1 14h10l1-14" />
                                                    <path d="M9 7V4h6v3" />

                                                </svg>

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
                                                class="mx-auto flex size-16
                                                   items-center justify-center
                                                   rounded-2xl
                                                   bg-[#F4EAE2]
                                                   text-[#6F4E37]">

                                                <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.7">

                                                    <rect x="3" y="3" width="7" height="7" />
                                                    <circle cx="17.5" cy="6.5" r="3.5" />
                                                    <path d="m7 14-4 7h8l-4-7Z" />
                                                    <rect x="14" y="14" width="7" height="7" />

                                                </svg>

                                            </div>


                                            <p
                                                class="mt-4 font-bold
                                                   text-[#4D4038]">

                                                Belum ada kategori

                                            </p>


                                            <p
                                                class="mt-2 text-sm
                                                   text-slate-500">

                                                Tambahkan kategori pertama
                                                untuk produk KampusMart.

                                            </p>


                                            <a href="{{ route('admin.categories.create') }}"
                                                class="mt-5 inline-flex
                                                   h-10 items-center
                                                   justify-center gap-2
                                                   rounded-xl
                                                   bg-[#6F4E37]
                                                   px-5 text-sm
                                                   font-bold text-white
                                                   hover:bg-[#5B3B2B]">

                                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">

                                                    <path d="M12 5v14" />
                                                    <path d="M5 12h14" />

                                                </svg>

                                                Tambah Kategori

                                            </a>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- PAGINATION --}}
                @if ($categories->hasPages())
                    <div
                        class="border-t border-[#E7DBD1]
                           bg-[#FAF7F2]
                           px-5 py-4">

                        {{ $categories->links() }}

                    </div>
                @endif

            </section>

        </div>

    @endsection
