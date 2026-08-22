@extends('layouts.admin')

@section('title', 'Detail Penjual')

@section('content')

    <div class="mx-auto max-w-6xl">

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


            <div class="mt-5 flex flex-col gap-4
                       sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <div
                        class="inline-flex items-center gap-2
                               rounded-full bg-[#FBEAE2]
                               px-3 py-1.5 text-xs font-bold
                               text-[#A95E43]">

                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M4 10v10h16V10" />
                            <path d="M3 10l2-6h14l2 6" />
                        </svg>

                        Informasi Seller

                    </div>

                    <h1
                        class="mt-3 text-2xl font-black
                               tracking-tight text-[#332B26]
                               lg:text-3xl">
                        Detail Penjual
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Informasi akun seller dan toko KampusMart.
                    </p>

                </div>


                <a href="{{ route('admin.sellers.edit', $seller) }}"
                    class="inline-flex h-11 items-center justify-center gap-2
                           rounded-xl bg-[#C8795A] px-5
                           text-sm font-bold text-white shadow-sm
                           transition hover:bg-[#B66F52]">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M12 20h9" />
                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z" />
                    </svg>

                    Edit Penjual
                </a>

            </div>

        </section>


        @if (session('success'))
            <div
                class="mb-6 flex items-center gap-3
                       rounded-2xl border border-[#D3DFCE]
                       bg-[#EEF3EA] px-4 py-3
                       text-sm text-[#65795E]">

                <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m5 12 4 4L19 6" />
                </svg>

                {{ session('success') }}

            </div>
        @endif


        <div class="grid gap-6 lg:grid-cols-[350px_1fr]">

            {{-- SELLER --}}
            <section
                class="overflow-hidden rounded-3xl
                       border border-[#DFD2C7]
                       bg-white shadow-sm">

                <div
                    class="h-1.5 bg-gradient-to-r
                           from-[#C8795A] via-[#A86B4E]
                           to-[#6F4E37]">
                </div>


                <div class="p-6">

                    <div class="flex flex-col items-center text-center">

                        @if ($seller->sellerProfile?->photo)
                            <img src="{{ asset('storage/' . $seller->sellerProfile->photo) }}" alt="{{ $seller->name }}"
                                class="size-24 rounded-3xl
                                       border border-[#DFD2C7]
                                       object-cover">
                        @else
                            <div
                                class="flex size-24 items-center justify-center
                                       rounded-3xl bg-[#C8795A]
                                       text-3xl font-black
                                       uppercase text-white">

                                {{ strtoupper(substr($seller->name, 0, 1)) }}

                            </div>
                        @endif


                        <h2 class="mt-4 text-xl font-black
                                   text-[#332B26]">
                            {{ $seller->name }}
                        </h2>


                        @if ($seller->status === 'active')
                            <span
                                class="mt-3 inline-flex items-center gap-2
                                       rounded-full border border-[#D3DFCE]
                                       bg-[#EEF3EA] px-3 py-1.5
                                       text-xs font-bold text-[#65795E]">

                                <span class="size-1.5 rounded-full bg-[#718268]"></span>

                                Aktif
                            </span>
                        @else
                            <span
                                class="mt-3 inline-flex items-center gap-2
                                       rounded-full border border-[#ECD2CF]
                                       bg-[#FAEDEC] px-3 py-1.5
                                       text-xs font-bold text-[#A65954]">

                                <span class="size-1.5 rounded-full bg-[#A65954]"></span>

                                Nonaktif
                            </span>
                        @endif

                    </div>


                    <dl class="mt-7 divide-y divide-[#EEE5DE] text-sm">

                        <div class="flex justify-between gap-4 py-4">
                            <dt class="text-slate-500">NIM</dt>

                            <dd class="font-semibold text-[#4D4038]">
                                {{ $seller->sellerProfile?->nim ?? '-' }}
                            </dd>
                        </div>


                        <div class="py-4">

                            <dt class="text-slate-500">
                                Email
                            </dt>

                            <dd class="mt-1 break-all
                                       font-semibold text-[#4D4038]">
                                {{ $seller->email }}
                            </dd>

                        </div>


                        <div class="flex justify-between gap-4 py-4">

                            <dt class="text-slate-500">
                                No. HP
                            </dt>

                            <dd class="font-semibold text-[#4D4038]">
                                {{ $seller->phone ?? '-' }}
                            </dd>

                        </div>


                        <div class="py-4">

                            <dt class="text-slate-500">
                                Fakultas
                            </dt>

                            <dd class="mt-1 font-semibold
                                       text-[#4D4038]">
                                {{ $seller->sellerProfile?->faculty ?? '-' }}
                            </dd>

                        </div>

                    </dl>

                </div>

            </section>


            {{-- STORE --}}
            <section
                class="overflow-hidden rounded-3xl
                       border border-[#DFD2C7]
                       bg-white shadow-sm">


                <div
                    class="flex items-center justify-between gap-4
                           border-b border-[#E7DBD1]
                           bg-[#FAF7F2]
                           p-5 sm:p-6">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex size-10 items-center justify-center
                                   rounded-xl bg-[#6F4E37]
                                   text-white">

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
                                Informasi yang ditampilkan ke pembeli.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-5 sm:p-6">

                    <p class="text-2xl font-black
                               tracking-tight text-[#332B26]">

                        {{ $seller->sellerProfile?->store_name ?? '-' }}

                    </p>


                    <p class="mt-4 max-w-2xl
                               leading-7 text-slate-600">

                        {{ $seller->sellerProfile?->description ?? 'Belum ada deskripsi toko.' }}

                    </p>


                    <div class="mt-8 grid gap-4 sm:grid-cols-2">

                        <div
                            class="rounded-2xl
                                   border border-[#E7DBD1]
                                   bg-[#FAF7F2] p-4">

                            <div
                                class="flex size-9 items-center justify-center
                                       rounded-xl bg-[#EEF3EA]
                                       text-[#65795E]">

                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <path
                                        d="M6 3h4l2 5-3 2a14 14 0 0 0 5 5l2-3 5 2v4c0 1.7-1.3 3-3 3C9.7 21 3 14.3 3 6c0-1.7 1.3-3 3-3Z" />

                                </svg>

                            </div>

                            <p
                                class="mt-3 text-[10px]
                                       font-bold uppercase
                                       tracking-wider text-[#A28A7A]">
                                WhatsApp
                            </p>

                            <p class="mt-1 font-bold
                                       text-[#4D4038]">
                                {{ $seller->sellerProfile?->whatsapp ?? '-' }}
                            </p>

                        </div>


                        <div
                            class="rounded-2xl
                                   border border-[#E7DBD1]
                                   bg-[#FAF7F2] p-4">

                            <div
                                class="flex size-9 items-center justify-center
                                       rounded-xl bg-[#F1E6DE]
                                       text-[#6F4E37]">

                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <rect x="4" y="5" width="16" height="15" rx="2" />
                                    <path d="M8 3v4" />
                                    <path d="M16 3v4" />
                                    <path d="M4 10h16" />

                                </svg>

                            </div>

                            <p
                                class="mt-3 text-[10px]
                                       font-bold uppercase
                                       tracking-wider text-[#A28A7A]">
                                Bergabung
                            </p>

                            <p class="mt-1 font-bold
                                       text-[#4D4038]">
                                {{ $seller->created_at->format('d M Y') }}
                            </p>

                        </div>

                    </div>

                </div>

            </section>

        </div>

    </div>

@endsection
