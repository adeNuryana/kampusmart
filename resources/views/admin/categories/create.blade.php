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
                       hover:text-[#6F4E37]">

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
                           text-[#6F4E37]">

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

        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">

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
                                   bg-[#6F4E37]
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


                        <select id="icon" name="icon"
                            class="h-11 w-full
                                   rounded-xl border
                                   border-[#DFD2C7]
                                   bg-white px-4
                                   text-sm text-[#4D4038]
                                   outline-none transition
                                   focus:border-[#A97957]
                                   focus:ring-4
                                   focus:ring-[#F1E6DE]">

                            <option value="">
                                Pilih Icon
                            </option>

                            <option value="food" @selected(old('icon') === 'food')>
                                🍴 Makanan
                            </option>

                            <option value="drink" @selected(old('icon') === 'drink')>
                                ☕ Minuman
                            </option>

                            <option value="book" @selected(old('icon') === 'book')>
                                📚 Buku
                            </option>

                            <option value="electronic" @selected(old('icon') === 'electronic')>
                                💻 Elektronik
                            </option>

                            <option value="fashion" @selected(old('icon') === 'fashion')>
                                👕 Fashion
                            </option>

                            <option value="service" @selected(old('icon') === 'service')>
                                🛠 Jasa
                            </option>

                        </select>


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
                           hover:text-[#493124]">

                    Batal

                </a>


                <button type="submit"
                    class="inline-flex h-11
                           items-center justify-center
                           gap-2 rounded-xl
                           bg-[#6F4E37]
                           px-6 text-sm
                           font-bold text-white
                           shadow-sm transition
                           hover:bg-[#5B3B2B]
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
