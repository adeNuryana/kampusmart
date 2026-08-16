@extends('layouts.admin')

@section('title', 'Kategori Produk')

@section('content')

    <div class="mx-auto max-w-[1400px]">

        {{-- HEADER --}}
        <div
            class="mb-7 flex flex-col gap-4
               sm:flex-row
               sm:items-center
               sm:justify-between">

            <div>

                <h1
                    class="text-2xl font-bold
                       tracking-tight
                       text-slate-900
                       lg:text-3xl">
                    Kategori Produk
                </h1>

                <p class="mt-2 text-sm
                       text-slate-500">
                    Kelola kategori yang digunakan
                    untuk mengelompokkan produk KampusMart.
                </p>

            </div>


            <a href="{{ route('admin.categories.create') }}"
                class="inline-flex h-11
                   items-center justify-center
                   gap-2 rounded-xl
                   bg-violet-600 px-5
                   text-sm font-semibold
                   text-white transition
                   hover:bg-violet-700">
                <span class="text-xl">
                    +
                </span>

                Tambah Kategori
            </a>

        </div>


        {{-- SUCCESS --}}
        @if (session('success'))
            <div
                class="mb-5 rounded-xl
                   border border-green-200
                   bg-green-50 px-4 py-3
                   text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div
                class="mb-5 rounded-xl
               border border-red-200
               bg-red-50 px-4 py-3
               text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <section
            class="overflow-hidden
               rounded-2xl
               border border-slate-200
               bg-white shadow-sm">

            {{-- SEARCH --}}
            <form action="{{ route('admin.categories.index') }}" method="GET"
                class="flex flex-col gap-4
                   border-b border-slate-200
                   p-5
                   sm:flex-row
                   sm:items-center
                   sm:justify-between">

                <div class="relative w-full
                       sm:max-w-sm">

                    <svg class="absolute left-4
                           top-1/2 size-5
                           -translate-y-1/2
                           text-slate-400"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="7" />

                        <path d="m20 20-3.5-3.5" />
                    </svg>


                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..."
                        class="h-11 w-full
                           rounded-xl
                           border border-slate-200
                           bg-white
                           pl-11 pr-4
                           text-sm
                           outline-none
                           transition
                           focus:border-violet-500
                           focus:ring-4
                           focus:ring-violet-100">

                </div>


                <button type="submit"
                    class="h-11 rounded-xl
                       border border-slate-200
                       bg-white px-5
                       text-sm font-medium
                       text-slate-700
                       hover:bg-slate-50">
                    Cari
                </button>

            </form>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full
                       min-w-[750px]">

                    <thead class="bg-slate-50">

                        <tr
                            class="text-left
                               text-xs font-semibold
                               uppercase
                               tracking-wide
                               text-slate-500">

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

                            <th class="px-5 py-4
                                   text-right">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y
                           divide-slate-100">

                        @forelse ($categories as $category)
                            <tr class="text-sm">

                                {{-- ICON --}}
                                <td class="px-5 py-4">

                                    <div
                                        class="flex size-10
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-violet-50
                                           text-lg
                                           text-violet-600">

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
                                                ◈
                                        @endswitch

                                    </div>

                                </td>


                                {{-- NAME --}}
                                <td class="px-5 py-4">

                                    <p class="font-semibold
                                           text-slate-800">
                                        {{ $category->name }}
                                    </p>

                                    <p class="mt-1 text-xs
                                           text-slate-400">
                                        {{ $category->slug }}
                                    </p>

                                </td>


                                {{-- PRODUCT COUNT --}}
                                <td class="px-5 py-4
                                       text-slate-600">
                                    {{ $category->products_count }}
                                </td>


                                {{-- STATUS --}}
                                <td class="px-5 py-4">

                                    @if ($category->status === 'active')
                                        <span
                                            class="inline-flex
                                               rounded-full
                                               bg-green-100
                                               px-3 py-1
                                               text-xs font-medium
                                               text-green-700">
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex
                                               rounded-full
                                               bg-slate-100
                                               px-3 py-1
                                               text-xs font-medium
                                               text-slate-600">
                                            Nonaktif
                                        </span>
                                    @endif

                                </td>


                                {{-- ACTION --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center
               justify-end gap-1">

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.categories.edit', $category) }}" title="Edit kategori"
                                            class="inline-flex size-9
                   items-center justify-center
                   rounded-lg text-slate-500
                   transition
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


                                        {{-- ACTIVE / INACTIVE --}}
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
                       rounded-lg transition

                       {{ $category->status === 'active' ? 'text-amber-500 hover:bg-amber-50' : 'text-green-600 hover:bg-green-50' }}">

                                                @if ($category->status === 'active')
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
                       rounded-lg
                       text-red-500 transition
                       hover:bg-red-50
                       hover:text-red-600">

                                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.8">
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

                                    <td colspan="5" class="px-6 py-16
                                       text-center">

                                        <div
                                            class="mx-auto flex
                                           size-14
                                           items-center
                                           justify-center
                                           rounded-2xl
                                           bg-violet-50
                                           text-2xl">
                                            ◈
                                        </div>

                                        <p class="mt-4 font-semibold
                                           text-slate-700">
                                            Belum ada kategori
                                        </p>

                                        <p class="mt-2 text-sm
                                           text-slate-500">
                                            Tambahkan kategori
                                            pertama KampusMart.
                                        </p>

                                        <a href="{{ route('admin.categories.create') }}"
                                            class="mt-5
                                           inline-flex
                                           rounded-xl
                                           bg-violet-600
                                           px-5 py-2.5
                                           text-sm font-semibold
                                           text-white">
                                            Tambah Kategori
                                        </a>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                @if ($categories->hasPages())
                    <div class="border-t
                       border-slate-200
                       px-5 py-4">
                        {{ $categories->links() }}
                    </div>
                @endif

            </section>

        </div>

    @endsection
