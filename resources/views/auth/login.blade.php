<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Masuk - KampusMart</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>


<body
    class="min-h-screen
           bg-gradient-to-br
           from-[#FBF8F5]
           via-[#FAF5F1]
           to-[#F4EAE2]
           text-slate-900
           antialiased">


    <main class="flex min-h-screen">


        {{-- ========================================================= --}}
        {{-- LEFT SECTION --}}
        {{-- ========================================================= --}}

        <section
            class="relative
                   hidden
                   overflow-hidden
                   bg-gradient-to-br
                   from-[#0a1d45]
                   via-[#4371d1]
                   to-[#4371d1]
                   p-12
                   text-white
                   lg:flex
                   lg:w-1/2">


            {{-- DECORATION --}}

            <div
                class="pointer-events-none
                       absolute
                       -left-24
                       -top-24
                       size-80
                       rounded-full
                       bg-[#E3B66D]/15
                       blur-3xl">
            </div>


            <div
                class="pointer-events-none
                       absolute
                       -bottom-24
                       -right-20
                       size-80
                       rounded-full
                       bg-[#C8795A]/20
                       blur-3xl">
            </div>


            <div
                class="pointer-events-none
                       absolute
                       right-16
                       top-1/3
                       size-52
                       rounded-full
                       bg-[#B97972]/10
                       blur-3xl">
            </div>



            <div
                class="relative
                       z-10
                       flex
                       w-full
                       flex-col
                       justify-between">


                {{-- LOGO --}}

                <a href="{{ route('home') }}"
                    class="inline-flex
                           w-fit
                           items-center
                           gap-3">


                    <div
                        class="flex
                               size-11
                               items-center
                               justify-center
                               rounded-xl
                               bg-white
                               text-lg
                               font-black
                               text-[#4371d1]
                               shadow-lg
                               shadow-black/10">

                        K

                    </div>


                    <span
                        class="text-2xl
                               font-black
                               tracking-tight">

                        KampusMart

                    </span>

                </a>



                {{-- MAIN CONTENT --}}

                <div class="max-w-xl">


                    <span
                        class="inline-flex
                               items-center
                               gap-2
                               rounded-full
                               border
                               border-white/15
                               bg-white/10
                               px-4
                               py-2
                               text-sm
                               font-medium
                               backdrop-blur">


                        <span
                            class="flex
                                   size-6
                                   items-center
                                   justify-center
                                   rounded-full
                                   bg-[#E3B66D]
                                   text-[#0a1d45]">

                            <i
                                class="fa-solid
                                       fa-bag-shopping
                                       text-[10px]">
                            </i>

                        </span>

                        Marketplace Mahasiswa

                    </span>



                    <h1
                        class="mt-6
                               text-4xl
                               font-black
                               leading-tight
                               tracking-tight
                               xl:text-5xl">

                        Satu platform untuk

                        <span
                            class="block
                                   bg-gradient-to-r
                                   from-[#F6D9A7]
                                   via-white
                                   to-[#F4C7B6]
                                   bg-clip-text
                                   text-transparent">

                            kebutuhan jual beli
                            di lingkungan kampus.

                        </span>

                    </h1>



                    <p
                        class="mt-6
                               max-w-lg
                               text-base
                               leading-7
                               text-[#F2E5DC]">

                        Temukan berbagai produk, kelola toko,
                        dan hubungkan pembeli dengan penjual
                        secara lebih praktis melalui KampusMart.

                    </p>



                    {{-- BENEFITS --}}

                    <div
                        class="mt-8
                               grid
                               grid-cols-3
                               gap-3">


                        <div
                            class="rounded-2xl
                                   border
                                   border-white/10
                                   bg-white/10
                                   p-4
                                   backdrop-blur">

                            <div
                                class="flex
                                       size-9
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-[#E3B66D]/20
                                       text-[#F5D59F]">

                                <i class="fa-solid
                                           fa-bag-shopping">
                                </i>

                            </div>

                            <p
                                class="mt-3
                                       text-xs
                                       font-semibold">

                                Belanja Praktis

                            </p>

                        </div>



                        <div
                            class="rounded-2xl
                                   border
                                   border-white/10
                                   bg-white/10
                                   p-4
                                   backdrop-blur">

                            <div
                                class="flex
                                       size-9
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-[#9FB293]/20
                                       text-[#DCE9D5]">

                                <i class="fa-solid
                                           fa-shield-halved">
                                </i>

                            </div>

                            <p
                                class="mt-3
                                       text-xs
                                       font-semibold">

                                Lebih Aman

                            </p>

                        </div>



                        <div
                            class="rounded-2xl
                                   border
                                   border-white/10
                                   bg-white/10
                                   p-4
                                   backdrop-blur">

                            <div
                                class="flex
                                       size-9
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-[#D99576]/20
                                       text-[#F5CDBA]">

                                <i class="fa-solid
                                           fa-store">
                                </i>

                            </div>

                            <p
                                class="mt-3
                                       text-xs
                                       font-semibold">

                                Seller Pilihan

                            </p>

                        </div>

                    </div>

                </div>



                {{-- COPYRIGHT --}}

                <p class="text-sm
                           text-[#E8D4C6]">

                    © {{ date('Y') }} KampusMart

                </p>

            </div>

        </section>



        {{-- ========================================================= --}}
        {{-- RIGHT SECTION --}}
        {{-- ========================================================= --}}

        <section
            class="relative
                   flex
                   w-full
                   items-center
                   justify-center
                   overflow-hidden
                   px-5
                   py-10
                   sm:px-6
                   lg:w-1/2
                   lg:px-12">


            {{-- BACKGROUND DECORATION --}}

            <div
                class="pointer-events-none
                       absolute
                       -right-28
                       -top-28
                       size-72
                       rounded-full
                       bg-[#C89B55]/10
                       blur-3xl">
            </div>


            <div
                class="pointer-events-none
                       absolute
                       -bottom-24
                       -left-24
                       size-72
                       rounded-full
                       bg-[#C8795A]/10
                       blur-3xl">
            </div>



            <div
                class="relative
                       z-10
                       w-full
                       max-w-md">


                {{-- ================================================= --}}
                {{-- MOBILE LOGO --}}
                {{-- ================================================= --}}

                <div class="mb-9
                           lg:hidden">


                    <a href="{{ route('home') }}"
                        class="inline-flex
                               items-center
                               gap-3">


                        <div
                            class="flex
                                   size-10
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-gradient-to-br
                                   from-[#0a1d45]
                                   via-[#4371d1]
                                   to-[#9A6948]
                                   font-black
                                   text-white
                                   shadow-lg
                                   shadow-[#4371d1]/20">

                            K

                        </div>


                        <span
                            class="bg-gradient-to-r
                                   from-[#0a1d45]
                                   to-[#4371d1]
                                   bg-clip-text
                                   text-xl
                                   font-black
                                   text-transparent">

                            KampusMart

                        </span>

                    </a>

                </div>



                {{-- ================================================= --}}
                {{-- CARD --}}
                {{-- ================================================= --}}

                <div
                    class="rounded-3xl
                           border
                           border-[#E8DAD0]
                           bg-white/90
                           p-5
                           shadow-xl
                           shadow-[#4371d1]/5
                           backdrop-blur
                           sm:p-7
                           lg:border-0
                           lg:bg-transparent
                           lg:p-0
                           lg:shadow-none">


                    {{-- TITLE --}}

                    <div class="mb-8">




                        <p
                            class="mb-2
                                   text-sm
                                   font-bold
                                   text-[#4371d1]">

                            Selamat datang

                        </p>


                        <h2
                            class="text-3xl
                                   font-black
                                   tracking-tight
                                   text-slate-900">

                            Masuk ke KampusMart

                        </h2>


                        <p
                            class="mt-3
                                   text-sm
                                   leading-6
                                   text-slate-500">

                            Masukkan email dan password
                            untuk melanjutkan ke akunmu.

                        </p>

                    </div>



                    {{-- ================================================= --}}
                    {{-- ERROR --}}
                    {{-- ================================================= --}}

                    @if ($errors->any())
                        <div
                            class="mb-6
                                   flex
                                   items-start
                                   gap-3
                                   rounded-2xl
                                   border
                                   border-[#E9C9C5]
                                   bg-[#FAEDEC]
                                   px-4
                                   py-3
                                   text-sm
                                   text-[#9D504B]">


                            <div
                                class="flex
                                       size-8
                                       shrink-0
                                       items-center
                                       justify-center
                                       rounded-lg
                                       bg-[#F4D8D5]">

                                <i class="fa-solid
                                           fa-circle-exclamation">
                                </i>

                            </div>


                            <div>

                                <p class="font-semibold">
                                    Gagal masuk
                                </p>

                                <p class="mt-1 text-xs">
                                    {{ $errors->first() }}
                                </p>

                            </div>

                        </div>
                    @endif



                    {{-- ================================================= --}}
                    {{-- FORM --}}
                    {{-- ================================================= --}}

                    <form action="{{ route('login.process') }}" method="POST" class="space-y-5">

                        @csrf



                        {{-- EMAIL --}}

                        <div>

                            <label for="email"
                                class="mb-2
                                       block
                                       text-sm
                                       font-semibold
                                       text-slate-700">

                                Email

                            </label>


                            <div class="relative">

                                <div
                                    class="pointer-events-none
                                           absolute
                                           inset-y-0
                                           left-0
                                           flex
                                           w-12
                                           items-center
                                           justify-center
                                           text-[#A68A77]">

                                    <i
                                        class="fa-regular
                                               fa-envelope
                                               text-sm">
                                    </i>

                                </div>


                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="nama@email.com" autocomplete="email" required autofocus
                                    class="h-12
                                           w-full
                                           rounded-xl
                                           border
                                           border-[#E5D5C9]
                                           bg-white
                                           pl-12
                                           pr-4
                                           text-sm
                                           outline-none
                                           transition
                                           placeholder:text-slate-400
                                           focus:border-[#A97957]
                                           focus:ring-4
                                           focus:ring-[#F5E9DF]">

                            </div>

                        </div>



                        {{-- PASSWORD --}}

                        <div x-data="{
                            showPassword: false
                        }">

                            <label for="password"
                                class="mb-2
                                       block
                                       text-sm
                                       font-semibold
                                       text-slate-700">

                                Password

                            </label>


                            <div class="relative">


                                <div
                                    class="pointer-events-none
                                           absolute
                                           inset-y-0
                                           left-0
                                           flex
                                           w-12
                                           items-center
                                           justify-center
                                           text-[#A68A77]">

                                    <i
                                        class="fa-solid
                                               fa-lock
                                               text-sm">
                                    </i>

                                </div>


                                <input
                                    :type="showPassword
                                        ?
                                        'text' :
                                        'password'"
                                    id="password" name="password" placeholder="Masukkan password"
                                    autocomplete="current-password" required
                                    class="h-12
                                           w-full
                                           rounded-xl
                                           border
                                           border-[#E5D5C9]
                                           bg-white
                                           pl-12
                                           pr-12
                                           text-sm
                                           outline-none
                                           transition
                                           placeholder:text-slate-400
                                           focus:border-[#A97957]
                                           focus:ring-4
                                           focus:ring-[#F5E9DF]">


                                <button type="button"
                                    @click="
                                        showPassword =
                                            !showPassword
                                    "
                                    class="absolute
                                           inset-y-0
                                           right-0
                                           flex
                                           w-12
                                           items-center
                                           justify-center
                                           text-slate-400
                                           transition
                                           hover:text-[#4371d1]">

                                    <i class="fa-regular"
                                        :class="showPassword
                                            ?
                                            'fa-eye-slash' :
                                            'fa-eye'">
                                    </i>

                                </button>

                            </div>

                        </div>



                        {{-- ================================================= --}}
                        {{-- REMEMBER --}}
                        {{-- ================================================= --}}

                        <div
                            class="flex
                                   items-center
                                   justify-between
                                   gap-4">


                            <label
                                class="flex
                                       cursor-pointer
                                       items-center
                                       gap-2
                                       text-sm
                                       text-slate-600">


                                <input type="checkbox" name="remember" value="1"
                                    class="size-4
                                           rounded
                                           border-[#D8C6B8]
                                           text-[#4371d1]
                                           focus:ring-[#A97957]">


                                Ingat saya

                            </label>

                        </div>



                        {{-- ================================================= --}}
                        {{-- SUBMIT --}}
                        {{-- ================================================= --}}

                        <button type="submit"
                            class="group
                                   flex
                                   h-12
                                   w-full
                                   items-center
                                   justify-center
                                   gap-2
                                   rounded-xl
                                   bg-gradient-to-r
                                   from-[#0a1d45]
                                   via-[#4371d1]
                                   to-[#4371d1]
                                   px-5
                                   text-sm
                                   font-bold
                                   text-white
                                   shadow-lg
                                   shadow-[#4371d1]/20
                                   transition
                                   duration-300
                                   hover:-translate-y-0.5
                                   hover:shadow-xl
                                   focus:outline-none
                                   focus:ring-4
                                   focus:ring-[#EAD9CD]">

                            Masuk

                            <i
                                class="fa-solid
                                       fa-arrow-right
                                       text-xs
                                       transition
                                       group-hover:translate-x-1">
                            </i>

                        </button>

                    </form>


  {{-- LOGIN LINK --}}

                    <div
                        class="mt-7
                               border-t
                               border-[#E9DCD2]
                               pt-6">


                        <p
                            class="text-center
                                   text-sm
                                   text-slate-500">

                            Belum memiliki akun?

                            <a href="{{ route('register') }}"
                                class="ml-1
                                       font-bold
                                       text-[#4371d1]
                                       transition
                                       hover:text-[#4371d1]">

                                Daftar

                            </a>

                        </p>

                    </div>
                    {{-- ================================================= --}}
                    {{-- BACK HOME --}}
                    {{-- ================================================= --}}

                    <div class="mt-6
                               text-center">

                        <a href="{{ route('home') }}"
                            class="inline-flex
                                   items-center
                                   gap-2
                                   text-sm
                                   font-semibold
                                   text-[#4371d1]
                                   transition
                                   hover:text-[#0a1d45]">

                            <i
                                class="fa-solid
                                       fa-arrow-left
                                       text-xs">
                            </i>

                            Kembali ke halaman utama

                        </a>

                    </div>



                    {{-- ================================================= --}}
                    {{-- INFORMATION --}}
                    {{-- ================================================= --}}

                    <div
                        class="mt-8
                               border-t
                               border-[#E9DCD2]
                               pt-6">


                        <div
                            class="flex
                                   gap-3
                                   rounded-2xl
                                   border
                                   border-[#D9E2D4]
                                   bg-gradient-to-br
                                   from-[#F1F5ED]
                                   to-[#E7EFE3]
                                   p-4">


                            <div
                                class="flex
                                       size-9
                                       shrink-0
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-[#7F9275]
                                       text-white">

                                <i
                                    class="fa-solid
                                           fa-circle-info
                                           text-sm">
                                </i>

                            </div>


                            <p
                                class="text-xs
                                       leading-5
                                       text-slate-600">

                                Akun penjual hanya dapat dibuat
                                oleh Super Admin KampusMart.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

</body>

</html>
