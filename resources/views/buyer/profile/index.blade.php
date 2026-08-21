@extends('layouts.public')

@section('title', 'Profile - KampusMart')

@section('content')

    <div
        class="min-h-screen
               bg-gradient-to-br
               from-[#FBF8F5]
               via-[#FAF5F1]
               to-[#F4EAE2]">


        <main
            class="mx-auto
                   max-w-7xl
                   px-4
                   py-6
                   pb-28
                   sm:px-5
                   sm:py-8
                   md:pb-10">


            {{-- ===================================================== --}}
            {{-- HEADER --}}
            {{-- ===================================================== --}}

            <section
                class="relative
                       mb-5
                       overflow-hidden
                       rounded-3xl
                       border
                       border-[#E6D8CD]
                       bg-gradient-to-br
                       from-white
                       via-[#FBF8F5]
                       to-[#F4EAE2]
                       p-5
                       shadow-sm
                       sm:p-6">


                <div
                    class="pointer-events-none
                           absolute
                           -right-20
                           -top-20
                           size-52
                           rounded-full
                           bg-[#C89B55]/10
                           blur-3xl">
                </div>


                <div
                    class="pointer-events-none
                           absolute
                           -bottom-20
                           left-1/3
                           size-44
                           rounded-full
                           bg-[#C8795A]/10
                           blur-3xl">
                </div>


                <div class="relative">

                    <div
                        class="inline-flex
                               items-center
                               gap-2
                               rounded-full
                               bg-[#F4EAE2]
                               px-3
                               py-1.5
                               text-xs
                               font-bold
                               text-[#6F4E37]">

                        <i class="fa-regular fa-user"></i>

                        Akun Saya

                    </div>


                    <h1
                        class="mt-3
                               text-2xl
                               font-black
                               tracking-tight
                               text-slate-900
                               sm:text-3xl">

                        Profile

                    </h1>


                    <p
                        class="mt-2
                               max-w-2xl
                               text-sm
                               leading-6
                               text-slate-500">

                        Kelola informasi akun, nomor kontak,
                        dan keamanan akun KampusMart milikmu.

                    </p>

                </div>

            </section>



            <div class="grid
                       gap-5
                       lg:grid-cols-[320px_minmax(0,1fr)]">


                {{-- ================================================= --}}
                {{-- LEFT PROFILE --}}
                {{-- ================================================= --}}

                <aside>

                    <section
                        class="relative
                               overflow-hidden
                               rounded-3xl
                               border
                               border-[#E5D8CE]
                               bg-white
                               p-5
                               shadow-sm
                               sm:p-6">


                        <div
                            class="pointer-events-none
                                   absolute
                                   -right-16
                                   -top-16
                                   size-44
                                   rounded-full
                                   bg-[#6F4E37]/10
                                   blur-3xl">
                        </div>


                        <div class="relative">


                            {{-- AVATAR --}}

                            <div
                                class="mx-auto
                                       flex
                                       size-24
                                       items-center
                                       justify-center
                                       rounded-full
                                       bg-gradient-to-br
                                       from-[#493124]
                                       via-[#6F4E37]
                                       to-[#9A6948]
                                       text-3xl
                                       font-black
                                       uppercase
                                       text-white
                                       shadow-xl
                                       shadow-[#6F4E37]/20
                                       ring-4
                                       ring-[#F4EAE2]">

                                {{ strtoupper(substr($buyer->name, 0, 1)) }}

                            </div>



                            {{-- USER --}}

                            <div class="mt-5 text-center">

                                <h2
                                    class="text-lg
                                           font-black
                                           text-slate-900">

                                    {{ $buyer->name }}

                                </h2>


                                <p
                                    class="mt-1
                                           break-all
                                           text-sm
                                           text-slate-500">

                                    {{ $buyer->email }}

                                </p>


                                <span
                                    class="mt-4
                                           inline-flex
                                           items-center
                                           gap-1.5
                                           rounded-full
                                           bg-[#F4EAE2]
                                           px-3
                                           py-1.5
                                           text-xs
                                           font-bold
                                           text-[#6F4E37]">

                                    <i class="fa-solid fa-user"></i>

                                    Pembeli

                                </span>

                            </div>



                            {{-- INFO --}}

                            <div
                                class="mt-6
                                       space-y-4
                                       border-t
                                       border-[#EFE4DC]
                                       pt-5">


                                {{-- STATUS --}}

                                <div
                                    class="flex
                                           items-center
                                           justify-between
                                           gap-4">

                                    <span class="text-sm
                                               text-slate-500">

                                        Status

                                    </span>


                                    @if ($buyer->status === 'active')
                                        <span
                                            class="inline-flex
                                                   items-center
                                                   gap-2
                                                   text-sm
                                                   font-semibold
                                                   text-[#65795E]">

                                            <span
                                                class="size-2
                                                       rounded-full
                                                       bg-[#7F9275]">
                                            </span>

                                            Aktif

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex
                                                   items-center
                                                   gap-2
                                                   text-sm
                                                   font-semibold
                                                   text-[#A65954]">

                                            <span
                                                class="size-2
                                                       rounded-full
                                                       bg-[#A65954]">
                                            </span>

                                            Nonaktif

                                        </span>
                                    @endif

                                </div>



                                {{-- JOINED --}}

                                <div
                                    class="flex
                                           items-center
                                           justify-between
                                           gap-4">

                                    <span class="text-sm
                                               text-slate-500">

                                        Bergabung

                                    </span>

                                    <span
                                        class="text-sm
                                               font-semibold
                                               text-slate-700">

                                        {{ $buyer->created_at->format('d M Y') }}

                                    </span>

                                </div>



                                {{-- PHONE --}}

                                <div
                                    class="flex
                                           items-center
                                           justify-between
                                           gap-4">

                                    <span class="text-sm
                                               text-slate-500">

                                        Nomor HP

                                    </span>

                                    <span
                                        class="max-w-36
                                               truncate
                                               text-sm
                                               font-semibold
                                               text-slate-700">

                                        {{ $buyer->phone ?: '-' }}

                                    </span>

                                </div>



                                {{-- EMAIL VERIFIED --}}

                                <div
                                    class="flex
                                           items-center
                                           justify-between
                                           gap-4">

                                    <span class="text-sm
                                               text-slate-500">

                                        Email

                                    </span>


                                    @if ($buyer->email_verified_at)
                                        <span
                                            class="inline-flex
                                                   items-center
                                                   gap-1.5
                                                   text-sm
                                                   font-semibold
                                                   text-[#65795E]">

                                            <i
                                                class="fa-solid
                                                       fa-circle-check
                                                       text-xs">
                                            </i>

                                            Terverifikasi

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex
                                                   items-center
                                                   gap-1.5
                                                   text-sm
                                                   font-semibold
                                                   text-[#A87A37]">

                                            <i
                                                class="fa-solid
                                                       fa-clock
                                                       text-xs">
                                            </i>

                                            Belum diverifikasi

                                        </span>
                                    @endif

                                </div>

                            </div>



                            {{-- SECURITY BADGE --}}

                            <div
                                class="mt-6
                                       flex
                                       gap-3
                                       rounded-2xl
                                       border
                                       border-[#D7E1D2]
                                       bg-gradient-to-br
                                       from-[#F1F5ED]
                                       to-[#E7EFE3]
                                       p-4">

                                <div
                                    class="flex
                                           size-9
                                           shrink-0
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#7F9275]
                                           text-white">

                                    <i class="fa-solid fa-shield-halved"></i>

                                </div>


                                <p
                                    class="text-xs
                                           leading-5
                                           text-slate-600">

                                    Jaga informasi akun dan password
                                    agar tidak diberikan kepada orang lain.

                                </p>

                            </div>

                        </div>

                    </section>

                </aside>



                {{-- ================================================= --}}
                {{-- RIGHT CONTENT --}}
                {{-- ================================================= --}}

                <div class="space-y-5">


                    {{-- ================================================= --}}
                    {{-- PROFILE FORM --}}
                    {{-- ================================================= --}}

                    <section
                        class="overflow-hidden
                               rounded-3xl
                               border
                               border-[#E5D8CE]
                               bg-white
                               shadow-sm">


                        {{-- HEADER --}}

                        <div
                            class="border-b
                                   border-[#EFE4DC]
                                   bg-gradient-to-r
                                   from-[#FBF8F5]
                                   to-white
                                   px-5
                                   py-4
                                   sm:px-6
                                   sm:py-5">


                            <div
                                class="flex
                                       items-center
                                       gap-3">

                                <div
                                    class="flex
                                           size-10
                                           shrink-0
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#F4EAE2]
                                           text-[#6F4E37]">

                                    <i class="fa-regular fa-address-card"></i>

                                </div>


                                <div>

                                    <h2 class="font-bold
                                               text-slate-900">

                                        Informasi Profile

                                    </h2>

                                    <p
                                        class="mt-1
                                               text-xs
                                               text-slate-500
                                               sm:text-sm">

                                        Perbarui informasi dasar akunmu.

                                    </p>

                                </div>

                            </div>

                        </div>



                        <div class="p-5 sm:p-6">


                            {{-- SUCCESS --}}

                            @if (session('profile_success'))
                                <div
                                    class="mb-5
                                           flex
                                           items-start
                                           gap-3
                                           rounded-2xl
                                           border
                                           border-[#D1DEC9]
                                           bg-[#EEF3EA]
                                           px-4
                                           py-3
                                           text-sm
                                           text-[#65795E]">

                                    <i
                                        class="fa-solid
                                               fa-circle-check
                                               mt-0.5">
                                    </i>

                                    <span>
                                        {{ session('profile_success') }}
                                    </span>

                                </div>
                            @endif



                            <form
                                action="{{ route('buyer.profile.update') }}"
                                method="POST">

                                @csrf
                                @method('PUT')


                                <div
                                    class="grid
                                           gap-5
                                           sm:grid-cols-2">


                                    {{-- NAME --}}

                                    <div class="sm:col-span-2">

                                        <label for="name"
                                            class="mb-2
                                                   block
                                                   text-sm
                                                   font-semibold
                                                   text-slate-700">

                                            Nama Lengkap

                                        </label>


                                        <div class="relative">

                                            <div
                                                class="pointer-events-none
                                                       absolute
                                                       inset-y-0
                                                       left-0
                                                       flex
                                                       w-11
                                                       items-center
                                                       justify-center
                                                       text-[#A68A77]">

                                                <i
                                                    class="fa-regular
                                                           fa-user">
                                                </i>

                                            </div>


                                            <input type="text" name="name" id="name"
                                                value="{{ old('name', $buyer->name) }}"
                                                required
                                                class="h-11
                                                       w-full
                                                       rounded-xl
                                                       border
                                                       border-[#E5D5C9]
                                                       bg-white
                                                       pl-11
                                                       pr-4
                                                       text-sm
                                                       outline-none
                                                       transition
                                                       focus:border-[#A97957]
                                                       focus:ring-4
                                                       focus:ring-[#F5E9DF]">

                                        </div>


                                        @error('name')
                                            <p
                                                class="mt-2
                                                       text-xs
                                                       font-medium
                                                       text-[#A65954]">

                                                {{ $message }}

                                            </p>
                                        @enderror

                                    </div>



                                    {{-- EMAIL --}}

                                    <div>

                                        <label for="email"
                                            class="mb-2
                                                   block
                                                   text-sm
                                                   font-semibold
                                                   text-slate-700">

                                            Email

                                        </label>


                                        <div class="relative">

                                            <div
                                                class="pointer-events-none
                                                       absolute
                                                       inset-y-0
                                                       left-0
                                                       flex
                                                       w-11
                                                       items-center
                                                       justify-center
                                                       text-[#A68A77]">

                                                <i
                                                    class="fa-regular
                                                           fa-envelope">
                                                </i>

                                            </div>


                                            <input type="email" name="email" id="email"
                                                value="{{ old('email', $buyer->email) }}"
                                                required
                                                class="h-11
                                                       w-full
                                                       rounded-xl
                                                       border
                                                       border-[#E5D5C9]
                                                       bg-white
                                                       pl-11
                                                       pr-4
                                                       text-sm
                                                       outline-none
                                                       transition
                                                       focus:border-[#A97957]
                                                       focus:ring-4
                                                       focus:ring-[#F5E9DF]">

                                        </div>


                                        @error('email')
                                            <p
                                                class="mt-2
                                                       text-xs
                                                       font-medium
                                                       text-[#A65954]">

                                                {{ $message }}

                                            </p>
                                        @enderror

                                    </div>



                                    {{-- PHONE --}}

                                    <div>

                                        <label for="phone"
                                            class="mb-2
                                                   block
                                                   text-sm
                                                   font-semibold
                                                   text-slate-700">

                                            Nomor Telepon

                                        </label>


                                        <div class="relative">

                                            <div
                                                class="pointer-events-none
                                                       absolute
                                                       inset-y-0
                                                       left-0
                                                       flex
                                                       w-11
                                                       items-center
                                                       justify-center
                                                       text-[#65795E]">

                                                <i
                                                    class="fa-solid
                                                           fa-phone">
                                                </i>

                                            </div>


                                            <input type="tel" name="phone" id="phone"
                                                value="{{ old('phone', $buyer->phone) }}"
                                                placeholder="Contoh: 081234567890" inputmode="numeric"
                                                class="h-11
                                                       w-full
                                                       rounded-xl
                                                       border
                                                       border-[#E5D5C9]
                                                       bg-white
                                                       pl-11
                                                       pr-4
                                                       text-sm
                                                       outline-none
                                                       transition
                                                       placeholder:text-slate-400
                                                       focus:border-[#A97957]
                                                       focus:ring-4
                                                       focus:ring-[#F5E9DF]">

                                        </div>


                                        @error('phone')
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



                                {{-- BUTTON --}}

                                <div
                                    class="mt-6
                                           flex
                                           justify-end">

                                    <button type="submit"
                                        class="group
                                               inline-flex
                                               h-11
                                               items-center
                                               justify-center
                                               gap-2
                                               rounded-xl
                                               bg-gradient-to-r
                                               from-[#5B3B2B]
                                               via-[#6F4E37]
                                               to-[#8B6245]
                                               px-5
                                               text-sm
                                               font-bold
                                               text-white
                                               shadow-lg
                                               shadow-[#6F4E37]/15
                                               transition
                                               duration-300
                                               hover:-translate-y-0.5
                                               hover:shadow-xl">

                                        <i class="fa-solid fa-floppy-disk"></i>

                                        Simpan Perubahan

                                    </button>

                                </div>

                            </form>

                        </div>

                    </section>



                    {{-- ================================================= --}}
                    {{-- PASSWORD --}}
                    {{-- ================================================= --}}

                    <section
                        class="overflow-hidden
                               rounded-3xl
                               border
                               border-[#E5D8CE]
                               bg-white
                               shadow-sm"
                        x-data="{
                            showCurrent: false,
                            showNew: false,
                            showConfirmation: false
                        }">


                        {{-- HEADER --}}

                        <div
                            class="border-b
                                   border-[#EFE4DC]
                                   bg-gradient-to-r
                                   from-[#FBF8F5]
                                   to-white
                                   px-5
                                   py-4
                                   sm:px-6
                                   sm:py-5">


                            <div
                                class="flex
                                       items-center
                                       gap-3">

                                <div
                                    class="flex
                                           size-10
                                           shrink-0
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#FAF2DF]
                                           text-[#A87A37]">

                                    <i class="fa-solid fa-lock"></i>

                                </div>


                                <div>

                                    <h2 class="font-bold
                                               text-slate-900">

                                        Keamanan Akun

                                    </h2>

                                    <p
                                        class="mt-1
                                               text-xs
                                               text-slate-500
                                               sm:text-sm">

                                        Gunakan password yang kuat untuk
                                        menjaga keamanan akun.

                                    </p>

                                </div>

                            </div>

                        </div>



                        <div class="p-5 sm:p-6">


                            {{-- SUCCESS --}}

                            @if (session('password_success'))
                                <div
                                    class="mb-5
                                           flex
                                           items-start
                                           gap-3
                                           rounded-2xl
                                           border
                                           border-[#D1DEC9]
                                           bg-[#EEF3EA]
                                           px-4
                                           py-3
                                           text-sm
                                           text-[#65795E]">

                                    <i
                                        class="fa-solid
                                               fa-circle-check
                                               mt-0.5">
                                    </i>

                                    <span>
                                        {{ session('password_success') }}
                                    </span>

                                </div>
                            @endif



                            <form
                                action="{{ route('buyer.profile.password') }}"
                                method="POST">

                                @csrf
                                @method('PUT')


                                <div class="space-y-5">


                                    {{-- CURRENT PASSWORD --}}

                                    <div>

                                        <label for="current_password"
                                            class="mb-2
                                                   block
                                                   text-sm
                                                   font-semibold
                                                   text-slate-700">

                                            Password Saat Ini

                                        </label>


                                        <div class="relative">

                                            <div
                                                class="pointer-events-none
                                                       absolute
                                                       inset-y-0
                                                       left-0
                                                       flex
                                                       w-11
                                                       items-center
                                                       justify-center
                                                       text-[#A68A77]">

                                                <i class="fa-solid fa-lock"></i>

                                            </div>


                                            <input
                                                :type="showCurrent
                                                    ?
                                                    'text' :
                                                    'password'"
                                                name="current_password" id="current_password"
                                                autocomplete="current-password" placeholder="Masukkan password saat ini"
                                                class="h-11
                                                       w-full
                                                       rounded-xl
                                                       border
                                                       border-[#E5D5C9]
                                                       bg-white
                                                       pl-11
                                                       pr-11
                                                       text-sm
                                                       outline-none
                                                       transition
                                                       placeholder:text-slate-400
                                                       focus:border-[#A97957]
                                                       focus:ring-4
                                                       focus:ring-[#F5E9DF]">


                                            <button type="button"
                                                @click="
                                                    showCurrent =
                                                        !showCurrent
                                                "
                                                class="absolute
                                                       inset-y-0
                                                       right-0
                                                       flex
                                                       w-11
                                                       items-center
                                                       justify-center
                                                       text-slate-400
                                                       transition
                                                       hover:text-[#6F4E37]">

                                                <i class="fa-regular"
                                                    :class="showCurrent
                                                        ?
                                                        'fa-eye-slash' :
                                                        'fa-eye'">
                                                </i>

                                            </button>

                                        </div>


                                        @error('current_password', 'updatePassword')
                                            <p
                                                class="mt-2
                                                       text-xs
                                                       font-medium
                                                       text-[#A65954]">

                                                {{ $message }}

                                            </p>
                                        @enderror

                                    </div>



                                    <div
                                        class="grid
                                               gap-5
                                               sm:grid-cols-2">


                                        {{-- NEW PASSWORD --}}

                                        <div>

                                            <label for="password"
                                                class="mb-2
                                                       block
                                                       text-sm
                                                       font-semibold
                                                       text-slate-700">

                                                Password Baru

                                            </label>


                                            <div class="relative">

                                                <input
                                                    :type="showNew
                                                        ?
                                                        'text' :
                                                        'password'"
                                                    name="password" id="password" autocomplete="new-password"
                                                    placeholder="Minimal 8 karakter"
                                                    class="h-11
                                                           w-full
                                                           rounded-xl
                                                           border
                                                           border-[#E5D5C9]
                                                           bg-white
                                                           px-4
                                                           pr-11
                                                           text-sm
                                                           outline-none
                                                           transition
                                                           placeholder:text-slate-400
                                                           focus:border-[#A97957]
                                                           focus:ring-4
                                                           focus:ring-[#F5E9DF]">


                                                <button type="button"
                                                    @click="
                                                        showNew =
                                                            !showNew
                                                    "
                                                    class="absolute
                                                           inset-y-0
                                                           right-0
                                                           flex
                                                           w-11
                                                           items-center
                                                           justify-center
                                                           text-slate-400
                                                           transition
                                                           hover:text-[#6F4E37]">

                                                    <i class="fa-regular"
                                                        :class="showNew
                                                            ?
                                                            'fa-eye-slash' :
                                                            'fa-eye'">
                                                    </i>

                                                </button>

                                            </div>


                                            @error('password', 'updatePassword')
                                                <p
                                                    class="mt-2
                                                           text-xs
                                                           font-medium
                                                           text-[#A65954]">

                                                    {{ $message }}

                                                </p>
                                            @enderror

                                        </div>



                                        {{-- CONFIRMATION --}}

                                        <div>

                                            <label for="password_confirmation"
                                                class="mb-2
                                                       block
                                                       text-sm
                                                       font-semibold
                                                       text-slate-700">

                                                Konfirmasi Password

                                            </label>


                                            <div class="relative">

                                                <input
                                                    :type="showConfirmation
                                                        ?
                                                        'text' :
                                                        'password'"
                                                    name="password_confirmation" id="password_confirmation"
                                                    autocomplete="new-password" placeholder="Ulangi password baru"
                                                    class="h-11
                                                           w-full
                                                           rounded-xl
                                                           border
                                                           border-[#E5D5C9]
                                                           bg-white
                                                           px-4
                                                           pr-11
                                                           text-sm
                                                           outline-none
                                                           transition
                                                           placeholder:text-slate-400
                                                           focus:border-[#A97957]
                                                           focus:ring-4
                                                           focus:ring-[#F5E9DF]">


                                                <button type="button"
                                                    @click="
                                                        showConfirmation =
                                                            !showConfirmation
                                                    "
                                                    class="absolute
                                                           inset-y-0
                                                           right-0
                                                           flex
                                                           w-11
                                                           items-center
                                                           justify-center
                                                           text-slate-400
                                                           transition
                                                           hover:text-[#6F4E37]">

                                                    <i class="fa-regular"
                                                        :class="showConfirmation
                                                            ?
                                                            'fa-eye-slash' :
                                                            'fa-eye'">
                                                    </i>

                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                {{-- PASSWORD INFO --}}

                                <div
                                    class="mt-5
                                           flex
                                           gap-3
                                           rounded-2xl
                                           border
                                           border-[#ECD7AF]
                                           bg-[#FAF2DF]
                                           p-4">

                                    <div
                                        class="flex
                                               size-8
                                               shrink-0
                                               items-center
                                               justify-center
                                               rounded-lg
                                               bg-[#C89B55]
                                               text-xs
                                               text-white">

                                        <i class="fa-solid fa-key"></i>

                                    </div>


                                    <p
                                        class="text-xs
                                               leading-5
                                               text-slate-600">

                                        Gunakan minimal 8 karakter dan
                                        hindari menggunakan password yang
                                        mudah ditebak.

                                    </p>

                                </div>



                                {{-- BUTTON --}}

                                <div
                                    class="mt-6
                                           flex
                                           justify-end">

                                    <button type="submit"
                                        class="group
                                               inline-flex
                                               h-11
                                               items-center
                                               justify-center
                                               gap-2
                                               rounded-xl
                                               bg-gradient-to-r
                                               from-[#493124]
                                               via-[#5B3B2B]
                                               to-[#6F4E37]
                                               px-5
                                               text-sm
                                               font-bold
                                               text-white
                                               shadow-lg
                                               shadow-[#6F4E37]/15
                                               transition
                                               duration-300
                                               hover:-translate-y-0.5
                                               hover:shadow-xl">

                                        <i class="fa-solid fa-key"></i>

                                        Ubah Password

                                    </button>

                                </div>

                            </form>

                        </div>

                    </section>

                </div>

            </div>

        </main>

    </div>

@endsection
