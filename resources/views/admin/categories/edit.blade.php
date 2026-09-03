@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')

    <div class="mx-auto max-w-3xl">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section class="mb-6">

            <a href="{{ route('admin.categories.index') }}"
                class="inline-flex items-center gap-2
                       text-sm font-semibold
                       text-[#8B7465]
                       transition
                       hover:text-[#4371d1]">

                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                    <path d="m15 18-6-6 6-6" />

                </svg>

                Kembali ke Kategori

            </a>


            <div
                class="mt-5 flex flex-col gap-4
                       sm:flex-row
                       sm:items-end
                       sm:justify-between">

                <div>

                    <div
                        class="inline-flex items-center
                               gap-2 rounded-full
                               bg-[#F4EAE2]
                               px-3 py-1.5
                               text-xs font-bold
                               text-[#4371d1]">

                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <path d="M12 20h9" />
                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z" />

                        </svg>

                        Edit Kategori

                    </div>


                    <h1
                        class="mt-3 text-2xl
                               font-black tracking-tight
                               text-[#332B26]
                               lg:text-3xl">

                        Edit Kategori

                    </h1>


                    <p class="mt-2 text-sm
                               leading-6 text-slate-500">

                        Perbarui informasi kategori produk KampusMart.

                    </p>

                </div>


                @if ($category->status === 'active')
                    <span
                        class="inline-flex w-fit
                               items-center gap-2
                               rounded-full border
                               border-[#D3DFCE]
                               bg-[#EEF3EA]
                               px-3 py-1.5
                               text-xs font-bold
                               text-[#65795E]">

                        <span class="size-1.5 rounded-full
                                   bg-[#718268]">
                        </span>

                        Aktif

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

                        <span class="size-1.5 rounded-full
                                   bg-[#A65954]">
                        </span>

                        Nonaktif

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
                       rounded-2xl border
                       border-[#ECD2CF]
                       bg-[#FAEDEC]
                       px-4 py-3.5">

                <div
                    class="flex size-8 shrink-0
                           items-center justify-center
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

                        Periksa kembali form di bawah.

                    </p>

                </div>

            </div>
        @endif



        {{-- ===================================================== --}}
        {{-- FORM --}}
        {{-- ===================================================== --}}

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">

            @csrf
            @method('PUT')


            <section
                class="overflow-hidden
                       rounded-3xl border
                       border-[#DFD2C7]
                       bg-white shadow-sm">


                {{-- HEADER --}}
                <div
                    class="border-b border-[#E7DBD1]
                           bg-[#FAF7F2]
                           p-5 sm:p-6">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex size-10
                                   shrink-0 items-center
                                   justify-center
                                   rounded-xl
                                   bg-[#4371d1]
                                   text-white">

                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <rect x="3" y="3" width="7" height="7" rx="1.5" />
                                <circle cx="17.5" cy="6.5" r="3.5" />
                                <path d="m7 14-4 7h8l-4-7Z" />
                                <rect x="14" y="14" width="7" height="7" rx="1.5" />

                            </svg>

                        </div>


                        <div>

                            <h2 class="font-bold
                                       text-[#332B26]">

                                Informasi Kategori

                            </h2>

                            <p class="mt-1 text-xs
                                       text-slate-500">

                                Ubah identitas dan pengaturan kategori.

                            </p>

                        </div>

                    </div>

                </div>


                {{-- FIELDS --}}
                <div class="space-y-5 p-5 sm:p-6">


                    {{-- NAME --}}
                    <div>

                        <label for="name"
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-[#4D4038]">

                            Nama Kategori

                            <span class="text-[#A65954]">
                                *
                            </span>

                        </label>


                        <input id="name" type="text" name="name" value="{{ old('name', $category->name) }}"
                            required
                            class="h-11 w-full
                                   rounded-xl border
                                   {{ $errors->has('name') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                   bg-white px-4
                                   text-sm text-[#4D4038]
                                   outline-none transition
                                   focus:border-[#A97957]
                                   focus:ring-4
                                   focus:ring-[#F1E6DE]">


                        @error('name')
                            <p
                                class="mt-2 text-xs
                                       font-medium
                                       text-[#A65954]">

                                {{ $message }}

                            </p>
                        @enderror

                    </div>



                    {{-- SLUG --}}
                    <div>

                        <label
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-[#4D4038]">

                            Slug Saat Ini

                        </label>


                        <div
                            class="flex h-11
                                   items-center gap-3
                                   rounded-xl
                                   border border-[#E7DBD1]
                                   bg-[#FAF7F2]
                                   px-4">

                            <svg class="size-4 shrink-0
                                       text-[#A28A7A]"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                <path d="M10 13a5 5 0 0 0 7.5.5l2-2a5 5 0 0 0-7-7l-1 1" />
                                <path d="M14 11a5 5 0 0 0-7.5-.5l-2 2a5 5 0 0 0 7 7l1-1" />

                            </svg>

                            <span
                                class="font-mono
                                       text-sm
                                       text-[#7C695C]">

                                {{ $category->slug }}

                            </span>

                        </div>


                        <p class="mt-2 text-xs
                                   text-slate-400">

                            Slug akan diperbarui otomatis
                            berdasarkan nama kategori.

                        </p>

                    </div>



                    {{-- ICON --}}
                    <div>

                        <label for="icon"
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-[#4D4038]">

                            Icon

                        </label>


                        <div x-data="{
                            icon: '{{ old('icon', 'food') }}'
                        }">

                            <label for="icon"
                                class="mb-2 block
               text-sm font-semibold
               text-[#4D4038]">
                                Icon Kategori

                                <span class="text-[#A65954]">
                                    *
                                </span>
                            </label>


                            <select name="icon" id="icon" x-model="icon"
                                class="h-11 w-full
               rounded-xl border
               border-[#DFD2C7]
               bg-white px-4
               text-sm text-[#4D4038]
               outline-none transition
               focus:border-[#6F4E37]
               focus:ring-4
               focus:ring-[#F4EAE2]">

                                <option value="food">
                                    Makanan
                                </option>

                                <option value="drink">
                                    Minuman
                                </option>

                                <option value="electronics">
                                    Elektronik
                                </option>

                                <option value="fashion">
                                    Fashion
                                </option>

                                <option value="book">
                                    Buku & Pendidikan
                                </option>

                                <option value="accessories">
                                    Aksesoris
                                </option>

                                <option value="health">
                                    Kesehatan
                                </option>

                                <option value="sport">
                                    Olahraga
                                </option>

                                <option value="beauty">
                                    Kecantikan
                                </option>

                                <option value="home">
                                    Rumah & Kebutuhan
                                </option>

                                <option value="service">
                                    Jasa
                                </option>

                                <option value="other">
                                    Lainnya
                                </option>

                                <option value="custom">
                                    Upload Icon Sendiri
                                </option>

                            </select>


                            @error('icon')
                                <p class="mt-2 text-xs
                   font-medium
                   text-[#A65954]">
                                    {{ $message }}
                                </p>
                            @enderror



                            {{-- CUSTOM ICON --}}
                            <div x-cloak x-show="icon === 'custom'" x-transition
                                class="mt-4 rounded-2xl
               border border-[#E7DBD1]
               bg-[#FAF7F2]
               p-4">

                                <label for="icon_image"
                                    class="mb-2 block
                   text-sm font-semibold
                   text-[#4D4038]">
                                    Upload Icon
                                </label>


                                <div
                                    class="flex flex-col gap-4
                   sm:flex-row
                   sm:items-center">

                                    {{-- PREVIEW --}}
                                    <div
                                        class="flex size-20
                       shrink-0
                       items-center
                       justify-center
                       overflow-hidden
                       rounded-2xl
                       border border-[#DFD2C7]
                       bg-white">

                                        <img id="categoryIconPreview" src="" alt="Preview Icon"
                                            class="hidden h-full
                           w-full object-cover">


                                        <div id="categoryIconPlaceholder" class="text-[#A28A7A]">

                                            <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.6">
                                                <rect x="3" y="3" width="18" height="18" rx="2" />

                                                <circle cx="8.5" cy="8.5" r="1.5" />

                                                <path d="m21 15-5-5L5 21" />
                                            </svg>

                                        </div>

                                    </div>


                                    {{-- INPUT --}}
                                    <div class="flex-1">

                                        <input type="file" name="icon_image" id="icon_image"
                                            accept="image/jpeg,image/png,image/webp"
                                            class="block w-full
                           rounded-xl border
                           border-[#DFD2C7]
                           bg-white px-3 py-2
                           text-sm text-[#6F6259]
                           file:mr-3
                           file:rounded-lg
                           file:border-0
                           file:bg-[#F4EAE2]
                           file:px-3
                           file:py-1.5
                           file:text-xs
                           file:font-bold
                           file:text-[#6F4E37]">


                                        <p
                                            class="mt-2 text-xs
                           leading-5
                           text-slate-400">
                                            Gunakan gambar persegi.
                                            PNG atau WebP transparan lebih disarankan.
                                            Maksimal 1 MB.
                                        </p>

                                    </div>

                                </div>


                                @error('icon_image')
                                    <p
                                        class="mt-2 text-xs
                       font-medium
                       text-[#A65954]">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>



                    {{-- DESCRIPTION --}}
                    <div>

                        <label for="description"
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-[#4D4038]">

                            Deskripsi

                        </label>


                        <textarea id="description" name="description" rows="5" placeholder="Deskripsi singkat kategori..."
                            class="w-full resize-none
                                   rounded-xl border
                                   border-[#DFD2C7]
                                   bg-white p-4
                                   text-sm leading-6
                                   text-[#4D4038]
                                   outline-none
                                   placeholder:text-[#B3A195]
                                   focus:border-[#A97957]
                                   focus:ring-4
                                   focus:ring-[#F1E6DE]">{{ old('description', $category->description) }}</textarea>


                        @error('description')
                            <p
                                class="mt-2 text-xs
                                       font-medium
                                       text-[#A65954]">

                                {{ $message }}

                            </p>
                        @enderror

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
                                   outline-none
                                   focus:border-[#A97957]
                                   focus:ring-4
                                   focus:ring-[#F1E6DE]">

                            <option value="active" @selected(old('status', $category->status) === 'active')>

                                Aktif

                            </option>

                            <option value="inactive" @selected(old('status', $category->status) === 'inactive')>

                                Nonaktif

                            </option>

                        </select>


                        <p class="mt-2 text-xs
                                   text-slate-500">

                            Kategori nonaktif tidak tersedia
                            untuk produk baru.

                        </p>

                    </div>

                </div>

            </section>



            {{-- ACTION --}}
            <div class="flex flex-col-reverse gap-3
                       sm:flex-row sm:justify-end">

                <a href="{{ route('admin.categories.index') }}"
                    class="inline-flex h-11
                           items-center justify-center
                           rounded-xl border
                           border-[#DFD2C7]
                           bg-white px-5
                           text-sm font-semibold
                           text-[#6F6259]
                           transition
                           hover:bg-[#F3EAE3]">

                    Batal

                </a>


                <button type="submit"
                    class="inline-flex h-11
                           items-center justify-center
                           gap-2 rounded-xl
                           bg-[#4371d1]
                           px-6 text-sm
                           font-bold text-white
                           shadow-sm transition
                           hover:bg-[#0a1d45]">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <path d="m5 12 4 4L19 6" />

                    </svg>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

@endsection
