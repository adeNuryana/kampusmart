@extends('layouts.seller')

@section('title', 'Pengaturan')

@section('content')

    <div class="mx-auto max-w-6xl">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section class="mb-6">

            <div
                class="inline-flex items-center gap-2
                       rounded-full bg-[#FBEAE2]
                       px-3 py-1.5
                       text-xs font-bold
                       text-[#A95E43]">

                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                    <circle cx="12" cy="12" r="3" />

                    <path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-2.8 2.8-.1-.1
                               a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.6V21h-4v-.1
                               a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1L4.2 17
                               l.1-.1a1.7 1.7 0 0 0 .3-1.9A1.7 1.7 0 0 0 3 14H3v-4h.1
                               a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9L4.2 7
                               7 4.2l.1.1a1.7 1.7 0 0 0 1.9.3 1.7 1.7 0 0 0 1-1.6V3h4v.1
                               a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9-.3l.1-.1L19.8 7
                               l-.1.1a1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0 1.6 1H21v4h-.1
                               a1.7 1.7 0 0 0-1.5 1Z" />

                </svg>

                Seller Center

            </div>


            <h1
                class="mt-3 text-2xl
                       font-black tracking-tight
                       text-[#332B26]
                       lg:text-3xl">

                Pengaturan

            </h1>


            <p class="mt-2 max-w-2xl
                       text-sm leading-6
                       text-slate-500">

                Kelola informasi akun, profil toko,
                identitas seller, dan keamanan akun.

            </p>

        </section>



        {{-- ===================================================== --}}
        {{-- CONTENT --}}
        {{-- ===================================================== --}}

        <div class="grid gap-6 lg:grid-cols-[320px_1fr]">


            {{-- ================================================= --}}
            {{-- LEFT PROFILE --}}
            {{-- ================================================= --}}

            <aside>

                <section
                    class="sticky top-24
                           overflow-hidden
                           rounded-3xl
                           border border-[#DFD2C7]
                           bg-white shadow-sm">

                    <div
                        class="h-1.5
                               bg-gradient-to-r
                               from-[#C8795A]
                               via-[#A95E43]
                               to-[#6F4E37]">
                    </div>


                    <div class="p-6">

                        {{-- PHOTO --}}
                        @if ($seller->sellerProfile?->photo)
                            <img src="{{ asset('storage/' . $seller->sellerProfile->photo) }}"
                                alt="{{ $seller->name }}"
                                class="mx-auto size-24
                                       rounded-3xl
                                       border border-[#E7DBD1]
                                       object-cover
                                       shadow-sm">
                        @else
                            <div
                                class="mx-auto flex size-24
                                       items-center justify-center
                                       rounded-3xl
                                       bg-[#C8795A]
                                       text-3xl font-black
                                       text-white
                                       shadow-sm">

                                {{ strtoupper(substr($seller->name, 0, 1)) }}

                            </div>
                        @endif


                        <div class="mt-5 text-center">

                            <h2 class="text-lg font-black
                                       text-[#332B26]">

                                {{ $seller->name }}

                            </h2>


                            <p class="mt-1 text-sm
                                       text-slate-500">

                                {{ $seller->sellerProfile?->store_name ?? 'Belum ada nama toko' }}

                            </p>


                            <span
                                class="mt-4 inline-flex
                                       items-center gap-2
                                       rounded-full
                                       border border-[#EBCFC2]
                                       bg-[#FBEAE2]
                                       px-3 py-1.5
                                       text-xs font-bold
                                       text-[#A95E43]">

                                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <path d="M4 10v10h16V10" />
                                    <path d="M3 10l2-6h14l2 6" />

                                </svg>

                                Seller

                            </span>

                        </div>



                        {{-- META --}}
                        <div
                            class="mt-6 space-y-4
                                   border-t
                                   border-[#EEE5DE]
                                   pt-5">


                            {{-- STATUS --}}
                            <div class="flex items-center
                                       justify-between gap-4">

                                <span class="text-sm
                                           text-slate-500">

                                    Status

                                </span>


                                @if ($seller->status === 'active')
                                    <span
                                        class="inline-flex
                                               items-center gap-2
                                               rounded-full
                                               bg-[#EEF3EA]
                                               px-2.5 py-1
                                               text-xs font-bold
                                               text-[#65795E]">

                                        <span
                                            class="size-1.5
                                                   rounded-full
                                                   bg-[#718268]">
                                        </span>

                                        Aktif

                                    </span>
                                @else
                                    <span
                                        class="inline-flex
                                               items-center gap-2
                                               rounded-full
                                               bg-[#FAEDEC]
                                               px-2.5 py-1
                                               text-xs font-bold
                                               text-[#A65954]">

                                        <span
                                            class="size-1.5
                                                   rounded-full
                                                   bg-[#A65954]">
                                        </span>

                                        Nonaktif

                                    </span>
                                @endif

                            </div>



                            {{-- JOINED --}}
                            <div class="flex items-center
                                       justify-between gap-4">

                                <span class="text-sm
                                           text-slate-500">

                                    Bergabung

                                </span>


                                <span
                                    class="text-sm font-semibold
                                           text-[#4D4038]">

                                    {{ $seller->created_at->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d M Y') }}

                                </span>

                            </div>



                            {{-- NIM --}}
                            <div class="flex items-center
                                       justify-between gap-4">

                                <span class="text-sm
                                           text-slate-500">

                                    NIM

                                </span>


                                <span
                                    class="text-sm font-semibold
                                           text-[#4D4038]">

                                    {{ $seller->sellerProfile?->nim ?? '-' }}

                                </span>

                            </div>



                            {{-- FACULTY --}}
                            <div class="flex items-start
                                       justify-between gap-4">

                                <span class="shrink-0 text-sm
                                           text-slate-500">

                                    Fakultas

                                </span>


                                <span
                                    class="text-right text-sm
                                           font-semibold
                                           text-[#4D4038]">

                                    {{ $seller->sellerProfile?->faculty ?? '-' }}

                                </span>

                            </div>

                        </div>

                    </div>

                </section>

            </aside>



            {{-- ================================================= --}}
            {{-- RIGHT --}}
            {{-- ================================================= --}}

            <div class="space-y-6">


                {{-- ================================================= --}}
                {{-- PROFILE & STORE --}}
                {{-- ================================================= --}}

                <section
                    class="overflow-hidden
                           rounded-3xl
                           border border-[#DFD2C7]
                           bg-white shadow-sm">


                    {{-- HEADER --}}
                    <div
                        class="border-b
                               border-[#E7DBD1]
                               bg-[#FAF7F2]
                               p-5 sm:p-6">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex size-10
                                       shrink-0
                                       items-center justify-center
                                       rounded-xl
                                       bg-[#C8795A]
                                       text-white">

                                <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <path d="M4 10v10h16V10" />
                                    <path d="M3 10l2-6h14l2 6" />
                                    <path d="M8 20v-6h8v6" />

                                </svg>

                            </div>


                            <div>

                                <h2 class="font-bold
                                           text-[#332B26]">

                                    Informasi Seller & Toko

                                </h2>

                                <p class="mt-1 text-xs
                                           text-slate-500">

                                    Informasi ini ditampilkan pada
                                    produk dan profil tokomu.

                                </p>

                            </div>

                        </div>

                    </div>



                    {{-- BODY --}}
                    <div class="p-5 sm:p-6">

                        @if (session('profile_success'))
                            <div
                                class="mb-5 flex items-start gap-3
                                       rounded-2xl
                                       border border-[#D3DFCE]
                                       bg-[#EEF3EA]
                                       px-4 py-3.5">

                                <div
                                    class="flex size-8
                                           shrink-0 items-center
                                           justify-center
                                           rounded-lg
                                           bg-[#718268]
                                           text-white">

                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">

                                        <path d="m5 12 4 4L19 6" />

                                    </svg>

                                </div>


                                <div>

                                    <p
                                        class="text-sm font-bold
                                               text-[#65795E]">

                                        Berhasil

                                    </p>

                                    <p class="mt-0.5 text-xs
                                               text-[#65795E]">

                                        {{ session('profile_success') }}

                                    </p>

                                </div>

                            </div>
                        @endif



                        <form
                            action="{{ route('seller.settings.profile.update') }}"
                            method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')


                            <div class="grid gap-5
                                       sm:grid-cols-2">


                                {{-- NAME --}}
                                <div>

                                    <label for="name"
                                        class="mb-2 block
                                               text-sm font-semibold
                                               text-[#4D4038]">

                                        Nama Lengkap

                                        <span class="text-[#A65954]">
                                            *
                                        </span>

                                    </label>


                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $seller->name) }}"
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



                                {{-- STORE NAME --}}
                                <div>

                                    <label for="store_name"
                                        class="mb-2 block
                                               text-sm font-semibold
                                               text-[#4D4038]">

                                        Nama Toko

                                        <span class="text-[#A65954]">
                                            *
                                        </span>

                                    </label>


                                    <input type="text" name="store_name" id="store_name"
                                        value="{{ old('store_name', $seller->sellerProfile?->store_name) }}"
                                        placeholder="Nama toko"
                                        class="h-11 w-full
                                               rounded-xl border
                                               {{ $errors->has('store_name') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                               bg-white px-4
                                               text-sm text-[#4D4038]
                                               outline-none transition
                                               placeholder:text-[#B3A195]
                                               focus:border-[#C8795A]
                                               focus:ring-4
                                               focus:ring-[#FBEAE2]">


                                    @error('store_name')
                                        <p
                                            class="mt-2 text-xs
                                                   font-medium
                                                   text-[#A65954]">

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>



                                {{-- EMAIL --}}
                                <div>

                                    <label for="email"
                                        class="mb-2 block
                                               text-sm font-semibold
                                               text-[#4D4038]">

                                        Email

                                        <span class="text-[#A65954]">
                                            *
                                        </span>

                                    </label>


                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', $seller->email) }}"
                                        class="h-11 w-full
                                               rounded-xl border
                                               {{ $errors->has('email') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                               bg-white px-4
                                               text-sm text-[#4D4038]
                                               outline-none transition
                                               focus:border-[#C8795A]
                                               focus:ring-4
                                               focus:ring-[#FBEAE2]">


                                    @error('email')
                                        <p
                                            class="mt-2 text-xs
                                                   font-medium
                                                   text-[#A65954]">

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>



                                {{-- PHONE --}}
                                <div>

                                    <label for="phone"
                                        class="mb-2 block
                                               text-sm font-semibold
                                               text-[#4D4038]">

                                        Nomor Telepon

                                    </label>


                                    <input type="text" name="phone" id="phone"
                                        value="{{ old('phone', $seller->phone) }}"
                                        placeholder="081234567890"
                                        class="h-11 w-full
                                               rounded-xl border
                                               {{ $errors->has('phone') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                               bg-white px-4
                                               text-sm text-[#4D4038]
                                               outline-none transition
                                               placeholder:text-[#B3A195]
                                               focus:border-[#C8795A]
                                               focus:ring-4
                                               focus:ring-[#FBEAE2]">


                                    @error('phone')
                                        <p
                                            class="mt-2 text-xs
                                                   font-medium
                                                   text-[#A65954]">

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>



                                {{-- WHATSAPP --}}
                                <div>

                                    <label for="whatsapp"
                                        class="mb-2 block
                                               text-sm font-semibold
                                               text-[#4D4038]">

                                        WhatsApp

                                    </label>


                                    <input type="text" name="whatsapp" id="whatsapp"
                                        value="{{ old('whatsapp', $seller->sellerProfile?->whatsapp) }}"
                                        placeholder="6281234567890"
                                        class="h-11 w-full
                                               rounded-xl border
                                               {{ $errors->has('whatsapp') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                               bg-white px-4
                                               text-sm text-[#4D4038]
                                               outline-none transition
                                               placeholder:text-[#B3A195]
                                               focus:border-[#C8795A]
                                               focus:ring-4
                                               focus:ring-[#FBEAE2]">


                                    <p class="mt-2 text-xs
                                               text-slate-400">

                                        Gunakan format 62 tanpa tanda `+`.

                                    </p>


                                    @error('whatsapp')
                                        <p
                                            class="mt-2 text-xs
                                                   font-medium
                                                   text-[#A65954]">

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>



                                {{-- NIM --}}
                                <div>

                                    <label for="nim"
                                        class="mb-2 block
                                               text-sm font-semibold
                                               text-[#4D4038]">

                                        NIM

                                    </label>


                                    <input type="text" name="nim" id="nim"
                                        value="{{ old('nim', $seller->sellerProfile?->nim) }}"
                                        class="h-11 w-full
                                               rounded-xl border
                                               {{ $errors->has('nim') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                               bg-white px-4
                                               text-sm text-[#4D4038]
                                               outline-none transition
                                               focus:border-[#C8795A]
                                               focus:ring-4
                                               focus:ring-[#FBEAE2]">


                                    @error('nim')
                                        <p
                                            class="mt-2 text-xs
                                                   font-medium
                                                   text-[#A65954]">

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>



                                {{-- FACULTY --}}
                                <div class="sm:col-span-2">

                                    <label for="faculty"
                                        class="mb-2 block
                                               text-sm font-semibold
                                               text-[#4D4038]">

                                        Fakultas

                                    </label>


                                    <input type="text" name="faculty" id="faculty"
                                        value="{{ old('faculty', $seller->sellerProfile?->faculty) }}"
                                        placeholder="Contoh: Fakultas Teknik"
                                        class="h-11 w-full
                                               rounded-xl border
                                               {{ $errors->has('faculty') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                               bg-white px-4
                                               text-sm text-[#4D4038]
                                               outline-none transition
                                               placeholder:text-[#B3A195]
                                               focus:border-[#C8795A]
                                               focus:ring-4
                                               focus:ring-[#FBEAE2]">


                                    @error('faculty')
                                        <p
                                            class="mt-2 text-xs
                                                   font-medium
                                                   text-[#A65954]">

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>



                                {{-- DESCRIPTION --}}
                                <div class="sm:col-span-2">

                                    <label for="description"
                                        class="mb-2 block
                                               text-sm font-semibold
                                               text-[#4D4038]">

                                        Deskripsi Toko

                                    </label>


                                    <textarea name="description" id="description" rows="5" placeholder="Ceritakan tentang toko kamu..."
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
                                               focus:ring-[#FBEAE2]">{{ old('description', $seller->sellerProfile?->description) }}</textarea>


                                    @error('description')
                                        <p
                                            class="mt-2 text-xs
                                                   font-medium
                                                   text-[#A65954]">

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>



                                {{-- PHOTO --}}
                                <div class="sm:col-span-2">

                                    <label for="photo"
                                        class="mb-2 block
                                               text-sm font-semibold
                                               text-[#4D4038]">

                                        Foto Seller

                                    </label>


                                    <div
                                        class="rounded-2xl
                                               border border-[#E7DBD1]
                                               bg-[#FAF7F2]
                                               p-4">

                                        <div
                                            class="flex flex-col gap-4
                                                   sm:flex-row
                                                   sm:items-center">


                                            {{-- PREVIEW --}}
                                            <div
                                                class="flex size-20
                                                       shrink-0
                                                       items-center justify-center
                                                       overflow-hidden
                                                       rounded-2xl
                                                       border border-[#E7DBD1]
                                                       bg-white">


                                                @if ($seller->sellerProfile?->photo)
                                                    <img id="photoPreview"
                                                        src="{{ asset('storage/' . $seller->sellerProfile->photo) }}"
                                                        alt="{{ $seller->name }}"
                                                        class="h-full w-full
                                                               object-cover">


                                                    <span id="photoPlaceholder" class="hidden">
                                                    </span>
                                                @else
                                                    <img id="photoPreview" src="" alt="Preview Foto"
                                                        class="hidden h-full
                                                               w-full object-cover">


                                                    <span id="photoPlaceholder"
                                                        class="flex h-full
                                                               w-full items-center
                                                               justify-center
                                                               bg-[#FBEAE2]
                                                               text-xl font-black
                                                               text-[#A95E43]">

                                                        {{ strtoupper(substr($seller->name, 0, 1)) }}

                                                    </span>
                                                @endif

                                            </div>



                                            <div class="flex-1">

                                                <input type="file" name="photo" id="photo"
                                                    accept="image/jpeg,image/png,image/webp"
                                                    class="block w-full
                                                           rounded-xl border
                                                           border-[#DFD2C7]
                                                           bg-white
                                                           px-3 py-2
                                                           text-sm
                                                           text-[#6F6259]
                                                           file:mr-3
                                                           file:rounded-lg
                                                           file:border-0
                                                           file:bg-[#FBEAE2]
                                                           file:px-3
                                                           file:py-1.5
                                                           file:text-xs
                                                           file:font-bold
                                                           file:text-[#A95E43]">


                                                <p
                                                    class="mt-2 text-xs
                                                           text-slate-400">

                                                    JPG, PNG atau WebP.
                                                    Maksimal 2 MB.

                                                </p>

                                            </div>

                                        </div>

                                    </div>


                                    @error('photo')
                                        <p
                                            class="mt-2 text-xs
                                                   font-medium
                                                   text-[#A65954]">

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>

                            </div>



                            {{-- ACTION --}}
                            <div
                                class="mt-6 flex
                                       justify-end
                                       border-t
                                       border-[#EEE5DE]
                                       pt-5">

                                <button type="submit"
                                    class="inline-flex h-11
                                           items-center justify-center
                                           gap-2 rounded-xl
                                           bg-[#C8795A]
                                           px-5
                                           text-sm font-bold
                                           text-white
                                           shadow-sm transition
                                           hover:bg-[#B66F52]
                                           hover:shadow-md">

                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">

                                        <path d="m5 12 4 4L19 6" />

                                    </svg>

                                    Simpan Perubahan

                                </button>

                            </div>

                        </form>

                    </div>

                </section>



                {{-- ================================================= --}}
                {{-- PASSWORD --}}
                {{-- ================================================= --}}

                <section x-data="{
                    showCurrent: false,
                    showPassword: false,
                    showConfirmation: false
                }"
                    class="overflow-hidden
                           rounded-3xl
                           border border-[#DFD2C7]
                           bg-white shadow-sm">


                    {{-- HEADER --}}
                    <div
                        class="border-b
                               border-[#E7DBD1]
                               bg-[#FAF7F2]
                               p-5 sm:p-6">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex size-10
                                       shrink-0
                                       items-center justify-center
                                       rounded-xl
                                       bg-[#C89B55]
                                       text-white">

                                <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <rect x="5" y="10" width="14" height="11" rx="2" />

                                    <path d="M8 10V7a4 4 0 0 1 8 0v3" />

                                    <circle cx="12" cy="15" r="1" />

                                </svg>

                            </div>


                            <div>

                                <h2 class="font-bold
                                           text-[#332B26]">

                                    Keamanan Akun

                                </h2>

                                <p class="mt-1 text-xs
                                           text-slate-500">

                                    Perbarui password akun seller.

                                </p>

                            </div>

                        </div>

                    </div>



                    <div class="p-5 sm:p-6">

                        @if (session('password_success'))
                            <div
                                class="mb-5 flex items-start gap-3
                                       rounded-2xl
                                       border border-[#D3DFCE]
                                       bg-[#EEF3EA]
                                       px-4 py-3.5">

                                <div
                                    class="flex size-8
                                           shrink-0 items-center
                                           justify-center
                                           rounded-lg
                                           bg-[#718268]
                                           text-white">

                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">

                                        <path d="m5 12 4 4L19 6" />

                                    </svg>

                                </div>


                                <div>

                                    <p
                                        class="text-sm font-bold
                                               text-[#65795E]">

                                        Password berhasil diubah

                                    </p>


                                    <p
                                        class="mt-0.5 text-xs
                                               text-[#65795E]">

                                        {{ session('password_success') }}

                                    </p>

                                </div>

                            </div>
                        @endif



                        <form
                            action="{{ route('seller.settings.password.update') }}"
                            method="POST">

                            @csrf
                            @method('PUT')


                            <div class="space-y-5">


                                {{-- CURRENT --}}
                                <div>

                                    <label for="current_password"
                                        class="mb-2 block
                                               text-sm font-semibold
                                               text-[#4D4038]">

                                        Password Saat Ini

                                        <span class="text-[#A65954]">
                                            *
                                        </span>

                                    </label>


                                    <div class="relative">

                                        <input
                                            :type="showCurrent
                                                ?
                                                'text' :
                                                'password'"
                                            name="current_password" id="current_password" autocomplete="current-password"
                                            placeholder="Masukkan password saat ini"
                                            class="h-11 w-full
                                                   rounded-xl border
                                                   bg-white
                                                   px-4 pr-12
                                                   text-sm text-[#4D4038]
                                                   outline-none transition
                                                   placeholder:text-[#B3A195]
                                                   focus:border-[#C89B55]
                                                   focus:ring-4
                                                   focus:ring-[#FAF2DF]
                                                   {{ $errors->getBag('updatePassword')->has('current_password') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}">


                                        <button type="button"
                                            @click="
                                                showCurrent =
                                                    !showCurrent
                                            "
                                            class="absolute right-3
                                                   top-1/2
                                                   flex size-8
                                                   -translate-y-1/2
                                                   items-center justify-center
                                                   rounded-lg
                                                   text-[#9C8677]
                                                   transition
                                                   hover:bg-[#FAF2DF]
                                                   hover:text-[#A87A37]">

                                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path d="M2 12s3.5-6 10-6
                                                           10 6 10 6-3.5 6-10 6
                                                           S2 12 2 12Z" />

                                                <circle cx="12" cy="12" r="3" />

                                            </svg>

                                        </button>

                                    </div>


                                    @error('current_password', 'updatePassword')
                                        <p
                                            class="mt-2 text-xs
                                                   font-medium
                                                   text-[#A65954]">

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>



                                <div class="grid gap-5
                                           sm:grid-cols-2">


                                    {{-- NEW PASSWORD --}}
                                    <div>

                                        <label for="password"
                                            class="mb-2 block
                                                   text-sm font-semibold
                                                   text-[#4D4038]">

                                            Password Baru

                                            <span class="text-[#A65954]">
                                                *
                                            </span>

                                        </label>


                                        <div class="relative">

                                            <input
                                                :type="showPassword
                                                    ?
                                                    'text' :
                                                    'password'"
                                                name="password" id="password" autocomplete="new-password"
                                                placeholder="Minimal 8 karakter"
                                                class="h-11 w-full
                                                       rounded-xl border
                                                       bg-white
                                                       px-4 pr-12
                                                       text-sm text-[#4D4038]
                                                       outline-none transition
                                                       placeholder:text-[#B3A195]
                                                       focus:border-[#C89B55]
                                                       focus:ring-4
                                                       focus:ring-[#FAF2DF]
                                                       {{ $errors->getBag('updatePassword')->has('password') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}">


                                            <button type="button"
                                                @click="
                                                    showPassword =
                                                        !showPassword
                                                "
                                                class="absolute right-3
                                                       top-1/2
                                                       flex size-8
                                                       -translate-y-1/2
                                                       items-center justify-center
                                                       rounded-lg
                                                       text-[#9C8677]
                                                       transition
                                                       hover:bg-[#FAF2DF]
                                                       hover:text-[#A87A37]">

                                                <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.8">

                                                    <path d="M2 12s3.5-6 10-6
                                                               10 6 10 6-3.5 6-10 6
                                                               S2 12 2 12Z" />

                                                    <circle cx="12" cy="12" r="3" />

                                                </svg>

                                            </button>

                                        </div>


                                        @error('password', 'updatePassword')
                                            <p
                                                class="mt-2 text-xs
                                                       font-medium
                                                       text-[#A65954]">

                                                {{ $message }}

                                            </p>
                                        @enderror

                                    </div>



                                    {{-- CONFIRM --}}
                                    <div>

                                        <label for="password_confirmation"
                                            class="mb-2 block
                                                   text-sm font-semibold
                                                   text-[#4D4038]">

                                            Konfirmasi Password

                                            <span class="text-[#A65954]">
                                                *
                                            </span>

                                        </label>


                                        <div class="relative">

                                            <input
                                                :type="showConfirmation
                                                    ?
                                                    'text' :
                                                    'password'"
                                                name="password_confirmation" id="password_confirmation"
                                                autocomplete="new-password" placeholder="Ulangi password baru"
                                                class="h-11 w-full
                                                       rounded-xl
                                                       border border-[#DFD2C7]
                                                       bg-white
                                                       px-4 pr-12
                                                       text-sm text-[#4D4038]
                                                       outline-none transition
                                                       placeholder:text-[#B3A195]
                                                       focus:border-[#C89B55]
                                                       focus:ring-4
                                                       focus:ring-[#FAF2DF]">


                                            <button type="button"
                                                @click="
                                                    showConfirmation =
                                                        !showConfirmation
                                                "
                                                class="absolute right-3
                                                       top-1/2
                                                       flex size-8
                                                       -translate-y-1/2
                                                       items-center justify-center
                                                       rounded-lg
                                                       text-[#9C8677]
                                                       transition
                                                       hover:bg-[#FAF2DF]
                                                       hover:text-[#A87A37]">

                                                <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.8">

                                                    <path d="M2 12s3.5-6 10-6
                                                               10 6 10 6-3.5 6-10 6
                                                               S2 12 2 12Z" />

                                                    <circle cx="12" cy="12" r="3" />

                                                </svg>

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>



                            {{-- NOTICE --}}
                            <div
                                class="mt-5 flex items-start gap-3
                                       rounded-2xl
                                       border border-[#E8D8B9]
                                       bg-[#FAF2DF]
                                       p-4">

                                <div
                                    class="flex size-8
                                           shrink-0 items-center
                                           justify-center
                                           rounded-lg
                                           bg-[#C89B55]
                                           text-white">

                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">

                                        <circle cx="12" cy="12" r="9" />

                                        <path d="M12 8v5" />
                                        <path d="M12 17h.01" />

                                    </svg>

                                </div>


                                <p class="text-xs leading-5
                                           text-[#806638]">

                                    Gunakan password yang kuat dan
                                    berbeda dari password sebelumnya.

                                </p>

                            </div>



                            {{-- ACTION --}}
                            <div
                                class="mt-6 flex
                                       justify-end
                                       border-t
                                       border-[#EEE5DE]
                                       pt-5">

                                <button type="submit"
                                    class="inline-flex h-11
                                           items-center justify-center
                                           gap-2 rounded-xl
                                           bg-[#C89B55]
                                           px-5
                                           text-sm font-bold
                                           text-white
                                           shadow-sm transition
                                           hover:bg-[#A87A37]">

                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">

                                        <rect x="5" y="10" width="14" height="11" rx="2" />

                                        <path d="M8 10V7a4 4 0 0 1 8 0v3" />

                                    </svg>

                                    Ubah Password

                                </button>

                            </div>

                        </form>

                    </div>

                </section>

            </div>

        </div>

    </div>

@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const photoInput =
                document.getElementById('photo');

            const photoPreview =
                document.getElementById('photoPreview');

            const photoPlaceholder =
                document.getElementById('photoPlaceholder');


            photoInput?.addEventListener(
                'change',
                function(event) {

                    const file =
                        event.target.files[0];


                    if (!file || !photoPreview) {
                        return;
                    }


                    const reader =
                        new FileReader();


                    reader.onload =
                        function(event) {

                            photoPreview.src =
                                event.target.result;

                            photoPreview.classList.remove(
                                'hidden'
                            );

                            photoPlaceholder?.classList.add(
                                'hidden'
                            );
                        };


                    reader.readAsDataURL(file);

                }
            );

        });
    </script>
@endpush
