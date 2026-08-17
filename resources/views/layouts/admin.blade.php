<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Super Admin') - KampusMart
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#fafafa] font-sans text-slate-900">

    <div class="min-h-screen lg:flex">

        {{-- SIDEBAR --}}
        <aside
            class="hidden min-h-screen w-[250px] shrink-0
               border-r border-slate-200 bg-white
               lg:fixed lg:inset-y-0 lg:left-0
               lg:flex lg:flex-col">

            {{-- BRAND --}}
            <div class="px-6 pb-7 pt-8">

                <h1 class="text-3xl font-bold tracking-tight
                       text-violet-600">
                    KampusMart
                </h1>

                <p
                    class="mt-1 text-xs font-semibold
                       uppercase tracking-[0.12em]
                       text-slate-600">
                    Super Admin
                </p>

            </div>


            {{-- NAVIGATION --}}
            <nav class="flex-1 space-y-1 px-3">

                {{-- DASHBOARD --}}
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-4 rounded-xl
                       px-4 py-3 text-sm font-medium
                       transition
                       {{ request()->routeIs('admin.dashboard')
                           ? 'bg-violet-100 text-violet-700'
                           : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">

                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="3" width="7" height="7" />
                        <rect x="14" y="3" width="7" height="7" />
                        <rect x="3" y="14" width="7" height="7" />
                        <rect x="14" y="14" width="7" height="7" />
                    </svg>

                    Dashboard

                </a>


                {{-- PEMBELI --}}
                <a href="{{ route('admin.buyers.index') }}"
                    class="flex items-center gap-4 rounded-xl
           px-4 py-3 text-sm font-medium transition
           {{ request()->routeIs('admin.buyers.*') ? 'bg-violet-50 text-violet-700' : 'text-slate-600 hover:bg-slate-50' }}">

                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="8" r="4" />

                        <path d="M4 21a8 8 0 0 1 16 0" />
                    </svg>

                    Pembeli

                </a>


                {{-- PENJUAL --}}
                <a href="{{ route('admin.sellers.index') }}"
                    class="flex items-center gap-4 rounded-xl px-4 py-3 text-sm font-medium transition
           {{ request()->routeIs('admin.sellers.*') ? 'bg-violet-100 text-violet-700' : 'text-slate-600 hover:bg-slate-50' }}">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M4 10v10h16V10" />
                        <path d="M3 10l2-6h14l2 6" />
                        <path d="M8 20v-6h8v6" />
                    </svg>

                    Penjual
                </a>
                <a href="{{ route('admin.orders.index') }}"
                    class="flex items-center gap-4
           rounded-xl px-4 py-3
           text-sm font-medium transition
           {{ request()->routeIs('admin.orders.*') ? 'bg-violet-50 text-violet-700' : 'text-slate-600 hover:bg-slate-50' }}">

                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M6 3h12v18H6z" />
                        <path d="M9 8h6" />
                        <path d="M9 12h6" />
                        <path d="M9 16h4" />
                    </svg>

                    Pesanan

                </a>

                {{-- PRODUK --}}
                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center gap-4 rounded-xl
                       px-4 py-3 text-sm font-medium
                       text-slate-600
                       hover:bg-slate-50">

                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M6 7h12l1 14H5L6 7Z" />
                        <path d="M9 7a3 3 0 0 1 6 0" />
                    </svg>

                    Produk

                </a>


                {{-- KATEGORI --}}
                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center gap-4
           rounded-xl px-4 py-3
           text-sm font-medium
           transition

           {{ request()->routeIs('admin.categories.*')
               ? 'bg-violet-100 text-violet-700'
               : 'text-slate-600 hover:bg-slate-50' }}">

                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="3" width="7" height="7" />

                        <circle cx="17.5" cy="6.5" r="3.5" />

                        <path d="m7 14-4 7h8l-4-7Z" />

                        <rect x="14" y="14" width="7" height="7" />
                    </svg>

                    Kategori

                </a>


                {{-- LAPORAN --}}
                <a href="#"
                    class="flex items-center gap-4 rounded-xl
                       px-4 py-3 text-sm font-medium
                       text-slate-600
                       hover:bg-slate-50">

                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="4" y="3" width="16" height="18" />
                        <path d="M8 17v-4" />
                        <path d="M12 17V8" />
                        <path d="M16 17v-7" />
                    </svg>

                    Laporan

                </a>

            </nav>


            {{-- BOTTOM MENU --}}
            <div class="space-y-1 border-t border-slate-200 p-3">

                <a href="{{ route('admin.settings.index') }}"
                    class="flex items-center gap-4 rounded-xl
           px-4 py-3 text-sm font-medium transition
           {{ request()->routeIs('admin.settings.*') ? 'bg-violet-50 text-violet-700' : 'text-slate-600 hover:bg-slate-50' }}">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
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



                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="flex w-full items-center gap-4
                           rounded-xl px-4 py-3
                           text-left text-sm font-medium
                           text-red-600
                           hover:bg-red-50">
                        ↪
                        Keluar
                    </button>

                </form>

            </div>

        </aside>


        {{-- MAIN --}}
        <div class="min-w-0 flex-1 lg:ml-[250px]">

            {{-- TOPBAR --}}
            <header
                class="sticky top-0 z-20 flex h-[68px]
                   items-center justify-between
                   border-b border-slate-200
                   bg-white/95 px-5
                   backdrop-blur
                   lg:px-7">

                {{-- SEARCH --}}
                <div class="hidden w-full max-w-[350px] sm:block">

                    <div class="relative">

                        <svg class="absolute left-4 top-1/2
                               size-5 -translate-y-1/2
                               text-slate-400"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7" />
                            <path d="m20 20-3.5-3.5" />
                        </svg>

                        <input type="text" placeholder="Search..."
                            class="h-11 w-full rounded-xl
                               border border-slate-200
                               bg-slate-50 pl-11 pr-4
                               text-sm outline-none
                               transition
                               focus:border-violet-400
                               focus:bg-white
                               focus:ring-4
                               focus:ring-violet-100">

                    </div>

                </div>


                <div class="ml-auto flex items-center gap-5">

                    {{-- NOTIFICATION --}}
                    <button type="button"
                        class="relative flex size-10 items-center
                           justify-center rounded-full
                           text-slate-600
                           hover:bg-slate-100">

                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M18 8a6 6 0 0 0-12 0
                               c0 7-3 7-3 9h18
                               c0-2-3-2-3-9" />
                            <path d="M10 21h4" />
                        </svg>

                        <span
                            class="absolute right-2 top-2
                               size-2 rounded-full bg-red-500"></span>

                    </button>


                    <div class="h-8 w-px bg-slate-200"></div>


                    {{-- ADMIN --}}
                    <div class="flex items-center gap-3">

                        <div class="hidden text-right sm:block">

                            <p class="text-sm font-semibold text-slate-800">
                                {{ \Illuminate\Support\Facades\Auth::user()?->name }}
                            </p>

                            <p class="text-xs text-slate-500">
                                Super Admin
                            </p>

                        </div>


                        <div
                            class="flex size-10 items-center
                               justify-center rounded-full
                               bg-violet-100
                               font-semibold text-violet-700">
                            {{ strtoupper(substr(\Illuminate\Support\Facades\Auth::user()?->name ?? 'A', 0, 1)) }}
                        </div>

                    </div>

                </div>

            </header>


            {{-- PAGE --}}
            <main class="p-5 lg:p-7">

                @yield('content')

            </main>

        </div>

    </div>

</body>

</html>
