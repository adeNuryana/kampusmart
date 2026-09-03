@extends('layouts.admin')

@section('title', 'Detail Pembeli')

@section('content')

    <div class="mx-auto max-w-5xl">


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
                       hover:text-[#4371d1]">

                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                    <path d="m15 18-6-6 6-6" />

                </svg>

                Kembali ke Pembeli

            </a>



            <div
                class="mt-5
                       flex
                       flex-col
                       gap-4
                       sm:flex-row
                       sm:items-end
                       sm:justify-between">


                <div>

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
                               text-[#4371d1]">

                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <circle cx="12" cy="8" r="3.5" />
                            <path d="M5 20c0-4 3-7 7-7s7 3 7 7" />

                        </svg>

                        Informasi Pembeli

                    </div>


                    <h1
                        class="mt-3
                               text-2xl
                               font-black
                               tracking-tight
                               text-[#332B26]
                               lg:text-3xl">

                        Detail Pembeli

                    </h1>


                    <p class="mt-2
                               text-sm
                               text-slate-500">

                        Informasi akun pembeli yang terdaftar
                        di KampusMart.

                    </p>

                </div>



                <a href="{{ route('admin.buyers.edit', $buyer) }}"
                    class="inline-flex
                           h-11
                           items-center
                           justify-center
                           gap-2
                           rounded-xl
                           bg-[#4371d1]
                           px-5
                           text-sm
                           font-bold
                           text-white
                           shadow-sm
                           transition
                           hover:bg-[#0a1d45]
                           hover:shadow-md">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                        <path d="M12 20h9" />

                        <path d="M16.5 3.5
                                   a2.1 2.1 0 0 1 3 3
                                   L8 18l-4 1 1-4Z" />

                    </svg>

                    Edit Pembeli

                </a>

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- PROFILE CARD --}}
        {{-- ===================================================== --}}

        <section
            class="relative
                   overflow-hidden
                   rounded-3xl
                   border
                   border-[#DFD2C7]
                   bg-white
                   p-6
                   shadow-sm">


            <div
                class="absolute
                       left-0
                       top-0
                       h-1
                       w-full
                       bg-gradient-to-r
                       from-[#4371d1]
                       via-[#A67552]
                       to-[#C89B55]">
            </div>


            <div
                class="flex
                       flex-col
                       gap-5
                       sm:flex-row
                       sm:items-center">


                {{-- AVATAR --}}

                <div
                    class="flex
                           size-24
                           shrink-0
                           items-center
                           justify-center
                           rounded-3xl
                           bg-[#4371d1]
                           text-3xl
                           font-black
                           uppercase
                           text-white
                           shadow-sm">

                    {{ strtoupper(substr($buyer->name, 0, 1)) }}

                </div>



                <div class="min-w-0 flex-1">


                    <div
                        class="flex
                               flex-col
                               gap-3
                               sm:flex-row
                               sm:items-center">


                        <h2
                            class="text-xl
                                   font-black
                                   text-[#332B26]">

                            {{ $buyer->name }}

                        </h2>



                        @if ($buyer->status === 'active')
                            <span
                                class="inline-flex
                                       w-fit
                                       items-center
                                       gap-2
                                       rounded-full
                                       border
                                       border-[#D3DFCE]
                                       bg-[#EEF3EA]
                                       px-3
                                       py-1.5
                                       text-xs
                                       font-bold
                                       text-[#65795E]">

                                <span
                                    class="size-1.5
                                           rounded-full
                                           bg-[#718268]">
                                </span>

                                Aktif

                            </span>
                        @else
                            <span
                                class="inline-flex
                                       w-fit
                                       items-center
                                       gap-2
                                       rounded-full
                                       border
                                       border-[#ECD2CF]
                                       bg-[#FAEDEC]
                                       px-3
                                       py-1.5
                                       text-xs
                                       font-bold
                                       text-[#A65954]">

                                <span
                                    class="size-1.5
                                           rounded-full
                                           bg-[#A65954]">
                                </span>

                                Nonaktif

                            </span>
                        @endif

                    </div>



                    <div
                        class="mt-3
                               flex
                               flex-col
                               gap-2
                               text-sm
                               text-slate-500
                               sm:flex-row
                               sm:items-center
                               sm:gap-5">


                        <span
                            class="inline-flex
                                   items-center
                                   gap-2">

                            <svg class="size-4
                                       text-[#A28A7A]" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.8">

                                <rect x="3" y="5" width="18" height="14" rx="2" />

                                <path d="m3 7 9 6 9-6" />

                            </svg>

                            {{ $buyer->email }}

                        </span>


                        @if ($buyer->phone)
                            <span
                                class="inline-flex
                                       items-center
                                       gap-2">

                                <svg class="size-4
                                           text-[#A28A7A]"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                    <path d="M6 3h4l2 5-3 2
                                               a14 14 0 0 0 5 5
                                               l2-3 5 2v4
                                               c0 1.7-1.3 3-3 3
                                               C9.7 21 3 14.3 3 6
                                               c0-1.7 1.3-3 3-3Z" />

                                </svg>

                                {{ $buyer->phone }}

                            </span>
                        @endif

                    </div>


                    <p class="mt-3
                               text-xs
                               text-slate-400">

                        Bergabung sejak
                        {{ $buyer->created_at->format('d M Y') }}

                    </p>

                </div>

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- INFORMATION GRID --}}
        {{-- ===================================================== --}}

        <div class="mt-6
                   grid
                   gap-6
                   lg:grid-cols-2">


            {{-- ================================================= --}}
            {{-- ACCOUNT INFO --}}
            {{-- ================================================= --}}

            <section
                class="overflow-hidden
                       rounded-3xl
                       border
                       border-[#DFD2C7]
                       bg-white
                       shadow-sm">


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
                                   items-center
                                   justify-center
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

                            <h3 class="font-bold
                                       text-[#332B26]">

                                Informasi Akun

                            </h3>

                            <p
                                class="mt-1
                                       text-xs
                                       text-slate-500">

                                Informasi dasar akun pembeli.

                            </p>

                        </div>

                    </div>

                </div>



                <div class="divide-y
                           divide-[#EEE5DE]
                           px-6">


                    {{-- NAME --}}

                    <div class="py-4">

                        <p
                            class="text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-[0.12em]
                                   text-[#A28A7A]">

                            Nama Lengkap

                        </p>

                        <p
                            class="mt-1.5
                                   text-sm
                                   font-semibold
                                   text-[#4D4038]">

                            {{ $buyer->name }}

                        </p>

                    </div>



                    {{-- EMAIL --}}

                    <div class="py-4">

                        <p
                            class="text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-[0.12em]
                                   text-[#A28A7A]">

                            Email

                        </p>

                        <p
                            class="mt-1.5
                                   break-all
                                   text-sm
                                   text-slate-700">

                            {{ $buyer->email }}

                        </p>

                    </div>



                    {{-- PHONE --}}

                    <div class="py-4">

                        <p
                            class="text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-[0.12em]
                                   text-[#A28A7A]">

                            Nomor Telepon

                        </p>

                        <p
                            class="mt-1.5
                                   text-sm
                                   text-slate-700">

                            {{ $buyer->phone ?? '-' }}

                        </p>

                    </div>

                </div>

            </section>



            {{-- ================================================= --}}
            {{-- STATUS INFO --}}
            {{-- ================================================= --}}

            <section
                class="overflow-hidden
                       rounded-3xl
                       border
                       border-[#DFD2C7]
                       bg-white
                       shadow-sm">


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
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-[#C89B55]
                                   text-white">

                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <path d="M12 3
                                           19 6v5
                                           c0 5-3 8-7 10
                                           -4-2-7-5-7-10V6Z" />

                                <path d="m9 12 2 2 4-5" />

                            </svg>

                        </div>


                        <div>

                            <h3 class="font-bold
                                       text-[#332B26]">

                                Status Akun

                            </h3>

                            <p
                                class="mt-1
                                       text-xs
                                       text-slate-500">

                                Status dan informasi registrasi akun.

                            </p>

                        </div>

                    </div>

                </div>



                <div class="divide-y
                           divide-[#EEE5DE]
                           px-6">


                    {{-- ROLE --}}

                    <div class="py-4">

                        <p
                            class="text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-[0.12em]
                                   text-[#A28A7A]">

                            Role

                        </p>

                        <span
                            class="mt-2
                                   inline-flex
                                   rounded-lg
                                   bg-[#F1E6DE]
                                   px-3
                                   py-1.5
                                   text-xs
                                   font-bold
                                   text-[#4371d1]">

                            Pembeli

                        </span>

                    </div>



                    {{-- STATUS --}}

                    <div class="py-4">

                        <p
                            class="text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-[0.12em]
                                   text-[#A28A7A]">

                            Status

                        </p>


                        <div class="mt-2">

                            @if ($buyer->status === 'active')
                                <span
                                    class="inline-flex
                                           items-center
                                           gap-2
                                           rounded-full
                                           border
                                           border-[#D3DFCE]
                                           bg-[#EEF3EA]
                                           px-3
                                           py-1.5
                                           text-xs
                                           font-bold
                                           text-[#65795E]">

                                    <span
                                        class="size-1.5
                                               rounded-full
                                               bg-[#718268]">
                                    </span>

                                    Aktif

                                </span>
                            @else
                                <span
                                    class="inline-flex
                                           items-center
                                           gap-2
                                           rounded-full
                                           border
                                           border-[#ECD2CF]
                                           bg-[#FAEDEC]
                                           px-3
                                           py-1.5
                                           text-xs
                                           font-bold
                                           text-[#A65954]">

                                    <span
                                        class="size-1.5
                                               rounded-full
                                               bg-[#A65954]">
                                    </span>

                                    Nonaktif

                                </span>
                            @endif

                        </div>

                    </div>



                    {{-- REGISTERED --}}

                    <div class="py-4">

                        <p
                            class="text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-[0.12em]
                                   text-[#A28A7A]">

                            Tanggal Daftar

                        </p>

                        <p
                            class="mt-1.5
                                   text-sm
                                   text-slate-700">

                            {{ $buyer->created_at->format('d M Y, H:i') }}

                        </p>

                    </div>



                    {{-- VERIFIED --}}

                    <div class="py-4">

                        <p
                            class="text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-[0.12em]
                                   text-[#A28A7A]">

                            Verifikasi Email

                        </p>


                        @if ($buyer->email_verified_at)
                            <div
                                class="mt-2
                                       inline-flex
                                       items-center
                                       gap-2
                                       text-sm
                                       font-semibold
                                       text-[#65795E]">

                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">

                                    <path d="m5 12 4 4L19 6" />

                                </svg>

                                Terverifikasi

                            </div>
                        @else
                            <div
                                class="mt-2
                                       inline-flex
                                       items-center
                                       gap-2
                                       text-sm
                                       font-semibold
                                       text-[#A87A37]">

                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <circle cx="12" cy="12" r="9" />

                                    <path d="M12 8v5" />
                                    <path d="M12 17h.01" />

                                </svg>

                                Belum terverifikasi

                            </div>
                        @endif

                    </div>

                </div>

            </section>

        </div>



        {{-- ===================================================== --}}
        {{-- ACCOUNT CONTROL --}}
        {{-- ===================================================== --}}

        <section
            class="mt-6
                   overflow-hidden
                   rounded-3xl
                   border
                   {{ $buyer->status === 'active' ? 'border-[#ECD2CF]' : 'border-[#D3DFCE]' }}
                   bg-white
                   shadow-sm">


            <div
                class="flex
                       flex-col
                       gap-4
                       p-5
                       sm:flex-row
                       sm:items-center
                       sm:justify-between
                       sm:p-6">


                <div class="flex
                           items-start
                           gap-3">


                    <div
                        class="flex
                               size-10
                               shrink-0
                               items-center
                               justify-center
                               rounded-xl
                               {{ $buyer->status === 'active' ? 'bg-[#FAEDEC] text-[#A65954]' : 'bg-[#EEF3EA] text-[#65795E]' }}">

                        @if ($buyer->status === 'active')
                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <circle cx="12" cy="12" r="9" />

                                <path d="m7 7 10 10" />

                            </svg>
                        @else
                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">

                                <path d="m5 12 4 4L19 6" />

                            </svg>
                        @endif

                    </div>


                    <div>

                        <h3 class="font-bold
                                   text-[#332B26]">

                            Kontrol Akun

                        </h3>

                        <p
                            class="mt-1
                                   text-sm
                                   leading-6
                                   text-slate-500">

                            @if ($buyer->status === 'active')
                                Nonaktifkan akun untuk menghentikan
                                akses pembeli ke KampusMart.
                            @else
                                Aktifkan kembali akun agar pembeli
                                dapat menggunakan KampusMart.
                            @endif

                        </p>

                    </div>

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
                        class="inline-flex
                               h-11
                               items-center
                               justify-center
                               gap-2
                               rounded-xl
                               px-5
                               text-sm
                               font-bold
                               transition
                               {{ $buyer->status === 'active'
                                   ? 'bg-[#A65954] text-white hover:bg-[#8D4944]'
                                   : 'bg-[#718268] text-white hover:bg-[#65795E]' }}">


                        @if ($buyer->status === 'active')
                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">

                                <circle cx="12" cy="12" r="9" />

                                <path d="m7 7 10 10" />

                            </svg>

                            Nonaktifkan Akun
                        @else
                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">

                                <path d="m5 12 4 4L19 6" />

                            </svg>

                            Aktifkan Akun
                        @endif

                    </button>

                </form>

            </div>

        </section>

    </div>

@endsection
