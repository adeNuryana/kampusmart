@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')

    <div class="mx-auto max-w-[1400px] space-y-6">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section
            class="flex flex-col gap-4
                   lg:flex-row
                   lg:items-end
                   lg:justify-between">

            <div>

                <div
                    class="inline-flex
                           items-center gap-2
                           rounded-full
                           bg-[#FAF2DF]
                           px-3 py-1.5
                           text-xs font-bold
                           text-[#A87A37]">

                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                        <rect x="4" y="3" width="16" height="18" rx="2" />

                        <path d="M8 17v-4" />
                        <path d="M12 17V8" />
                        <path d="M16 17v-7" />

                    </svg>

                    Pusat Pelaporan

                </div>


                <h1
                    class="mt-3
                           text-2xl
                           font-black
                           tracking-tight
                           text-[#332B26]
                           lg:text-3xl">

                    Laporan KampusMart

                </h1>


                <p
                    class="mt-2
                           max-w-2xl
                           text-sm
                           leading-6
                           text-slate-500">

                    Pantau performa transaksi,
                    buyer, seller, dan produk
                    berdasarkan periode tertentu.

                </p>

            </div>


            {{-- EXPORT --}}

            <a href="{{ route('admin.reports.export', request()->query()) }}"
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
           hover:bg-[#0a1d45]">

                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                    <path d="M12 3v12" />
                    <path d="m7 10 5 5 5-5" />
                    <path d="M5 21h14" />

                </svg>

                Export PDF

            </a>

        </section>



        {{-- ===================================================== --}}
        {{-- FILTER --}}
        {{-- ===================================================== --}}

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
                       px-5 py-4">

                <h2 class="font-bold
                           text-[#332B26]">

                    Periode Laporan

                </h2>

                <p class="mt-1 text-xs
                           text-slate-500">

                    Pilih periode data yang
                    ingin ditampilkan.

                </p>

            </div>


            <form method="GET" action="{{ route('admin.reports.index') }}" class="p-5">

                <div x-data="{
                    period: '{{ request('period', 'month') }}'
                }" class="space-y-4">


                    {{-- PERIOD TYPE --}}

                    <div class="flex flex-wrap gap-2">

                        <label>

                            <input type="radio" name="period" value="month" x-model="period" class="peer sr-only">

                            <span
                                class="inline-flex
                                       cursor-pointer
                                       rounded-xl
                                       border
                                       border-[#DFD2C7]
                                       bg-white
                                       px-4 py-2
                                       text-sm
                                       font-semibold
                                       text-[#7C695C]
                                       transition
                                       peer-checked:border-[#4371d1]
                                       peer-checked:bg-[#4371d1]
                                       peer-checked:text-white">

                                Bulanan

                            </span>

                        </label>


                        <label>

                            <input type="radio" name="period" value="year" x-model="period" class="peer sr-only">

                            <span
                                class="inline-flex
                                       cursor-pointer
                                       rounded-xl
                                       border
                                       border-[#DFD2C7]
                                       bg-white
                                       px-4 py-2
                                       text-sm
                                       font-semibold
                                       text-[#7C695C]
                                       transition
                                       peer-checked:border-[#4371d1]
                                       peer-checked:bg-[#4371d1]
                                       peer-checked:text-white">

                                Tahunan

                            </span>

                        </label>


                        <label>

                            <input type="radio" name="period" value="custom" x-model="period" class="peer sr-only">

                            <span
                                class="inline-flex
                                       cursor-pointer
                                       rounded-xl
                                       border
                                       border-[#DFD2C7]
                                       bg-white
                                       px-4 py-2
                                       text-sm
                                       font-semibold
                                       text-[#7C695C]
                                       transition
                                       peer-checked:border-[#4371d1]
                                       peer-checked:bg-[#4371d1]
                                       peer-checked:text-white">

                                Rentang Tanggal

                            </span>

                        </label>

                    </div>



                    {{-- MONTH --}}

                    <div x-show="period === 'month'" x-cloak class="max-w-xs">

                        <label
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-[#4D4038]">

                            Pilih Bulan

                        </label>

                        <input type="month" name="month" value="{{ request('month', now()->format('Y-m')) }}"
                            class="h-11 w-full
                                   rounded-xl
                                   border
                                   border-[#DFD2C7]
                                   px-4
                                   text-sm
                                   outline-none
                                   focus:border-[#A97957]
                                   focus:ring-4
                                   focus:ring-[#F1E6DE]">

                    </div>



                    {{-- YEAR --}}

                    <div x-show="period === 'year'" x-cloak class="max-w-xs">

                        <label
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-[#4D4038]">

                            Pilih Tahun

                        </label>

                        <select name="year"
                            class="h-11 w-full
                                   rounded-xl
                                   border
                                   border-[#DFD2C7]
                                   bg-white
                                   px-4 text-sm
                                   outline-none
                                   focus:border-[#A97957]
                                   focus:ring-4
                                   focus:ring-[#F1E6DE]">

                            @for ($year = now()->year; $year >= now()->year - 5; $year--)
                                <option value="{{ $year }}" @selected(request('year', now()->year) == $year)>

                                    {{ $year }}

                                </option>
                            @endfor

                        </select>

                    </div>



                    {{-- CUSTOM --}}

                    <div x-show="period === 'custom'" x-cloak
                        class="grid
                               max-w-2xl
                               gap-4
                               sm:grid-cols-2">

                        <div>

                            <label
                                class="mb-2 block
                                       text-sm font-semibold
                                       text-[#4D4038]">

                                Dari Tanggal

                            </label>

                            <input type="date" name="start_date"
                                value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}"
                                class="h-11 w-full
                                       rounded-xl
                                       border
                                       border-[#DFD2C7]
                                       px-4
                                       text-sm
                                       outline-none
                                       focus:border-[#A97957]
                                       focus:ring-4
                                       focus:ring-[#F1E6DE]">

                        </div>


                        <div>

                            <label
                                class="mb-2 block
                                       text-sm font-semibold
                                       text-[#4D4038]">

                                Sampai Tanggal

                            </label>

                            <input type="date" name="end_date" value="{{ request('end_date', now()->format('Y-m-d')) }}"
                                class="h-11 w-full
                                       rounded-xl
                                       border
                                       border-[#DFD2C7]
                                       px-4
                                       text-sm
                                       outline-none
                                       focus:border-[#A97957]
                                       focus:ring-4
                                       focus:ring-[#F1E6DE]">

                        </div>

                    </div>



                    <div>

                        <button type="submit"
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
                                   transition
                                   hover:bg-[#0a1d45]">

                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                                <path d="M4 6h16" />
                                <path d="M7 12h10" />
                                <path d="M10 18h4" />

                            </svg>

                            Terapkan Periode

                        </button>

                    </div>

                </div>

            </form>

        </section>



        {{-- ===================================================== --}}
        {{-- PERIOD TITLE --}}
        {{-- ===================================================== --}}

        <div
            class="flex flex-col gap-1
                   sm:flex-row
                   sm:items-center
                   sm:justify-between">

            <div>

                <p
                    class="text-xs font-bold
                           uppercase tracking-wider
                           text-[#A28A7A]">

                    Periode Laporan

                </p>

                <p class="mt-1 text-lg
                           font-black
                           text-[#332B26]">

                    {{ $periodLabel }}

                </p>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- SUMMARY CARDS --}}
        {{-- ===================================================== --}}

        <div class="grid gap-4
                   sm:grid-cols-2
                   xl:grid-cols-4">


            {{-- TRANSACTION --}}

            <div
                class="rounded-3xl
                       border
                       border-[#DFD2C7]
                       bg-white
                       p-5 shadow-sm">

                <div class="flex items-start
                           justify-between">

                    <div>

                        <p
                            class="text-xs
                                   font-bold
                                   uppercase
                                   tracking-wide
                                   text-[#998274]">

                            Total Pesanan

                        </p>

                        <p
                            class="mt-4 text-3xl
                                   font-black
                                   text-[#332B26]">

                            {{ number_format($totalOrders) }}

                        </p>

                    </div>


                    <div
                        class="flex size-11
                               items-center
                               justify-center
                               rounded-xl
                               bg-[#4371d1]
                               text-white">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <path d="M6 3h12v18H6z" />
                            <path d="M9 8h6" />
                            <path d="M9 12h6" />

                        </svg>

                    </div>

                </div>

            </div>



            {{-- VALUE --}}

            <div
                class="rounded-3xl
                       border
                       border-[#E8D8B9]
                       bg-white
                       p-5 shadow-sm">

                <div class="flex items-start
                           justify-between">

                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-wide
                                   text-[#A87A37]">

                            Nilai Transaksi

                        </p>

                        <p
                            class="mt-4 text-2xl
                                   font-black
                                   text-[#A87A37]">

                            Rp{{ number_format($totalTransactionValue, 0, ',', '.') }}

                        </p>

                    </div>


                    <div
                        class="flex size-11
                               items-center
                               justify-center
                               rounded-xl
                               bg-[#C89B55]
                               text-white">

                        <span class="text-sm font-black">
                            Rp
                        </span>

                    </div>

                </div>

            </div>



            {{-- COMPLETED --}}

            <div
                class="rounded-3xl
                       border
                       border-[#D3DFCE]
                       bg-white
                       p-5 shadow-sm">

                <div class="flex items-start
                           justify-between">

                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-wide
                                   text-[#65795E]">

                            Pesanan Selesai

                        </p>

                        <p
                            class="mt-4 text-3xl
                                   font-black
                                   text-[#65795E]">

                            {{ number_format($completedOrders) }}

                        </p>

                    </div>


                    <div
                        class="flex size-11
                               items-center
                               justify-center
                               rounded-xl
                               bg-[#718268]
                               text-white">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                            <path d="m5 12 4 4L19 6" />

                        </svg>

                    </div>

                </div>

            </div>



            {{-- ITEMS --}}

            <div
                class="rounded-3xl
                       border
                       border-[#EBCFC2]
                       bg-white
                       p-5 shadow-sm">

                <div class="flex items-start
                           justify-between">

                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-wide
                                   text-[#A95E43]">

                            Barang Terjual

                        </p>

                        <p
                            class="mt-4 text-3xl
                                   font-black
                                   text-[#A95E43]">

                            {{ number_format($totalItems) }}

                        </p>

                    </div>


                    <div
                        class="flex size-11
                               items-center
                               justify-center
                               rounded-xl
                               bg-[#C8795A]
                               text-white">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">

                            <path d="M6 7h12l1 14H5L6 7Z" />
                            <path d="M9 7a3 3 0 0 1 6 0" />

                        </svg>

                    </div>

                </div>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- SECONDARY SUMMARY --}}
        {{-- ===================================================== --}}

        <div class="grid gap-4
                   md:grid-cols-3">

            <div class="rounded-2xl
                       border border-[#DFD2C7]
                       bg-white p-4">

                <p class="text-xs text-slate-500">
                    Buyer Terlibat
                </p>

                <p class="mt-2 text-xl
                           font-black
                           text-[#4371d1]">

                    {{ number_format($totalBuyers) }}

                </p>

            </div>


            <div class="rounded-2xl
                       border border-[#DFD2C7]
                       bg-white p-4">

                <p class="text-xs text-slate-500">
                    Seller Terlibat
                </p>

                <p class="mt-2 text-xl
                           font-black
                           text-[#C8795A]">

                    {{ number_format($totalSellers) }}

                </p>

            </div>


            <div class="rounded-2xl
                       border border-[#ECD2CF]
                       bg-white p-4">

                <p class="text-xs text-slate-500">
                    Dibatalkan
                </p>

                <p class="mt-2 text-xl
                           font-black
                           text-[#A65954]">

                    {{ number_format($cancelledOrders) }}

                </p>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- TOP SELLER + PRODUCTS --}}
        {{-- ===================================================== --}}

        <div class="grid gap-6
                   lg:grid-cols-2">


            {{-- TOP SELLERS --}}

            <section
                class="overflow-hidden
                       rounded-3xl
                       border
                       border-[#DFD2C7]
                       bg-white shadow-sm">

                <div
                    class="border-b
                           border-[#E7DBD1]
                           bg-[#FAF7F2]
                           p-5">

                    <h2 class="font-bold
                               text-[#332B26]">

                        Seller Teratas

                    </h2>

                    <p class="mt-1 text-xs
                               text-slate-500">

                        Berdasarkan nilai transaksi.

                    </p>

                </div>


                <div class="divide-y
                           divide-[#EEE5DE]">

                    @forelse ($topSellers as $index => $seller)
                        <div class="flex items-center
                                   gap-4 p-4">

                            <div
                                class="flex size-9
                                       shrink-0
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-[#FBEAE2]
                                       text-sm
                                       font-black
                                       text-[#A95E43]">

                                {{ $index + 1 }}

                            </div>


                            <div class="min-w-0 flex-1">

                                <p
                                    class="truncate
                                           font-bold
                                           text-[#332B26]">

                                    {{ $seller['store_name'] }}

                                </p>

                                <p
                                    class="mt-1 truncate
                                           text-xs
                                           text-slate-500">

                                    {{ $seller['name'] }}
                                    ·
                                    {{ $seller['orders'] }}
                                    pesanan

                                </p>

                            </div>


                            <p
                                class="whitespace-nowrap
                                       text-sm font-bold
                                       text-[#4371d1]">

                                Rp{{ number_format($seller['transaction_value'], 0, ',', '.') }}

                            </p>

                        </div>

                    @empty

                        <p
                            class="p-6 text-center
                                   text-sm
                                   text-slate-500">

                            Belum ada data seller.

                        </p>
                    @endforelse

                </div>

            </section>



            {{-- TOP PRODUCTS --}}

            <section
                class="overflow-hidden
                       rounded-3xl
                       border
                       border-[#DFD2C7]
                       bg-white shadow-sm">

                <div
                    class="border-b
                           border-[#E7DBD1]
                           bg-[#FAF7F2]
                           p-5">

                    <h2 class="font-bold
                               text-[#332B26]">

                        Produk Terlaris

                    </h2>

                    <p class="mt-1 text-xs
                               text-slate-500">

                        Berdasarkan jumlah barang.

                    </p>

                </div>


                <div class="divide-y
                           divide-[#EEE5DE]">

                    @forelse ($topProducts as $index => $product)
                        <div class="flex items-center
                                   gap-4 p-4">

                            <div
                                class="flex size-9
                                       shrink-0
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-[#EEF3EA]
                                       text-sm
                                       font-black
                                       text-[#65795E]">

                                {{ $index + 1 }}

                            </div>


                            <div class="min-w-0 flex-1">

                                <p
                                    class="truncate
                                           font-bold
                                           text-[#332B26]">

                                    {{ $product['name'] }}

                                </p>

                                <p class="mt-1 text-xs
                                           text-slate-500">

                                    {{ $product['quantity'] }}
                                    barang

                                </p>

                            </div>


                            <p
                                class="whitespace-nowrap
                                       text-sm
                                       font-bold
                                       text-[#4371d1]">

                                Rp{{ number_format($product['transaction_value'], 0, ',', '.') }}

                            </p>

                        </div>

                    @empty

                        <p
                            class="p-6 text-center
                                   text-sm
                                   text-slate-500">

                            Belum ada data produk.

                        </p>
                    @endforelse

                </div>

            </section>

        </div>

    </div>

@endsection
