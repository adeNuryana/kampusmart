@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="mx-auto max-w-[1400px]">

    {{-- PAGE HEADER --}}
    <div class="mb-8">

        <h2
            class="text-2xl font-bold tracking-tight
                   text-slate-900 lg:text-3xl"
        >
            Dashboard
        </h2>

        <p class="mt-2 text-sm text-slate-500">
            Pantau aktivitas dan kelola platform KampusMart.
        </p>

    </div>


    {{-- STAT CARDS --}}
    <div
        class="grid gap-4
               sm:grid-cols-2
               xl:grid-cols-4"
    >

        {{-- BUYERS --}}
        <div
            class="rounded-2xl border border-slate-200
                   bg-white p-5 shadow-sm"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p
                        class="text-xs font-semibold uppercase
                               tracking-[0.08em]
                               text-slate-500"
                    >
                        Total Pembeli
                    </p>

                    <p
                        class="mt-8 text-3xl font-bold
                               text-slate-900"
                    >
                        {{ number_format($totalBuyers) }}
                    </p>

                </div>


                <div
                    class="flex size-12 items-center
                           justify-center rounded-2xl
                           bg-violet-50 text-violet-600"
                >
                    <svg
                        class="size-6"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <circle cx="12" cy="8" r="3"/>
                        <path d="M5 20c0-4 3-7 7-7s7 3 7 7"/>
                    </svg>
                </div>

            </div>

        </div>


        {{-- SELLERS --}}
        <div
            class="rounded-2xl border border-slate-200
                   bg-white p-5 shadow-sm"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p
                        class="text-xs font-semibold uppercase
                               tracking-[0.08em]
                               text-slate-500"
                    >
                        Total Penjual
                    </p>

                    <p
                        class="mt-8 text-3xl font-bold
                               text-slate-900"
                    >
                        {{ number_format($totalSellers) }}
                    </p>

                </div>


                <div
                    class="flex size-12 items-center
                           justify-center rounded-2xl
                           bg-violet-50 text-violet-600"
                >
                    <svg
                        class="size-6"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="M4 10v10h16V10"/>
                        <path d="M3 10l2-6h14l2 6"/>
                    </svg>
                </div>

            </div>

        </div>


        {{-- ACTIVE SELLER --}}
        <div
            class="rounded-2xl border border-slate-200
                   bg-white p-5 shadow-sm"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p
                        class="text-xs font-semibold uppercase
                               tracking-[0.08em]
                               text-slate-500"
                    >
                        Penjual Aktif
                    </p>

                    <p
                        class="mt-8 text-3xl font-bold
                               text-slate-900"
                    >
                        {{ number_format($activeSellers) }}
                    </p>

                    <p class="mt-2 text-xs text-green-600">
                        Akun dapat digunakan
                    </p>

                </div>


                <div
                    class="flex size-12 items-center
                           justify-center rounded-2xl
                           bg-green-50 text-green-600"
                >
                    ✓
                </div>

            </div>

        </div>


        {{-- INACTIVE --}}
        <div
            class="rounded-2xl border
                   border-red-100 bg-red-50/50
                   p-5 shadow-sm"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p
                        class="text-xs font-semibold uppercase
                               tracking-[0.08em]
                               text-red-600"
                    >
                        Penjual Nonaktif
                    </p>

                    <p
                        class="mt-8 text-3xl font-bold
                               text-red-700"
                    >
                        {{ number_format($inactiveSellers) }}
                    </p>

                    <p class="mt-2 text-xs text-red-600">
                        Perlu ditinjau
                    </p>

                </div>

                <div
                    class="flex size-12 items-center
                           justify-center rounded-2xl
                           bg-red-100 text-red-600"
                >
                    !
                </div>

            </div>

        </div>

    </div>


    {{-- MIDDLE SECTION --}}
    <div
        class="mt-6 grid gap-6
               xl:grid-cols-[minmax(0,2fr)_340px]"
    >

        {{-- CHART --}}
        <section
            class="rounded-2xl border border-slate-200
                   bg-white p-6 shadow-sm"
        >

            <div>

                <h3 class="text-lg font-semibold">
                    Pertumbuhan Pengguna
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Gambaran pengguna baru KampusMart.
                </p>

            </div>


            <div
                class="mt-8 flex h-[270px]
                       items-end gap-5
                       border-b border-slate-200
                       px-3"
            >

                @php
                    $bars = [38, 55, 31, 68, 58, 82];
                @endphp

                @foreach ($bars as $index => $height)

                    <div
                        class="flex h-full flex-1
                               flex-col justify-end"
                    >

                        <div
                            class="mx-auto w-full max-w-12
                                   rounded-t-md bg-violet-500
                                   transition hover:bg-violet-600"
                            style="height: {{ $height }}%"
                        ></div>

                        <p
                            class="mt-3 whitespace-nowrap
                                   text-center text-xs
                                   text-slate-500"
                        >
                            M{{ $index + 1 }}
                        </p>

                    </div>

                @endforeach

            </div>

        </section>


        {{-- ACTION --}}
        <section
            class="rounded-2xl border border-slate-200
                   bg-white p-6 shadow-sm"
        >

            <h3 class="text-lg font-semibold">
                Memerlukan Tindakan
            </h3>

            <div class="mt-5 space-y-3">

                @if ($inactiveSellers > 0)

                    <div
                        class="rounded-xl border
                               border-slate-200 p-4"
                    >

                        <p class="font-semibold text-slate-800">
                            Akun Penjual Nonaktif
                        </p>

                        <p
                            class="mt-1 text-sm
                                   text-slate-500"
                        >
                            {{ $inactiveSellers }}
                            akun penjual tidak aktif.
                        </p>

                        <button
                            type="button"
                            class="mt-4 rounded-lg
                                   bg-violet-600 px-4 py-2
                                   text-xs font-semibold
                                   text-white
                                   hover:bg-violet-700"
                        >
                            Tinjau
                        </button>

                    </div>

                @else

                    <div
                        class="rounded-xl bg-green-50
                               px-4 py-5 text-sm
                               text-green-700"
                    >
                        Tidak ada akun penjual yang
                        membutuhkan tindakan.
                    </div>

                @endif


                <div
                    class="rounded-xl border
                           border-slate-200 p-4"
                >

                    <p class="font-semibold">
                        Kelola Penjual
                    </p>

                    <p
                        class="mt-1 text-sm
                               leading-6 text-slate-500"
                    >
                        Tambahkan akun penjual baru
                        melalui halaman Kelola Penjual.
                    </p>

                </div>

            </div>

        </section>

    </div>


    {{-- ACTIVITY --}}
    <section
        class="mt-6 overflow-hidden
               rounded-2xl border
               border-slate-200
               bg-white shadow-sm"
    >

        <div
            class="flex items-center justify-between
                   border-b border-slate-200
                   px-6 py-5"
        >

            <h3 class="text-lg font-semibold">
                Aktivitas Terbaru
            </h3>

            <span
                class="text-sm font-medium
                       text-violet-600"
            >
                KampusMart
            </span>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full min-w-[700px]">

                <thead class="bg-slate-50">

                    <tr
                        class="text-left text-xs
                               uppercase tracking-wide
                               text-slate-500"
                    >

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
                    class="divide-y divide-slate-100
                           text-sm"
                >

                    <tr>

                        <td class="px-6 py-4 text-slate-500">
                            Hari ini
                        </td>

                        <td class="px-6 py-4">
                            Login Super Admin
                        </td>

                        <td class="px-6 py-4">
                            {{ \Illuminate\Support\Facades\Auth::user()?->name }}
                        </td>

                        <td class="px-6 py-4">

                            <span
                                class="rounded-full
                                       bg-green-100
                                       px-3 py-1
                                       text-xs font-medium
                                       text-green-700"
                            >
                                Berhasil
                            </span>

                        </td>

                    </tr>


                    <tr>

                        <td class="px-6 py-4 text-slate-500">
                            -
                        </td>

                        <td class="px-6 py-4">
                            Data aktivitas berikutnya
                            akan dicatat pada modul terkait
                        </td>

                        <td class="px-6 py-4">
                            -
                        </td>

                        <td class="px-6 py-4">

                            <span
                                class="rounded-full bg-slate-100
                                       px-3 py-1 text-xs
                                       text-slate-600"
                            >
                                -
                            </span>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </section>

</div>

@endsection
