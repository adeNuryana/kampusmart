@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')

<div class="mx-auto max-w-[1200px]">

    {{-- HEADER --}}
    <div class="mb-7">

        <h1 class="text-2xl font-bold tracking-tight text-slate-900 lg:text-3xl">
            Pengaturan
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Kelola informasi akun dan keamanan Admin KampusMart.
        </p>

    </div>


    <div class="grid gap-6 lg:grid-cols-3">

        {{-- SIDEBAR INFO --}}
        <div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="flex size-16 items-center justify-center
                            rounded-2xl bg-violet-100
                            text-xl font-bold text-violet-700">
                    {{ strtoupper(substr($admin->name, 0, 1)) }}
                </div>

                <h2 class="mt-4 font-semibold text-slate-900">
                    {{ $admin->name }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    {{ $admin->email }}
                </p>


                <div class="mt-5 border-t border-slate-100 pt-5">

                    <span class="inline-flex rounded-full
                                 bg-violet-50 px-3 py-1.5
                                 text-xs font-semibold text-violet-700">
                        Administrator
                    </span>

                </div>

            </div>

        </div>


        <div class="space-y-6 lg:col-span-2">

            {{-- PROFILE --}}
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 p-6">

                    <h2 class="font-semibold text-slate-900">
                        Informasi Profil
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Perbarui informasi dasar akun administrator.
                    </p>

                </div>


                <form
                    action="{{ route('admin.settings.profile') }}"
                    method="POST"
                    class="p-6"
                >

                    @csrf
                    @method('PUT')


                    @if (session('success'))

                        <div class="mb-5 rounded-xl border
                                    border-green-200 bg-green-50
                                    px-4 py-3 text-sm text-green-700">

                            {{ session('success') }}

                        </div>

                    @endif


                    <div class="grid gap-5 md:grid-cols-2">

                        {{-- NAMA --}}
                        <div>

                            <label
                                for="name"
                                class="mb-2 block text-sm
                                       font-medium text-slate-700"
                            >
                                Nama
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $admin->name) }}"
                                class="h-11 w-full rounded-xl
                                       border border-slate-200
                                       px-4 text-sm outline-none
                                       transition
                                       focus:border-violet-400
                                       focus:ring-4
                                       focus:ring-violet-100"
                            >

                            @error('name')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- EMAIL --}}
                        <div>

                            <label
                                for="email"
                                class="mb-2 block text-sm
                                       font-medium text-slate-700"
                            >
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $admin->email) }}"
                                class="h-11 w-full rounded-xl
                                       border border-slate-200
                                       px-4 text-sm outline-none
                                       transition
                                       focus:border-violet-400
                                       focus:ring-4
                                       focus:ring-violet-100"
                            >

                            @error('email')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- PHONE --}}
                        <div class="md:col-span-2">

                            <label
                                for="phone"
                                class="mb-2 block text-sm
                                       font-medium text-slate-700"
                            >
                                Nomor Telepon
                            </label>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone', $admin->phone) }}"
                                placeholder="Contoh: 081234567890"
                                class="h-11 w-full rounded-xl
                                       border border-slate-200
                                       px-4 text-sm outline-none
                                       transition
                                       focus:border-violet-400
                                       focus:ring-4
                                       focus:ring-violet-100"
                            >

                            @error('phone')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>


                    <div class="mt-6 flex justify-end">

                        <button
                            type="submit"
                            class="inline-flex h-11 items-center
                                   justify-center rounded-xl
                                   bg-violet-600 px-5
                                   text-sm font-semibold text-white
                                   transition hover:bg-violet-700"
                        >
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>


            {{-- PASSWORD --}}
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 p-6">

                    <h2 class="font-semibold text-slate-900">
                        Keamanan
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Ganti password untuk menjaga keamanan akun.
                    </p>

                </div>


                <form
                    action="{{ route('admin.settings.password') }}"
                    method="POST"
                    class="p-6"
                >

                    @csrf
                    @method('PUT')


                    @if (session('password_success'))

                        <div class="mb-5 rounded-xl border
                                    border-green-200 bg-green-50
                                    px-4 py-3 text-sm text-green-700">

                            {{ session('password_success') }}

                        </div>

                    @endif


                    <div class="space-y-5">

                        {{-- CURRENT PASSWORD --}}
                        <div>

                            <label
                                for="current_password"
                                class="mb-2 block text-sm
                                       font-medium text-slate-700"
                            >
                                Password Saat Ini
                            </label>

                            <input
                                type="password"
                                name="current_password"
                                id="current_password"
                                class="h-11 w-full rounded-xl
                                       border border-slate-200
                                       px-4 text-sm outline-none
                                       transition
                                       focus:border-violet-400
                                       focus:ring-4
                                       focus:ring-violet-100"
                            >

                            @error('current_password')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <div class="grid gap-5 md:grid-cols-2">

                            {{-- PASSWORD --}}
                            <div>

                                <label
                                    for="password"
                                    class="mb-2 block text-sm
                                           font-medium text-slate-700"
                                >
                                    Password Baru
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="h-11 w-full rounded-xl
                                           border border-slate-200
                                           px-4 text-sm outline-none
                                           transition
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >

                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- CONFIRM --}}
                            <div>

                                <label
                                    for="password_confirmation"
                                    class="mb-2 block text-sm
                                           font-medium text-slate-700"
                                >
                                    Konfirmasi Password
                                </label>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    class="h-11 w-full rounded-xl
                                           border border-slate-200
                                           px-4 text-sm outline-none
                                           transition
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >

                            </div>

                        </div>

                    </div>


                    <div class="mt-6 flex justify-end">

                        <button
                            type="submit"
                            class="inline-flex h-11 items-center
                                   justify-center rounded-xl
                                   bg-slate-900 px-5
                                   text-sm font-semibold text-white
                                   transition hover:bg-slate-800"
                        >
                            Ubah Password
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
