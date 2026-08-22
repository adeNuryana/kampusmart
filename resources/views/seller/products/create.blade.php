@extends('layouts.seller')

@section('title', 'Tambah Produk')

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


            <div class="mt-5">

                <div
                    class="inline-flex items-center gap-2
                           rounded-full bg-[#FBEAE2]
                           px-3 py-1.5
                           text-xs font-bold
                           text-[#A95E43]">

                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                        <path d="M6 7h12l1 14H5L6 7Z" />
                        <path d="M9 7a3 3 0 0 1 6 0" />
                        <path d="M12 11v6" />
                        <path d="M9 14h6" />

                    </svg>

                    Produk Baru

                </div>


                <h1
                    class="mt-3 text-2xl
                           font-black tracking-tight
                           text-[#332B26]
                           lg:text-3xl">

                    Tambah Produk

                </h1>


                <p
                    class="mt-2 max-w-2xl
                           text-sm leading-6
                           text-slate-500">

                    Tambahkan produk baru yang akan ditampilkan
                    kepada pembeli di KampusMart.

                </p>

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- FORM --}}
        {{-- ===================================================== --}}

        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">

            @csrf


            <div class="grid gap-6 lg:grid-cols-3">


                {{-- ================================================= --}}
                {{-- LEFT --}}
                {{-- ================================================= --}}

                <div class="space-y-6 lg:col-span-2">


                    {{-- ================================================= --}}
                    {{-- PRODUCT INFO --}}
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

                                        Masukkan informasi utama produk.

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


                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    placeholder="Contoh: Laptop ASUS Vivobook"
                                    class="h-11 w-full
                                           rounded-xl border
                                           {{ $errors->has('name') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                           bg-white px-4
                                           text-sm text-[#4D4038]
                                           outline-none transition
                                           placeholder:text-[#B3A195]
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
                                           outline-none transition
                                           focus:border-[#C8795A]
                                           focus:ring-4
                                           focus:ring-[#FBEAE2]">

                                    <option value="">
                                        Pilih kategori
                                    </option>


                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>

                                            {{ $category->name }}

                                        </option>
                                    @endforeach

                                </select>


                                <p class="mt-2 text-xs
                                           text-slate-400">

                                    Pilih kategori yang paling sesuai
                                    dengan produk.

                                </p>


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
                                    placeholder="Jelaskan kondisi, spesifikasi, atau informasi lain mengenai produk..."
                                    class="w-full resize-none
                                           rounded-xl border
                                           {{ $errors->has('description') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                           bg-white px-4 py-3
                                           text-sm leading-6
                                           text-[#4D4038]
                                           outline-none transition
                                           placeholder:text-[#B3A195]
                                           focus:border-[#C8795A]
                                           focus:ring-4
                                           focus:ring-[#FBEAE2]">{{ old('description') }}</textarea>


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

                                        Tentukan harga jual dan stok produk.

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


                                    <input type="number" name="price" id="price" value="{{ old('price') }}"
                                        min="0" placeholder="100000"
                                        class="h-11 w-full
                                               rounded-xl border
                                               {{ $errors->has('price') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                               bg-white pl-11 pr-4
                                               text-sm text-[#4D4038]
                                               outline-none transition
                                               placeholder:text-[#B3A195]
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


                                <input type="number" name="stock" id="stock" value="{{ old('stock', 1) }}"
                                    min="0"
                                    class="h-11 w-full
                                           rounded-xl border
                                           {{ $errors->has('stock') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                           bg-white px-4
                                           text-sm text-[#4D4038]
                                           outline-none transition
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


                    {{-- ================================================= --}}
                    {{-- IMAGE --}}
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
                                   p-5">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex size-9
                                           items-center justify-center
                                           rounded-xl
                                           bg-[#FBEAE2]
                                           text-[#A95E43]">

                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">

                                        <rect x="3" y="3" width="18" height="18" rx="2" />

                                        <circle cx="8.5" cy="8.5" r="1.5" />

                                        <path d="m21 15-5-5L5 21" />

                                    </svg>

                                </div>


                                <div>

                                    <h2 class="font-bold
                                               text-[#332B26]">

                                        Foto Produk

                                    </h2>

                                    <p
                                        class="mt-0.5 text-xs
                                               text-slate-500">

                                        Foto utama produk.

                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="p-5">

                            <div id="imagePreviewContainer"
                                class="flex aspect-square
                                       items-center justify-center
                                       overflow-hidden
                                       rounded-2xl
                                       border-2 border-dashed
                                       border-[#DFD2C7]
                                       bg-[#FAF7F2]">

                                <img id="imagePreview" src="" alt="Preview Produk"
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
                                            stroke-width="1.6">

                                            <rect x="3" y="3" width="18" height="18" rx="2" />

                                            <circle cx="8.5" cy="8.5" r="1.5" />

                                            <path d="m21 15-5-5L5 21" />

                                        </svg>

                                    </div>


                                    <p
                                        class="mt-3 text-sm
                                               font-semibold
                                               text-[#6F6259]">

                                        Belum ada foto

                                    </p>

                                    <p class="mt-1 text-xs
                                               text-slate-400">

                                        Pilih foto untuk menampilkan preview.

                                    </p>

                                </div>

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

                                Pilih Foto

                            </label>


                            <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp"
                                class="hidden">


                            <p class="mt-3 text-xs
                                       leading-5 text-slate-400">

                                JPG, PNG atau WebP.
                                Maksimal 2 MB.

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



                    {{-- ================================================= --}}
                    {{-- STATUS --}}
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
                                   p-5">

                            <h2 class="font-bold
                                       text-[#332B26]">

                                Status Produk

                            </h2>

                            <p class="mt-1 text-xs
                                       text-slate-500">

                                Atur visibilitas produk di marketplace.

                            </p>

                        </div>


                        <div class="space-y-3 p-5">


                            {{-- ACTIVE --}}
                            <label
                                class="group flex cursor-pointer
                                       items-start gap-3
                                       rounded-2xl border
                                       border-[#D3DFCE]
                                       bg-[#FAFCF9]
                                       p-4 transition
                                       hover:bg-[#EEF3EA]">

                                <input type="radio" name="status" value="active" @checked(old('status', 'active') === 'active')
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

                                        Produk langsung tampil di marketplace.

                                    </p>

                                </div>

                            </label>



                            {{-- INACTIVE --}}
                            <label
                                class="group flex cursor-pointer
                                       items-start gap-3
                                       rounded-2xl border
                                       border-[#ECD2CF]
                                       bg-[#FEFAFA]
                                       p-4 transition
                                       hover:bg-[#FAEDEC]">

                                <input type="radio" name="status" value="inactive" @checked(old('status') === 'inactive')
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

                                        Produk disimpan tetapi tidak tampil.

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

                    Simpan Produk

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


                    if (!file) {

                        imagePreview?.classList.add('hidden');

                        imagePlaceholder?.classList.remove(
                            'hidden'
                        );

                        return;
                    }


                    const reader =
                        new FileReader();


                    reader.onload =
                        function(event) {

                            if (!imagePreview) {
                                return;
                            }

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
