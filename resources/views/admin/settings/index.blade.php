@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')

    <div class="mx-auto max-w-[1200px]">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section class="mb-6">

            <div
                class="inline-flex items-center gap-2
                       rounded-full bg-[#F4EAE2]
                       px-3 py-1.5
                       text-xs font-bold text-[#4371d1]">

                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                    <circle cx="12" cy="12" r="3" />
                    <path
                        d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-2.8 2.8-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.6V21h-4v-.1a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1L4.2 17l.1-.1a1.7 1.7 0 0 0 .3-1.9A1.7 1.7 0 0 0 3 14H3v-4h.1a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9L4.2 7 7 4.2l.1.1a1.7 1.7 0 0 0 1.9.3 1.7 1.7 0 0 0 1-1.6V3h4v.1a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9-.3l.1-.1L19.8 7l-.1.1a1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0 1.6 1H21v4h-.1a1.7 1.7 0 0 0-1.5 1Z" />

                </svg>

                Pengaturan Admin

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

                Kelola informasi profil dan keamanan
                akun administrator KampusMart.

            </p>

        </section>



        {{-- ===================================================== --}}
        {{-- CONTENT --}}
        {{-- ===================================================== --}}

        <div class="grid gap-6 lg:grid-cols-[320px_1fr]">


            {{-- ================================================= --}}
            {{-- ADMIN PROFILE CARD --}}
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
                               from-[#4371d1]
                               via-[#9A6B4C]
                               to-[#C89B55]">
                    </div>


                    <div class="p-6">

                        <div class="flex flex-col
                                   items-center text-center">

                            <div
                                class="flex size-20
                                       items-center justify-center
                                       rounded-3xl
                                       bg-[#4371d1]
                                       text-2xl font-black
                                       uppercase text-white
                                       shadow-sm">

                                {{ strtoupper(substr($admin->name, 0, 1)) }}

                            </div>


                            <h2 class="mt-4 text-lg
                                       font-black text-[#332B26]">

                                {{ $admin->name }}

                            </h2>


                            <p
                                class="mt-1 max-w-full
                                       break-all text-sm
                                       text-slate-500">

                                {{ $admin->email }}

                            </p>


                            <span
                                class="mt-4 inline-flex
                                       items-center gap-2
                                       rounded-full
                                       border border-[#DFD2C7]
                                       bg-[#F4EAE2]
                                       px-3 py-1.5
                                       text-xs font-bold
                                       text-[#4371d1]">

                                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <path d="M12 3 5 6v5c0 4.4 3 8.5 7 10 4-1.5 7-5.6 7-10V6Z" />
                                    <path d="m9 12 2 2 4-4" />

                                </svg>

                                Administrator

                            </span>

                        </div>


                        <div
                            class="mt-6 border-t
                                   border-[#EEE5DE]
                                   pt-5">

                            <div class="space-y-4">

                                <div class="flex items-start gap-3">

                                    <div
                                        class="flex size-8
                                               shrink-0
                                               items-center justify-center
                                               rounded-lg
                                               bg-[#FAF7F2]
                                               text-[#8B7465]">

                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.8">

                                            <rect x="3" y="5" width="18" height="14" rx="2" />
                                            <path d="m3 7 9 6 9-6" />

                                        </svg>

                                    </div>

                                    <div class="min-w-0">

                                        <p
                                            class="text-[10px]
                                                   font-bold uppercase
                                                   tracking-wider
                                                   text-[#A28A7A]">

                                            Email

                                        </p>

                                        <p
                                            class="mt-1 break-all
                                                   text-xs font-semibold
                                                   text-[#4D4038]">

                                            {{ $admin->email }}

                                        </p>

                                    </div>

                                </div>


                                <div class="flex items-start gap-3">

                                    <div
                                        class="flex size-8
                                               shrink-0
                                               items-center justify-center
                                               rounded-lg
                                               bg-[#FAF7F2]
                                               text-[#8B7465]">

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

                                    <div>

                                        <p
                                            class="text-[10px]
                                                   font-bold uppercase
                                                   tracking-wider
                                                   text-[#A28A7A]">

                                            Nomor Telepon

                                        </p>

                                        <p
                                            class="mt-1 text-xs
                                                   font-semibold
                                                   text-[#4D4038]">

                                            {{ $admin->phone ?? 'Belum diatur' }}

                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

            </aside>



            {{-- ================================================= --}}
            {{-- RIGHT CONTENT --}}
            {{-- ================================================= --}}

            <div class="space-y-6">


                {{-- ================================================= --}}
                {{-- PROFILE --}}
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
                                       bg-[#4371d1]
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

                                    Informasi Profil

                                </h2>

                                <p class="mt-1 text-xs
                                           text-slate-500">

                                    Perbarui informasi dasar
                                    akun administrator.

                                </p>

                            </div>

                        </div>

                    </div>



                    {{-- FORM --}}
                    <form action="{{ route('admin.settings.profile') }}" method="POST" class="p-5 sm:p-6">

                        @csrf
                        @method('PUT')


                        {{-- SUCCESS --}}
                        @if (session('success'))
                            <div
                                class="mb-5 flex items-start gap-3
                                       rounded-2xl
                                       border border-[#D3DFCE]
                                       bg-[#EEF3EA]
                                       px-4 py-3.5
                                       text-[#65795E]">

                                <div
                                    class="flex size-8
                                           shrink-0
                                           items-center justify-center
                                           rounded-lg
                                           bg-[#718268]
                                           text-white">

                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">

                                        <path d="m5 12 4 4L19 6" />

                                    </svg>

                                </div>

                                <div>

                                    <p class="text-sm font-bold">
                                        Berhasil
                                    </p>

                                    <p class="mt-0.5 text-xs">
                                        {{ session('success') }}
                                    </p>

                                </div>

                            </div>
                        @endif



                        <div class="grid gap-5 md:grid-cols-2">


                            {{-- NAME --}}
                            <div>

                                <label for="name"
                                    class="mb-2 block
                                           text-sm font-semibold
                                           text-[#4D4038]">

                                    Nama

                                    <span class="text-[#A65954]">
                                        *
                                    </span>

                                </label>


                                <div class="relative">

                                    <svg class="pointer-events-none
                                               absolute left-4 top-1/2
                                               size-4 -translate-y-1/2
                                               text-[#A28A7A]"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                        <circle cx="12" cy="8" r="3.5" />
                                        <path d="M5 20c0-4 3-7 7-7s7 3 7 7" />

                                    </svg>


                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $admin->name) }}"
                                        class="h-11 w-full
                                               rounded-xl border
                                               {{ $errors->has('name') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                               bg-white pl-11 pr-4
                                               text-sm text-[#4D4038]
                                               outline-none transition
                                               focus:border-[#A97957]
                                               focus:ring-4
                                               focus:ring-[#F1E6DE]">

                                </div>


                                @error('name')
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


                                <div class="relative">

                                    <svg class="pointer-events-none
                                               absolute left-4 top-1/2
                                               size-4 -translate-y-1/2
                                               text-[#A28A7A]"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                        <rect x="3" y="5" width="18" height="14" rx="2" />
                                        <path d="m3 7 9 6 9-6" />

                                    </svg>


                                    <input type="email" id="email" name="email"
                                        value="{{ old('email', $admin->email) }}"
                                        class="h-11 w-full
                                               rounded-xl border
                                               {{ $errors->has('email') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                               bg-white pl-11 pr-4
                                               text-sm text-[#4D4038]
                                               outline-none transition
                                               focus:border-[#A97957]
                                               focus:ring-4
                                               focus:ring-[#F1E6DE]">

                                </div>


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
                            <div class="md:col-span-2">

                                <label for="phone"
                                    class="mb-2 block
                                           text-sm font-semibold
                                           text-[#4D4038]">

                                    Nomor Telepon

                                </label>


                                <div class="relative">

                                    <svg class="pointer-events-none
                                               absolute left-4 top-1/2
                                               size-4 -translate-y-1/2
                                               text-[#A28A7A]"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                        <path d="M6 3h4l2 5-3 2
                                                   a14 14 0 0 0 5 5
                                                   l2-3 5 2v4
                                                   c0 1.7-1.3 3-3 3
                                                   C9.7 21 3 14.3 3 6
                                                   c0-1.7 1.3-3 3-3Z" />

                                    </svg>


                                    <input type="text" id="phone" name="phone"
                                        value="{{ old('phone', $admin->phone) }}" placeholder="Contoh: 081234567890"
                                        class="h-11 w-full
                                               rounded-xl border
                                               {{ $errors->has('phone') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                               bg-white pl-11 pr-4
                                               text-sm text-[#4D4038]
                                               outline-none transition
                                               placeholder:text-[#B3A195]
                                               focus:border-[#A97957]
                                               focus:ring-4
                                               focus:ring-[#F1E6DE]">

                                </div>


                                @error('phone')
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
                                       bg-[#4371d1]
                                       px-5
                                       text-sm font-bold
                                       text-white
                                       shadow-sm transition
                                       hover:bg-[#0a1d45]
                                       hover:shadow-md">

                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">

                                    <path d="m5 12 4 4L19 6" />

                                </svg>

                                Simpan Perubahan

                            </button>

                        </div>

                    </form>

                </section>



                {{-- ================================================= --}}
                {{-- SECURITY / PASSWORD --}}
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

                                    Perbarui password untuk menjaga
                                    keamanan akun administrator.

                                </p>

                            </div>

                        </div>

                    </div>



                    <form action="{{ route('admin.settings.password') }}" method="POST" class="p-5 sm:p-6">

                        @csrf
                        @method('PUT')


                        {{-- SUCCESS --}}
                        @if (session('password_success'))
                            <div
                                class="mb-5 flex items-start gap-3
                                       rounded-2xl
                                       border border-[#D3DFCE]
                                       bg-[#EEF3EA]
                                       px-4 py-3.5
                                       text-[#65795E]">

                                <div
                                    class="flex size-8
                                           shrink-0
                                           items-center justify-center
                                           rounded-lg
                                           bg-[#718268]
                                           text-white">

                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">

                                        <path d="m5 12 4 4L19 6" />

                                    </svg>

                                </div>


                                <div>

                                    <p class="text-sm font-bold">
                                        Password berhasil diubah
                                    </p>

                                    <p class="mt-0.5 text-xs">
                                        {{ session('password_success') }}
                                    </p>

                                </div>

                            </div>
                        @endif



                        <div class="space-y-5">

                            {{-- CURRENT PASSWORD --}}
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

                                    <input :type="showCurrent ? 'text' : 'password'" name="current_password"
                                        id="current_password" autocomplete="current-password"
                                        placeholder="Masukkan password saat ini"
                                        class="h-11 w-full
                                               rounded-xl border
                                               {{ $errors->has('current_password') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                               bg-white px-4 pr-12
                                               text-sm text-[#4D4038]
                                               outline-none transition
                                               placeholder:text-[#B3A195]
                                               focus:border-[#A97957]
                                               focus:ring-4
                                               focus:ring-[#F1E6DE]">


                                    <button type="button" @click="showCurrent = !showCurrent"
                                        class="absolute right-3 top-1/2
                                               flex size-8
                                               -translate-y-1/2
                                               items-center justify-center
                                               rounded-lg
                                               text-[#9C8677]
                                               transition
                                               hover:bg-[#F1E6DE]
                                               hover:text-[#4371d1]">

                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.8">

                                            <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" />
                                            <circle cx="12" cy="12" r="3" />

                                        </svg>

                                    </button>

                                </div>


                                @error('current_password')
                                    <p
                                        class="mt-2 text-xs
                                               font-medium
                                               text-[#A65954]">

                                        {{ $message }}

                                    </p>
                                @enderror

                            </div>



                            <div class="grid gap-5 md:grid-cols-2">


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

                                        <input :type="showPassword ? 'text' : 'password'" name="password" id="password"
                                            autocomplete="new-password" placeholder="Minimal 8 karakter"
                                            class="h-11 w-full
                                                   rounded-xl border
                                                   {{ $errors->has('password') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                                   bg-white px-4 pr-12
                                                   text-sm text-[#4D4038]
                                                   outline-none transition
                                                   placeholder:text-[#B3A195]
                                                   focus:border-[#A97957]
                                                   focus:ring-4
                                                   focus:ring-[#F1E6DE]">


                                        <button type="button" @click="showPassword = !showPassword"
                                            class="absolute right-3 top-1/2
                                                   flex size-8
                                                   -translate-y-1/2
                                                   items-center justify-center
                                                   rounded-lg
                                                   text-[#9C8677]
                                                   transition
                                                   hover:bg-[#F1E6DE]
                                                   hover:text-[#4371d1]">

                                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" />
                                                <circle cx="12" cy="12" r="3" />

                                            </svg>

                                        </button>

                                    </div>


                                    <p class="mt-2 text-xs
                                               text-slate-400">

                                        Gunakan minimal 8 karakter.

                                    </p>


                                    @error('password')
                                        <p
                                            class="mt-2 text-xs
                                                   font-medium
                                                   text-[#A65954]">

                                            {{ $message }}

                                        </p>
                                    @enderror

                                </div>



                                {{-- CONFIRMATION --}}
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

                                        <input :type="showConfirmation ? 'text' : 'password'" name="password_confirmation"
                                            id="password_confirmation" autocomplete="new-password"
                                            placeholder="Ulangi password baru"
                                            class="h-11 w-full
                                                   rounded-xl
                                                   border border-[#DFD2C7]
                                                   bg-white px-4 pr-12
                                                   text-sm text-[#4D4038]
                                                   outline-none transition
                                                   placeholder:text-[#B3A195]
                                                   focus:border-[#A97957]
                                                   focus:ring-4
                                                   focus:ring-[#F1E6DE]">


                                        <button type="button" @click="showConfirmation = !showConfirmation"
                                            class="absolute right-3 top-1/2
                                                   flex size-8
                                                   -translate-y-1/2
                                                   items-center justify-center
                                                   rounded-lg
                                                   text-[#9C8677]
                                                   transition
                                                   hover:bg-[#F1E6DE]
                                                   hover:text-[#4371d1]">

                                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" />
                                                <circle cx="12" cy="12" r="3" />

                                            </svg>

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>



                        {{-- SECURITY NOTICE --}}
                        <div
                            class="mt-5 flex items-start gap-3
                                   rounded-2xl
                                   border border-[#E8D8B9]
                                   bg-[#FAF2DF]
                                   p-4">

                            <div
                                class="flex size-8
                                       shrink-0
                                       items-center justify-center
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

                                Pastikan password baru berbeda dari
                                password sebelumnya dan tidak mudah
                                ditebak.

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

                </section>

            </div>

        </div>

    </div>

@endsection
