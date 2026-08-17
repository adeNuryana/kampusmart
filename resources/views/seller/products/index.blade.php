@extends('layouts.seller')

@section('title', 'Produk Saya')

@section('content')

<div class="mx-auto max-w-[1400px]">

    {{-- HEADER --}}
    <div
        class="mb-7 flex flex-col gap-4
               sm:flex-row sm:items-center
               sm:justify-between"
    >

        <div>

            <h1
                class="text-2xl font-bold
                       tracking-tight text-slate-900
                       lg:text-3xl"
            >
                Produk Saya
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Kelola produk yang ditampilkan di KampusMart.
            </p>

        </div>


        <a
            href="{{ route('seller.products.create') }}"
            class="inline-flex h-11
                   items-center justify-center
                   gap-2 rounded-xl
                   bg-violet-600 px-5
                   text-sm font-semibold
                   text-white transition
                   hover:bg-violet-700"
        >

            <span class="text-xl leading-none">
                +
            </span>

            Tambah Produk

        </a>

    </div>


    {{-- SUCCESS --}}
    @if (session('success'))

        <div
            class="mb-5 rounded-xl
                   border border-green-200
                   bg-green-50 px-4 py-3
                   text-sm text-green-700"
        >
            {{ session('success') }}
        </div>

    @endif


    {{-- FILTER --}}
    <div
        class="mb-5 rounded-2xl
               border border-slate-200
               bg-white p-5 shadow-sm"
    >

        <form
            action="{{ route('seller.products.index') }}"
            method="GET"
        >

            <div
                class="grid gap-4
                       md:grid-cols-2
                       xl:grid-cols-4"
            >

                {{-- SEARCH --}}
                <div>

                    <label
                        class="mb-2 block
                               text-sm font-medium
                               text-slate-700"
                    >
                        Cari Produk
                    </label>


                    <div class="relative">

                        <svg
                            class="absolute left-4
                                   top-1/2 size-5
                                   -translate-y-1/2
                                   text-slate-400"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <circle
                                cx="11"
                                cy="11"
                                r="7"
                            />

                            <path
                                d="m20 20-3.5-3.5"
                            />
                        </svg>


                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Nama produk..."
                            class="h-11 w-full
                                   rounded-xl border
                                   border-slate-200
                                   pl-11 pr-4
                                   text-sm outline-none
                                   focus:border-violet-400
                                   focus:ring-4
                                   focus:ring-violet-100"
                        >

                    </div>

                </div>


                {{-- CATEGORY --}}
                <div>

                    <label
                        class="mb-2 block
                               text-sm font-medium
                               text-slate-700"
                    >
                        Kategori
                    </label>


                    <select
                        name="category"
                        class="h-11 w-full
                               rounded-xl border
                               border-slate-200
                               bg-white px-4
                               text-sm outline-none
                               focus:border-violet-400
                               focus:ring-4
                               focus:ring-violet-100"
                    >

                        <option value="">
                            Semua Kategori
                        </option>


                        @foreach ($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                @selected(
                                    request('category')
                                    == $category->id
                                )
                            >
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- STATUS --}}
                <div>

                    <label
                        class="mb-2 block
                               text-sm font-medium
                               text-slate-700"
                    >
                        Status
                    </label>


                    <select
                        name="status"
                        class="h-11 w-full
                               rounded-xl border
                               border-slate-200
                               bg-white px-4
                               text-sm outline-none
                               focus:border-violet-400
                               focus:ring-4
                               focus:ring-violet-100"
                    >

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="active"
                            @selected(
                                request('status')
                                === 'active'
                            )
                        >
                            Aktif
                        </option>

                        <option
                            value="inactive"
                            @selected(
                                request('status')
                                === 'inactive'
                            )
                        >
                            Nonaktif
                        </option>

                    </select>

                </div>


                {{-- BUTTON --}}
                <div class="flex items-end gap-2">

                    <button
                        type="submit"
                        class="h-11 flex-1
                               rounded-xl
                               bg-slate-900
                               px-5 text-sm
                               font-semibold
                               text-white transition
                               hover:bg-slate-800"
                    >
                        Terapkan
                    </button>


                    <a
                        href="{{ route('seller.products.index') }}"
                        title="Reset"
                        class="inline-flex size-11
                               shrink-0 items-center
                               justify-center rounded-xl
                               border border-slate-200
                               text-slate-500
                               transition
                               hover:bg-slate-50"
                    >

                        <svg
                            class="size-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                d="M3 12a9 9 0 1 0
                                   3-6.7"
                            />

                            <path d="M3 4v6h6" />
                        </svg>

                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- TABLE --}}
    <div
        class="overflow-hidden
               rounded-2xl border
               border-slate-200
               bg-white shadow-sm"
    >

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1000px]">

                <thead class="bg-slate-50">

                    <tr
                        class="text-left text-xs
                               font-semibold uppercase
                               tracking-wide
                               text-slate-500"
                    >

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


                <tbody class="divide-y divide-slate-100">

                    @forelse ($products as $product)

                        <tr
                            class="text-sm transition
                                   hover:bg-slate-50/70"
                        >

                            {{-- PRODUCT --}}
                            <td class="px-5 py-4">

                                <div
                                    class="flex items-center
                                           gap-3"
                                >

                                    @if ($product->image)

                                        <img
                                            src="{{ asset(
                                                'storage/' .
                                                $product->image
                                            ) }}"
                                            alt="{{ $product->name }}"
                                            class="size-12
                                                   shrink-0
                                                   rounded-xl
                                                   object-cover"
                                        >

                                    @else

                                        <div
                                            class="flex size-12
                                                   shrink-0
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-slate-100"
                                        >

                                            <svg
                                                class="size-6
                                                       text-slate-300"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                            >
                                                <rect
                                                    x="3"
                                                    y="3"
                                                    width="18"
                                                    height="18"
                                                    rx="2"
                                                />

                                                <path
                                                    d="m21 15-5-5L5 21"
                                                />
                                            </svg>

                                        </div>

                                    @endif


                                    <div class="min-w-0">

                                        <p
                                            class="max-w-[250px]
                                                   truncate
                                                   font-semibold
                                                   text-slate-800"
                                        >
                                            {{ $product->name }}
                                        </p>

                                        <p
                                            class="mt-1
                                                   text-xs
                                                   text-slate-400"
                                        >
                                            ID #{{ $product->id }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- CATEGORY --}}
                            <td class="px-5 py-4 text-slate-600">

                                {{ $product->category?->name
                                    ?? '-' }}

                            </td>


                            {{-- PRICE --}}
                            <td class="px-5 py-4">

                                <span
                                    class="font-semibold
                                           text-slate-900"
                                >
                                    Rp {{ number_format(
                                        $product->price,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </span>

                            </td>


                            {{-- STOCK --}}
                            <td class="px-5 py-4">

                                @if ($product->stock === 0)

                                    <span
                                        class="inline-flex
                                               rounded-lg
                                               bg-red-50
                                               px-2.5 py-1
                                               text-xs
                                               font-semibold
                                               text-red-600"
                                    >
                                        Habis
                                    </span>

                                @elseif ($product->stock <= 5)

                                    <span
                                        class="inline-flex
                                               rounded-lg
                                               bg-amber-50
                                               px-2.5 py-1
                                               text-xs
                                               font-semibold
                                               text-amber-700"
                                    >
                                        {{ $product->stock }}
                                    </span>

                                @else

                                    <span
                                        class="font-medium
                                               text-slate-700"
                                    >
                                        {{ $product->stock }}
                                    </span>

                                @endif

                            </td>


                            {{-- STATUS --}}
                            <td class="px-5 py-4">

                                @if ($product->status === 'active')

                                    <span
                                        class="inline-flex
                                               rounded-full
                                               bg-green-50
                                               px-3 py-1.5
                                               text-xs
                                               font-semibold
                                               text-green-700"
                                    >
                                        Aktif
                                    </span>

                                @else

                                    <span
                                        class="inline-flex
                                               rounded-full
                                               bg-slate-100
                                               px-3 py-1.5
                                               text-xs
                                               font-semibold
                                               text-slate-600"
                                    >
                                        Nonaktif
                                    </span>

                                @endif

                            </td>


                            {{-- DATE --}}
                            <td class="px-5 py-4 text-slate-500">

                                {{ $product->created_at
                                    ->format('d M Y') }}

                            </td>


                            {{-- ACTION --}}
                            <td class="px-5 py-4">

                                <div
                                    class="flex
                                           items-center
                                           justify-end
                                           gap-1"
                                >

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route(
                                            'seller.products.edit',
                                            $product
                                        ) }}"
                                        title="Edit Produk"
                                        class="inline-flex
                                               size-9
                                               items-center
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
                                                d="M12 20h9"
                                            />

                                            <path
                                                d="M16.5 3.5
                                                   a2.1 2.1 0 0 1
                                                   3 3L8 18
                                                   l-4 1 1-4Z"
                                            />
                                        </svg>

                                    </a>


                                    {{-- STATUS --}}
                                    <form
                                        action="{{ route(
                                            'seller.products.status',
                                            $product
                                        ) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('PATCH')


                                        <input
                                            type="hidden"
                                            name="status"
                                            value="{{
                                                $product->status
                                                === 'active'
                                                    ? 'inactive'
                                                    : 'active'
                                            }}"
                                        >


                                        <button
                                            type="submit"
                                            title="{{
                                                $product->status
                                                === 'active'
                                                    ? 'Nonaktifkan'
                                                    : 'Aktifkan'
                                            }}"
                                            class="inline-flex
                                                   size-9
                                                   items-center
                                                   justify-center
                                                   rounded-lg
                                                   text-slate-500
                                                   transition
                                                   hover:bg-amber-50
                                                   hover:text-amber-600"
                                        >

                                            @if ($product->status === 'active')

                                                <svg
                                                    class="size-5"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="9"
                                                    />

                                                    <path
                                                        d="m8 8 8 8"
                                                    />
                                                </svg>

                                            @else

                                                <svg
                                                    class="size-5"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                >
                                                    <path
                                                        d="m5 12 4 4
                                                           10-10"
                                                    />
                                                </svg>

                                            @endif

                                        </button>

                                    </form>


                                    {{-- DELETE --}}
                                    <form
                                        action="{{ route(
                                            'seller.products.destroy',
                                            $product
                                        ) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            onclick="return confirm(
                                                'Hapus produk ini?'
                                            )"
                                            title="Hapus Produk"
                                            class="inline-flex
                                                   size-9
                                                   items-center
                                                   justify-center
                                                   rounded-lg
                                                   text-slate-500
                                                   transition
                                                   hover:bg-red-50
                                                   hover:text-red-600"
                                        >

                                            <svg
                                                class="size-5"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path
                                                    d="M3 6h18"
                                                />

                                                <path
                                                    d="M8 6V4h8v2"
                                                />

                                                <path
                                                    d="M19 6
                                                       18 21H6
                                                       L5 6"
                                                />

                                                <path
                                                    d="M10 11v5"
                                                />

                                                <path
                                                    d="M14 11v5"
                                                />
                                            </svg>

                                        </button>

                                    </form>

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

                                <div
                                    class="mx-auto
                                           flex size-16
                                           items-center
                                           justify-center
                                           rounded-2xl
                                           bg-slate-100"
                                >

                                    <svg
                                        class="size-8
                                               text-slate-400"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                    >
                                        <path
                                            d="M6 7h12l1 14H5L6 7Z"
                                        />

                                        <path
                                            d="M9 7
                                               a3 3 0 0 1
                                               6 0"
                                        />
                                    </svg>

                                </div>


                                <h3
                                    class="mt-4
                                           font-semibold
                                           text-slate-800"
                                >
                                    Belum ada produk
                                </h3>


                                <p
                                    class="mt-1
                                           text-sm
                                           text-slate-500"
                                >
                                    Tambahkan produk pertama untuk mulai berjualan.
                                </p>


                                <a
                                    href="{{ route(
                                        'seller.products.create'
                                    ) }}"
                                    class="mt-5
                                           inline-flex
                                           h-10
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-violet-600
                                           px-4
                                           text-sm
                                           font-semibold
                                           text-white
                                           hover:bg-violet-700"
                                >
                                    Tambah Produk
                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if ($products->hasPages())

            <div
                class="border-t
                       border-slate-200
                       px-5 py-4"
            >
                {{ $products->links() }}
            </div>

        @endif

    </div>

</div>

@endsection
