@extends('layouts.admin')

@section('title', 'Tambah Pembeli')

@section('content')

    <div class="mx-auto max-w-4xl">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section class="mb-6">

            <a href="{{ route('admin.buyers.index') }}"
                class="inline-flex
                       items-center
                       gap-2
                       text-sm
                       font-semibold
                       text-[#8B7465]
                       transition
                       hover:text-[#6F4E37]">

                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                    <path d="m15 18-6-6 6-6" />

                </svg>

                Kembali ke Pembeli

            </a>


            <div class="mt-5">

                <div
                    class="inline-flex
                           items-center
                           gap-2
                           rounded-full
                           bg-[#F1E6DE]
                           px-3
                           py-1.5
                           text-xs
                           font-bold
                           text-[#6F4E37]">

                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                        <circle cx="9" cy="8" r="3" />

                        <path d="M3 20c0-4 2.7-7 6-7
                                   1.4 0 2.7.5 3.8 1.3" />

                        <path d="M18 11v6" />
                        <path d="M15 14h6" />

                    </svg>

                    Tambah Pengguna

                </div>


                <h1
                    class="mt-3
                           text-2xl
                           font-black
                           tracking-tight
                           text-[#332B26]
                           lg:text-3xl">

                    Tambah Pembeli

                </h1>


                <p
                    class="mt-2
                           text-sm
                           leading-6
                           text-slate-500">

                    Buat akun pembeli baru untuk
                    menggunakan layanan KampusMart.

                </p>

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- FORM --}}
        {{-- ===================================================== --}}

        <form action="{{ route('admin.buyers.store') }}" method="POST" class="space-y-6">

            @csrf



            {{-- ================================================= --}}
            {{-- ACCOUNT INFORMATION --}}
            {{-- ================================================= --}}

            <section
                class="overflow-hidden
                       rounded-3xl
                       border
                       border-[#DFD2C7]
                       bg-white
                       shadow-sm">


                {{-- HEADER --}}

                <div
                    class="border-b
                           border-[#E7DBD1]
                           bg-[#FAF7F2]
                           p-5
                           sm:p-6">


                    <div class="flex
                               items-center
                               gap-3">

                        <div
                            class="flex
                                   size-10
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-[#6F4E37]
                                   text-white">

                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <circle cx="12" cy="8" r="3.5" />

                                <path d="M5 20c0-4 3-7 7-7s7 3 7 7" />

                            </svg>

                        </div>


                        <div>

                            <h2 class="font-bold
                                       text-[#332B26]">

                                Informasi Akun

                            </h2>


                            <p
                                class="mt-1
                                       text-xs
                                       text-slate-500">

                                Masukkan informasi dasar pembeli.

                            </p>

                        </div>

                    </div>

                </div>



                {{-- FIELDS --}}

                <div
                    class="grid
                           gap-5
                           p-5
                           sm:p-6
                           md:grid-cols-2">


                    {{-- ================================================= --}}
                    {{-- NAME --}}
                    {{-- ================================================= --}}

                    <div>

                        <label for="name"
                            class="mb-2
                                   block
                                   text-sm
                                   font-semibold
                                   text-[#4D4038]">

                            Nama Lengkap

                            <span class="text-[#A65954]">
                                *
                            </span>

                        </label>


                        <div class="relative">

                            <div
                                class="pointer-events-none
                                       absolute
                                       inset-y-0
                                       left-0
                                       flex
                                       items-center
                                       pl-4
                                       text-[#A28A7A]">

                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <circle cx="12" cy="8" r="3.5" />

                                    <path d="M5 20c0-4 3-7 7-7s7 3 7 7" />

                                </svg>

                            </div>


                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                placeholder="Masukkan nama pembeli"
                                class="h-11
                                       w-full
                                       rounded-xl
                                       border
                                       {{ $errors->has('name') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                       bg-white
                                       pl-11
                                       pr-4
                                       text-sm
                                       text-[#4D4038]
                                       outline-none
                                       transition
                                       placeholder:text-[#B6A69B]
                                       focus:border-[#A97957]
                                       focus:ring-4
                                       focus:ring-[#F1E6DE]">

                        </div>


                        @error('name')
                            <p
                                class="mt-2
                                       flex
                                       items-center
                                       gap-1.5
                                       text-xs
                                       font-medium
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



                    {{-- ================================================= --}}
                    {{-- EMAIL --}}
                    {{-- ================================================= --}}

                    <div>

                        <label for="email"
                            class="mb-2
                                   block
                                   text-sm
                                   font-semibold
                                   text-[#4D4038]">

                            Email

                            <span class="text-[#A65954]">
                                *
                            </span>

                        </label>


                        <div class="relative">

                            <div
                                class="pointer-events-none
                                       absolute
                                       inset-y-0
                                       left-0
                                       flex
                                       items-center
                                       pl-4
                                       text-[#A28A7A]">

                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <rect x="3" y="5" width="18" height="14" rx="2" />

                                    <path d="m3 7 9 6 9-6" />

                                </svg>

                            </div>


                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                placeholder="contoh@email.com"
                                class="h-11
                                       w-full
                                       rounded-xl
                                       border
                                       {{ $errors->has('email') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                       bg-white
                                       pl-11
                                       pr-4
                                       text-sm
                                       text-[#4D4038]
                                       outline-none
                                       transition
                                       placeholder:text-[#B6A69B]
                                       focus:border-[#A97957]
                                       focus:ring-4
                                       focus:ring-[#F1E6DE]">

                        </div>


                        @error('email')
                            <p
                                class="mt-2
                                       flex
                                       items-center
                                       gap-1.5
                                       text-xs
                                       font-medium
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



                    {{-- ================================================= --}}
                    {{-- PHONE --}}
                    {{-- ================================================= --}}

                    <div>

                        <label for="phone"
                            class="mb-2
                                   block
                                   text-sm
                                   font-semibold
                                   text-[#4D4038]">

                            Nomor Telepon

                        </label>


                        <div class="relative">

                            <div
                                class="pointer-events-none
                                       absolute
                                       inset-y-0
                                       left-0
                                       flex
                                       items-center
                                       pl-4
                                       text-[#A28A7A]">

                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <path d="M6 3h4l2 5-3 2
                                               a14 14 0 0 0 5 5
                                               l2-3 5 2v4
                                               c0 1.7-1.3 3-3 3
                                               C9.7 21 3 14.3 3 6
                                               c0-1.7 1.3-3 3-3Z" />

                                </svg>

                            </div>


                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                placeholder="Contoh: 081234567890"
                                class="h-11
                                       w-full
                                       rounded-xl
                                       border
                                       {{ $errors->has('phone') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                       bg-white
                                       pl-11
                                       pr-4
                                       text-sm
                                       text-[#4D4038]
                                       outline-none
                                       transition
                                       placeholder:text-[#B6A69B]
                                       focus:border-[#A97957]
                                       focus:ring-4
                                       focus:ring-[#F1E6DE]">

                        </div>


                        @error('phone')
                            <p
                                class="mt-2
                                       flex
                                       items-center
                                       gap-1.5
                                       text-xs
                                       font-medium
                                       text-[#A65954]">

                                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">

                                    <circle cx="12" cy="12" r="9" />

                                    <path d="M12 8v5" />
                                    <path d="M12 17h.01" />

                                </svg>

                                {{ $message }}

                            </p>
                        @enderror

                    </div>



                    {{-- ================================================= --}}
                    {{-- STATUS --}}
                    {{-- ================================================= --}}

                    <div>

                        <label for="status"
                            class="mb-2
                                   block
                                   text-sm
                                   font-semibold
                                   text-[#4D4038]">

                            Status Akun

                            <span class="text-[#A65954]">
                                *
                            </span>

                        </label>


                        <select name="status" id="status"
                            class="h-11
                                   w-full
                                   rounded-xl
                                   border
                                   {{ $errors->has('status') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                   bg-white
                                   px-4
                                   text-sm
                                   font-medium
                                   text-[#4D4038]
                                   outline-none
                                   transition
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
                            class="mt-2
                                   flex
                                   items-center
                                   gap-2
                                   text-xs
                                   text-slate-400">

                            <span
                                class="size-1.5
                                       rounded-full
                                       bg-[#718268]">
                            </span>

                            Akun aktif dapat langsung digunakan
                            untuk masuk ke KampusMart.

                        </div>


                        @error('status')
                            <p
                                class="mt-2
                                       text-xs
                                       font-medium
                                       text-[#A65954]">

                                {{ $message }}

                            </p>
                        @enderror

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
                class="overflow-hidden
                       rounded-3xl
                       border
                       border-[#DFD2C7]
                       bg-white
                       shadow-sm">


                {{-- HEADER --}}

                <div
                    class="border-b
                           border-[#E7DBD1]
                           bg-[#FAF7F2]
                           p-5
                           sm:p-6">


                    <div class="flex
                               items-center
                               gap-3">


                        <div
                            class="flex
                                   size-10
                                   shrink-0
                                   items-center
                                   justify-center
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

                                Password

                            </h2>


                            <p
                                class="mt-1
                                       text-xs
                                       text-slate-500">

                                Tentukan password awal untuk akun pembeli.

                            </p>

                        </div>

                    </div>

                </div>



                {{-- PASSWORD FIELDS --}}

                <div
                    class="grid
                           gap-5
                           p-5
                           sm:p-6
                           md:grid-cols-2">


                    {{-- PASSWORD --}}

                    <div>

                        <label for="password"
                            class="mb-2
                                   block
                                   text-sm
                                   font-semibold
                                   text-[#4D4038]">

                            Password

                            <span class="text-[#A65954]">
                                *
                            </span>

                        </label>


                        <div class="relative">

                            <input :type="showPassword ? 'text' : 'password'" name="password" id="password"
                                autocomplete="new-password" placeholder="Minimal 8 karakter"
                                class="h-11
                                       w-full
                                       rounded-xl
                                       border
                                       {{ $errors->has('password') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                       bg-white
                                       px-4
                                       pr-11
                                       text-sm
                                       text-[#4D4038]
                                       outline-none
                                       transition
                                       placeholder:text-[#B6A69B]
                                       focus:border-[#A97957]
                                       focus:ring-4
                                       focus:ring-[#F1E6DE]">


                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute
                                       right-3
                                       top-1/2
                                       flex
                                       size-8
                                       -translate-y-1/2
                                       items-center
                                       justify-center
                                       rounded-lg
                                       text-[#9C8677]
                                       transition
                                       hover:bg-[#F1E6DE]
                                       hover:text-[#6F4E37]">


                                {{-- EYE --}}

                                <svg x-show="!showPassword" class="size-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8">

                                    <path d="M2 12s3.5-6 10-6
                                               10 6 10 6-3.5 6-10 6
                                               S2 12 2 12Z" />

                                    <circle cx="12" cy="12" r="3" />

                                </svg>


                                {{-- EYE OFF --}}

                                <svg x-cloak x-show="showPassword" class="size-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8">

                                    <path d="m3 3 18 18" />

                                    <path d="M10.6 6.2
                                               C11 6.1 11.5 6 12 6
                                               c6.5 0 10 6 10 6
                                               a17 17 0 0 1-3.2 3.8" />

                                    <path d="M6.5 6.5
                                               C3.6 8.3 2 12 2 12
                                               s3.5 6 10 6
                                               c1 0 2-.2 2.8-.4" />

                                </svg>

                            </button>

                        </div>


                        <p
                            class="mt-2
                                   text-xs
                                   text-slate-400">

                            Gunakan minimal 8 karakter.

                        </p>


                        @error('password')
                            <p
                                class="mt-2
                                       text-xs
                                       font-medium
                                       text-[#A65954]">

                                {{ $message }}

                            </p>
                        @enderror

                    </div>



                    {{-- PASSWORD CONFIRMATION --}}

                    <div>

                        <label for="password_confirmation"
                            class="mb-2
                                   block
                                   text-sm
                                   font-semibold
                                   text-[#4D4038]">

                            Konfirmasi Password

                            <span class="text-[#A65954]">
                                *
                            </span>

                        </label>


                        <div class="relative">

                            <input :type="showConfirmation ? 'text' : 'password'" name="password_confirmation"
                                id="password_confirmation" autocomplete="new-password" placeholder="Ulangi password"
                                class="h-11
                                       w-full
                                       rounded-xl
                                       border
                                       border-[#DFD2C7]
                                       bg-white
                                       px-4
                                       pr-11
                                       text-sm
                                       text-[#4D4038]
                                       outline-none
                                       transition
                                       placeholder:text-[#B6A69B]
                                       focus:border-[#A97957]
                                       focus:ring-4
                                       focus:ring-[#F1E6DE]">


                            <button type="button" @click="showConfirmation = !showConfirmation"
                                class="absolute
                                       right-3
                                       top-1/2
                                       flex
                                       size-8
                                       -translate-y-1/2
                                       items-center
                                       justify-center
                                       rounded-lg
                                       text-[#9C8677]
                                       transition
                                       hover:bg-[#F1E6DE]
                                       hover:text-[#6F4E37]">


                                <svg x-show="!showConfirmation" class="size-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8">

                                    <path d="M2 12s3.5-6 10-6
                                               10 6 10 6-3.5 6-10 6
                                               S2 12 2 12Z" />

                                    <circle cx="12" cy="12" r="3" />

                                </svg>


                                <svg x-cloak x-show="showConfirmation" class="size-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8">

                                    <path d="m3 3 18 18" />

                                    <path d="M10.6 6.2
                                               C11 6.1 11.5 6 12 6
                                               c6.5 0 10 6 10 6
                                               a17 17 0 0 1-3.2 3.8" />

                                    <path d="M6.5 6.5
                                               C3.6 8.3 2 12 2 12
                                               s3.5 6 10 6
                                               c1 0 2-.2 2.8-.4" />

                                </svg>

                            </button>

                        </div>

                    </div>

                </div>

            </section>



            {{-- ================================================= --}}
            {{-- ACTION --}}
            {{-- ================================================= --}}

            <div
                class="flex
                       flex-col-reverse
                       gap-3
                       sm:flex-row
                       sm:items-center
                       sm:justify-end">


                <a href="{{ route('admin.buyers.index') }}"
                    class="inline-flex
                           h-11
                           items-center
                           justify-center
                           gap-2
                           rounded-xl
                           border
                           border-[#DFD2C7]
                           bg-white
                           px-5
                           text-sm
                           font-semibold
                           text-[#6F6259]
                           transition
                           hover:bg-[#F3EAE3]
                           hover:text-[#493124]">

                    Batal

                </a>



                <button type="submit"
                    class="inline-flex
                           h-11
                           items-center
                           justify-center
                           gap-2
                           rounded-xl
                           bg-[#6F4E37]
                           px-5
                           text-sm
                           font-bold
                           text-white
                           shadow-sm
                           transition
                           hover:bg-[#5B3B2B]
                           hover:shadow-md">


                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <path d="m5 12 4 4L19 6" />

                    </svg>

                    Simpan Pembeli

                </button>

            </div>

        </form>

    </div>

@endsection
