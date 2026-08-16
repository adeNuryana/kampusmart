@extends('layouts.admin')

@section('title', 'Tambah Kategori')

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
            Tambah Kategori
        </h1>

        <p
            class="mt-2 text-sm
                   text-slate-500"
        >
            Tambahkan kategori produk
            baru ke KampusMart.
        </p>

    </div>


    <form
        action="{{ route('admin.categories.store') }}"
        method="POST"
        class="space-y-6"
    >

        @csrf


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
                        value="{{ old('name') }}"
                        placeholder="Contoh: Makanan"

                        required

                        class="h-12 w-full
                               rounded-xl
                               border
                               {{ $errors->has('name')
                                    ? 'border-red-300'
                                    : 'border-slate-200' }}
                               px-4 text-sm
                               outline-none
                               transition
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                    >

                    @error('name')

                        <p
                            class="mt-2 text-xs
                                   text-red-600"
                        >
                            {{ $message }}
                        </p>

                    @enderror

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
                                old('icon') === 'food'
                            )
                        >
                            🍴 Makanan
                        </option>

                        <option
                            value="drink"
                            @selected(
                                old('icon') === 'drink'
                            )
                        >
                            ☕ Minuman
                        </option>

                        <option
                            value="book"
                            @selected(
                                old('icon') === 'book'
                            )
                        >
                            📚 Buku
                        </option>

                        <option
                            value="electronic"
                            @selected(
                                old('icon')
                                === 'electronic'
                            )
                        >
                            💻 Elektronik
                        </option>

                        <option
                            value="fashion"
                            @selected(
                                old('icon')
                                === 'fashion'
                            )
                        >
                            👕 Fashion
                        </option>

                        <option
                            value="service"
                            @selected(
                                old('icon')
                                === 'service'
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
                        rows="4"

                        placeholder="Deskripsi singkat kategori..."

                        class="w-full resize-none
                               rounded-xl
                               border border-slate-200
                               p-4 text-sm
                               leading-6 outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                    >{{ old('description') }}</textarea>

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
                                old('status', 'active')
                                === 'active'
                            )
                        >
                            Aktif
                        </option>

                        <option
                            value="inactive"
                            @selected(
                                old('status')
                                === 'inactive'
                            )
                        >
                            Nonaktif
                        </option>

                    </select>


                    <p
                        class="mt-2 text-xs
                               text-slate-500"
                    >
                        Kategori aktif nantinya
                        dapat digunakan oleh penjual.
                    </p>

                </div>

            </div>

        </section>


        {{-- BUTTON --}}
        <div
            class="flex justify-end gap-3"
        >

            <a
                href="{{ route('admin.categories.index') }}"

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
                       transition
                       hover:bg-violet-700"
            >
                Simpan Kategori
            </button>

        </div>

    </form>

</div>

@endsection
