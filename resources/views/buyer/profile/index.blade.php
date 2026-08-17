@extends('layouts.buyer')

@section('title', 'Profile - KampusMart')

@section('content')

<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

    {{-- =========================
        HEADER
    ========================== --}}
    <div class="mb-7">

        <p class="text-sm font-semibold text-violet-600">
            Akun Saya
        </p>

        <h1
            class="mt-1 text-2xl font-bold
                   tracking-tight text-slate-900
                   md:text-3xl"
        >
            Profile
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Kelola informasi akun dan keamanan akunmu.
        </p>

    </div>


    <div class="grid gap-6 lg:grid-cols-3">

        {{-- =========================
            LEFT PROFILE
        ========================== --}}
        <div>

            <div
                class="rounded-2xl border
                       border-slate-200
                       bg-white p-6
                       shadow-sm"
            >

                {{-- AVATAR --}}
                <div
                    class="mx-auto flex size-24
                           items-center justify-center
                           rounded-full
                           bg-violet-100
                           text-3xl font-bold
                           text-violet-700"
                >

                    {{ strtoupper(
                        substr(
                            $buyer->name,
                            0,
                            1
                        )
                    ) }}

                </div>


                {{-- USER --}}
                <div class="mt-5 text-center">

                    <h2
                        class="text-lg font-bold
                               text-slate-900"
                    >
                        {{ $buyer->name }}
                    </h2>


                    <p class="mt-1 text-sm text-slate-500">
                        {{ $buyer->email }}
                    </p>


                    <span
                        class="mt-4 inline-flex
                               rounded-full
                               bg-violet-50
                               px-3 py-1.5
                               text-xs font-semibold
                               text-violet-700"
                    >
                        Pembeli
                    </span>

                </div>


                {{-- INFO --}}
                <div
                    class="mt-6 border-t
                           border-slate-100 pt-5"
                >

                    <div
                        class="flex items-center
                               justify-between gap-4"
                    >

                        <span class="text-sm text-slate-500">
                            Status
                        </span>


                        @if ($buyer->status === 'active')

                            <span
                                class="inline-flex items-center
                                       gap-2 text-sm
                                       font-semibold
                                       text-green-600"
                            >
                                <span
                                    class="size-2 rounded-full
                                           bg-green-500"
                                ></span>

                                Aktif
                            </span>

                        @else

                            <span
                                class="inline-flex items-center
                                       gap-2 text-sm
                                       font-semibold
                                       text-red-600"
                            >
                                <span
                                    class="size-2 rounded-full
                                           bg-red-500"
                                ></span>

                                Nonaktif
                            </span>

                        @endif

                    </div>


                    <div
                        class="mt-4 flex items-center
                               justify-between gap-4"
                    >

                        <span class="text-sm text-slate-500">
                            Bergabung
                        </span>

                        <span
                            class="text-sm font-medium
                                   text-slate-700"
                        >
                            {{ $buyer->created_at->format('d M Y') }}
                        </span>

                    </div>


                    <div
                        class="mt-4 flex items-center
                               justify-between gap-4"
                    >

                        <span class="text-sm text-slate-500">
                            Email
                        </span>


                        @if ($buyer->email_verified_at)

                            <span
                                class="text-sm font-medium
                                       text-green-600"
                            >
                                Terverifikasi
                            </span>

                        @else

                            <span
                                class="text-sm font-medium
                                       text-amber-600"
                            >
                                Belum diverifikasi
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
            RIGHT
        ========================== --}}
        <div class="space-y-6 lg:col-span-2">

            {{-- =========================
                PROFILE FORM
            ========================== --}}
            <div
                class="rounded-2xl border
                       border-slate-200
                       bg-white shadow-sm"
            >

                <div
                    class="border-b border-slate-100
                           px-6 py-5"
                >

                    <h2 class="font-semibold text-slate-900">
                        Informasi Profile
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Perbarui informasi dasar akunmu.
                    </p>

                </div>


                <div class="p-6">

                    {{-- SUCCESS --}}
                    @if (session('profile_success'))

                        <div
                            class="mb-5 rounded-xl
                                   border border-green-200
                                   bg-green-50
                                   px-4 py-3
                                   text-sm text-green-700"
                        >
                            {{ session('profile_success') }}
                        </div>

                    @endif


                    <form
                        action="{{ route('buyer.profile.update') }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')


                        <div
                            class="grid gap-5
                                   sm:grid-cols-2"
                        >

                            {{-- NAME --}}
                            <div class="sm:col-span-2">

                                <label
                                    for="name"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    Nama Lengkap
                                </label>


                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ old(
                                        'name',
                                        $buyer->name
                                    ) }}"
                                    class="h-11 w-full
                                           rounded-xl border
                                           border-slate-200
                                           px-4 text-sm
                                           outline-none
                                           transition
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >


                                @error('name')

                                    <p
                                        class="mt-2 text-sm
                                               text-red-600"
                                    >
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- EMAIL --}}
                            <div>

                                <label
                                    for="email"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    Email
                                </label>


                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old(
                                        'email',
                                        $buyer->email
                                    ) }}"
                                    class="h-11 w-full
                                           rounded-xl border
                                           border-slate-200
                                           px-4 text-sm
                                           outline-none
                                           transition
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >


                                @error('email')

                                    <p
                                        class="mt-2 text-sm
                                               text-red-600"
                                    >
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- PHONE --}}
                            <div>

                                <label
                                    for="phone"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    Nomor Telepon
                                </label>


                                <input
                                    type="text"
                                    name="phone"
                                    id="phone"
                                    value="{{ old(
                                        'phone',
                                        $buyer->phone
                                    ) }}"
                                    placeholder="Contoh: 081234567890"
                                    class="h-11 w-full
                                           rounded-xl border
                                           border-slate-200
                                           px-4 text-sm
                                           outline-none
                                           transition
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >


                                @error('phone')

                                    <p
                                        class="mt-2 text-sm
                                               text-red-600"
                                    >
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div
                            class="mt-6 flex
                                   justify-end"
                        >

                            <button
                                type="submit"
                                class="inline-flex h-11
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-violet-600
                                       px-5 text-sm
                                       font-semibold
                                       text-white transition
                                       hover:bg-violet-700"
                            >
                                Simpan Perubahan
                            </button>

                        </div>

                    </form>

                </div>

            </div>


            {{-- =========================
                PASSWORD
            ========================== --}}
            <div
                class="rounded-2xl border
                       border-slate-200
                       bg-white shadow-sm"
            >

                <div
                    class="border-b border-slate-100
                           px-6 py-5"
                >

                    <h2 class="font-semibold text-slate-900">
                        Keamanan Akun
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Gunakan password yang kuat untuk menjaga keamanan akun.
                    </p>

                </div>


                <div class="p-6">

                    {{-- SUCCESS --}}
                    @if (session('password_success'))

                        <div
                            class="mb-5 rounded-xl
                                   border border-green-200
                                   bg-green-50
                                   px-4 py-3
                                   text-sm text-green-700"
                        >
                            {{ session('password_success') }}
                        </div>

                    @endif


                    <form
                        action="{{ route(
                            'buyer.profile.password'
                        ) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')


                        <div class="space-y-5">

                            {{-- CURRENT PASSWORD --}}
                            <div>

                                <label
                                    for="current_password"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    Password Saat Ini
                                </label>


                                <input
                                    type="password"
                                    name="current_password"
                                    id="current_password"
                                    autocomplete="current-password"
                                    placeholder="Masukkan password saat ini"
                                    class="h-11 w-full
                                           rounded-xl border
                                           border-slate-200
                                           px-4 text-sm
                                           outline-none
                                           transition
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >


                                @error(
                                    'current_password',
                                    'updatePassword'
                                )

                                    <p
                                        class="mt-2 text-sm
                                               text-red-600"
                                    >
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            <div
                                class="grid gap-5
                                       sm:grid-cols-2"
                            >

                                {{-- PASSWORD --}}
                                <div>

                                    <label
                                        for="password"
                                        class="mb-2 block
                                               text-sm font-medium
                                               text-slate-700"
                                    >
                                        Password Baru
                                    </label>


                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        autocomplete="new-password"
                                        placeholder="Minimal 8 karakter"
                                        class="h-11 w-full
                                               rounded-xl border
                                               border-slate-200
                                               px-4 text-sm
                                               outline-none
                                               transition
                                               focus:border-violet-400
                                               focus:ring-4
                                               focus:ring-violet-100"
                                    >


                                    @error(
                                        'password',
                                        'updatePassword'
                                    )

                                        <p
                                            class="mt-2 text-sm
                                                   text-red-600"
                                        >
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>


                                {{-- CONFIRMATION --}}
                                <div>

                                    <label
                                        for="password_confirmation"
                                        class="mb-2 block
                                               text-sm font-medium
                                               text-slate-700"
                                    >
                                        Konfirmasi Password
                                    </label>


                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        autocomplete="new-password"
                                        placeholder="Ulangi password baru"
                                        class="h-11 w-full
                                               rounded-xl border
                                               border-slate-200
                                               px-4 text-sm
                                               outline-none
                                               transition
                                               focus:border-violet-400
                                               focus:ring-4
                                               focus:ring-violet-100"
                                    >

                                </div>

                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div
                            class="mt-6 flex
                                   justify-end"
                        >

                            <button
                                type="submit"
                                class="inline-flex h-11
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-slate-900
                                       px-5 text-sm
                                       font-semibold
                                       text-white
                                       transition
                                       hover:bg-slate-800"
                            >
                                Ubah Password
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
