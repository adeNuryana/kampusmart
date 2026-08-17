@extends('layouts.seller')

@section('title', 'Edit Produk')

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
            Edit Produk
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Perbarui informasi produk
            <strong class="font-semibold text-slate-700">
                {{ $product->name }}
            </strong>.
        </p>

    </div>


    <form
        action="{{ route(
            'seller.products.update',
            $product
        ) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >

        @csrf
        @method('PUT')


        <div class="grid gap-6 lg:grid-cols-3">

            {{-- LEFT --}}
            <div class="space-y-6 lg:col-span-2">

                {{-- INFORMASI --}}
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
                            Perbarui informasi dasar produk.
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
                                value="{{ old(
                                    'name',
                                    $product->name
                                ) }}"
                                class="h-11 w-full rounded-xl
                                       border border-slate-200
                                       px-4 text-sm outline-none
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

                                @foreach ($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        @selected(
                                            old(
                                                'category_id',
                                                $product->category_id
                                            ) == $category->id
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
                                class="w-full rounded-xl
                                       border border-slate-200
                                       px-4 py-3 text-sm
                                       outline-none
                                       focus:border-violet-400
                                       focus:ring-4
                                       focus:ring-violet-100"
                            >{{ old(
                                'description',
                                $product->description
                            ) }}</textarea>

                            @error('description')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- PRICE STOCK --}}
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
                                    value="{{ old(
                                        'price',
                                        $product->price
                                    ) }}"
                                    min="0"
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
                                value="{{ old(
                                    'stock',
                                    $product->stock
                                ) }}"
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


            {{-- RIGHT --}}
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
                        Pilih foto baru jika ingin mengganti foto saat ini.
                    </p>


                    <div
                        class="mt-5 flex aspect-square
                               items-center justify-center
                               overflow-hidden rounded-2xl
                               bg-slate-100"
                    >

                        @if ($product->image)

                            <img
                                id="imagePreview"
                                src="{{ asset(
                                    'storage/' .
                                    $product->image
                                ) }}"
                                alt="{{ $product->name }}"
                                class="h-full w-full object-cover"
                            >

                        @else

                            <img
                                id="imagePreview"
                                src=""
                                alt="Preview"
                                class="hidden h-full
                                       w-full object-cover"
                            >

                            <div
                                id="imagePlaceholder"
                                class="text-center"
                            >

                                <svg
                                    class="mx-auto size-10
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

                                <p class="mt-3 text-xs text-slate-400">
                                    Belum ada foto
                                </p>

                            </div>

                        @endif

                    </div>


                    <label
                        for="image"
                        class="mt-4 inline-flex
                               h-10 w-full
                               cursor-pointer
                               items-center
                               justify-center
                               rounded-xl
                               border border-slate-200
                               text-sm font-semibold
                               text-slate-600
                               transition
                               hover:bg-slate-50"
                    >
                        Ganti Foto
                    </label>


                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/jpeg,image/png,image/webp"
                        class="hidden"
                    >

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


                    <div class="mt-5 space-y-3">

                        <label
                            class="flex cursor-pointer
                                   gap-3 rounded-xl
                                   border border-slate-200
                                   p-4"
                        >

                            <input
                                type="radio"
                                name="status"
                                value="active"
                                @checked(
                                    old(
                                        'status',
                                        $product->status
                                    ) === 'active'
                                )
                                class="mt-0.5 accent-violet-600"
                            >

                            <div>

                                <p class="text-sm font-semibold text-slate-800">
                                    Aktif
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    Produk tampil di marketplace.
                                </p>

                            </div>

                        </label>


                        <label
                            class="flex cursor-pointer
                                   gap-3 rounded-xl
                                   border border-slate-200
                                   p-4"
                        >

                            <input
                                type="radio"
                                name="status"
                                value="inactive"
                                @checked(
                                    old(
                                        'status',
                                        $product->status
                                    ) === 'inactive'
                                )
                                class="mt-0.5 accent-violet-600"
                            >

                            <div>

                                <p class="text-sm font-semibold text-slate-800">
                                    Nonaktif
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    Produk disembunyikan dari marketplace.
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
            class="flex flex-col-reverse
                   gap-3 border-t
                   border-slate-200 pt-6
                   sm:flex-row sm:justify-end"
        >

            <a
                href="{{ route('seller.products.index') }}"
                class="inline-flex h-11
                       items-center justify-center
                       rounded-xl border
                       border-slate-200 px-5
                       text-sm font-semibold
                       text-slate-600
                       hover:bg-slate-50"
            >
                Batal
            </a>


            <button
                type="submit"
                class="inline-flex h-11
                       items-center justify-center
                       rounded-xl bg-violet-600
                       px-6 text-sm font-semibold
                       text-white
                       hover:bg-violet-700"
            >
                Simpan Perubahan
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
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {

            imagePreview.src = event.target.result;

            imagePreview.classList.remove('hidden');

            imagePlaceholder?.classList.add('hidden');
        };

        reader.readAsDataURL(file);
    });
</script>

@endpush
