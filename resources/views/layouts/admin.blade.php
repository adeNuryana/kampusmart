<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin')  - {{ $siteSetting?->site_name ?? 'KampusMart' }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>


<body class="bg-[#F3EEE8]
           font-sans
           text-[#332B26]
           antialiased">


    <div x-data="{
        mobileSidebar: false
    }" class="min-h-screen">


        {{-- ===================================================== --}}
        {{-- MOBILE OVERLAY --}}
        {{-- ===================================================== --}}

        <div x-cloak x-show="mobileSidebar" x-transition.opacity @click="mobileSidebar = false"
            class="fixed
                   inset-0
                   z-40
                   bg-[#332B26]/40
                   backdrop-blur-sm
                   lg:hidden">
        </div>



        {{-- ===================================================== --}}
        {{-- SIDEBAR --}}
        {{-- ===================================================== --}}

        <aside
            :class="mobileSidebar
                ?
                'translate-x-0' :
                '-translate-x-full lg:translate-x-0'"
            class="fixed
                   inset-y-0
                   left-0
                   z-50
                   flex
                   w-[260px]
                   flex-col
                   border-r
                   border-[#DFD2C7]
                   bg-[#FFFDF9]
                   transition-transform
                   duration-300
                   lg:z-30">


            {{-- ================================================= --}}
            {{-- BRAND --}}
            {{-- ================================================= --}}

            <div
                class="border-b
                       border-[#EEE3DA]
                       px-5
                       pb-5
                       pt-6">


                <div
                    class="flex
                           items-center
                           justify-between
                           gap-3">


                    <a href="{{ route('admin.dashboard') }}"
                        class="flex
                               min-w-0
                               items-center
                               gap-3">


                        {{-- LOGO --}}

                        <div
                            class="flex
                                   size-11
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-2xl
                                   bg-gradient-to-br
                                   from-[#0a1d45]
                                   via-[#4371d1]
                                   to-[#9A6948]
                                   text-white
                                   shadow-sm">

                            @if ($siteSetting?->logo)
                                <img src="{{ asset('storage/' . $siteSetting->logo) }}"
                                    alt="{{ $siteSetting->site_name }}"
                                    class="size-10
               shrink-0
               rounded-xl
               object-contain">
                            @else
                                <div
                                    class="flex size-10
               shrink-0
               items-center justify-center
               rounded-2xl
               bg-gradient-to-br
               from-[#C8795A]
               to-[#4371d1]
               font-black
               text-white">

                                    {{ strtoupper(substr($siteSetting?->site_name ?? 'KampusMart', 0, 1)) }}

                                </div>
                            @endif
                        </div>


                        <div class="min-w-0">

                            <h1
                                class="truncate
                                       text-xl
                                       font-black
                                       tracking-tight
                                       text-[#0a1d45]">

                                {{ $siteSetting?->site_name ?? 'KampusMart' }}

                            </h1>


                            <p
                                class="mt-0.5
                                       text-[10px]
                                       font-bold
                                       uppercase
                                       tracking-[0.16em]
                                       text-[#A28A7A]">

                                Super Admin

                            </p>

                        </div>

                    </a>



                    {{-- CLOSE MOBILE --}}

                    <button type="button" @click="mobileSidebar = false"
                        class="flex
                               size-9
                               items-center
                               justify-center
                               rounded-xl
                               text-[#8B7465]
                               transition
                               hover:bg-[#F3EAE3]
                               lg:hidden">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                            <path d="M6 6l12 12" />
                            <path d="M18 6 6 18" />

                        </svg>

                    </button>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- NAVIGATION --}}
            {{-- ================================================= --}}

            <nav
                class="flex-1
                       space-y-1
                       overflow-y-auto
                       px-3
                       py-5">


                <p
                    class="mb-2
                           px-3
                           text-[10px]
                           font-bold
                           uppercase
                           tracking-[0.14em]
                           text-[#B09A8B]">

                    Menu Utama

                </p>



                {{-- ================================================= --}}
                {{-- DASHBOARD --}}
                {{-- ================================================= --}}

                <a href="{{ route('admin.dashboard') }}"
                    class="group
                           relative
                           flex
                           items-center
                           gap-3
                           overflow-hidden
                           rounded-xl
                           px-3.5
                           py-3
                           text-sm
                           font-semibold
                           transition
                           {{ request()->routeIs('admin.dashboard')
                               ? 'bg-[#4371d1] text-white shadow-sm'
                               : 'text-[#6F6259] hover:bg-[#F3EAE3] hover:text-[#0a1d45]' }}">


                    <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">

                        <rect x="3" y="3" width="7" height="7" rx="1.5" />

                        <rect x="14" y="3" width="7" height="7" rx="1.5" />

                        <rect x="3" y="14" width="7" height="7" rx="1.5" />

                        <rect x="14" y="14" width="7" height="7" rx="1.5" />

                    </svg>

                    <span>
                        Dashboard
                    </span>

                </a>



                {{-- ================================================= --}}
                {{-- PEMBELI --}}
                {{-- ================================================= --}}

                <a href="{{ route('admin.buyers.index') }}"
                    class="group
                           flex
                           items-center
                           gap-3
                           rounded-xl
                           px-3.5
                           py-3
                           text-sm
                           font-semibold
                           transition
                           {{ request()->routeIs('admin.buyers.*')
                               ? 'bg-[#F1E6DE] text-[#4371d1]'
                               : 'text-[#6F6259] hover:bg-[#F3EAE3] hover:text-[#0a1d45]' }}">


                    <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">

                        <circle cx="12" cy="8" r="3.5" />

                        <path d="M4.5 21c0-4.3 3.3-7.5 7.5-7.5s7.5 3.2 7.5 7.5" />

                    </svg>

                    Pembeli

                </a>



                {{-- ================================================= --}}
                {{-- PENJUAL --}}
                {{-- ================================================= --}}

                <a href="{{ route('admin.sellers.index') }}"
                    class="group
                           flex
                           items-center
                           gap-3
                           rounded-xl
                           px-3.5
                           py-3
                           text-sm
                           font-semibold
                           transition
                           {{ request()->routeIs('admin.sellers.*')
                               ? 'bg-[#FBEAE2] text-[#A95E43]'
                               : 'text-[#6F6259] hover:bg-[#F3EAE3] hover:text-[#0a1d45]' }}">


                    <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">

                        <path d="M4 10v10h16V10" />
                        <path d="M3 10l2-6h14l2 6" />
                        <path d="M8 20v-6h8v6" />

                    </svg>

                    Penjual

                </a>



                {{-- ================================================= --}}
                {{-- PESANAN --}}
                {{-- ================================================= --}}

                <a href="{{ route('admin.orders.index') }}"
                    class="group
                           flex
                           items-center
                           gap-3
                           rounded-xl
                           px-3.5
                           py-3
                           text-sm
                           font-semibold
                           transition
                           {{ request()->routeIs('admin.orders.*')
                               ? 'bg-[#FAF2DF] text-[#A87A37]'
                               : 'text-[#6F6259] hover:bg-[#F3EAE3] hover:text-[#0a1d45]' }}">


                    <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">

                        <path d="M6 3h12v18H6z" stroke-linejoin="round" />

                        <path d="M9 8h6" />
                        <path d="M9 12h6" />
                        <path d="M9 16h4" />

                    </svg>

                    Pesanan

                </a>



                {{-- ================================================= --}}
                {{-- PRODUK --}}
                {{-- ================================================= --}}

                <a href="{{ route('admin.products.index') }}"
                    class="group
                           flex
                           items-center
                           gap-3
                           rounded-xl
                           px-3.5
                           py-3
                           text-sm
                           font-semibold
                           transition
                           {{ request()->routeIs('admin.products.*')
                               ? 'bg-[#EEF3EA] text-[#65795E]'
                               : 'text-[#6F6259] hover:bg-[#F3EAE3] hover:text-[#0a1d45]' }}">


                    <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">

                        <path d="M6 7h12l1 14H5L6 7Z" />

                        <path d="M9 7a3 3 0 0 1 6 0" />

                    </svg>

                    Produk

                </a>



                {{-- ================================================= --}}
                {{-- KATEGORI --}}
                {{-- ================================================= --}}

                <a href="{{ route('admin.categories.index') }}"
                    class="group
                           flex
                           items-center
                           gap-3
                           rounded-xl
                           px-3.5
                           py-3
                           text-sm
                           font-semibold
                           transition
                           {{ request()->routeIs('admin.categories.*')
                               ? 'bg-[#F4EAE2] text-[#4371d1]'
                               : 'text-[#6F6259] hover:bg-[#F3EAE3] hover:text-[#0a1d45]' }}">


                    <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">

                        <rect x="3" y="3" width="7" height="7" rx="1.5" />

                        <circle cx="17.5" cy="6.5" r="3.5" />

                        <path d="m7 14-4 7h8l-4-7Z" stroke-linejoin="round" />

                        <rect x="14" y="14" width="7" height="7" rx="1.5" />

                    </svg>

                    Kategori

                </a>



                {{-- ================================================= --}}
                {{-- LAPORAN --}}
                {{-- ================================================= --}}

                <a href="{{ route('admin.reports.index') }}"
                    class="group
           flex
           items-center
           gap-3
           rounded-xl
           px-3.5
           py-3
           text-sm
           font-semibold
           transition
           {{ request()->routeIs('admin.reports.*')
               ? 'bg-[#FAF2DF] text-[#A87A37]'
               : 'text-[#6F6259] hover:bg-[#F3EAE3] hover:text-[#0a1d45]' }}">

                    <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">

                        <rect x="4" y="3" width="16" height="18" rx="2" />

                        <path d="M8 17v-4" />
                        <path d="M12 17V8" />
                        <path d="M16 17v-7" />

                    </svg>

                    Laporan

                </a>

            </nav>



            {{-- ================================================= --}}
            {{-- BOTTOM MENU --}}
            {{-- ================================================= --}}

            <div class="border-t
                       border-[#EEE3DA]
                       p-3">


                <p
                    class="mb-2
                           px-3
                           text-[10px]
                           font-bold
                           uppercase
                           tracking-[0.14em]
                           text-[#B09A8B]">

                    Sistem

                </p>



                {{-- SETTINGS --}}

                <a href="{{ route('admin.settings.website') }}"
                    class="flex
                           items-center
                           gap-3
                           rounded-xl
                           px-3.5
                           py-3
                           text-sm
                           font-semibold
                           transition
                           {{ request()->routeIs('admin.settings.*')
                               ? 'bg-[#F1E6DE] text-[#4371d1]'
                               : 'text-[#6F6259] hover:bg-[#F3EAE3] hover:text-[#0a1d45]' }}">


                    <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">

                        <circle cx="12" cy="12" r="3" />

                        <path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06
                               a2 2 0 1 1-2.83 2.83l-.06-.06
                               A1.7 1.7 0 0 0 15 19.4
                               a1.7 1.7 0 0 0-1 .6
                               1.7 1.7 0 0 0-.4 1.1V21
                               a2 2 0 1 1-4 0v-.09
                               A1.7 1.7 0 0 0 8.6 19.4
                               a1.7 1.7 0 0 0-1.88.34l-.06.06
                               a2 2 0 1 1-2.83-2.83l.06-.06
                               A1.7 1.7 0 0 0 4.6 15
                               a1.7 1.7 0 0 0-.6-1
                               1.7 1.7 0 0 0-1.1-.4H3
                               a2 2 0 1 1 0-4h.09
                               A1.7 1.7 0 0 0 4.6 8.6
                               a1.7 1.7 0 0 0-.34-1.88l-.06-.06
                               a2 2 0 1 1 2.83-2.83l.06.06
                               A1.7 1.7 0 0 0 9 4.6
                               a1.7 1.7 0 0 0 1-.6
                               1.7 1.7 0 0 0 .4-1.1V3
                               a2 2 0 1 1 4 0v.09
                               A1.7 1.7 0 0 0 15.4 4.6
                               a1.7 1.7 0 0 0 1.88-.34l.06-.06
                               a2 2 0 1 1 2.83 2.83l-.06.06
                               A1.7 1.7 0 0 0 19.4 9
                               a1.7 1.7 0 0 0 .6 1
                               1.7 1.7 0 0 0 1.1.4H21
                               a2 2 0 1 1 0 4h-.09
                               A1.7 1.7 0 0 0 19.4 15Z" />

                    </svg>

                    Pengaturan

                </a>



                {{-- LOGOUT --}}

                <form action="{{ route('logout') }}" method="POST" class="mt-1">

                    @csrf


                    <button type="submit"
                        class="flex
                               w-full
                               items-center
                               gap-3
                               rounded-xl
                               px-3.5
                               py-3
                               text-left
                               text-sm
                               font-semibold
                               text-[#A65954]
                               transition
                               hover:bg-[#FAEDEC]">


                        <svg class="size-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">

                            <path d="M10 17l5-5-5-5" />

                            <path d="M15 12H3" />

                            <path d="M14 4h5a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-5" />

                        </svg>

                        Keluar

                    </button>

                </form>

            </div>

        </aside>



        {{-- ===================================================== --}}
        {{-- MAIN --}}
        {{-- ===================================================== --}}

        <div class="min-w-0
                   lg:ml-[260px]">


            {{-- ================================================= --}}
            {{-- TOPBAR --}}
            {{-- ================================================= --}}

            <header
                class="sticky
                       top-0
                       z-30
                       flex
                       h-[72px]
                       items-center
                       gap-4
                       border-b
                       border-[#DFD2C7]
                       bg-[#FFFDF9]/95
                       px-4
                       backdrop-blur-xl
                       sm:px-5
                       lg:px-7">


                {{-- MOBILE MENU --}}

                <button type="button" @click="mobileSidebar = true"
                    class="flex
                           size-10
                           shrink-0
                           items-center
                           justify-center
                           rounded-xl
                           border
                           border-[#DFD2C7]
                           bg-white
                           text-[#4371d1]
                           transition
                           hover:bg-[#F3EAE3]
                           lg:hidden">

                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <path d="M4 6h16" />
                        <path d="M4 12h16" />
                        <path d="M4 18h16" />

                    </svg>

                </button>



                {{-- ================================================= --}}
                {{-- SEARCH --}}
                {{-- ================================================= --}}

                <div
                    class="hidden
                           w-full
                           max-w-[380px]
                           sm:block">


                    <div class="relative">

                        <svg class="absolute
                                   left-4
                                   top-1/2
                                   size-4
                                   -translate-y-1/2
                                   text-[#A28A7A]"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                            <circle cx="11" cy="11" r="7" />

                            <path d="m20 20-3.5-3.5" />

                        </svg>


                        <input type="text" placeholder="Cari di panel admin..."
                            class="h-11
                                   w-full
                                   rounded-xl
                                   border
                                   border-[#DFD2C7]
                                   bg-[#F8F3ED]
                                   pl-11
                                   pr-4
                                   text-sm
                                   text-slate-700
                                   outline-none
                                   transition
                                   placeholder:text-[#B3A195]
                                   focus:border-[#A97957]
                                   focus:bg-white
                                   focus:ring-4
                                   focus:ring-[#F1E6DE]">

                    </div>

                </div>



                {{-- RIGHT --}}

                <div
                    class="ml-auto
                           flex
                           items-center
                           gap-3">


                    {{-- ADMIN STATUS --}}

                    <div
                        class="hidden
                               items-center
                               gap-2
                               rounded-full
                               border
                               border-[#D7E1D2]
                               bg-[#EEF3EA]
                               px-3
                               py-1.5
                               text-[10px]
                               font-bold
                               text-[#65795E]
                               md:flex">

                        <span
                            class="size-1.5
                                   rounded-full
                                   bg-[#718268]">
                        </span>

                        Sistem Aktif

                    </div>



                    <div
                        class="hidden
                               h-8
                               w-px
                               bg-[#E3D7CD]
                               sm:block">
                    </div>



                    {{-- ================================================= --}}
                    {{-- ADMIN DROPDOWN --}}
                    {{-- ================================================= --}}

                    <div x-data="{
                        open: false
                    }" @click.outside="open = false" @keydown.escape.window="open = false"
                        class="relative">


                        {{-- TRIGGER --}}

                        <button type="button" @click="open = !open"
                            class="flex
                                   items-center
                                   gap-3
                                   rounded-xl
                                   px-2
                                   py-1.5
                                   transition
                                   hover:bg-[#F3EAE3]">


                            <div
                                class="hidden
                                       text-right
                                       sm:block">

                                <p
                                    class="max-w-[160px]
                                           truncate
                                           text-sm
                                           font-bold
                                           text-[#3D342E]">

                                    {{ auth()->user()?->name }}

                                </p>

                                <p
                                    class="mt-0.5
                                           text-[10px]
                                           font-medium
                                           text-[#9C8677]">

                                    Super Admin

                                </p>

                            </div>



                            {{-- AVATAR --}}

                            <div
                                class="flex
                                       size-10
                                       shrink-0
                                       items-center
                                       justify-center
                                       rounded-full
                                       bg-gradient-to-br
                                       from-[#0a1d45]
                                       via-[#4371d1]
                                       to-[#9A6948]
                                       text-sm
                                       font-black
                                       uppercase
                                       text-white
                                       shadow-sm
                                       ring-2
                                       ring-[#F1E6DE]">

                                {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}

                            </div>


                            <svg class="hidden
                                       size-3
                                       text-[#9C8677]
                                       transition
                                       sm:block"
                                :class="open ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">

                                <path d="m6 9 6 6 6-6" />

                            </svg>

                        </button>



                        {{-- ================================================= --}}
                        {{-- DROPDOWN --}}
                        {{-- ================================================= --}}

                        <div x-cloak x-show="open"
                            x-transition:enter="
                                transition
                                ease-out
                                duration-150
                            "
                            x-transition:enter-start="
                                opacity-0
                                translate-y-1
                                scale-95
                            "
                            x-transition:enter-end="
                                opacity-100
                                translate-y-0
                                scale-100
                            "
                            x-transition:leave="
                                transition
                                ease-in
                                duration-100
                            "
                            x-transition:leave-start="
                                opacity-100
                                translate-y-0
                                scale-100
                            "
                            x-transition:leave-end="
                                opacity-0
                                translate-y-1
                                scale-95
                            "
                            class="absolute
                                   right-0
                                   top-full
                                   z-50
                                   mt-3
                                   w-64
                                   origin-top-right
                                   overflow-hidden
                                   rounded-2xl
                                   border
                                   border-[#DFD2C7]
                                   bg-white
                                   shadow-2xl
                                   shadow-[#0a1d45]/10">


                            {{-- USER HEADER --}}

                            <div
                                class="border-b
                                       border-[#EEE3DA]
                                       bg-[#FAF7F2]
                                       p-4">


                                <div
                                    class="flex
                                           items-center
                                           gap-3">


                                    <div
                                        class="flex
                                               size-11
                                               shrink-0
                                               items-center
                                               justify-center
                                               rounded-full
                                               bg-[#4371d1]
                                               text-sm
                                               font-black
                                               uppercase
                                               text-white">

                                        {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}

                                    </div>


                                    <div class="min-w-0">

                                        <p
                                            class="truncate
                                                   text-sm
                                                   font-bold
                                                   text-[#332B26]">

                                            {{ auth()->user()?->name }}

                                        </p>


                                        <p
                                            class="mt-0.5
                                                   truncate
                                                   text-xs
                                                   text-slate-500">

                                            {{ auth()->user()?->email }}

                                        </p>

                                    </div>

                                </div>

                            </div>



                            {{-- MENU --}}

                            <div class="p-2">


                                <a href="{{ route('admin.settings.index') }}"
                                    class="flex
                                           items-center
                                           gap-3
                                           rounded-xl
                                           px-3
                                           py-2.5
                                           text-sm
                                           font-semibold
                                           text-[#5F5148]
                                           transition
                                           hover:bg-[#F3EAE3]
                                           hover:text-[#0a1d45]">


                                    <div
                                        class="flex
                                               size-9
                                               items-center
                                               justify-center
                                               rounded-xl
                                               bg-[#F1E6DE]
                                               text-[#4371d1]">

                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.8">

                                            <circle cx="12" cy="12" r="3" />

                                            <path d="M19 12a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />

                                        </svg>

                                    </div>

                                    Profile

                                </a>



                                <div
                                    class="my-2
                                           border-t
                                           border-[#EEE3DA]">
                                </div>



                                <form action="{{ route('logout') }}" method="POST">

                                    @csrf


                                    <button type="submit"
                                        class="flex
                                               w-full
                                               items-center
                                               gap-3
                                               rounded-xl
                                               px-3
                                               py-2.5
                                               text-left
                                               text-sm
                                               font-semibold
                                               text-[#A65954]
                                               transition
                                               hover:bg-[#FAEDEC]">


                                        <div
                                            class="flex
                                                   size-9
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-[#FAEDEC]
                                                   text-[#A65954]">

                                            <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1.8">

                                                <path d="M10 17l5-5-5-5" />
                                                <path d="M15 12H3" />
                                                <path d="M14 4h5a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-5" />

                                            </svg>

                                        </div>

                                        Keluar

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </header>



            {{-- ================================================= --}}
            {{-- PAGE CONTENT --}}
            {{-- ================================================= --}}

            <main
                class="min-h-[calc(100vh-72px)]
                       p-4
                       sm:p-5
                       lg:p-7">

                @yield('content')

            </main>

        </div>

    </div>


    @stack('scripts')

</body>

</html>
