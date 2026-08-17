@extends('layouts.admin')

@section('title', 'Produk')
@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-medium text-indigo-600">
                    Manajemen Produk
                </p>

                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                    Produk
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola seluruh produk yang terdaftar dari seller.
                </p>
            </div>

        </div>


        {{-- Statistik --}}
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <p class="text-sm font-medium text-slate-500">
                    Total Produk
                </p>

                <p class="mt-2 text-3xl font-bold text-slate-900">
                    {{ $products->total() }}
                </p>

            </div>

        </div>


        {{-- Filter --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <form action="{{ route('admin.products.index') }}" method="GET">

                <div class="grid gap-4 lg:grid-cols-12">

                    {{-- Search --}}
                    <div class="lg:col-span-5">

                        <label for="search" class="mb-2 block text-sm font-medium text-slate-700">
                            Cari Produk
                        </label>

                        <div class="relative">

                            <svg class="absolute left-4 top-1/2 size-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.8">
                                <circle cx="11" cy="11" r="7"></circle>
                                <path d="m20 20-3.5-3.5"></path>
                            </svg>

                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="Cari nama produk..."
                                class="w-full rounded-xl border border-slate-200
                                   py-3 pl-11 pr-4 text-sm
                                   outline-none transition
                                   focus:border-indigo-500
                                   focus:ring-4 focus:ring-indigo-500/10">

                        </div>

                    </div>


                    {{-- Kategori --}}
                    <div class="lg:col-span-3">

                        <label for="category" class="mb-2 block text-sm font-medium text-slate-700">
                            Kategori
                        </label>

                        <select name="category" id="category"
                            class="w-full rounded-xl border border-slate-200
                               bg-white px-4 py-3 text-sm
                               outline-none transition
                               focus:border-indigo-500
                               focus:ring-4 focus:ring-indigo-500/10">

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


                    {{-- Status --}}
                    <div class="lg:col-span-2">

                        <label for="status" class="mb-2 block text-sm font-medium text-slate-700">
                            Status
                        </label>

                        <select name="status" id="status"
                            class="w-full rounded-xl border border-slate-200
                               bg-white px-4 py-3 text-sm
                               outline-none transition
                               focus:border-indigo-500
                               focus:ring-4 focus:ring-indigo-500/10">

                            <option value="">
                                Semua
                            </option>

                            <option value="active" @selected(request('status') === 'active')>
                                Aktif
                            </option>

                            <option value="inactive" @selected(request('status') === 'inactive')>
                                Nonaktif
                            </option>

                        </select>

                    </div>


                    {{-- Button --}}
                    <div class="flex items-end gap-2 lg:col-span-2">

                        <button type="submit"
                            class="flex-1 rounded-xl bg-slate-900
                               px-4 py-3 text-sm font-semibold
                               text-white transition hover:bg-slate-800">
                            Filter
                        </button>

                        <a href="{{ route('admin.products.index') }}"
                            class="rounded-xl border border-slate-200
                               px-4 py-3 text-sm font-medium
                               text-slate-600 transition
                               hover:bg-slate-50">
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>


        {{-- Table --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="border-b border-slate-200 bg-slate-50">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Produk
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Seller
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Kategori
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Harga
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Stok
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($products as $product)
                            <tr class="transition hover:bg-slate-50">

                                {{-- Produk --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-4">

                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                                class="size-14 rounded-xl border border-slate-200 object-cover">
                                        @else
                                            <div class="flex size-14 items-center justify-center rounded-xl bg-slate-100">

                                                <svg class="size-6 text-slate-400" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.7">
                                                    <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                    <path d="m21 15-5-5L5 21"></path>
                                                </svg>

                                            </div>
                                        @endif

                                        <div>

                                            <p class="font-semibold text-slate-900">
                                                {{ $product->name }}
                                            </p>

                                            <p class="mt-1 text-xs text-slate-400">
                                                ID #{{ $product->id }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Seller --}}
                                <td class="px-6 py-4">

                                    <div>

                                        <p class="text-sm font-medium text-slate-800">
                                            {{ $product->user?->sellerProfile?->store_name ?? '-' }}
                                        </p>

                                        @if ($product->user?->email)
                                            <p class="mt-1 text-xs text-slate-400">
                                               {{ $product->user?->name ?? '-' }}
                                            </p>
                                        @endif

                                    </div>

                                </td>


                                {{-- Kategori --}}
                                <td class="px-6 py-4">

                                    <span
                                        class="inline-flex rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-medium text-slate-600">

                                        {{ $product->category->name ?? '-' }}

                                    </span>

                                </td>


                                {{-- Harga --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    <span class="font-semibold text-slate-900">

                                        Rp {{ number_format($product->price, 0, ',', '.') }}

                                    </span>

                                </td>


                                {{-- Stok --}}
                                <td class="px-6 py-4">

                                    @if ($product->stock <= 0)
                                        <span class="text-sm font-semibold text-red-600">
                                            Habis
                                        </span>
                                    @elseif ($product->stock <= 5)
                                        <span class="text-sm font-semibold text-amber-600">
                                            {{ $product->stock }}
                                        </span>
                                    @else
                                        <span class="text-sm font-medium text-slate-700">
                                            {{ $product->stock }}
                                        </span>
                                    @endif

                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-4">

                                    @if ($product->status === 'active')
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full
                                                 bg-emerald-50 px-3 py-1.5
                                                 text-xs font-semibold text-emerald-700">

                                            <span class="size-1.5 rounded-full bg-emerald-500"></span>

                                            Aktif

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full
                                                 bg-slate-100 px-3 py-1.5
                                                 text-xs font-semibold text-slate-600">

                                            <span class="size-1.5 rounded-full bg-slate-400"></span>

                                            Nonaktif

                                        </span>
                                    @endif

                                </td>


                                {{-- Aksi --}}
                                <td class="px-6 py-4 text-right">

                                    <button type="button"
                                        class="rounded-lg p-2 text-slate-400
                                           transition hover:bg-slate-100
                                           hover:text-slate-700">

                                        <svg class="size-5" viewBox="0 0 24 24" fill="currentColor">
                                            <circle cx="5" cy="12" r="1.5" />
                                            <circle cx="12" cy="12" r="1.5" />
                                            <circle cx="19" cy="12" r="1.5" />
                                        </svg>

                                    </button>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="px-6 py-16 text-center">

                                    <div class="mx-auto flex size-16 items-center justify-center rounded-2xl bg-slate-100">

                                        <svg class="size-8 text-slate-400" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path d="M6 7h12l1 14H5L6 7Z" />
                                            <path d="M9 7a3 3 0 0 1 6 0" />
                                        </svg>

                                    </div>

                                    <h3 class="mt-4 font-semibold text-slate-900">
                                        Belum ada produk
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Produk dari seller akan muncul di halaman ini.
                                    </p>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            @if ($products->hasPages())
                <div class="border-t border-slate-200 px-6 py-4">

                    {{ $products->links() }}

                </div>
            @endif

        </div>

    </div>

@endsection
