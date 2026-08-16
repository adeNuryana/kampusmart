@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')

<div class="mx-auto max-w-3xl">

    {{-- HEADER --}}
    <div class="mb-7">

        <a
            href="{{ route('admin.categories.index') }}"
            class="inline-flex items-center gap-2
                   text-sm font-medium
                   text-slate-500
                   hover:text-violet-600"
        >
            ← Kembali ke Kategori
        </a>


        <h1
            class="mt-5 text-3xl
                   font-bold tracking-tight"
        >
            Edit Kategori
        </h1>


        <p
            class="mt-2 text-sm
                   text-slate-500"
        >
            Perbarui informasi kategori
            produk KampusMart.
        </p>

    </div>


    {{-- ERROR --}}
    @if ($errors->any())

        <div
            class="mb-6 rounded-xl
                   border border-red-200
                   bg-red-50 px-4 py-3"
        >

            <p
                class="text-sm font-semibold
                       text-red-700"
            >
                Data belum dapat disimpan.
            </p>

            <p
                class="mt-1 text-sm
                       text-red-600"
            >
                Periksa kembali form di bawah.
            </p>

        </div>

    @endif


    <form
        action="{{ route(
            'admin.categories.update',
            $category
        ) }}"
        method="POST"
        class="space-y-6"
    >

        @csrf
        @method('PUT')


        <section
            class="rounded-2xl
                   border border-slate-200
                   bg-white p-6
                   shadow-sm"
        >

            <div class="space-y-5">

                {{-- NAME --}}
                <div>

                    <label
                        for="name"
                        class="mb-2 block
                               text-sm font-medium
                               text-slate-700"
                    >
                        Nama Kategori

                        <span class="text-red-500">
                            *
                        </span>
                    </label>


                    <input
                        id="name"
                        type="text"
                        name="name"

                        value="{{ old(
                            'name',
                            $category->name
                        ) }}"

                        required

                        class="h-12 w-full
                               rounded-xl border
                               {{ $errors->has('name')
                                    ? 'border-red-300'
                                    : 'border-slate-200' }}
                               px-4 text-sm
                               outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                    >


                    @error('name')

                        <p
                            class="mt-2
                                   text-xs text-red-600"
                        >
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- SLUG PREVIEW --}}
                <div>

                    <label
                        class="mb-2 block
                               text-sm font-medium
                               text-slate-700"
                    >
                        Slug Saat Ini
                    </label>

                    <div
                        class="flex h-12 items-center
                               rounded-xl
                               border border-slate-200
                               bg-slate-50 px-4
                               text-sm text-slate-500"
                    >
                        {{ $category->slug }}
                    </div>


                    <p
                        class="mt-2 text-xs
                               text-slate-400"
                    >
                        Slug akan diperbarui otomatis
                        berdasarkan nama kategori.
                    </p>

                </div>


                {{-- ICON --}}
                <div>

                    <label
                        for="icon"
                        class="mb-2 block
                               text-sm font-medium
                               text-slate-700"
                    >
                        Icon
                    </label>


                    <select
                        id="icon"
                        name="icon"

                        class="h-12 w-full
                               rounded-xl
                               border border-slate-200
                               bg-white px-4
                               text-sm outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                    >

                        <option value="">
                            Pilih Icon
                        </option>

                        <option
                            value="food"
                            @selected(
                                old(
                                    'icon',
                                    $category->icon
                                ) === 'food'
                            )
                        >
                            🍴 Makanan
                        </option>

                        <option
                            value="drink"
                            @selected(
                                old(
                                    'icon',
                                    $category->icon
                                ) === 'drink'
                            )
                        >
                            ☕ Minuman
                        </option>

                        <option
                            value="book"
                            @selected(
                                old(
                                    'icon',
                                    $category->icon
                                ) === 'book'
                            )
                        >
                            📚 Buku
                        </option>

                        <option
                            value="electronic"
                            @selected(
                                old(
                                    'icon',
                                    $category->icon
                                ) === 'electronic'
                            )
                        >
                            💻 Elektronik
                        </option>

                        <option
                            value="fashion"
                            @selected(
                                old(
                                    'icon',
                                    $category->icon
                                ) === 'fashion'
                            )
                        >
                            👕 Fashion
                        </option>

                        <option
                            value="service"
                            @selected(
                                old(
                                    'icon',
                                    $category->icon
                                ) === 'service'
                            )
                        >
                            🛠 Jasa
                        </option>

                    </select>

                </div>


                {{-- DESCRIPTION --}}
                <div>

                    <label
                        for="description"
                        class="mb-2 block
                               text-sm font-medium
                               text-slate-700"
                    >
                        Deskripsi
                    </label>


                    <textarea
                        id="description"
                        name="description"
                        rows="5"

                        class="w-full resize-none
                               rounded-xl
                               border border-slate-200
                               p-4 text-sm
                               leading-6 outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                    >{{ old(
                        'description',
                        $category->description
                    ) }}</textarea>


                    @error('description')

                        <p
                            class="mt-2
                                   text-xs text-red-600"
                        >
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- STATUS --}}
                <div>

                    <label
                        for="status"
                        class="mb-2 block
                               text-sm font-medium
                               text-slate-700"
                    >
                        Status
                    </label>


                    <select
                        id="status"
                        name="status"

                        class="h-12 w-full
                               rounded-xl
                               border border-slate-200
                               bg-white px-4
                               text-sm outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                    >

                        <option
                            value="active"
                            @selected(
                                old(
                                    'status',
                                    $category->status
                                ) === 'active'
                            )
                        >
                            Aktif
                        </option>


                        <option
                            value="inactive"
                            @selected(
                                old(
                                    'status',
                                    $category->status
                                ) === 'inactive'
                            )
                        >
                            Nonaktif
                        </option>

                    </select>


                    <p
                        class="mt-2 text-xs
                               text-slate-500"
                    >
                        Kategori nonaktif tidak akan
                        tersedia untuk produk baru.
                    </p>

                </div>

            </div>

        </section>


        {{-- BUTTON --}}
        <div
            class="flex flex-col-reverse gap-3
                   sm:flex-row
                   sm:justify-end"
        >

            <a
                href="{{ route(
                    'admin.categories.index'
                ) }}"

                class="inline-flex h-12
                       items-center justify-center
                       rounded-xl
                       border border-slate-200
                       bg-white px-6
                       text-sm font-semibold
                       text-slate-600
                       hover:bg-slate-50"
            >
                Batal
            </a>


            <button
                type="submit"

                class="inline-flex h-12
                       items-center justify-center
                       rounded-xl
                       bg-violet-600
                       px-7 text-sm
                       font-semibold text-white
                       hover:bg-violet-700"
            >
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>

@endsection
