@extends('layouts.admin')

@section('title', 'Tambah Penjual')

@section('content')

<div class="mx-auto max-w-4xl">

    <div class="mb-7">

        <a
            href="{{ route('admin.sellers.index') }}"
            class="mb-4 inline-flex items-center
                   gap-2 text-sm font-medium
                   text-slate-500
                   hover:text-violet-600"
        >
            ← Kembali
        </a>

        <h1 class="text-3xl font-bold tracking-tight">
            Tambah Penjual
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Buat akun penjual baru untuk KampusMart.
        </p>

    </div>


    <form
        action="{{ route('admin.sellers.store') }}"
        method="POST"
        class="space-y-6"
    >
        @csrf


        {{-- ACCOUNT --}}
        <section
            class="rounded-2xl border
                   border-slate-200 bg-white
                   p-6 shadow-sm"
        >

            <h2 class="text-lg font-semibold">
                Informasi Akun
            </h2>

            <div
                class="mt-6 grid gap-5
                       md:grid-cols-2"
            >

                <div>
                    <label class="mb-2 block text-sm font-medium">
                        Nama Penjual
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="h-12 w-full rounded-xl
                               border border-slate-200
                               px-4 outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                        required
                    >

                    @error('name')
                        <p class="mt-2 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <div>
                    <label class="mb-2 block text-sm font-medium">
                        NIM
                    </label>

                    <input
                        type="text"
                        name="nim"
                        value="{{ old('nim') }}"
                        class="h-12 w-full rounded-xl
                               border border-slate-200 px-4
                               outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                    >
                </div>


                <div>
                    <label class="mb-2 block text-sm font-medium">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="h-12 w-full rounded-xl
                               border border-slate-200 px-4
                               outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                        required
                    >

                    @error('email')
                        <p class="mt-2 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <div>
                    <label class="mb-2 block text-sm font-medium">
                        Nomor HP
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="08xxxxxxxxxx"
                        class="h-12 w-full rounded-xl
                               border border-slate-200 px-4
                               outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                    >
                </div>


                <div>
                    <label class="mb-2 block text-sm font-medium">
                        Password Awal
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="h-12 w-full rounded-xl
                               border border-slate-200 px-4
                               outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                        required
                    >

                    @error('password')
                        <p class="mt-2 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <div>
                    <label class="mb-2 block text-sm font-medium">
                        Konfirmasi Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="h-12 w-full rounded-xl
                               border border-slate-200 px-4
                               outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                        required
                    >
                </div>

            </div>

        </section>


        {{-- STORE --}}
        <section
            class="rounded-2xl border
                   border-slate-200 bg-white
                   p-6 shadow-sm"
        >

            <h2 class="text-lg font-semibold">
                Informasi Toko
            </h2>

            <div
                class="mt-6 grid gap-5
                       md:grid-cols-2"
            >

                <div>
                    <label class="mb-2 block text-sm font-medium">
                        Nama Toko
                    </label>

                    <input
                        type="text"
                        name="store_name"
                        value="{{ old('store_name') }}"
                        class="h-12 w-full rounded-xl
                               border border-slate-200 px-4
                               outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                        required
                    >
                </div>


                <div>
                    <label class="mb-2 block text-sm font-medium">
                        WhatsApp
                    </label>

                    <input
                        type="text"
                        name="whatsapp"
                        value="{{ old('whatsapp') }}"
                        placeholder="08xxxxxxxxxx"
                        class="h-12 w-full rounded-xl
                               border border-slate-200 px-4
                               outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                        required
                    >
                </div>


                <div>
                    <label class="mb-2 block text-sm font-medium">
                        Fakultas
                    </label>

                    <input
                        type="text"
                        name="faculty"
                        value="{{ old('faculty') }}"
                        class="h-12 w-full rounded-xl
                               border border-slate-200 px-4
                               outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                    >
                </div>


                <div>
                    <label class="mb-2 block text-sm font-medium">
                        Status Akun
                    </label>

                    <select
                        name="status"
                        class="h-12 w-full rounded-xl
                               border border-slate-200
                               bg-white px-4 outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                    >
                        <option value="active">
                            Aktif
                        </option>

                        <option value="inactive">
                            Nonaktif
                        </option>
                    </select>
                </div>


                <div class="md:col-span-2">

                    <label class="mb-2 block text-sm font-medium">
                        Deskripsi Toko
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="w-full rounded-xl
                               border border-slate-200
                               p-4 outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100"
                    >{{ old('description') }}</textarea>

                </div>

            </div>

        </section>


        {{-- ACTION --}}
        <div class="flex justify-end gap-3">

            <a
                href="{{ route('admin.sellers.index') }}"
                class="inline-flex h-12 items-center
                       justify-center rounded-xl
                       border border-slate-200
                       bg-white px-6 text-sm
                       font-semibold text-slate-600"
            >
                Batal
            </a>


            <button
                type="submit"
                class="h-12 rounded-xl
                       bg-violet-600 px-7
                       text-sm font-semibold
                       text-white
                       hover:bg-violet-700"
            >
                Simpan Penjual
            </button>

        </div>

    </form>

</div>

@endsection
