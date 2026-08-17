@extends('layouts.seller')

@section('title', 'Tambah Produk')

@section('content')

<div class="mx-auto max-w-5xl">

    {{-- HEADER --}}
    <div class="mb-7">

        <a
            href="{{ route('seller.products.index') }}"
            class="inline-flex items-center gap-2
                   text-sm font-medium text-slate-500
                   transition hover:text-violet-600"
        >
            ← Kembali ke Produk
        </a>

        <h1
            class="mt-5 text-2xl font-bold
                   tracking-tight text-slate-900
                   lg:text-3xl"
        >
            Tambah Produk
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Tambahkan produk baru yang akan ditampilkan di KampusMart.
        </p>

    </div>


    <form
        action="{{ route('seller.products.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >

        @csrf


        <div class="grid gap-6 lg:grid-cols-3">

            {{-- =========================
                LEFT
            ========================== --}}
            <div class="space-y-6 lg:col-span-2">

                {{-- INFORMASI PRODUK --}}
                <div
                    class="rounded-2xl border
                           border-slate-200
                           bg-white shadow-sm"
                >

                    <div
                        class="border-b border-slate-100
                               px-6 py-5"
                    >

                        <h2 class="font-semibold text-slate-900">
                            Informasi Produk
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Masukkan informasi utama produk.
                        </p>

                    </div>


                    <div class="space-y-5 p-6">

                        {{-- NAME --}}
                        <div>

                            <label
                                for="name"
                                class="mb-2 block text-sm
                                       font-medium text-slate-700"
                            >
                                Nama Produk
                            </label>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                placeholder="Contoh: Laptop ASUS Vivobook"
                                class="h-11 w-full rounded-xl
                                       border border-slate-200
                                       px-4 text-sm outline-none
                                       transition
                                       focus:border-violet-400
                                       focus:ring-4
                                       focus:ring-violet-100"
                            >

                            @error('name')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- CATEGORY --}}
                        <div>

                            <label
                                for="category_id"
                                class="mb-2 block text-sm
                                       font-medium text-slate-700"
                            >
                                Kategori
                            </label>

                            <select
                                name="category_id"
                                id="category_id"
                                class="h-11 w-full rounded-xl
                                       border border-slate-200
                                       bg-white px-4 text-sm
                                       outline-none
                                       focus:border-violet-400
                                       focus:ring-4
                                       focus:ring-violet-100"
                            >

                                <option value="">
                                    Pilih kategori
                                </option>

                                @foreach ($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        @selected(
                                            old('category_id') == $category->id
                                        )
                                    >
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- DESCRIPTION --}}
                        <div>

                            <label
                                for="description"
                                class="mb-2 block text-sm
                                       font-medium text-slate-700"
                            >
                                Deskripsi
                            </label>

                            <textarea
                                name="description"
                                id="description"
                                rows="6"
                                placeholder="Jelaskan kondisi, spesifikasi, atau informasi lain mengenai produk..."
                                class="w-full rounded-xl
                                       border border-slate-200
                                       px-4 py-3 text-sm
                                       outline-none transition
                                       focus:border-violet-400
                                       focus:ring-4
                                       focus:ring-violet-100"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- HARGA & STOK --}}
                <div
                    class="rounded-2xl border
                           border-slate-200
                           bg-white shadow-sm"
                >

                    <div
                        class="border-b border-slate-100
                               px-6 py-5"
                    >

                        <h2 class="font-semibold text-slate-900">
                            Harga & Stok
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Tentukan harga jual dan stok produk.
                        </p>

                    </div>


                    <div
                        class="grid gap-5 p-6
                               sm:grid-cols-2"
                    >

                        {{-- PRICE --}}
                        <div>

                            <label
                                for="price"
                                class="mb-2 block text-sm
                                       font-medium text-slate-700"
                            >
                                Harga
                            </label>


                            <div class="relative">

                                <span
                                    class="absolute left-4 top-1/2
                                           -translate-y-1/2
                                           text-sm font-medium
                                           text-slate-400"
                                >
                                    Rp
                                </span>


                                <input
                                    type="number"
                                    name="price"
                                    id="price"
                                    value="{{ old('price') }}"
                                    min="0"
                                    placeholder="100000"
                                    class="h-11 w-full rounded-xl
                                           border border-slate-200
                                           pl-11 pr-4 text-sm
                                           outline-none
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >

                            </div>

                            @error('price')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- STOCK --}}
                        <div>

                            <label
                                for="stock"
                                class="mb-2 block text-sm
                                       font-medium text-slate-700"
                            >
                                Stok
                            </label>

                            <input
                                type="number"
                                name="stock"
                                id="stock"
                                value="{{ old('stock', 1) }}"
                                min="0"
                                class="h-11 w-full rounded-xl
                                       border border-slate-200
                                       px-4 text-sm outline-none
                                       focus:border-violet-400
                                       focus:ring-4
                                       focus:ring-violet-100"
                            >

                            @error('stock')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================
                RIGHT
            ========================== --}}
            <div class="space-y-6">

                {{-- IMAGE --}}
                <div
                    class="rounded-2xl border
                           border-slate-200
                           bg-white p-6 shadow-sm"
                >

                    <h2 class="font-semibold text-slate-900">
                        Foto Produk
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Gunakan foto yang jelas dan relevan.
                    </p>


                    {{-- PREVIEW --}}
                    <div
                        id="imagePreviewContainer"
                        class="mt-5 flex aspect-square
                               items-center justify-center
                               overflow-hidden rounded-2xl
                               border-2 border-dashed
                               border-slate-200 bg-slate-50"
                    >

                        <img
                            id="imagePreview"
                            src=""
                            alt="Preview Produk"
                            class="hidden h-full w-full object-cover"
                        >


                        <div
                            id="imagePlaceholder"
                            class="text-center"
                        >

                            <svg
                                class="mx-auto size-10 text-slate-300"
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

                                <circle
                                    cx="8.5"
                                    cy="8.5"
                                    r="1.5"
                                />

                                <path d="m21 15-5-5L5 21" />
                            </svg>

                            <p class="mt-3 text-xs text-slate-400">
                                Belum ada foto
                            </p>

                        </div>

                    </div>


                    <label
                        for="image"
                        class="mt-4 inline-flex h-10
                               w-full cursor-pointer
                               items-center justify-center
                               rounded-xl border
                               border-slate-200
                               bg-white text-sm
                               font-semibold text-slate-600
                               transition
                               hover:bg-slate-50"
                    >
                        Pilih Foto
                    </label>


                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/jpeg,image/png,image/webp"
                        class="hidden"
                    >


                    <p class="mt-3 text-xs leading-5 text-slate-400">
                        JPG, PNG atau WebP. Maksimal 2 MB.
                    </p>


                    @error('image')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- STATUS --}}
                <div
                    class="rounded-2xl border
                           border-slate-200
                           bg-white p-6 shadow-sm"
                >

                    <h2 class="font-semibold text-slate-900">
                        Status Produk
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Tentukan apakah produk langsung ditampilkan.
                    </p>


                    <div class="mt-5 space-y-3">

                        <label
                            class="flex cursor-pointer
                                   items-start gap-3
                                   rounded-xl border
                                   border-slate-200 p-4
                                   transition
                                   hover:border-violet-200
                                   hover:bg-violet-50/50"
                        >

                            <input
                                type="radio"
                                name="status"
                                value="active"
                                @checked(
                                    old('status', 'active') === 'active'
                                )
                                class="mt-0.5 size-4 accent-violet-600"
                            >

                            <div>

                                <p class="text-sm font-semibold text-slate-800">
                                    Aktif
                                </p>

                                <p class="mt-1 text-xs leading-5 text-slate-500">
                                    Produk langsung tampil di marketplace.
                                </p>

                            </div>

                        </label>


                        <label
                            class="flex cursor-pointer
                                   items-start gap-3
                                   rounded-xl border
                                   border-slate-200 p-4
                                   transition
                                   hover:border-violet-200
                                   hover:bg-violet-50/50"
                        >

                            <input
                                type="radio"
                                name="status"
                                value="inactive"
                                @checked(
                                    old('status') === 'inactive'
                                )
                                class="mt-0.5 size-4 accent-violet-600"
                            >

                            <div>

                                <p class="text-sm font-semibold text-slate-800">
                                    Nonaktif
                                </p>

                                <p class="mt-1 text-xs leading-5 text-slate-500">
                                    Produk disimpan tetapi tidak tampil.
                                </p>

                            </div>

                        </label>

                    </div>


                    @error('status')
                        <p class="mt-3 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>


        {{-- ACTION --}}
        <div
            class="flex flex-col-reverse gap-3
                   border-t border-slate-200
                   pt-6 sm:flex-row sm:justify-end"
        >

            <a
                href="{{ route('seller.products.index') }}"
                class="inline-flex h-11
                       items-center justify-center
                       rounded-xl border
                       border-slate-200
                       bg-white px-5
                       text-sm font-semibold
                       text-slate-600
                       transition hover:bg-slate-50"
            >
                Batal
            </a>


            <button
                type="submit"
                class="inline-flex h-11
                       items-center justify-center
                       rounded-xl bg-violet-600
                       px-6 text-sm font-semibold
                       text-white transition
                       hover:bg-violet-700"
            >
                Simpan Produk
            </button>

        </div>

    </form>

</div>

@endsection


@push('scripts')

<script>
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const imagePlaceholder = document.getElementById('imagePlaceholder');

    imageInput?.addEventListener('change', function (event) {

        const file = event.target.files[0];

        if (!file) {
            imagePreview.classList.add('hidden');
            imagePlaceholder.classList.remove('hidden');
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {

            imagePreview.src = event.target.result;

            imagePreview.classList.remove('hidden');

            imagePlaceholder.classList.add('hidden');
        };

        reader.readAsDataURL(file);
    });
</script>

@endpush
