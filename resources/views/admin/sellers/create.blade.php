@extends('layouts.admin')

@section('title', 'Tambah Penjual')

@section('content')

    <div class="mx-auto max-w-5xl">

        {{-- HEADER --}}
        <section class="mb-6">

            <a href="{{ route('admin.sellers.index') }}"
                class="inline-flex items-center gap-2
                       text-sm font-semibold text-[#8B7465]
                       transition hover:text-[#6F4E37]">

                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m15 18-6-6 6-6" />
                </svg>

                Kembali ke Penjual
            </a>


            <div class="mt-5">

                <div
                    class="inline-flex items-center gap-2
                           rounded-full bg-[#FBEAE2]
                           px-3 py-1.5 text-xs
                           font-bold text-[#A95E43]">

                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="9" cy="8" r="3" />
                        <path d="M3 20c0-4 2.7-7 6-7 1.4 0 2.7.5 3.8 1.3" />
                        <path d="M18 11v6" />
                        <path d="M15 14h6" />
                    </svg>

                    Tambah Seller
                </div>

                <h1
                    class="mt-3 text-2xl font-black
                           tracking-tight text-[#332B26]
                           lg:text-3xl">
                    Tambah Penjual
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Buat akun penjual baru beserta informasi tokonya.
                </p>

            </div>

        </section>


        <form action="{{ route('admin.sellers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">

            @csrf


            {{-- ================================================= --}}
            {{-- ACCOUNT --}}
            {{-- ================================================= --}}

            <section
                class="overflow-hidden rounded-3xl
                       border border-[#DFD2C7]
                       bg-white shadow-sm">

                <div class="border-b border-[#E7DBD1]
                           bg-[#FAF7F2] p-5 sm:p-6">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex size-10 items-center justify-center
                                   rounded-xl bg-[#C8795A]
                                   text-white">

                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <circle cx="12" cy="8" r="3.5" />
                                <path d="M5 20c0-4 3-7 7-7s7 3 7 7" />

                            </svg>

                        </div>

                        <div>
                            <h2 class="font-bold text-[#332B26]">
                                Informasi Akun
                            </h2>

                            <p class="mt-1 text-xs text-slate-500">
                                Data akun yang digunakan seller untuk masuk.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="grid gap-5 p-5 sm:p-6 md:grid-cols-2">

                    {{-- NAME --}}
                    <div>

                        <label for="name"
                            class="mb-2 block text-sm
                                   font-semibold text-[#4D4038]">
                            Nama Penjual
                            <span class="text-[#A65954]">*</span>
                        </label>

                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                            placeholder="Masukkan nama penjual"
                            class="h-11 w-full rounded-xl border
                                   {{ $errors->has('name') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                   bg-white px-4 text-sm
                                   outline-none transition
                                   focus:border-[#A97957]
                                   focus:ring-4 focus:ring-[#F1E6DE]">

                        @error('name')
                            <p class="mt-2 text-xs font-medium text-[#A65954]">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- NIM --}}
                    <div>

                        <label for="nim"
                            class="mb-2 block text-sm
                                   font-semibold text-[#4D4038]">
                            NIM
                        </label>

                        <input id="nim" type="text" name="nim" value="{{ old('nim') }}"
                            placeholder="Contoh: 230001234"
                            class="h-11 w-full rounded-xl
                                   border border-[#DFD2C7]
                                   bg-white px-4 text-sm
                                   outline-none transition
                                   focus:border-[#A97957]
                                   focus:ring-4 focus:ring-[#F1E6DE]">

                        @error('nim')
                            <p class="mt-2 text-xs font-medium text-[#A65954]">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- EMAIL --}}
                    <div>

                        <label for="email"
                            class="mb-2 block text-sm
                                   font-semibold text-[#4D4038]">
                            Email
                            <span class="text-[#A65954]">*</span>
                        </label>

                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            placeholder="contoh@email.com"
                            class="h-11 w-full rounded-xl border
                                   {{ $errors->has('email') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                   bg-white px-4 text-sm
                                   outline-none transition
                                   focus:border-[#A97957]
                                   focus:ring-4 focus:ring-[#F1E6DE]">

                        @error('email')
                            <p class="mt-2 text-xs font-medium text-[#A65954]">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- PHONE --}}
                    <div>

                        <label for="phone"
                            class="mb-2 block text-sm
                                   font-semibold text-[#4D4038]">
                            Nomor HP
                        </label>

                        <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                            placeholder="08xxxxxxxxxx"
                            class="h-11 w-full rounded-xl
                                   border border-[#DFD2C7]
                                   bg-white px-4 text-sm
                                   outline-none transition
                                   focus:border-[#A97957]
                                   focus:ring-4 focus:ring-[#F1E6DE]">

                        @error('phone')
                            <p class="mt-2 text-xs font-medium text-[#A65954]">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- PHOTO --}}
                    <div class="md:col-span-2">

                        <label for="photo"
                            class="mb-2 block text-sm
                                   font-semibold text-[#4D4038]">
                            Foto Penjual
                        </label>

                        <input type="file" name="photo" id="photo" accept="image/jpeg,image/png,image/webp"
                            class="block w-full rounded-xl
                                   border border-[#DFD2C7]
                                   bg-white px-4 py-3
                                   text-sm text-slate-600
                                   file:mr-4 file:rounded-lg
                                   file:border-0
                                   file:bg-[#FBEAE2]
                                   file:px-4 file:py-2
                                   file:text-sm file:font-bold
                                   file:text-[#A95E43]
                                   hover:file:bg-[#F5DDD2]">

                        <p class="mt-2 text-xs text-slate-400">
                            JPG, PNG, atau WEBP. Maksimal 2 MB.
                        </p>

                        @error('photo')
                            <p class="mt-2 text-xs font-medium text-[#A65954]">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- STORE --}}
            {{-- ================================================= --}}

            <section
                class="overflow-hidden rounded-3xl
                       border border-[#DFD2C7]
                       bg-white shadow-sm">

                <div class="border-b border-[#E7DBD1]
                           bg-[#FAF7F2] p-5 sm:p-6">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex size-10 items-center justify-center
                                   rounded-xl bg-[#6F4E37] text-white">

                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <path d="M4 10v10h16V10" />
                                <path d="M3 10l2-6h14l2 6" />
                                <path d="M8 20v-6h8v6" />
                            </svg>

                        </div>

                        <div>
                            <h2 class="font-bold text-[#332B26]">
                                Informasi Toko
                            </h2>

                            <p class="mt-1 text-xs text-slate-500">
                                Informasi yang akan dilihat pembeli.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="grid gap-5 p-5 sm:p-6 md:grid-cols-2">

                    <div>

                        <label for="store_name"
                            class="mb-2 block text-sm
                                   font-semibold text-[#4D4038]">
                            Nama Toko
                            <span class="text-[#A65954]">*</span>
                        </label>

                        <input id="store_name" type="text" name="store_name" value="{{ old('store_name') }}"
                            required
                            class="h-11 w-full rounded-xl
                                   border border-[#DFD2C7]
                                   px-4 text-sm outline-none
                                   transition focus:border-[#A97957]
                                   focus:ring-4 focus:ring-[#F1E6DE]">

                        @error('store_name')
                            <p class="mt-2 text-xs font-medium text-[#A65954]">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <div>

                        <label for="whatsapp"
                            class="mb-2 block text-sm
                                   font-semibold text-[#4D4038]">
                            WhatsApp
                            <span class="text-[#A65954]">*</span>
                        </label>

                        <input id="whatsapp" type="text" name="whatsapp" value="{{ old('whatsapp') }}"
                            placeholder="08xxxxxxxxxx" required
                            class="h-11 w-full rounded-xl
                                   border border-[#DFD2C7]
                                   px-4 text-sm outline-none
                                   transition focus:border-[#A97957]
                                   focus:ring-4 focus:ring-[#F1E6DE]">

                        @error('whatsapp')
                            <p class="mt-2 text-xs font-medium text-[#A65954]">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <div>

                        <label for="faculty"
                            class="mb-2 block text-sm
                                   font-semibold text-[#4D4038]">
                            Fakultas
                        </label>

                        <input id="faculty" type="text" name="faculty" value="{{ old('faculty') }}"
                            placeholder="Contoh: Fakultas Teknik"
                            class="h-11 w-full rounded-xl
                                   border border-[#DFD2C7]
                                   px-4 text-sm outline-none
                                   transition focus:border-[#A97957]
                                   focus:ring-4 focus:ring-[#F1E6DE]">

                    </div>


                    <div>

                        <label for="status"
                            class="mb-2 block text-sm
                                   font-semibold text-[#4D4038]">
                            Status Akun
                        </label>

                        <select id="status" name="status"
                            class="h-11 w-full rounded-xl
                                   border border-[#DFD2C7]
                                   bg-white px-4 text-sm
                                   outline-none transition
                                   focus:border-[#A97957]
                                   focus:ring-4 focus:ring-[#F1E6DE]">

                            <option value="active" @selected(old('status', 'active') === 'active')>
                                Aktif
                            </option>

                            <option value="inactive" @selected(old('status') === 'inactive')>
                                Nonaktif
                            </option>

                        </select>

                    </div>


                    <div class="md:col-span-2">

                        <label for="description"
                            class="mb-2 block text-sm
                                   font-semibold text-[#4D4038]">
                            Deskripsi Toko
                        </label>

                        <textarea id="description" name="description" rows="5" placeholder="Jelaskan secara singkat tentang toko..."
                            class="w-full resize-none rounded-xl
                                   border border-[#DFD2C7]
                                   p-4 text-sm leading-6
                                   outline-none transition
                                   focus:border-[#A97957]
                                   focus:ring-4 focus:ring-[#F1E6DE]">{{ old('description') }}</textarea>

                    </div>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- PASSWORD --}}
            {{-- ================================================= --}}

            <section x-data="{
                showPassword: false,
                showConfirmation: false
            }"
                class="overflow-hidden rounded-3xl
                       border border-[#DFD2C7]
                       bg-white shadow-sm">

                <div class="border-b border-[#E7DBD1]
                           bg-[#FAF7F2] p-5 sm:p-6">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex size-10 items-center justify-center
                                   rounded-xl bg-[#C89B55] text-white">

                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <rect x="5" y="10" width="14" height="11" rx="2" />
                                <path d="M8 10V7a4 4 0 0 1 8 0v3" />

                            </svg>

                        </div>

                        <div>
                            <h2 class="font-bold text-[#332B26]">
                                Password Awal
                            </h2>

                            <p class="mt-1 text-xs text-slate-500">
                                Password pertama yang digunakan seller untuk login.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="grid gap-5 p-5 sm:p-6 md:grid-cols-2">

                    <div>

                        <label for="password"
                            class="mb-2 block text-sm
                                   font-semibold text-[#4D4038]">
                            Password
                            <span class="text-[#A65954]">*</span>
                        </label>

                        <div class="relative">

                            <input :type="showPassword ? 'text' : 'password'" name="password" id="password" required
                                autocomplete="new-password" placeholder="Minimal 8 karakter"
                                class="h-11 w-full rounded-xl
                                       border border-[#DFD2C7]
                                       px-4 pr-11 text-sm
                                       outline-none transition
                                       focus:border-[#A97957]
                                       focus:ring-4 focus:ring-[#F1E6DE]">

                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2
                                       flex size-8 -translate-y-1/2
                                       items-center justify-center
                                       rounded-lg text-[#9C8677]
                                       hover:bg-[#F1E6DE]">

                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>

                            </button>

                        </div>

                        @error('password')
                            <p class="mt-2 text-xs font-medium text-[#A65954]">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <div>

                        <label for="password_confirmation"
                            class="mb-2 block text-sm
                                   font-semibold text-[#4D4038]">
                            Konfirmasi Password
                            <span class="text-[#A65954]">*</span>
                        </label>

                        <div class="relative">

                            <input :type="showConfirmation ? 'text' : 'password'" name="password_confirmation"
                                id="password_confirmation" required autocomplete="new-password"
                                placeholder="Ulangi password"
                                class="h-11 w-full rounded-xl
                                       border border-[#DFD2C7]
                                       px-4 pr-11 text-sm
                                       outline-none transition
                                       focus:border-[#A97957]
                                       focus:ring-4 focus:ring-[#F1E6DE]">

                            <button type="button" @click="showConfirmation = !showConfirmation"
                                class="absolute right-3 top-1/2
                                       flex size-8 -translate-y-1/2
                                       items-center justify-center
                                       rounded-lg text-[#9C8677]
                                       hover:bg-[#F1E6DE]">

                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>

                            </button>

                        </div>

                    </div>

                </div>

            </section>


            {{-- ACTION --}}
            <div class="flex flex-col-reverse gap-3
                       sm:flex-row sm:justify-end">

                <a href="{{ route('admin.sellers.index') }}"
                    class="inline-flex h-11 items-center justify-center
                           rounded-xl border border-[#DFD2C7]
                           bg-white px-5 text-sm font-semibold
                           text-[#6F6259] transition
                           hover:bg-[#F3EAE3]">
                    Batal
                </a>

                <button type="submit"
                    class="inline-flex h-11 items-center justify-center gap-2
                           rounded-xl bg-[#C8795A] px-6
                           text-sm font-bold text-white shadow-sm
                           transition hover:bg-[#B66F52]">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m5 12 4 4L19 6" />
                    </svg>

                    Simpan Penjual

                </button>

            </div>

        </form>

    </div>

@endsection
