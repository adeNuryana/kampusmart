@extends('layouts.admin')

@section('title', 'Detail Pembeli')

@section('content')

    <div class="mx-auto max-w-5xl">

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
            <a href="{{ route('admin.buyers.edit', $buyer) }}"
                class="inline-flex h-11 items-center
           justify-center gap-2 rounded-xl
           bg-violet-600 px-5
           text-sm font-semibold text-white
           transition hover:bg-violet-700">
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M12 20h9" />

                    <path d="M16.5 3.5
                   a2.1 2.1 0 0 1 3 3
                   L8 18l-4 1 1-4Z" />
                </svg>

                Edit Pembeli
            </a>

            <div
                class="mt-5 flex flex-col gap-4
                   sm:flex-row sm:items-end
                   sm:justify-between">

                <div>

                    <h1
                        class="text-2xl font-bold
                           tracking-tight text-slate-900
                           lg:text-3xl">
                        Detail Pembeli
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Informasi akun pembeli yang terdaftar di KampusMart.
                    </p>

                </div>

            </div>

        </div>


        {{-- PROFILE CARD --}}
        <div class="rounded-2xl border border-slate-200
               bg-white p-6 shadow-sm">

            <div class="flex flex-col gap-5
                   sm:flex-row sm:items-center">

                {{-- AVATAR --}}
                <div
                    class="flex size-24 shrink-0
                       items-center justify-center
                       rounded-2xl bg-violet-100
                       text-3xl font-bold text-violet-700">
                    {{ strtoupper(substr($buyer->name, 0, 1)) }}
                </div>


                <div class="min-w-0 flex-1">

                    <div class="flex flex-col gap-3
                           sm:flex-row sm:items-center">

                        <h2 class="text-xl font-bold text-slate-900">
                            {{ $buyer->name }}
                        </h2>


                        @if ($buyer->status === 'active')
                            <span
                                class="w-fit rounded-full
                                   bg-green-100 px-3 py-1
                                   text-xs font-medium
                                   text-green-700">
                                Aktif
                            </span>
                        @else
                            <span
                                class="w-fit rounded-full
                                   bg-slate-100 px-3 py-1
                                   text-xs font-medium
                                   text-slate-600">
                                Nonaktif
                            </span>
                        @endif

                    </div>


                    <p class="mt-2 text-sm text-slate-500">
                        {{ $buyer->email }}
                    </p>


                    <p class="mt-1 text-xs text-slate-400">
                        Bergabung sejak
                        {{ $buyer->created_at->format('d M Y') }}
                    </p>

                </div>

            </div>

        </div>


        {{-- INFORMATION --}}
        <div class="mt-6 grid gap-6 lg:grid-cols-2">

            {{-- ACCOUNT --}}
            <div class="rounded-2xl border border-slate-200
                   bg-white shadow-sm">

                <div class="border-b border-slate-100 p-6">

                    <h3 class="font-semibold text-slate-900">
                        Informasi Akun
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Informasi dasar akun pembeli.
                    </p>

                </div>


                <div class="divide-y divide-slate-100 px-6">

                    {{-- NAMA --}}
                    <div class="py-4">

                        <p
                            class="text-xs font-semibold uppercase
                               tracking-wide text-slate-400">
                            Nama Lengkap
                        </p>

                        <p class="mt-1.5 text-sm font-medium text-slate-800">
                            {{ $buyer->name }}
                        </p>

                    </div>


                    {{-- EMAIL --}}
                    <div class="py-4">

                        <p
                            class="text-xs font-semibold uppercase
                               tracking-wide text-slate-400">
                            Email
                        </p>

                        <p class="mt-1.5 text-sm text-slate-700">
                            {{ $buyer->email }}
                        </p>

                    </div>


                    {{-- PHONE --}}
                    <div class="py-4">

                        <p
                            class="text-xs font-semibold uppercase
                               tracking-wide text-slate-400">
                            Nomor Telepon
                        </p>

                        <p class="mt-1.5 text-sm text-slate-700">
                            {{ $buyer->phone ?? '-' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- STATUS --}}
            <div class="rounded-2xl border border-slate-200
                   bg-white shadow-sm">

                <div class="border-b border-slate-100 p-6">

                    <h3 class="font-semibold text-slate-900">
                        Status Akun
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Status dan informasi registrasi akun.
                    </p>

                </div>


                <div class="divide-y divide-slate-100 px-6">

                    {{-- ROLE --}}
                    <div class="py-4">

                        <p
                            class="text-xs font-semibold uppercase
                               tracking-wide text-slate-400">
                            Role
                        </p>

                        <span
                            class="mt-2 inline-flex rounded-lg
                               bg-violet-50 px-3 py-1.5
                               text-xs font-semibold text-violet-700">
                            Pembeli
                        </span>

                    </div>


                    {{-- STATUS --}}
                    <div class="py-4">

                        <p
                            class="text-xs font-semibold uppercase
                               tracking-wide text-slate-400">
                            Status
                        </p>


                        <div class="mt-2">

                            @if ($buyer->status === 'active')
                                <span
                                    class="inline-flex items-center gap-2
                                       rounded-full bg-green-100
                                       px-3 py-1.5 text-xs
                                       font-medium text-green-700">

                                    <span
                                        class="size-1.5
                                           rounded-full bg-green-500"></span>

                                    Aktif

                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-2
                                       rounded-full bg-slate-100
                                       px-3 py-1.5 text-xs
                                       font-medium text-slate-600">

                                    <span
                                        class="size-1.5
                                           rounded-full bg-slate-400"></span>

                                    Nonaktif

                                </span>
                            @endif

                        </div>

                    </div>


                    {{-- REGISTERED --}}
                    <div class="py-4">

                        <p
                            class="text-xs font-semibold uppercase
                               tracking-wide text-slate-400">
                            Tanggal Daftar
                        </p>

                        <p class="mt-1.5 text-sm text-slate-700">
                            {{ $buyer->created_at->format('d M Y, H:i') }}
                        </p>

                    </div>


                    {{-- VERIFIED --}}
                    <div class="py-4">

                        <p
                            class="text-xs font-semibold uppercase
                               tracking-wide text-slate-400">
                            Verifikasi Email
                        </p>


                        @if ($buyer->email_verified_at)
                            <p class="mt-1.5 text-sm font-medium text-green-600">
                                Terverifikasi
                            </p>
                        @else
                            <p class="mt-1.5 text-sm font-medium text-amber-600">
                                Belum terverifikasi
                            </p>
                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- ACTION --}}
        <div
            class="mt-6 flex flex-col gap-3
               rounded-2xl border border-slate-200
               bg-white p-6 shadow-sm
               sm:flex-row sm:items-center
               sm:justify-between">

            <div>

                <h3 class="font-semibold text-slate-900">
                    Kontrol Akun
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Aktifkan atau nonaktifkan akses akun pembeli.
                </p>

            </div>


            <form action="{{ route('admin.buyers.status', $buyer) }}" method="POST">

                @csrf
                @method('PATCH')


                <input type="hidden" name="status"
                    value="{{ $buyer->status === 'active' ? 'inactive' : 'active' }}">


                <button type="submit"
                    onclick="return confirm(
                    '{{ $buyer->status === 'active' ? 'Nonaktifkan akun pembeli ini?' : 'Aktifkan akun pembeli ini?' }}'
                )"
                    class="inline-flex h-11 items-center
                       justify-center rounded-xl px-5
                       text-sm font-semibold transition
                       {{ $buyer->status === 'active'
                           ? 'bg-red-50 text-red-600 hover:bg-red-100'
                           : 'bg-green-50 text-green-700 hover:bg-green-100' }}">

                    {{ $buyer->status === 'active' ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}

                </button>

            </form>

        </div>

    </div>

@endsection
