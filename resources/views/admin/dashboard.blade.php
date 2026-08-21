@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    @php
        $bars = [38, 55, 31, 68, 58, 82];

        $barColors = [
            'from-[#6F4E37] to-[#8B6245]',
            'from-[#C8795A] to-[#A95E43]',
            'from-[#7F9275] to-[#65795E]',
            'from-[#C89B55] to-[#A87A37]',
            'from-[#B97972] to-[#9B5F59]',
            'from-[#5B3B2B] to-[#8B6245]',
        ];
    @endphp


    <div
        class="min-h-screen
               bg-gradient-to-br
               from-[#FAF7F2]
               via-[#F8F3EC]
               to-[#F2EADF]">

        <div
            class="mx-auto
                   max-w-[1450px]
                   px-4
                   py-6
                   sm:px-6
                   lg:px-8
                   lg:py-8">


            {{-- ===================================================== --}}
            {{-- PAGE HEADER --}}
            {{-- ===================================================== --}}

            <section
                class="relative
                       mb-6
                       overflow-hidden
                       rounded-3xl
                       border
                       border-[#E5D8CC]
                       bg-gradient-to-br
                       from-[#FFFDF9]
                       via-[#FAF7F2]
                       to-[#F3EADF]
                       p-5
                       shadow-sm
                       sm:p-6">


                <div
                    class="pointer-events-none
                           absolute
                           -right-20
                           -top-20
                           size-56
                           rounded-full
                           bg-[#C89B55]/10
                           blur-3xl">
                </div>


                <div
                    class="pointer-events-none
                           absolute
                           -bottom-20
                           left-1/3
                           size-48
                           rounded-full
                           bg-[#C8795A]/10
                           blur-3xl">
                </div>


                <div
                    class="relative
                           flex
                           flex-col
                           gap-5
                           lg:flex-row
                           lg:items-center
                           lg:justify-between">


                    <div>
                        <div
                            class="inline-flex
           items-center
           gap-2
           rounded-full
           bg-[#6F4E37]
           px-3.5
           py-1.5
           text-xs
           font-bold
           text-white
           shadow-sm">

                            <span
                                class="flex size-5
               items-center justify-center
               rounded-full
               bg-white/15">

                                <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                                    <path d="M4 18V10" />
                                    <path d="M10 18V6" />
                                    <path d="M16 18v-4" />
                                    <path d="M22 18V3" />

                                </svg>

                            </span>

                            Admin Overview

                        </div>

                        <h1
                            class="mt-3
                                   text-2xl
                                   font-black
                                   tracking-tight
                                   text-[#2E2925]
                                   sm:text-3xl">

                            Dashboard Admin

                        </h1>


                        <p
                            class="mt-2
                                   max-w-2xl
                                   text-sm
                                   leading-6
                                   text-slate-500">

                            Pantau pengguna, aktivitas seller,
                            serta operasional platform KampusMart
                            dari satu halaman.

                        </p>

                    </div>



                    {{-- MINI INFO --}}

                    <div class="flex
                               flex-wrap
                               gap-3">


                        <div
                            class="rounded-2xl
                                   border
                                   border-[#E7D9CE]
                                   bg-white/80
                                   px-4
                                   py-3
                                   shadow-sm
                                   backdrop-blur">

                            <p
                                class="text-[10px]
                                       font-semibold
                                       uppercase
                                       tracking-wider
                                       text-[#A28A7A]">

                                Total User

                            </p>

                            <p
                                class="mt-1
                                       text-lg
                                       font-black
                                       text-[#5B3B2B]">

                                {{ number_format($totalBuyers + $totalSellers) }}

                            </p>

                        </div>


                        <div
                            class="rounded-2xl
                                   border
                                   border-[#D8E1D2]
                                   bg-[#F2F6EF]
                                   px-4
                                   py-3">

                            <p
                                class="text-[10px]
                                       font-semibold
                                       uppercase
                                       tracking-wider
                                       text-[#74836C]">

                                Seller Aktif

                            </p>

                            <p
                                class="mt-1
                                       text-lg
                                       font-black
                                       text-[#65795E]">

                                {{ number_format($activeSellers) }}

                            </p>

                        </div>

                    </div>

                </div>

            </section>



            {{-- ===================================================== --}}
            {{-- STAT CARDS --}}
            {{-- ===================================================== --}}

            <div
                class="grid
                       gap-4
                       sm:grid-cols-2
                       xl:grid-cols-4">


                {{-- BUYERS --}}

                <section
                    class="group
                           relative
                           overflow-hidden
                           rounded-3xl
                           border
                           border-[#E6D9CE]
                           bg-[#FFFDF9]
                           p-5
                           shadow-sm
                           transition
                           duration-300
                           hover:-translate-y-1
                           hover:shadow-lg">


                    <div
                        class="absolute
                               left-0
                               top-0
                               h-1
                               w-full
                               bg-gradient-to-r
                               from-[#6F4E37]
                               via-[#9B7356]
                               to-[#C89B55]">
                    </div>


                    <div
                        class="flex
                               items-start
                               justify-between
                               gap-4">


                        <div>

                            <p
                                class="text-xs
                                       font-bold
                                       uppercase
                                       tracking-[0.08em]
                                       text-[#998274]">

                                Total Pembeli

                            </p>


                            <p
                                class="mt-6
                                       text-3xl
                                       font-black
                                       tracking-tight
                                       text-[#332B26]">

                                {{ number_format($totalBuyers) }}

                            </p>


                            <p
                                class="mt-2
                                       text-xs
                                       text-slate-400">

                                Akun buyer terdaftar

                            </p>

                        </div>


                        <div
                            class="flex size-12 shrink-0
           items-center justify-center
           rounded-2xl
           bg-[#6F4E37]
           text-white
           shadow-sm">

                            <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                <circle cx="9" cy="8" r="3" />
                                <path d="M3 20c0-4 2.7-7 6-7s6 3 6 7" />
                                <path d="M16 4.5a3 3 0 0 1 0 5.5" />
                                <path d="M17 13c2.4.7 4 3.2 4 6" />

                            </svg>

                        </div>

                    </div>

                </section>



                {{-- SELLERS --}}

                <section
                    class="group
                           relative
                           overflow-hidden
                           rounded-3xl
                           border
                           border-[#E6D9CE]
                           bg-[#FFFDF9]
                           p-5
                           shadow-sm
                           transition
                           duration-300
                           hover:-translate-y-1
                           hover:shadow-lg">


                    <div
                        class="absolute
                               left-0
                               top-0
                               h-1
                               w-full
                               bg-gradient-to-r
                               from-[#C8795A]
                               via-[#B66F52]
                               to-[#9C6048]">
                    </div>


                    <div
                        class="flex
                               items-start
                               justify-between
                               gap-4">


                        <div>

                            <p
                                class="text-xs
                                       font-bold
                                       uppercase
                                       tracking-[0.08em]
                                       text-[#998274]">

                                Total Penjual

                            </p>


                            <p
                                class="mt-6
                                       text-3xl
                                       font-black
                                       tracking-tight
                                       text-[#332B26]">

                                {{ number_format($totalSellers) }}

                            </p>


                            <p
                                class="mt-2
                                       text-xs
                                       text-slate-400">

                                Seluruh akun seller

                            </p>

                        </div>

                        <div
                            class="flex size-12 shrink-0
           items-center justify-center
           rounded-2xl
           bg-[#C8795A]
           text-white
           shadow-sm">

                            <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                <path d="M4 10v10h16V10" />
                                <path d="M3 10l2-6h14l2 6" />
                                <path d="M8 20v-6h8v6" />

                            </svg>

                        </div>

                    </div>

                </section>



                {{-- ACTIVE SELLER --}}

                <section
                    class="group
                           relative
                           overflow-hidden
                           rounded-3xl
                           border
                           border-[#DCE5D7]
                           bg-[#FFFDF9]
                           p-5
                           shadow-sm
                           transition
                           duration-300
                           hover:-translate-y-1
                           hover:shadow-lg">


                    <div
                        class="absolute
                               left-0
                               top-0
                               h-1
                               w-full
                               bg-gradient-to-r
                               from-[#65795E]
                               via-[#7F9275]
                               to-[#A3B398]">
                    </div>


                    <div
                        class="flex
                               items-start
                               justify-between
                               gap-4">


                        <div>

                            <p
                                class="text-xs
                                       font-bold
                                       uppercase
                                       tracking-[0.08em]
                                       text-[#74836C]">

                                Penjual Aktif

                            </p>


                            <p
                                class="mt-6
                                       text-3xl
                                       font-black
                                       tracking-tight
                                       text-[#465441]">

                                {{ number_format($activeSellers) }}

                            </p>


                            <p
                                class="mt-2
                                       inline-flex
                                       items-center
                                       gap-1.5
                                       text-xs
                                       font-medium
                                       text-[#65795E]">

                                <span
                                    class="size-1.5
                                           rounded-full
                                           bg-[#7F9275]">
                                </span>

                                Akun dapat digunakan

                            </p>

                        </div>


                        <div
                            class="flex size-12 shrink-0
           items-center justify-center
           rounded-2xl
           bg-[#718268]
           text-white
           shadow-sm">

                            <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                <circle cx="12" cy="12" r="9" />
                                <path d="m8 12 2.5 2.5L16.5 8.5" />

                            </svg>

                        </div>
                    </div>

                </section>



                {{-- INACTIVE SELLER --}}

                <section
                    class="group
                           relative
                           overflow-hidden
                           rounded-3xl
                           border
                           border-[#ECD2CF]
                           bg-[#FFFDF9]
                           p-5
                           shadow-sm
                           transition
                           duration-300
                           hover:-translate-y-1
                           hover:shadow-lg">


                    <div
                        class="absolute
                               left-0
                               top-0
                               h-1
                               w-full
                               bg-gradient-to-r
                               from-[#A65954]
                               via-[#B97972]
                               to-[#D49A91]">
                    </div>


                    <div
                        class="flex
                               items-start
                               justify-between
                               gap-4">


                        <div>

                            <p
                                class="text-xs
                                       font-bold
                                       uppercase
                                       tracking-[0.08em]
                                       text-[#9B5F59]">

                                Penjual Nonaktif

                            </p>


                            <p
                                class="mt-6
                                       text-3xl
                                       font-black
                                       tracking-tight
                                       text-[#8B4D48]">

                                {{ number_format($inactiveSellers) }}

                            </p>


                            <p
                                class="mt-2
                                       text-xs
                                       font-medium
                                       text-[#A65954]">

                                Perlu ditinjau

                            </p>

                        </div>


                        <div
                            class="flex size-12 shrink-0
           items-center justify-center
           rounded-2xl
           bg-[#A65954]
           text-white
           shadow-sm">

                            <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                <circle cx="12" cy="12" r="9" />
                                <path d="M12 8v5" />
                                <path d="M12 17h.01" />

                            </svg>

                        </div>

                    </div>

                </section>

            </div>



            {{-- ===================================================== --}}
            {{-- MIDDLE SECTION --}}
            {{-- ===================================================== --}}

            <div
                class="mt-6
                       grid
                       gap-6
                       xl:grid-cols-[minmax(0,2fr)_350px]">


                {{-- ================================================= --}}
                {{-- USER GROWTH CHART --}}
                {{-- ================================================= --}}

                <section x-data="{
                    period: '{{ $chartPeriod }}'
                }"
                    class="overflow-hidden
           rounded-3xl
           border
           border-[#DFD2C7]
           bg-white
           shadow-sm">


                    {{-- ================================================= --}}
                    {{-- HEADER --}}
                    {{-- ================================================= --}}

                    <div
                        class="flex
               flex-col
               gap-4
               border-b
               border-[#E7DBD1]
               bg-[#FAF7F2]
               px-5
               py-5
               sm:px-6
               lg:flex-row
               lg:items-center
               lg:justify-between">


                        <div class="flex
                   items-center
                   gap-3">


                            {{-- ICON --}}

                            <div
                                class="flex
                       size-11
                       shrink-0
                       items-center
                       justify-center
                       rounded-xl
                       bg-[#6F4E37]
                       text-white">

                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <path d="M3 17
                                                               8 12
                                                               12 15
                                                               18 7
                                                               21 10" />

                                    <circle cx="3" cy="17" r="1" />

                                    <circle cx="8" cy="12" r="1" />

                                    <circle cx="12" cy="15" r="1" />

                                    <circle cx="18" cy="7" r="1" />

                                    <circle cx="21" cy="10" r="1" />

                                </svg>

                            </div>


                            <div>

                                <h2
                                    class="text-base
                           font-bold
                           text-[#332B26]
                           sm:text-lg">

                                    Pertumbuhan Pengguna

                                </h2>


                                <p
                                    class="mt-1
                           text-xs
                           text-slate-500
                           sm:text-sm">

                                    {{ $chartTitle }}

                                </p>

                            </div>

                        </div>



                        {{-- ================================================= --}}
                        {{-- FILTER --}}
                        {{-- ================================================= --}}

                        <form action="{{ route('admin.dashboard') }}" method="GET"
                            class="flex
                   flex-col
                   gap-2
                   sm:flex-row
                   sm:items-center">


                            {{-- PERIOD --}}

                            <div
                                class="flex
                       rounded-xl
                       border
                       border-[#DDCEC2]
                       bg-white
                       p-1">


                                <label class="cursor-pointer">


                                    <input type="radio" name="period" value="month" x-model="period"
                                        onchange="this.form.submit()" class="sr-only">


                                    <span
                                        class="block
                               rounded-lg
                               px-3.5
                               py-2
                               text-xs
                               font-semibold
                               transition"
                                        :class="period === 'month'
                                            ?
                                            'bg-[#6F4E37] text-white shadow-sm' :
                                            'text-[#8B7465] hover:bg-[#F5EDE7]'">

                                        1 Bulan

                                    </span>

                                </label>



                                <label class="cursor-pointer">


                                    <input type="radio" name="period" value="year" x-model="period"
                                        onchange="this.form.submit()" class="sr-only">


                                    <span
                                        class="block
                               rounded-lg
                               px-3.5
                               py-2
                               text-xs
                               font-semibold
                               transition"
                                        :class="period === 'year'
                                            ?
                                            'bg-[#6F4E37] text-white shadow-sm' :
                                            'text-[#8B7465] hover:bg-[#F5EDE7]'">

                                        1 Tahun

                                    </span>

                                </label>

                            </div>



                            {{-- ================================================= --}}
                            {{-- MONTH --}}
                            {{-- ================================================= --}}

                            <div x-show="period === 'month'" x-cloak>

                                <div
                                    class="flex
                           h-10
                           items-center
                           rounded-xl
                           border
                           border-[#DDCEC2]
                           bg-white
                           px-3">


                                    <input type="month" name="month" value="{{ $selectedMonth }}"
                                        max="{{ now()->format('Y-m') }}" onchange="this.form.submit()"
                                        class="block
                               min-w-0
                               border-0
                               bg-transparent
                               p-0
                               text-xs
                               font-semibold
                               text-[#5B3B2B]
                               outline-none
                               focus:ring-0">

                                </div>

                            </div>



                            {{-- ================================================= --}}
                            {{-- YEAR --}}
                            {{-- ================================================= --}}

                            <div x-show="period === 'year'" x-cloak>


                                <select name="year" onchange="this.form.submit()"
                                    class="h-10
                           rounded-xl
                           border
                           border-[#DDCEC2]
                           bg-white
                           px-3
                           text-xs
                           font-semibold
                           text-[#5B3B2B]
                           outline-none
                           transition
                           focus:border-[#8B6245]
                           focus:ring-4
                           focus:ring-[#F1E6DE]">


                                    @foreach ($availableYears as $year)
                                        <option value="{{ $year }}" @selected($selectedYear == $year)>

                                            {{ $year }}

                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </form>

                    </div>



                    {{-- ================================================= --}}
                    {{-- CHART BODY --}}
                    {{-- ================================================= --}}

                    <div class="p-5 sm:p-6">


                        {{-- SUMMARY --}}

                        <div
                            class="mb-5
                   flex
                   flex-wrap
                   items-center
                   justify-between
                   gap-3">


                            <div>

                                <p class="text-xs
                           text-slate-400">

                                    Pengguna baru pada periode ini

                                </p>


                                <p
                                    class="mt-1
                           text-2xl
                           font-black
                           text-[#332B26]">

                                    {{ number_format(array_sum($chartValues)) }}

                                </p>

                            </div>


                            <div
                                class="inline-flex
                       items-center
                       gap-2
                       rounded-full
                       bg-[#F4EAE2]
                       px-3
                       py-1.5
                       text-xs
                       font-semibold
                       text-[#6F4E37]">


                                <span
                                    class="size-2
                           rounded-full
                           bg-[#6F4E37]">
                                </span>


                                @if ($chartPeriod === 'month')
                                    Harian
                                @else
                                    Bulanan
                                @endif

                            </div>

                        </div>



                        {{-- CHART --}}

                        <div class="relative
                   h-[300px]
                   w-full">

                            <canvas id="userGrowthChart" data-labels='@json($chartLabels)'
                                data-values='@json($chartValues)' data-period="{{ $chartPeriod }}"
                                data-year="{{ $selectedYear }}">
                            </canvas>

                        </div>



                        {{-- FOOTER --}}

                        <div
                            class="mt-5
                   flex
                   flex-wrap
                   items-center
                   justify-between
                   gap-3
                   border-t
                   border-[#EEE4DC]
                   pt-4">


                            <p class="text-xs
                       text-slate-400">


                                @if ($chartPeriod === 'month')
                                    Data pengguna baru per tanggal
                                    pada bulan yang dipilih.
                                @else
                                    Data pengguna baru per bulan
                                    pada tahun yang dipilih.
                                @endif

                            </p>


                            <span
                                class="inline-flex
                       items-center
                       gap-2
                       text-xs
                       font-semibold
                       text-[#65795E]">

                                <span
                                    class="size-2
                           rounded-full
                           bg-[#7F9275]">
                                </span>

                                Buyer & Seller

                            </span>

                        </div>

                    </div>

                </section>


                {{-- ================================================= --}}
                {{-- ACTION --}}
                {{-- ================================================= --}}

                <section
                    class="overflow-hidden
                           rounded-3xl
                           border
                           border-[#E5D8CC]
                           bg-[#FFFDF9]
                           shadow-sm">


                    <div
                        class="border-b
                               border-[#EEE2D8]
                               px-5
                               py-5">


                        <div
                            class="flex
                                   items-center
                                   gap-3">


                            <div
                                class="flex size-11
           shrink-0
           items-center justify-center
           rounded-xl
           bg-[#C2944F]
           text-white">

                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9" />
                                    <path d="M10 21h4" />

                                </svg>

                            </div>


                            <div>

                                <h2 class="font-bold
                                           text-[#332B26]">

                                    Memerlukan Tindakan

                                </h2>

                                <p
                                    class="mt-1
                                           text-xs
                                           text-slate-400">

                                    Item yang perlu perhatian admin.

                                </p>

                            </div>

                        </div>

                    </div>



                    <div class="space-y-3
                               p-5">


                        @if ($inactiveSellers > 0)
                            <div
                                class="rounded-2xl
                                       border
                                       border-[#ECD2CF]
                                       bg-[#FCF2F0]
                                       p-4">


                                <div
                                    class="flex
                                           items-start
                                           gap-3">


                                    <div
                                        class="flex size-10
           shrink-0
           items-center justify-center
           rounded-xl
           bg-[#A65954]
           text-white">

                                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.8">

                                            <circle cx="9" cy="8" r="3" />
                                            <path d="M3 20c0-4 2.7-7 6-7 1.3 0 2.5.4 3.5 1" />
                                            <path d="m16 15 5 5" />
                                            <path d="m21 15-5 5" />

                                        </svg>

                                    </div>


                                    <div>

                                        <p
                                            class="text-sm
                                                   font-bold
                                                   text-[#7F4945]">

                                            Akun Penjual Nonaktif

                                        </p>


                                        <p
                                            class="mt-1
                                                   text-xs
                                                   leading-5
                                                   text-[#9B6A66]">

                                            {{ $inactiveSellers }}
                                            akun penjual sedang tidak aktif.

                                        </p>

                                    </div>

                                </div>


                                <button type="button"
                                    class="mt-4
                                           inline-flex
                                           items-center
                                           gap-2
                                           rounded-xl
                                           bg-[#A65954]
                                           px-4
                                           py-2
                                           text-xs
                                           font-bold
                                           text-white
                                           transition
                                           hover:bg-[#8D4944]">

                                    Tinjau

                                    <i
                                        class="fa-solid
                                               fa-arrow-right
                                               text-[9px]">
                                    </i>

                                </button>

                            </div>
                        @else
                            <div
                                class="rounded-2xl
                                       border
                                       border-[#D6E1D1]
                                       bg-[#F0F5ED]
                                       p-4">


                                <div
                                    class="flex
                                           items-start
                                           gap-3">


                                    <div
                                        class="flex
           size-9
           shrink-0
           items-center
           justify-center
           rounded-xl
           bg-[#718268]
           text-white">

                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">

                                            <path d="m5 12 4 4L19 6" />

                                        </svg>

                                    </div>

                                    <div>

                                        <p
                                            class="text-sm
                                                   font-bold
                                                   text-[#586C52]">

                                            Semua Aman

                                        </p>

                                        <p
                                            class="mt-1
                                                   text-xs
                                                   leading-5
                                                   text-[#74846F]">

                                            Tidak ada seller yang
                                            membutuhkan tindakan.

                                        </p>

                                    </div>

                                </div>

                            </div>
                        @endif



                        {{-- MANAGE SELLERS --}}

                        <div
                            class="rounded-2xl
                                   border
                                   border-[#E6D9CE]
                                   bg-[#FAF6F1]
                                   p-4">


                            <div
                                class="flex
                                       items-start
                                       gap-3">


                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <path d="M4 10v10h16V10" />
                                    <path d="M3 10l2-6h14l2 6" />
                                    <path d="M8 20v-6h8v6" />

                                </svg>


                                <div>

                                    <p
                                        class="text-sm
                                               font-bold
                                               text-[#4D4038]">

                                        Kelola Penjual

                                    </p>


                                    <p
                                        class="mt-1
                                               text-xs
                                               leading-5
                                               text-slate-500">

                                        Tambahkan atau kelola
                                        akun seller KampusMart.

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

            </div>



            {{-- ===================================================== --}}
            {{-- ACTIVITY --}}
            {{-- ===================================================== --}}

            <section
                class="mt-6
                       overflow-hidden
                       rounded-3xl
                       border
                       border-[#E5D8CC]
                       bg-[#FFFDF9]
                       shadow-sm">


                {{-- HEADER --}}

                <div
                    class="flex
                           flex-col
                           gap-4
                           border-b
                           border-[#EEE2D8]
                           px-5
                           py-5
                           sm:flex-row
                           sm:items-center
                           sm:justify-between
                           sm:px-6">


                    <div>

                        <h2
                            class="text-base
                                   font-bold
                                   text-[#332B26]
                                   sm:text-lg">

                            Aktivitas Terbaru

                        </h2>


                        <p
                            class="mt-1
                                   text-xs
                                   text-slate-500
                                   sm:text-sm">

                            Aktivitas terbaru buyer, seller, dan admin.

                        </p>

                    </div>


                    <span
                        class="inline-flex
                               w-fit
                               items-center
                               gap-2
                               rounded-full
                               bg-[#F4EAE2]
                               px-3
                               py-1.5
                               text-xs
                               font-bold
                               text-[#6F4E37]">

                        <span
                            class="size-2
                                   rounded-full
                                   bg-[#7F9275]">
                        </span>

                        KampusMart

                    </span>

                </div>



                {{-- TABLE --}}

                <div class="overflow-x-auto">

                    <table class="w-full
                               min-w-[780px]">


                        <thead class="bg-[#F8F3ED]">


                            <tr
                                class="text-left
                                       text-xs
                                       font-bold
                                       uppercase
                                       tracking-wide
                                       text-[#907A6C]">


                                <th class="px-6 py-4">
                                    Waktu
                                </th>

                                <th class="px-6 py-4">
                                    Aktivitas
                                </th>

                                <th class="px-6 py-4">
                                    Pengguna / Entitas
                                </th>

                                <th class="px-6 py-4">
                                    Status
                                </th>

                            </tr>

                        </thead>



                        <tbody
                            class="divide-y
                                   divide-[#EEE5DE]
                                   text-sm">


                            @forelse ($recentActivities as $activity)
                                @php

                                    /*
                                    |--------------------------------------------------------------------------
                                    | Nama Pengguna
                                    |--------------------------------------------------------------------------
                                    */

                                    $user = $activity->user;

                                    $actorName = match ($user?->role) {
                                        'seller' => $user?->sellerProfile?->store_name ?? ($user?->name ?? 'Seller'),

                                        default => $user?->name ?? 'Pengguna',
                                    };

                                    /*
                                    |--------------------------------------------------------------------------
                                    | Role
                                    |--------------------------------------------------------------------------
                                    */

                                    $roleLabel = match ($user?->role) {
                                        'seller' => 'Seller',

                                        'buyer' => 'Buyer',

                                        'admin' => 'Admin',

                                        'superadmin' => 'Super Admin',

                                        default => 'Pengguna',
                                    };

                                    /*
                                    |--------------------------------------------------------------------------
                                    | Role Color
                                    |--------------------------------------------------------------------------
                                    */

                                    $roleClass = match ($user?->role) {
                                        'seller' => 'bg-[#FAF2DF] text-[#A87A37]',

                                        'buyer' => 'bg-[#EEF3EA] text-[#65795E]',

                                        'admin', 'superadmin' => 'bg-[#F4EAE2] text-[#6F4E37]',

                                        default => 'bg-slate-100 text-slate-600',
                                    };

                                    /*
                                    |--------------------------------------------------------------------------
                                    | Activity Color
                                    |--------------------------------------------------------------------------
                                    */

                                    $activityClass = match ($activity->action) {
                                        'order_created' => 'bg-[#F4EAE2] text-[#6F4E37]',

                                        'order_sold' => 'bg-[#EEF3EA] text-[#65795E]',

                                        'product_created' => 'bg-[#EDF3EA] text-[#65795E]',

                                        'product_updated' => 'bg-[#FAF2DF] text-[#A87A37]',

                                        'product_deleted' => 'bg-[#FAEDEC] text-[#A65954]',

                                        'seller_profile_updated',
                                        'buyer_profile_updated'
                                            => 'bg-[#F5EAE4] text-[#8B6245]',

                                        'seller_created' => 'bg-[#FBEAE2] text-[#A95E43]',

                                        'seller_updated' => 'bg-[#F4EAE2] text-[#6F4E37]',

                                        'seller_deleted' => 'bg-[#FAEDEC] text-[#A65954]',

                                        'category_created' => 'bg-[#EEF3EA] text-[#65795E]',

                                        'category_updated' => 'bg-[#FAF2DF] text-[#A87A37]',

                                        'category_deleted' => 'bg-[#FAEDEC] text-[#A65954]',

                                        default => 'bg-slate-100 text-slate-600',
                                    };

                                @endphp



                                <tr class="transition
                                           hover:bg-[#FBF7F3]">


                                    {{-- TIME --}}

                                    <td
                                        class="whitespace-nowrap
                                               px-6
                                               py-4">

                                        <p
                                            class="font-semibold
                                                   text-slate-700">

                                            {{ $activity->created_at->diffForHumans() }}

                                        </p>


                                        <p
                                            class="mt-1
                                                   text-xs
                                                   text-slate-400">

                                            {{ $activity->created_at->format('d M Y, H:i') }}

                                        </p>

                                    </td>



                                    {{-- ACTIVITY --}}

                                    <td class="px-6 py-4">

                                        <div
                                            class="flex
                                                   items-start
                                                   gap-3">


                                            <div
                                                class="flex
           size-9
           shrink-0
           items-center
           justify-center
           rounded-xl
           {{ $activityClass }}">

                                                @switch($activity->action)
                                                    {{-- ORDER CREATED --}}
                                                    @case('order_created')
                                                        <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.8">

                                                            <circle cx="9" cy="20" r="1" />
                                                            <circle cx="18" cy="20" r="1" />
                                                            <path d="M3 4h2l2.2 10.5a2 2 0 0 0 2 1.5h7.8a2 2 0 0 0 2-1.5L21 8H6" />

                                                        </svg>
                                                    @break

                                                    {{-- PRODUCT CREATED --}}
                                                    @case('product_created')
                                                        <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.8">

                                                            <path d="M12 5v14" />
                                                            <path d="M5 12h14" />

                                                        </svg>
                                                    @break

                                                    {{-- UPDATED --}}
                                                    @case('product_updated')
                                                    @case('seller_updated')

                                                    @case('category_updated')
                                                        <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.8">

                                                            <path d="M12 20h9" />
                                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z" />

                                                        </svg>
                                                    @break

                                                    {{-- DELETE --}}
                                                    @case('product_deleted')
                                                    @case('seller_deleted')

                                                    @case('category_deleted')
                                                        <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.8">

                                                            <path d="M3 6h18" />
                                                            <path d="M8 6V4h8v2" />
                                                            <path d="M19 6l-1 14H6L5 6" />
                                                            <path d="M10 11v5" />
                                                            <path d="M14 11v5" />

                                                        </svg>
                                                    @break

                                                    {{-- PROFILE UPDATED --}}
                                                    @case('seller_profile_updated')
                                                    @case('buyer_profile_updated')
                                                        <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.8">

                                                            <circle cx="12" cy="8" r="3" />
                                                            <path d="M5 20c0-4 3-7 7-7s7 3 7 7" />

                                                        </svg>
                                                    @break

                                                    {{-- ORDER SOLD --}}
                                                    @case('order_sold')
                                                        <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2">

                                                            <path d="m5 12 4 4L19 6" />

                                                        </svg>
                                                    @break

                                                    {{-- SELLER CREATED --}}
                                                    @case('seller_created')
                                                        <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.8">

                                                            <circle cx="9" cy="8" r="3" />
                                                            <path d="M3 20c0-4 2.7-7 6-7 1.4 0 2.7.5 3.8 1.3" />
                                                            <path d="M18 11v6" />
                                                            <path d="M15 14h6" />

                                                        </svg>
                                                    @break

                                                    {{-- DEFAULT --}}

                                                    @default
                                                        <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.8">

                                                            <circle cx="12" cy="12" r="9" />
                                                            <path d="M12 11v5" />
                                                            <path d="M12 8h.01" />

                                                        </svg>
                                                @endswitch

                                            </div>


                                            <div class="min-w-0">

                                                <p
                                                    class="font-semibold
                                                           text-slate-800">

                                                    {{ ucfirst($activity->description) }}

                                                </p>


                                                <p
                                                    class="mt-1
                                                           text-xs
                                                           capitalize
                                                           text-slate-400">

                                                    {{ str_replace('_', ' ', $activity->action) }}

                                                </p>

                                            </div>

                                        </div>

                                    </td>



                                    {{-- USER --}}

                                    <td class="px-6 py-4">

                                        <div>

                                            <p
                                                class="font-bold
                                                       text-slate-800">

                                                {{ $actorName }}

                                            </p>


                                            <span
                                                class="mt-1.5
                                                       inline-flex
                                                       rounded-md
                                                       px-2
                                                       py-1
                                                       text-[10px]
                                                       font-bold
                                                       {{ $roleClass }}">

                                                {{ $roleLabel }}

                                            </span>

                                        </div>

                                    </td>



                                    {{-- STATUS --}}

                                    <td class="px-6 py-4">

                                        <span
                                            class="inline-flex
                                                   items-center
                                                   gap-1.5
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
                                                       bg-[#7F9275]">
                                            </span>

                                            Berhasil

                                        </span>

                                    </td>

                                </tr>


                                @empty

                                    <tr>

                                        <td colspan="4" class="px-6
                                               py-16">


                                            <div class="text-center">

                                                <div
                                                    class="mx-auto
                                                       flex
                                                       size-14
                                                       items-center
                                                       justify-center
                                                       rounded-2xl
                                                       bg-[#F1E6DE]
                                                       text-[#A38B7B]">

                                                    <i
                                                        class="fa-regular
                                                           fa-clock
                                                           text-xl">
                                                    </i>

                                                </div>


                                                <p
                                                    class="mt-4
                                                       font-bold
                                                       text-slate-700">

                                                    Belum ada aktivitas

                                                </p>


                                                <p
                                                    class="mt-1
                                                       text-sm
                                                       text-slate-400">

                                                    Aktivitas pengguna akan
                                                    ditampilkan di sini.

                                                </p>

                                            </div>

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </section>

            </div>

        </div>
        @vite('resources/js/admin-dashboard-chart.js')
    @endsection
