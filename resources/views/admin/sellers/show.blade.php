@extends('layouts.admin')

@section('title', 'Detail Penjual')

@section('content')

    <div class="mx-auto max-w-6xl">

        <div class="mb-6">

            <a href="{{ route('admin.sellers.index') }}"
                class="text-sm text-slate-500
                   hover:text-violet-600">
                ← Kembali
            </a>

            <h1 class="mt-4 text-3xl font-bold">
                Detail Penjual
            </h1>

        </div>

        @if (session('success'))
            <div
                class="mb-6 flex items-center gap-3
               rounded-xl border
               border-green-200
               bg-green-50 px-4 py-3
               text-sm text-green-700">

                <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m5 12 4 4L19 6" />
                </svg>

                {{ session('success') }}

            </div>
        @endif
        <div class="grid gap-6
               lg:grid-cols-[350px_1fr]">

            {{-- DATA SELLER --}}
            <section
                class="rounded-2xl border
                   border-slate-200 bg-white
                   p-6 shadow-sm">

                <div
                    class="mx-auto flex size-20
                       items-center justify-center
                       rounded-full bg-violet-100
                       text-3xl font-bold
                       text-violet-700">
                    {{ strtoupper(substr($seller->name, 0, 1)) }}
                </div>


                <div class="mt-4 text-center">

                    <h2 class="text-xl font-bold">
                        {{ $seller->name }}
                    </h2>

                    <span
                        class="mt-3 inline-flex rounded-full
                           px-3 py-1 text-xs font-medium
                           {{ $seller->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                        {{ $seller->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                    </span>

                </div>


                <dl class="mt-8 divide-y
                       divide-slate-100 text-sm">

                    <div class="flex justify-between gap-4
                           py-4">
                        <dt class="text-slate-500">
                            NIM
                        </dt>

                        <dd class="font-medium">
                            {{ $seller->sellerProfile?->nim ?? '-' }}
                        </dd>
                    </div>


                    <div class="flex justify-between gap-4
                           py-4">
                        <dt class="text-slate-500">
                            Email
                        </dt>

                        <dd class="font-medium">
                            {{ $seller->email }}
                        </dd>
                    </div>


                    <div class="flex justify-between gap-4
                           py-4">
                        <dt class="text-slate-500">
                            No. HP
                        </dt>

                        <dd class="font-medium">
                            {{ $seller->phone ?? '-' }}
                        </dd>
                    </div>


                    <div class="py-4">

                        <dt class="text-slate-500">
                            Fakultas
                        </dt>

                        <dd class="mt-2 font-medium">
                            {{ $seller->sellerProfile?->faculty ?? '-' }}
                        </dd>

                    </div>

                </dl>

            </section>


            {{-- TOKO --}}
            <section
                class="rounded-2xl border
                   border-slate-200 bg-white
                   p-6 shadow-sm">

                <div class="flex items-center
                       justify-between gap-4">

                    <h2 class="text-xl font-bold">
                        Informasi Toko
                    </h2>

                    <span
                        class="rounded-full bg-green-100
                           px-3 py-1 text-xs
                           font-medium text-green-700">
                        {{ $seller->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                    </span>

                </div>


                <div class="mt-8">

                    <p class="text-2xl font-bold">
                        {{ $seller->sellerProfile?->store_name ?? '-' }}
                    </p>

                    <p class="mt-4 max-w-2xl
                           leading-7 text-slate-600">
                        {{ $seller->sellerProfile?->description ?? 'Belum ada deskripsi toko.' }}
                    </p>

                </div>


                <div class="mt-8 grid gap-4 sm:grid-cols-2">

                    <div class="rounded-xl bg-slate-50 p-4">

                        <p class="text-xs text-slate-500">
                            WhatsApp
                        </p>

                        <p class="mt-2 font-semibold">
                            {{ $seller->sellerProfile?->whatsapp ?? '-' }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-slate-50 p-4">

                        <p class="text-xs text-slate-500">
                            Bergabung
                        </p>

                        <p class="mt-2 font-semibold">
                            {{ $seller->created_at->format('d M Y') }}
                        </p>

                    </div>

                </div>

            </section>

        </div>

    </div>

@endsection
