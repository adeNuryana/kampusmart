<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'KampusMart')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="min-h-screen bg-slate-50 text-slate-900">

    {{-- NAVBAR --}}
    <header
        class="sticky top-0 z-50
               border-b border-slate-200/80
               bg-white/90 backdrop-blur">

        <div
            class="mx-auto flex h-16 max-w-7xl
                   items-center gap-6 px-4
                   sm:px-6 lg:px-8">

            {{-- LOGO --}}
            <a href="{{ route('buyer.dashboard') }}"
                class="shrink-0 text-xl font-bold
                       tracking-tight text-violet-600">
                KampusMart
            </a>


            {{-- SEARCH --}}
            <div class="hidden flex-1 md:block">
                <form action="{{ route('buyer.products.index') }}" method="GET" class="hidden flex-1 md:block">

                    <div class="relative max-w-xl">

                        <svg class="absolute left-4 top-1/2
                   size-5 -translate-y-1/2
                   text-slate-400"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="11" cy="11" r="7" />
                            <path d="m20 20-3.5-3.5" />
                        </svg>


                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari produk di KampusMart..."
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

                </form>

            </div>


            {{-- RIGHT MENU --}}
            <div class="ml-auto flex items-center gap-2">
                <a href="{{ route('buyer.orders.index') }}"
                    class="hidden rounded-xl
           px-4 py-2
           text-sm font-medium
           text-slate-600
           transition
           hover:bg-slate-100
           hover:text-violet-600
           md:inline-flex">
                    Pesanan
                </a>

                {{-- CART --}}
                @php
                    $cartCount = auth()->check() ? auth()->user()->cartItems()->sum('quantity') : 0;
                @endphp


                <a href="{{ route('buyer.cart.index') }}" title="Keranjang"
                    class="relative inline-flex size-10
           items-center justify-center
           rounded-xl text-slate-600
           transition hover:bg-slate-100">

                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M3 4h2l2 11h10l2-7H6" />
                        <circle cx="9" cy="19" r="1" />
                        <circle cx="17" cy="19" r="1" />
                    </svg>


                    @if ($cartCount > 0)
                        <span
                            class="absolute -right-1 -top-1
                   flex min-w-5 items-center
                   justify-center rounded-full
                   bg-violet-600 px-1
                   text-[10px] font-bold
                   text-white">
                            {{ $cartCount > 99 ? '99+' : $cartCount }}
                        </span>
                    @endif

                </a>

                {{-- PROFILE --}}
                {{-- PROFILE DROPDOWN --}}
                <details class="group relative">

                    {{-- BUTTON PROFILE --}}
                    <summary
                        class="flex cursor-pointer
               list-none items-center gap-3
               rounded-xl px-2 py-1.5
               transition
               hover:bg-slate-100">

                        {{-- AVATAR --}}
                        <div
                            class="flex size-9 shrink-0
                   items-center justify-center
                   rounded-full bg-violet-100
                   text-sm font-bold
                   text-violet-700">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>


                        {{-- NAME --}}
                        <div class="hidden text-left lg:block">

                            <p
                                class="max-w-[130px] truncate
                       text-sm font-semibold
                       text-slate-800">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="text-xs text-slate-400">
                                Pembeli
                            </p>

                        </div>


                        {{-- ARROW --}}
                        <svg class="hidden size-4
                   text-slate-400
                   transition-transform
                   group-open:rotate-180
                   lg:block"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m6 9 6 6 6-6" />
                        </svg>

                    </summary>


                    {{-- DROPDOWN --}}
                    <div
                        class="absolute right-0 top-full
               z-50 mt-2 w-56
               overflow-hidden rounded-2xl
               border border-slate-200
               bg-white p-2
               shadow-xl shadow-slate-200/60">

                        {{-- USER INFO --}}
                        <div class="px-3 py-3">

                            <p class="truncate text-sm
                       font-semibold text-slate-900">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="mt-1 truncate
                       text-xs text-slate-400">
                                {{ auth()->user()->email }}
                            </p>

                        </div>


                        <div class="my-1 border-t border-slate-100"></div>


                        {{-- PROFILE --}}
                        <a href="{{ route('buyer.profile.index') }}"
                            class="flex items-center gap-3
                   rounded-xl px-3 py-2.5
                   text-sm font-medium
                   text-slate-600 transition
                   hover:bg-violet-50
                   hover:text-violet-700">

                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <circle cx="12" cy="8" r="4" />

                                <path d="M4 21a8 8 0 0 1
                       16 0" />
                            </svg>

                            Profile

                        </a>


                        {{-- LOGOUT --}}
                        <form action="{{ route('logout') }}" method="POST">

                            @csrf

                            <button type="submit"
                                class="flex w-full
                       items-center gap-3
                       rounded-xl px-3 py-2.5
                       text-left text-sm
                       font-medium text-red-500
                       transition
                       hover:bg-red-50
                       hover:text-red-600">

                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path d="M10 17l5-5-5-5" />

                                    <path d="M15 12H3" />

                                    <path d="M14 3h5
                           a2 2 0 0 1 2 2
                           v14
                           a2 2 0 0 1-2 2
                           h-5" />
                                </svg>

                                Logout

                            </button>

                        </form>

                    </div>

                </details>

            </div>

        </div>

    </header>


    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>


    {{-- FOOTER --}}
    <footer class="mt-16 border-t border-slate-200
               bg-white">

        <div
            class="mx-auto max-w-7xl px-4 py-8
                   text-center text-sm text-slate-500
                   sm:px-6 lg:px-8">
            © {{ date('Y') }} KampusMart.
            Marketplace mahasiswa.
        </div>

    </footer>

</body>

</html>
