@extends('layouts.admin')

@section('title', 'Tambah Kategori')

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


            <div class="mt-5">

                <div
                    class="inline-flex items-center gap-2
                           rounded-full bg-[#F4EAE2]
                           px-3 py-1.5
                           text-xs font-bold
                           text-[#4371d1]">

                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                        <rect x="4" y="4" width="6" height="6" rx="1" />
                        <rect x="14" y="4" width="6" height="6" rx="1" />
                        <rect x="4" y="14" width="6" height="6" rx="1" />
                        <path d="M17 14v6" />
                        <path d="M14 17h6" />

                    </svg>

                    Tambah Kategori

                </div>


                <h1
                    class="mt-3 text-2xl
                           font-black tracking-tight
                           text-[#332B26]
                           lg:text-3xl">

                    Tambah Kategori

                </h1>


                <p class="mt-2 text-sm
                           leading-6 text-slate-500">

                    Tambahkan kategori produk baru
                    yang dapat digunakan oleh seller KampusMart.

                </p>

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- FORM --}}
        {{-- ===================================================== --}}

        <form action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" method="POST" class="space-y-6">

            @csrf


            <section
                class="overflow-hidden
                       rounded-3xl border
                       border-[#DFD2C7]
                       bg-white shadow-sm">


                {{-- CARD HEADER --}}
                <div
                    class="border-b border-[#E7DBD1]
                           bg-[#FAF7F2]
                           p-5 sm:p-6">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex size-10 shrink-0
                                   items-center justify-center
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

                                Tentukan identitas dan status kategori.

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


                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                            placeholder="Contoh: Makanan" required
                            class="h-11 w-full
                                   rounded-xl border
                                   {{ $errors->has('name') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                   bg-white px-4
                                   text-sm text-[#4D4038]
                                   outline-none transition
                                   placeholder:text-[#B3A195]
                                   focus:border-[#A97957]
                                   focus:ring-4
                                   focus:ring-[#F1E6DE]">


                        @error('name')
                            <p
                                class="mt-2 flex
                                       items-center gap-1.5
                                       text-xs font-medium
                                       text-[#A65954]">

                                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M12 8v5" />
                                    <path d="M12 17h.01" />

                                </svg>

                                {{ $message }}

                            </p>
                        @enderror

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


                        <p class="mt-2 text-xs
                                   text-slate-400">

                            Icon membantu pembeli mengenali kategori
                            dengan lebih cepat.

                        </p>

                    </div>



                    {{-- DESCRIPTION --}}
                    <div>

                        <label for="description"
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-[#4D4038]">

                            Deskripsi

                        </label>


                        <textarea id="description" name="description" rows="4" placeholder="Deskripsi singkat kategori..."
                            class="w-full resize-none
                                   rounded-xl border
                                   border-[#DFD2C7]
                                   bg-white p-4
                                   text-sm leading-6
                                   text-[#4D4038]
                                   outline-none transition
                                   placeholder:text-[#B3A195]
                                   focus:border-[#A97957]
                                   focus:ring-4
                                   focus:ring-[#F1E6DE]">{{ old('description') }}</textarea>


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
                                   outline-none transition
                                   focus:border-[#A97957]
                                   focus:ring-4
                                   focus:ring-[#F1E6DE]">

                            <option value="active" @selected(old('status', 'active') === 'active')>

                                Aktif

                            </option>

                            <option value="inactive" @selected(old('status') === 'inactive')>

                                Nonaktif

                            </option>

                        </select>


                        <div
                            class="mt-2 flex
                                   items-center gap-2
                                   text-xs text-slate-500">

                            <span class="size-1.5 rounded-full
                                       bg-[#718268]">
                            </span>

                            Kategori aktif dapat digunakan oleh seller
                            untuk produk mereka.

                        </div>

                    </div>

                </div>

            </section>



            {{-- ================================================= --}}
            {{-- ACTION --}}
            {{-- ================================================= --}}

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
                           hover:bg-[#F3EAE3]
                           hover:text-[#0a1d45]">

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
                           hover:bg-[#0a1d45]
                           hover:shadow-md">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <path d="m5 12 4 4L19 6" />

                    </svg>

                    Simpan Kategori

                </button>

            </div>

        </form>

    </div>

@endsection
