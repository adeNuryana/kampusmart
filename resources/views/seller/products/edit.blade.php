@extends('layouts.seller')

@section('title', 'Edit Produk')

@section('content')

    <div class="mx-auto max-w-5xl">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section class="mb-6">

            <a href="{{ route('seller.products.index') }}"
                class="inline-flex items-center gap-2
                       text-sm font-semibold
                       text-[#8B7465]
                       transition
                       hover:text-[#A95E43]">

                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                    <path d="m15 18-6-6 6-6" />

                </svg>

                Kembali ke Produk

            </a>


            <div
                class="mt-5 flex flex-col gap-4
                       sm:flex-row
                       sm:items-end
                       sm:justify-between">

                <div>

                    <div
                        class="inline-flex items-center gap-2
                               rounded-full bg-[#FBEAE2]
                               px-3 py-1.5
                               text-xs font-bold
                               text-[#A95E43]">

                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <path d="M12 20h9" />

                            <path d="M16.5 3.5
                                       a2.1 2.1 0 0 1 3 3
                                       L8 18l-4 1 1-4Z" />

                        </svg>

                        Edit Produk

                    </div>


                    <h1
                        class="mt-3 text-2xl
                               font-black tracking-tight
                               text-[#332B26]
                               lg:text-3xl">

                        Edit Produk

                    </h1>


                    <p
                        class="mt-2 max-w-2xl
                               text-sm leading-6
                               text-slate-500">

                        Perbarui informasi produk

                        <strong class="font-bold
                                   text-[#4D4038]">

                            {{ $product->name }}

                        </strong>.

                    </p>

                </div>


                {{-- CURRENT STATUS --}}
                @if ($product->status === 'active')
                    <span
                        class="inline-flex w-fit
                               items-center gap-2
                               rounded-full border
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

                        Produk Aktif

                    </span>
                @else
                    <span
                        class="inline-flex w-fit
                               items-center gap-2
                               rounded-full border
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

                        Produk Nonaktif

                    </span>
                @endif

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- GLOBAL ERROR --}}
        {{-- ===================================================== --}}

        @if ($errors->any())
            <div
                class="mb-6 flex items-start gap-3
                       rounded-2xl
                       border border-[#ECD2CF]
                       bg-[#FAEDEC]
                       px-4 py-3.5">

                <div
                    class="flex size-8
                           shrink-0 items-center
                           justify-center
                           rounded-lg
                           bg-[#A65954]
                           text-white">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <circle cx="12" cy="12" r="9" />
                        <path d="M12 8v5" />
                        <path d="M12 17h.01" />

                    </svg>

                </div>


                <div>

                    <p class="text-sm font-bold
                               text-[#A65954]">

                        Data belum dapat disimpan.

                    </p>

                    <p class="mt-1 text-xs
                               text-[#9B5F59]">

                        Periksa kembali data produk di bawah.

                    </p>

                </div>

            </div>
        @endif



        {{-- ===================================================== --}}
        {{-- FORM --}}
        {{-- ===================================================== --}}

        <form action="{{ route('seller.products.update', $product) }}"
            method="POST" enctype="multipart/form-data" class="space-y-6">

            @csrf
            @method('PUT')


            <div class="grid gap-6 lg:grid-cols-3">


                {{-- ================================================= --}}
                {{-- LEFT --}}
                {{-- ================================================= --}}

                <div class="space-y-6 lg:col-span-2">


                    {{-- PRODUCT INFORMATION --}}
                    <section
                        class="overflow-hidden
                               rounded-3xl
                               border border-[#DFD2C7]
                               bg-white shadow-sm">

                        <div
                            class="border-b
                                   border-[#E7DBD1]
                                   bg-[#FAF7F2]
                                   p-5 sm:p-6">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex size-10
                                           items-center justify-center
                                           rounded-xl
                                           bg-[#C8795A]
                                           text-white">

                                    <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">

                                        <path d="M6 7h12l1 14H5L6 7Z" />
                                        <path d="M9 7a3 3 0 0 1 6 0" />

                                    </svg>

                                </div>


                                <div>

                                    <h2 class="font-bold
                                               text-[#332B26]">

                                        Informasi Produk

                                    </h2>

                                    <p class="mt-1 text-xs
                                               text-slate-500">

                                        Perbarui informasi dasar produk.

                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="space-y-5 p-5 sm:p-6">


                            {{-- NAME --}}
                            <div>

                                <label for="name"
                                    class="mb-2 block
                                           text-sm font-semibold
                                           text-[#4D4038]">

                                    Nama Produk

                                    <span class="text-[#A65954]">
                                        *
                                    </span>

                                </label>


                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $product->name) }}"
                                    class="h-11 w-full
                                           rounded-xl border
                                           {{ $errors->has('name') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                           bg-white px-4
                                           text-sm text-[#4D4038]
                                           outline-none transition
                                           focus:border-[#C8795A]
                                           focus:ring-4
                                           focus:ring-[#FBEAE2]">


                                @error('name')
                                    <p
                                        class="mt-2 text-xs
                                               font-medium
                                               text-[#A65954]">

                                        {{ $message }}

                                    </p>
                                @enderror

                            </div>



                            {{-- CATEGORY --}}
                            <div>

                                <label for="category_id"
                                    class="mb-2 block
                                           text-sm font-semibold
                                           text-[#4D4038]">

                                    Kategori

                                    <span class="text-[#A65954]">
                                        *
                                    </span>

                                </label>


                                <select name="category_id" id="category_id"
                                    class="h-11 w-full
                                           rounded-xl border
                                           {{ $errors->has('category_id') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                           bg-white px-4
                                           text-sm text-[#4D4038]
                                           outline-none
                                           focus:border-[#C8795A]
                                           focus:ring-4
                                           focus:ring-[#FBEAE2]">

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>

                                            {{ $category->name }}

                                        </option>
                                    @endforeach

                                </select>


                                @error('category_id')
                                    <p
                                        class="mt-2 text-xs
                                               font-medium
                                               text-[#A65954]">

                                        {{ $message }}

                                    </p>
                                @enderror

                            </div>



                            {{-- DESCRIPTION --}}
                            <div>

                                <label for="description"
                                    class="mb-2 block
                                           text-sm font-semibold
                                           text-[#4D4038]">

                                    Deskripsi

                                </label>


                                <textarea name="description" id="description" rows="6"
                                    class="w-full resize-none
                                           rounded-xl border
                                           {{ $errors->has('description') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                           bg-white px-4 py-3
                                           text-sm leading-6
                                           text-[#4D4038]
                                           outline-none
                                           focus:border-[#C8795A]
                                           focus:ring-4
                                           focus:ring-[#FBEAE2]">{{ old('description', $product->description) }}</textarea>


                                @error('description')
                                    <p
                                        class="mt-2 text-xs
                                               font-medium
                                               text-[#A65954]">

                                        {{ $message }}

                                    </p>
                                @enderror

                            </div>

                        </div>

                    </section>



                    {{-- ================================================= --}}
                    {{-- PRICE & STOCK --}}
                    {{-- ================================================= --}}

                    <section
                        class="overflow-hidden
                               rounded-3xl
                               border border-[#DFD2C7]
                               bg-white shadow-sm">

                        <div
                            class="border-b
                                   border-[#E7DBD1]
                                   bg-[#FAF7F2]
                                   p-5 sm:p-6">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex size-10
                                           items-center justify-center
                                           rounded-xl
                                           bg-[#C89B55]
                                           text-white">

                                    <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">

                                        <circle cx="12" cy="12" r="9" />
                                        <path d="M8 9h6a2 2 0 0 1 0 4h-4a2 2 0 0 0 0 4h6" />
                                        <path d="M12 6v12" />

                                    </svg>

                                </div>


                                <div>

                                    <h2 class="font-bold
                                               text-[#332B26]">

                                        Harga & Stok

                                    </h2>

                                    <p class="mt-1 text-xs
                                               text-slate-500">

                                        Perbarui harga jual dan ketersediaan stok.

                                    </p>

                                </div>

                            </div>

                        </div>


                        <div
                            class="grid gap-5
                                   p-5 sm:grid-cols-2
                                   sm:p-6">


                            {{-- PRICE --}}
                            <div>

                                <label for="price"
                                    class="mb-2 block
                                           text-sm font-semibold
                                           text-[#4D4038]">

                                    Harga

                                    <span class="text-[#A65954]">
                                        *
                                    </span>

                                </label>


                                <div class="relative">

                                    <span
                                        class="absolute left-4 top-1/2
                                               -translate-y-1/2
                                               text-sm font-bold
                                               text-[#8B7465]">

                                        Rp

                                    </span>


                                    <input type="number" name="price" id="price"
                                        value="{{ old('price', $product->price) }}"
                                        min="0"
                                        class="h-11 w-full
                                               rounded-xl border
                                               {{ $errors->has('price') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                               bg-white pl-11 pr-4
                                               text-sm text-[#4D4038]
                                               outline-none
                                               focus:border-[#C89B55]
                                               focus:ring-4
                                               focus:ring-[#FAF2DF]">

                                </div>


                                @error('price')
                                    <p
                                        class="mt-2 text-xs
                                               font-medium
                                               text-[#A65954]">

                                        {{ $message }}

                                    </p>
                                @enderror

                            </div>



                            {{-- STOCK --}}
                            <div>

                                <label for="stock"
                                    class="mb-2 block
                                           text-sm font-semibold
                                           text-[#4D4038]">

                                    Stok

                                    <span class="text-[#A65954]">
                                        *
                                    </span>

                                </label>


                                <input type="number" name="stock" id="stock"
                                    value="{{ old('stock', $product->stock) }}"
                                    min="0"
                                    class="h-11 w-full
                                           rounded-xl border
                                           {{ $errors->has('stock') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                           bg-white px-4
                                           text-sm text-[#4D4038]
                                           outline-none
                                           focus:border-[#C89B55]
                                           focus:ring-4
                                           focus:ring-[#FAF2DF]">


                                @error('stock')
                                    <p
                                        class="mt-2 text-xs
                                               font-medium
                                               text-[#A65954]">

                                        {{ $message }}

                                    </p>
                                @enderror

                            </div>

                        </div>

                    </section>

                </div>



                {{-- ================================================= --}}
                {{-- RIGHT --}}
                {{-- ================================================= --}}

                <div class="space-y-6">


                    {{-- IMAGE --}}
                    <section
                        class="overflow-hidden
                               rounded-3xl
                               border border-[#DFD2C7]
                               bg-white shadow-sm">

                        <div
                            class="border-b
                                   border-[#E7DBD1]
                                   bg-[#FAF7F2]
                                   p-5">

                            <h2 class="font-bold
                                       text-[#332B26]">

                                Foto Produk

                            </h2>

                            <p class="mt-1 text-xs
                                       text-slate-500">

                                Pilih foto baru jika ingin mengganti
                                foto saat ini.

                            </p>

                        </div>


                        <div class="p-5">

                            <div
                                class="flex aspect-square
                                       items-center justify-center
                                       overflow-hidden
                                       rounded-2xl
                                       border border-[#E7DBD1]
                                       bg-[#FAF7F2]">

                                @if ($product->image)
                                    <img id="imagePreview"
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="h-full w-full
                                               object-cover">

                                    <div id="imagePlaceholder" class="hidden text-center">
                                    </div>
                                @else
                                    <img id="imagePreview" src="" alt="Preview"
                                        class="hidden h-full
                                               w-full object-cover">


                                    <div id="imagePlaceholder" class="px-4 text-center">

                                        <div
                                            class="mx-auto flex
                                                   size-14
                                                   items-center justify-center
                                                   rounded-2xl
                                                   bg-[#FBEAE2]
                                                   text-[#A95E43]">

                                            <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5">

                                                <rect x="3" y="3" width="18" height="18" rx="2" />

                                                <path d="m21 15-5-5L5 21" />

                                            </svg>

                                        </div>


                                        <p
                                            class="mt-3 text-sm
                                                   font-semibold
                                                   text-[#6F6259]">

                                            Belum ada foto

                                        </p>

                                    </div>
                                @endif

                            </div>


                            <label for="image"
                                class="mt-4 inline-flex
                                       h-10 w-full
                                       cursor-pointer
                                       items-center justify-center
                                       gap-2 rounded-xl
                                       border border-[#DFD2C7]
                                       bg-white
                                       text-sm font-bold
                                       text-[#A95E43]
                                       transition
                                       hover:bg-[#FBEAE2]">

                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <path d="M12 5v14" />
                                    <path d="M5 12h14" />

                                </svg>

                                Ganti Foto

                            </label>


                            <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp"
                                class="hidden">


                            <p
                                class="mt-3 text-xs
                                       leading-5
                                       text-slate-400">

                                Kosongkan jika tidak ingin
                                mengganti foto.

                            </p>


                            @error('image')
                                <p
                                    class="mt-2 text-xs
                                           font-medium
                                           text-[#A65954]">

                                    {{ $message }}

                                </p>
                            @enderror

                        </div>

                    </section>



                    {{-- STATUS --}}
                    <section
                        class="overflow-hidden
                               rounded-3xl
                               border border-[#DFD2C7]
                               bg-white shadow-sm">

                        <div
                            class="border-b
                                   border-[#E7DBD1]
                                   bg-[#FAF7F2]
                                   p-5">

                            <h2 class="font-bold
                                       text-[#332B26]">

                                Status Produk

                            </h2>

                            <p class="mt-1 text-xs
                                       text-slate-500">

                                Atur apakah produk ditampilkan
                                kepada pembeli.

                            </p>

                        </div>


                        <div class="space-y-3 p-5">


                            <label
                                class="flex cursor-pointer
                                       items-start gap-3
                                       rounded-2xl
                                       border border-[#D3DFCE]
                                       bg-[#FAFCF9]
                                       p-4 transition
                                       hover:bg-[#EEF3EA]">

                                <input type="radio" name="status" value="active" @checked(old('status', $product->status) === 'active')
                                    class="mt-0.5 size-4
                                           accent-[#718268]">


                                <div>

                                    <div class="flex items-center gap-2">

                                        <span
                                            class="size-2
                                                   rounded-full
                                                   bg-[#718268]">
                                        </span>

                                        <p
                                            class="text-sm font-bold
                                                   text-[#65795E]">

                                            Aktif

                                        </p>

                                    </div>

                                    <p
                                        class="mt-1 text-xs
                                               leading-5
                                               text-slate-500">

                                        Produk tampil di marketplace.

                                    </p>

                                </div>

                            </label>


                            <label
                                class="flex cursor-pointer
                                       items-start gap-3
                                       rounded-2xl
                                       border border-[#ECD2CF]
                                       bg-[#FEFAFA]
                                       p-4 transition
                                       hover:bg-[#FAEDEC]">

                                <input type="radio" name="status" value="inactive" @checked(old('status', $product->status) === 'inactive')
                                    class="mt-0.5 size-4
                                           accent-[#A65954]">


                                <div>

                                    <div class="flex items-center gap-2">

                                        <span
                                            class="size-2
                                                   rounded-full
                                                   bg-[#A65954]">
                                        </span>

                                        <p
                                            class="text-sm font-bold
                                                   text-[#A65954]">

                                            Nonaktif

                                        </p>

                                    </div>

                                    <p
                                        class="mt-1 text-xs
                                               leading-5
                                               text-slate-500">

                                        Produk disembunyikan dari marketplace.

                                    </p>

                                </div>

                            </label>


                            @error('status')
                                <p class="text-xs font-medium
                                           text-[#A65954]">

                                    {{ $message }}

                                </p>
                            @enderror

                        </div>

                    </section>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- ACTION --}}
            {{-- ================================================= --}}

            <div
                class="flex flex-col-reverse
                       gap-3 border-t
                       border-[#DFD2C7]
                       pt-6 sm:flex-row
                       sm:justify-end">

                <a href="{{ route('seller.products.index') }}"
                    class="inline-flex h-11
                           items-center justify-center
                           rounded-xl border
                           border-[#DFD2C7]
                           bg-white px-5
                           text-sm font-semibold
                           text-[#6F6259]
                           transition
                           hover:bg-[#F5ECE6]">

                    Batal

                </a>


                <button type="submit"
                    class="inline-flex h-11
                           items-center justify-center
                           gap-2 rounded-xl
                           bg-[#C8795A]
                           px-6 text-sm
                           font-bold text-white
                           shadow-sm transition
                           hover:bg-[#B66F52]
                           hover:shadow-md">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <path d="m5 12 4 4L19 6" />

                    </svg>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const imageInput =
                document.getElementById('image');

            const imagePreview =
                document.getElementById('imagePreview');

            const imagePlaceholder =
                document.getElementById('imagePlaceholder');


            imageInput?.addEventListener(
                'change',
                function(event) {

                    const file =
                        event.target.files[0];


                    if (!file || !imagePreview) {
                        return;
                    }


                    const reader =
                        new FileReader();


                    reader.onload =
                        function(event) {

                            imagePreview.src =
                                event.target.result;

                            imagePreview.classList.remove(
                                'hidden'
                            );

                            imagePlaceholder?.classList.add(
                                'hidden'
                            );
                        };


                    reader.readAsDataURL(file);

                }
            );

        });
    </script>
@endpush
