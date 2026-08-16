<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Masuk - KampusMart</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900">

    <main class="flex min-h-screen">

        {{-- LEFT SECTION --}}
        <section
            class="hidden lg:flex lg:w-1/2
                   bg-gradient-to-br
                   from-violet-600
                   to-purple-800
                   p-12 text-white"
        >
            <div class="flex w-full flex-col justify-between">

                <a
                    href="/"
                    class="inline-flex items-center gap-3"
                >
                    <div
                        class="flex size-11 items-center
                               justify-center rounded-xl
                               bg-white text-lg font-bold
                               text-violet-600"
                    >
                        K
                    </div>

                    <span class="text-2xl font-bold">
                        KampusMart
                    </span>
                </a>


                <div class="max-w-xl">

                    <span
                        class="mb-5 inline-flex rounded-full
                               bg-white/10 px-4 py-2
                               text-sm font-medium
                               backdrop-blur"
                    >
                        Marketplace Mahasiswa
                    </span>

                    <h1
                        class="text-4xl font-bold
                               leading-tight xl:text-5xl"
                    >
                        Satu platform untuk kebutuhan
                        jual beli di lingkungan kampus.
                    </h1>

                    <p
                        class="mt-6 max-w-lg
                               text-base leading-7
                               text-violet-100"
                    >
                        Temukan produk dari mahasiswa,
                        kelola toko, dan hubungkan
                        pembeli dengan penjual secara
                        lebih mudah melalui KampusMart.
                    </p>

                </div>


                <p class="text-sm text-violet-200">
                    © {{ date('Y') }} KampusMart
                </p>

            </div>
        </section>


        {{-- RIGHT SECTION --}}
        <section
            class="flex w-full items-center
                   justify-center px-6 py-12
                   lg:w-1/2 lg:px-12"
        >

            <div class="w-full max-w-md">

                {{-- MOBILE LOGO --}}
                <div class="mb-10 lg:hidden">

                    <a
                        href="/"
                        class="inline-flex items-center gap-3"
                    >
                        <div
                            class="flex size-10 items-center
                                   justify-center rounded-xl
                                   bg-violet-600 font-bold
                                   text-white"
                        >
                            K
                        </div>

                        <span
                            class="text-xl font-bold
                                   text-violet-700"
                        >
                            KampusMart
                        </span>
                    </a>

                </div>


                <div class="mb-8">

                    <p
                        class="mb-2 text-sm font-semibold
                               text-violet-600"
                    >
                        Selamat datang
                    </p>

                    <h2
                        class="text-3xl font-bold
                               tracking-tight"
                    >
                        Masuk ke KampusMart
                    </h2>

                    <p
                        class="mt-3 text-sm
                               leading-6 text-slate-500"
                    >
                        Masukkan email dan password
                        untuk melanjutkan.
                    </p>

                </div>


                @if ($errors->any())

                    <div
                        class="mb-6 rounded-xl
                               border border-red-200
                               bg-red-50 px-4 py-3
                               text-sm text-red-700"
                    >
                        {{ $errors->first() }}
                    </div>

                @endif


                <form
                    action="{{ route('login.process') }}"
                    method="POST"
                    class="space-y-5"
                >

                    @csrf


                    {{-- EMAIL --}}
                    <div>

                        <label
                            for="email"
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-slate-700"
                        >
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            autocomplete="email"
                            required

                            class="h-12 w-full rounded-xl
                                   border border-slate-200
                                   bg-white px-4
                                   text-sm outline-none
                                   transition
                                   placeholder:text-slate-400
                                   focus:border-violet-500
                                   focus:ring-4
                                   focus:ring-violet-100"
                        >

                    </div>


                    {{-- PASSWORD --}}
                    <div>

                        <label
                            for="password"
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-slate-700"
                        >
                            Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required

                            class="h-12 w-full rounded-xl
                                   border border-slate-200
                                   bg-white px-4
                                   text-sm outline-none
                                   transition
                                   placeholder:text-slate-400
                                   focus:border-violet-500
                                   focus:ring-4
                                   focus:ring-violet-100"
                        >

                    </div>


                    {{-- REMEMBER --}}
                    <div
                        class="flex items-center
                               justify-between gap-4"
                    >

                        <label
                            class="flex cursor-pointer
                                   items-center gap-2
                                   text-sm text-slate-600"
                        >

                            <input
                                type="checkbox"
                                name="remember"
                                value="1"

                                class="size-4 rounded
                                       border-slate-300
                                       text-violet-600
                                       focus:ring-violet-500"
                            >

                            Ingat saya

                        </label>

                    </div>


                    {{-- BUTTON --}}
                    <button
                        type="submit"

                        class="flex h-12 w-full
                               items-center justify-center
                               rounded-xl bg-violet-600
                               px-5 text-sm font-semibold
                               text-white transition
                               hover:bg-violet-700
                               focus:outline-none
                               focus:ring-4
                               focus:ring-violet-200"
                    >
                        Masuk
                    </button>

                </form>


                <div
                    class="mt-8 border-t
                           border-slate-200 pt-6"
                >

                    <p
                        class="text-center text-sm
                               leading-6 text-slate-500"
                    >
                        Akun penjual hanya dapat
                        dibuat oleh Super Admin
                        KampusMart.
                    </p>

                </div>

            </div>

        </section>

    </main>

</body>
</html>
