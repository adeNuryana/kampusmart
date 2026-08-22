@extends('layouts.seller')

@section('title', 'Produk Saya')

@section('content')

    <div class="mx-auto max-w-[1400px]">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section
            class="mb-6 flex flex-col gap-4
                   sm:flex-row sm:items-end
                   sm:justify-between">

            <div>

                <div
                    class="inline-flex items-center gap-2
                           rounded-full bg-[#FBEAE2]
                           px-3 py-1.5
                           text-xs font-bold
                           text-[#A95E43]">

                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                        <path d="M6 7h12l1 14H5L6 7Z" />
                        <path d="M9 7a3 3 0 0 1 6 0" />

                    </svg>

                    Manajemen Produk

                </div>


                <h1
                    class="mt-3 text-2xl
                           font-black tracking-tight
                           text-[#332B26]
                           lg:text-3xl">

                    Produk Saya

                </h1>


                <p
                    class="mt-2 max-w-2xl
                           text-sm leading-6
                           text-slate-500">

                    Kelola produk yang ditampilkan
                    kepada pembeli di KampusMart.

                </p>

            </div>


            <a href="{{ route('seller.products.create') }}"
                class="inline-flex h-11
                       items-center justify-center
                       gap-2 rounded-xl
                       bg-[#C8795A] px-5
                       text-sm font-bold
                       text-white shadow-sm
                       transition
                       hover:bg-[#B66F52]
                       hover:shadow-md">

                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                    <path d="M12 5v14" />
                    <path d="M5 12h14" />

                </svg>

                Tambah Produk

            </a>

        </section>



        {{-- ===================================================== --}}
        {{-- SUCCESS --}}
        {{-- ===================================================== --}}

        @if (session('success'))
            <div
                class="mb-5 flex items-start gap-3
                       rounded-2xl
                       border border-[#D3DFCE]
                       bg-[#EEF3EA]
                       px-4 py-3.5">

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

                    <p class="text-sm font-bold
                               text-[#65795E]">

                        Berhasil

                    </p>

                    <p class="mt-0.5 text-xs
                               text-[#65795E]">

                        {{ session('success') }}

                    </p>

                </div>

            </div>
        @endif



        {{-- ===================================================== --}}
        {{-- FILTER --}}
        {{-- ===================================================== --}}

        <section
            class="mb-5 overflow-hidden
                   rounded-3xl
                   border border-[#DFD2C7]
                   bg-white shadow-sm">

            <div class="border-b border-[#E7DBD1]
                       bg-[#FAF7F2]
                       px-5 py-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex size-9
                               items-center justify-center
                               rounded-xl
                               bg-[#FBEAE2]
                               text-[#A95E43]">

                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <path d="M4 6h16" />
                            <path d="M7 12h10" />
                            <path d="M10 18h4" />

                        </svg>

                    </div>


                    <div>

                        <p class="text-sm font-bold
                                   text-[#332B26]">

                            Filter Produk

                        </p>

                        <p class="mt-0.5 text-xs
                                   text-slate-500">

                            Cari berdasarkan nama, kategori, atau status.

                        </p>

                    </div>

                </div>

            </div>


            <form action="{{ route('seller.products.index') }}" method="GET" class="p-5">

                <div class="grid gap-4
                           md:grid-cols-2
                           xl:grid-cols-4">


                    {{-- SEARCH --}}
                    <div>

                        <label for="search"
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-[#4D4038]">

                            Cari Produk

                        </label>


                        <div class="relative">

                            <svg class="absolute left-4 top-1/2
                                       size-4 -translate-y-1/2
                                       text-[#A28A7A]"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                                <circle cx="11" cy="11" r="7" />
                                <path d="m20 20-3.5-3.5" />

                            </svg>


                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                placeholder="Nama produk..."
                                class="h-11 w-full
                                       rounded-xl border
                                       border-[#DFD2C7]
                                       bg-white pl-11 pr-4
                                       text-sm text-[#4D4038]
                                       outline-none transition
                                       placeholder:text-[#B3A195]
                                       focus:border-[#C8795A]
                                       focus:ring-4
                                       focus:ring-[#FBEAE2]">

                        </div>

                    </div>



                    {{-- CATEGORY --}}
                    <div>

                        <label for="category"
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-[#4D4038]">

                            Kategori

                        </label>


                        <select id="category" name="category"
                            class="h-11 w-full
                                   rounded-xl border
                                   border-[#DFD2C7]
                                   bg-white px-4
                                   text-sm text-[#4D4038]
                                   outline-none transition
                                   focus:border-[#C8795A]
                                   focus:ring-4
                                   focus:ring-[#FBEAE2]">

                            <option value="">
                                Semua Kategori
                            </option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>

                                    {{ $category->name }}

                                </option>
                            @endforeach

                        </select>

                    </div>



                    {{-- STATUS --}}
                    <div>

                        <label for="status"
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-[#4D4038]">

                            Status

                        </label>


                        <select id="status" name="status"
                            class="h-11 w-full
                                   rounded-xl border
                                   border-[#DFD2C7]
                                   bg-white px-4
                                   text-sm text-[#4D4038]
                                   outline-none transition
                                   focus:border-[#C8795A]
                                   focus:ring-4
                                   focus:ring-[#FBEAE2]">

                            <option value="">
                                Semua Status
                            </option>

                            <option value="active" @selected(request('status') === 'active')>

                                Aktif

                            </option>

                            <option value="inactive" @selected(request('status') === 'inactive')>

                                Nonaktif

                            </option>

                        </select>

                    </div>



                    {{-- ACTION --}}
                    <div class="flex items-end gap-2">

                        <button type="submit"
                            class="inline-flex h-11
                                   flex-1 items-center
                                   justify-center gap-2
                                   rounded-xl
                                   bg-[#6F4E37]
                                   px-5 text-sm
                                   font-bold text-white
                                   transition
                                   hover:bg-[#5B3B2B]">

                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                                <path d="M4 6h16" />
                                <path d="M7 12h10" />
                                <path d="M10 18h4" />

                            </svg>

                            Terapkan

                        </button>


                        <a href="{{ route('seller.products.index') }}" title="Reset Filter"
                            class="inline-flex size-11
                                   shrink-0 items-center
                                   justify-center
                                   rounded-xl border
                                   border-[#DFD2C7]
                                   bg-white
                                   text-[#8B7465]
                                   transition
                                   hover:bg-[#F5ECE6]
                                   hover:text-[#493124]">

                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                <path d="M3 12a9 9 0 1 0 3-6.7" />
                                <path d="M3 4v6h6" />

                            </svg>

                        </a>

                    </div>

                </div>

            </form>

        </section>



        {{-- ===================================================== --}}
        {{-- PRODUCT TABLE --}}
        {{-- ===================================================== --}}

        <section
            class="overflow-hidden
                   rounded-3xl border
                   border-[#DFD2C7]
                   bg-white shadow-sm">


            {{-- CARD HEADER --}}
            <div
                class="flex flex-col gap-2
                       border-b border-[#E7DBD1]
                       bg-[#FAF7F2]
                       px-5 py-4
                       sm:flex-row
                       sm:items-center
                       sm:justify-between">

                <div>

                    <h2 class="text-sm font-bold
                               text-[#332B26]">

                        Daftar Produk

                    </h2>

                    <p class="mt-0.5 text-xs
                               text-slate-500">

                        Semua produk yang kamu kelola.

                    </p>

                </div>


                <span
                    class="inline-flex w-fit
                           items-center rounded-full
                           bg-[#FBEAE2]
                           px-3 py-1.5
                           text-xs font-bold
                           text-[#A95E43]">

                    {{ number_format($products->total()) }}
                    produk

                </span>

            </div>



            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1000px]">

                    <thead class="bg-[#F8F3ED]">

                        <tr
                            class="text-left text-xs
                                   font-bold uppercase
                                   tracking-wide
                                   text-[#907A6C]">

                            <th class="px-5 py-4">
                                Produk
                            </th>

                            <th class="px-5 py-4">
                                Kategori
                            </th>

                            <th class="px-5 py-4">
                                Harga
                            </th>

                            <th class="px-5 py-4">
                                Stok
                            </th>

                            <th class="px-5 py-4">
                                Status
                            </th>

                            <th class="px-5 py-4">
                                Dibuat
                            </th>

                            <th class="px-5 py-4 text-right">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-[#EEE5DE]">

                        @forelse ($products as $product)
                            <tr class="text-sm transition
                                       hover:bg-[#FBF7F3]">


                                {{-- PRODUCT --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center
                                               gap-3">

                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="size-14
                                                       shrink-0
                                                       rounded-xl
                                                       border
                                                       border-[#E7DBD1]
                                                       object-cover">
                                        @else
                                            <div
                                                class="flex size-14
                                                       shrink-0
                                                       items-center
                                                       justify-center
                                                       rounded-xl
                                                       bg-[#FAF7F2]
                                                       text-[#A28A7A]">

                                                <svg class="size-6" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.6">

                                                    <rect x="3" y="3" width="18" height="18" rx="2" />

                                                    <circle cx="8.5" cy="8.5" r="1.5" />

                                                    <path d="m21 15-5-5L5 21" />

                                                </svg>

                                            </div>
                                        @endif


                                        <div class="min-w-0">

                                            <p
                                                class="max-w-[250px]
                                                       truncate
                                                       font-bold
                                                       text-[#332B26]">

                                                {{ $product->name }}

                                            </p>

                                            <p
                                                class="mt-1 text-xs
                                                       text-slate-400">

                                                ID #{{ $product->id }}

                                            </p>

                                        </div>

                                    </div>

                                </td>



                                {{-- CATEGORY --}}
                                <td class="px-5 py-4">

                                    <span
                                        class="inline-flex
                                               rounded-lg
                                               bg-[#F4EAE2]
                                               px-3 py-1.5
                                               text-xs font-semibold
                                               text-[#6F4E37]">

                                        {{ $product->category?->name ?? '-' }}

                                    </span>

                                </td>



                                {{-- PRICE --}}
                                <td class="px-5 py-4">

                                    <span
                                        class="whitespace-nowrap
                                               font-bold
                                               text-[#332B26]">

                                        Rp{{ number_format($product->price, 0, ',', '.') }}

                                    </span>

                                </td>



                                {{-- STOCK --}}
                                <td class="px-5 py-4">

                                    @if ($product->stock <= 0)
                                        <span
                                            class="inline-flex
                                                   items-center gap-2
                                                   rounded-full
                                                   border
                                                   border-[#ECD2CF]
                                                   bg-[#FAEDEC]
                                                   px-3 py-1.5
                                                   text-xs font-bold
                                                   text-[#A65954]">

                                            <span
                                                class="size-1.5
                                                       rounded-full
                                                       bg-[#A65954]">
                                            </span>

                                            Habis

                                        </span>
                                    @elseif ($product->stock <= 5)
                                        <span
                                            class="inline-flex
                                                   items-center gap-2
                                                   rounded-full
                                                   border
                                                   border-[#E8D8B9]
                                                   bg-[#FAF2DF]
                                                   px-3 py-1.5
                                                   text-xs font-bold
                                                   text-[#A87A37]">

                                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2">

                                                <path d="M12 8v5" />
                                                <path d="M12 17h.01" />

                                            </svg>

                                            {{ $product->stock }}
                                            tersisa

                                        </span>
                                    @else
                                        <span
                                            class="font-semibold
                                                   text-[#4D4038]">

                                            {{ $product->stock }}

                                        </span>
                                    @endif

                                </td>



                                {{-- STATUS --}}
                                <td class="px-5 py-4">

                                    @if ($product->status === 'active')
                                        <span
                                            class="inline-flex
                                                   items-center gap-2
                                                   rounded-full
                                                   border
                                                   border-[#D3DFCE]
                                                   bg-[#EEF3EA]
                                                   px-3 py-1.5
                                                   text-xs font-bold
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
                                                   items-center gap-2
                                                   rounded-full
                                                   border
                                                   border-[#ECD2CF]
                                                   bg-[#FAEDEC]
                                                   px-3 py-1.5
                                                   text-xs font-bold
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



                                {{-- DATE --}}
                                <td class="px-5 py-4">

                                    <p class="font-medium
                                               text-[#6F6259]">

                                        {{ $product->created_at->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') }}

                                    </p>

                                    <p class="mt-1 text-xs
                                               text-slate-400">

                                        {{ $product->created_at->timezone('Asia/Jakarta')->format('H:i') }}
                                        WIB

                                    </p>

                                </td>



                                {{-- ACTION --}}
                                <td class="px-5 py-4">

                                    <div
                                        class="flex items-center
                                               justify-end gap-1">


                                        {{-- EDIT --}}
                                        <a href="{{ route('seller.products.edit', $product) }}"
                                            title="Edit Produk"
                                            class="inline-flex
                                                   size-9 items-center
                                                   justify-center
                                                   rounded-xl
                                                   text-[#A95E43]
                                                   transition
                                                   hover:bg-[#FBEAE2]">

                                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1.8">

                                                <path d="M12 20h9" />

                                                <path d="M16.5 3.5
                                                           a2.1 2.1 0 0 1 3 3
                                                           L8 18l-4 1 1-4Z" />

                                            </svg>

                                        </a>



                                        {{-- STATUS --}}
                                        <form
                                            action="{{ route('seller.products.status', $product) }}"
                                            method="POST">

                                            @csrf
                                            @method('PATCH')


                                            <input type="hidden" name="status"
                                                value="{{ $product->status === 'active' ? 'inactive' : 'active' }}">


                                            <button type="submit"
                                                title="{{ $product->status === 'active' ? 'Nonaktifkan Produk' : 'Aktifkan Produk' }}"
                                                onclick="return confirm(
                                                    '{{ $product->status === 'active' ? 'Nonaktifkan produk ini?' : 'Aktifkan produk ini?' }}'
                                                )"
                                                class="inline-flex
                                                       size-9 items-center
                                                       justify-center
                                                       rounded-xl
                                                       transition
                                                       {{ $product->status === 'active' ? 'text-[#A87A37] hover:bg-[#FAF2DF]' : 'text-[#65795E] hover:bg-[#EEF3EA]' }}">

                                                @if ($product->status === 'active')
                                                    <svg class="size-4.5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.8">

                                                        <circle cx="12" cy="12" r="9" />

                                                        <path d="m8 8 8 8" />

                                                    </svg>
                                                @else
                                                    <svg class="size-4.5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">

                                                        <path d="m5 12 4 4 10-10" />

                                                    </svg>
                                                @endif

                                            </button>

                                        </form>



                                        {{-- DELETE --}}
                                        <form
                                            action="{{ route('seller.products.destroy', $product) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')


                                            <button type="submit"
                                                onclick="return confirm(
                                                    'Yakin ingin menghapus produk {{ $product->name }}?'
                                                )"
                                                title="Hapus Produk"
                                                class="inline-flex
                                                       size-9 items-center
                                                       justify-center
                                                       rounded-xl
                                                       text-[#A65954]
                                                       transition
                                                       hover:bg-[#FAEDEC]">

                                                <svg class="size-4.5" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.8">

                                                    <path d="M3 6h18" />
                                                    <path d="M8 6V4h8v2" />
                                                    <path d="M19 6 18 21H6L5 6" />
                                                    <path d="M10 11v5" />
                                                    <path d="M14 11v5" />

                                                </svg>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="7" class="px-6 py-16">

                                    <div class="text-center">

                                        <div
                                            class="mx-auto flex
                                                   size-16
                                                   items-center
                                                   justify-center
                                                   rounded-2xl
                                                   bg-[#FBEAE2]
                                                   text-[#A95E43]">

                                            <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.7">

                                                <path d="M6 7h12l1 14H5L6 7Z" />

                                                <path d="M9 7a3 3 0 0 1 6 0" />

                                            </svg>

                                        </div>


                                        <h3
                                            class="mt-4
                                                   font-bold
                                                   text-[#4D4038]">

                                            Belum ada produk

                                        </h3>


                                        <p
                                            class="mt-2 text-sm
                                                   text-slate-500">

                                            Tambahkan produk pertama
                                            untuk mulai berjualan di KampusMart.

                                        </p>


                                        <a href="{{ route('seller.products.create') }}"
                                            class="mt-5
                                                   inline-flex h-10
                                                   items-center
                                                   justify-center
                                                   gap-2
                                                   rounded-xl
                                                   bg-[#C8795A]
                                                   px-5
                                                   text-sm font-bold
                                                   text-white
                                                   transition
                                                   hover:bg-[#B66F52]">

                                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2">

                                                <path d="M12 5v14" />
                                                <path d="M5 12h14" />

                                            </svg>

                                            Tambah Produk

                                        </a>

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

            @if ($products->hasPages())
                <div
                    class="border-t
                           border-[#E7DBD1]
                           bg-[#FAF7F2]
                           px-5 py-4">

                    {{ $products->links() }}

                </div>
            @endif

        </section>

    </div>

@endsection
