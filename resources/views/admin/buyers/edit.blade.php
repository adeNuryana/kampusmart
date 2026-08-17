@extends('layouts.admin')

@section('title', 'Edit Pembeli')

@section('content')

    <div class="mx-auto max-w-4xl">

        {{-- HEADER --}}
        <div class="mb-7">

            <a href="{{ route('admin.buyers.index') }}"
                class="inline-flex items-center gap-2
                   text-sm font-medium text-slate-500
                   transition hover:text-violet-600">

                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m15 18-6-6 6-6" />
                </svg>

                Kembali ke Pembeli

            </a>


            <h1
                class="mt-5 text-2xl font-bold
                   tracking-tight text-slate-900
                   lg:text-3xl">
                Edit Pembeli
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Perbarui informasi akun pembeli KampusMart.
            </p>

        </div>


        <form action="{{ route('admin.buyers.update', $buyer) }}" method="POST" class="space-y-6">

            @csrf
            @method('PUT')


            {{-- ACCOUNT --}}
            <div class="rounded-2xl border border-slate-200
                   bg-white shadow-sm">

                <div class="border-b border-slate-100 p-6">

                    <h2 class="font-semibold text-slate-900">
                        Informasi Akun
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Informasi dasar akun pembeli.
                    </p>

                </div>


                <div class="p-6">

                    <div class="grid gap-5 md:grid-cols-2">

                        {{-- NAME --}}
                        <div>

                            <label for="name"
                                class="mb-2 block text-sm
                                   font-medium text-slate-700">
                                Nama Lengkap
                            </label>

                            <input type="text" name="name" id="name" value="{{ old('name', $buyer->name) }}"
                                class="h-11 w-full rounded-xl
                                   border border-slate-200
                                   px-4 text-sm outline-none
                                   transition
                                   focus:border-violet-400
                                   focus:ring-4
                                   focus:ring-violet-100">

                            @error('name')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- EMAIL --}}
                        <div>

                            <label for="email"
                                class="mb-2 block text-sm
                                   font-medium text-slate-700">
                                Email
                            </label>

                            <input type="email" name="email" id="email" value="{{ old('email', $buyer->email) }}"
                                class="h-11 w-full rounded-xl
                                   border border-slate-200
                                   px-4 text-sm outline-none
                                   transition
                                   focus:border-violet-400
                                   focus:ring-4
                                   focus:ring-violet-100">

                            @error('email')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- PHONE --}}
                        <div>

                            <label for="phone"
                                class="mb-2 block text-sm
                                   font-medium text-slate-700">
                                Nomor Telepon
                            </label>

                            <input type="text" name="phone" id="phone" value="{{ old('phone', $buyer->phone) }}"
                                placeholder="Contoh: 081234567890"
                                class="h-11 w-full rounded-xl
                                   border border-slate-200
                                   px-4 text-sm outline-none
                                   transition
                                   focus:border-violet-400
                                   focus:ring-4
                                   focus:ring-violet-100">

                            @error('phone')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- STATUS --}}
                        <div>

                            <label for="status"
                                class="mb-2 block text-sm
                                   font-medium text-slate-700">
                                Status Akun
                            </label>

                            <select name="status" id="status"
                                class="h-11 w-full rounded-xl
                                   border border-slate-200
                                   bg-white px-4 text-sm
                                   outline-none transition
                                   focus:border-violet-400
                                   focus:ring-4
                                   focus:ring-violet-100">

                                <option value="active" @selected(old('status', $buyer->status) === 'active')>
                                    Aktif
                                </option>

                                <option value="inactive" @selected(old('status', $buyer->status) === 'inactive')>
                                    Nonaktif
                                </option>

                            </select>

                            @error('status')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- PASSWORD --}}
            <div class="rounded-2xl border border-slate-200
                   bg-white shadow-sm">

                <div class="border-b border-slate-100 p-6">

                    <h2 class="font-semibold text-slate-900">
                        Password
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Kosongkan jika tidak ingin mengganti password pembeli.
                    </p>

                </div>


                <div class="grid gap-5 p-6 md:grid-cols-2">

                    {{-- PASSWORD --}}
                    <div>

                        <label for="password"
                            class="mb-2 block text-sm
                               font-medium text-slate-700">
                            Password Baru
                        </label>

                        <input type="password" name="password" id="password" autocomplete="new-password"
                            placeholder="Minimal 8 karakter"
                            class="h-11 w-full rounded-xl
                               border border-slate-200
                               px-4 text-sm outline-none
                               transition
                               focus:border-violet-400
                               focus:ring-4
                               focus:ring-violet-100">

                        @error('password')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- CONFIRM --}}
                    <div>

                        <label for="password_confirmation"
                            class="mb-2 block text-sm
                               font-medium text-slate-700">
                            Konfirmasi Password
                        </label>

                        <input type="password" name="password_confirmation" id="password_confirmation"
                            autocomplete="new-password" placeholder="Ulangi password baru"
                            class="h-11 w-full rounded-xl
                               border border-slate-200
                               px-4 text-sm outline-none
                               transition
                               focus:border-violet-400
                               focus:ring-4
                               focus:ring-violet-100">

                    </div>

                </div>

            </div>


            {{-- ACTION --}}
            <div class="flex justify-end gap-3">

                <a href="{{ route('admin.buyers.index') }}"
                    class="inline-flex h-11 items-center
                       justify-center rounded-xl
                       border border-slate-200
                       bg-white px-5
                       text-sm font-semibold
                       text-slate-600 transition
                       hover:bg-slate-50">
                    Batal
                </a>


                <button type="submit"
                    class="inline-flex h-11 items-center
                       justify-center rounded-xl
                       bg-violet-600 px-5
                       text-sm font-semibold
                       text-white transition
                       hover:bg-violet-700">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

@endsection
