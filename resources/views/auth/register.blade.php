<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar - KampusMart</title>

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
                   from-[#38251C]
                   via-[#6F4E37]
                   to-[#A66D4B]
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
                               text-[#6F4E37]
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



                {{-- CONTENT --}}

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
                                   text-[#493124]">

                            <i
                                class="fa-solid
                                       fa-user-plus
                                       text-[10px]">
                            </i>

                        </span>

                        Daftar Sebagai Pembeli

                    </span>


                    <h1
                        class="mt-6
                               text-4xl
                               font-black
                               leading-tight
                               tracking-tight
                               xl:text-5xl">

                        Mulai belanja lebih

                        <span
                            class="block
                                   bg-gradient-to-r
                                   from-[#F6D9A7]
                                   via-white
                                   to-[#F4C7B6]
                                   bg-clip-text
                                   text-transparent">

                            mudah di KampusMart.

                        </span>

                    </h1>


                    <p
                        class="mt-6
                               max-w-lg
                               text-base
                               leading-7
                               text-[#F2E5DC]">

                        Buat akun pembeli untuk menyimpan keranjang,
                        melakukan transaksi, dan melihat riwayat
                        pembelian dari berbagai seller KampusMart.

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

                                <i class="fa-solid fa-cart-shopping"></i>

                            </div>

                            <p
                                class="mt-3
                                       text-xs
                                       font-semibold">

                                Keranjang

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

                                <i class="fa-solid fa-shield-halved"></i>

                            </div>

                            <p
                                class="mt-3
                                       text-xs
                                       font-semibold">

                                Aman

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

                                <i class="fa-solid fa-receipt"></i>

                            </div>

                            <p
                                class="mt-3
                                       text-xs
                                       font-semibold">

                                Riwayat Order

                            </p>

                        </div>

                    </div>

                </div>



                <p class="text-sm text-[#E8D4C6]">
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


                {{-- MOBILE LOGO --}}

                <div class="mb-8 lg:hidden">

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
                                   from-[#493124]
                                   via-[#6F4E37]
                                   to-[#9A6948]
                                   font-black
                                   text-white
                                   shadow-lg
                                   shadow-[#6F4E37]/20">

                            K

                        </div>

                        <span
                            class="bg-gradient-to-r
                                   from-[#493124]
                                   to-[#8B6245]
                                   bg-clip-text
                                   text-xl
                                   font-black
                                   text-transparent">

                            KampusMart

                        </span>

                    </a>

                </div>



                <div
                    class="rounded-3xl
                           border
                           border-[#E8DAD0]
                           bg-white/90
                           p-5
                           shadow-xl
                           shadow-[#6F4E37]/5
                           backdrop-blur
                           sm:p-7
                           lg:border-0
                           lg:bg-transparent
                           lg:p-0
                           lg:shadow-none">


                    {{-- TITLE --}}

                    <div class="mb-7">




                        <p
                            class="mb-2
                                   text-sm
                                   font-bold
                                   text-[#A66D4B]">

                            Buat akun baru

                        </p>


                        <h2
                            class="text-3xl
                                   font-black
                                   tracking-tight
                                   text-slate-900">

                            Daftar ke KampusMart

                        </h2>


                        <p
                            class="mt-3
                                   text-sm
                                   leading-6
                                   text-slate-500">

                            Lengkapi data berikut untuk membuat
                            akun pembeli.

                        </p>

                    </div>



                    {{-- ERROR --}}

                    @if ($errors->any())
                        <div
                            class="mb-6
                                   rounded-2xl
                                   border
                                   border-[#E9C9C5]
                                   bg-[#FAEDEC]
                                   px-4
                                   py-3
                                   text-sm
                                   text-[#9D504B]">

                            <div class="flex items-start gap-3">

                                <i
                                    class="fa-solid
                                           fa-circle-exclamation
                                           mt-0.5">
                                </i>

                                <div>

                                    <p class="font-semibold">
                                        Data belum valid
                                    </p>

                                    <p class="mt-1 text-xs">
                                        {{ $errors->first() }}
                                    </p>

                                </div>

                            </div>

                        </div>
                    @endif



                    {{-- FORM --}}

                    <form action="{{ route('register.process') }}" method="POST" class="space-y-5">

                        @csrf



                        {{-- NAME --}}

                        <div>

                            <label for="name"
                                class="mb-2
                                       block
                                       text-sm
                                       font-semibold
                                       text-slate-700">

                                Nama Lengkap

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

                                    <i class="fa-regular fa-user"></i>

                                </div>


                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    placeholder="Masukkan nama lengkap" autocomplete="name" required autofocus
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

                                    <i class="fa-regular fa-envelope"></i>

                                </div>


                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="nama@email.com" autocomplete="email" required
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


                        {{-- PHONE NUMBER --}}

                        <div>

                            <label for="phone"
                                class="mb-2
               block
               text-sm
               font-semibold
               text-slate-700">

                                Nomor HP

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

                                    <i class="fa-solid fa-phone"></i>

                                </div>


                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                    placeholder="Contoh: 081234567890" autocomplete="tel" inputmode="numeric" required
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

                                    <i class="fa-solid fa-lock"></i>

                                </div>


                                <input
                                    :type="showPassword
                                        ?
                                        'text' :
                                        'password'"
                                    id="password" name="password" placeholder="Minimal 8 karakter"
                                    autocomplete="new-password" required
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
                                           hover:text-[#6F4E37]">

                                    <i class="fa-regular"
                                        :class="showPassword
                                            ?
                                            'fa-eye-slash' :
                                            'fa-eye'">
                                    </i>

                                </button>

                            </div>

                        </div>



                        {{-- PASSWORD CONFIRMATION --}}

                        <div x-data="{
                            showConfirmation: false
                        }">

                            <label for="password_confirmation"
                                class="mb-2
                                       block
                                       text-sm
                                       font-semibold
                                       text-slate-700">

                                Konfirmasi Password

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

                                    <i class="fa-solid fa-shield-halved"></i>

                                </div>


                                <input
                                    :type="showConfirmation
                                        ?
                                        'text' :
                                        'password'"
                                    id="password_confirmation" name="password_confirmation"
                                    placeholder="Ulangi password" autocomplete="new-password" required
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
                                        showConfirmation =
                                            !showConfirmation
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
                                           hover:text-[#6F4E37]">

                                    <i class="fa-regular"
                                        :class="showConfirmation
                                            ?
                                            'fa-eye-slash' :
                                            'fa-eye'">
                                    </i>

                                </button>

                            </div>

                        </div>



                        {{-- SUBMIT --}}

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
                                   from-[#5B3B2B]
                                   via-[#6F4E37]
                                   to-[#8B6245]
                                   px-5
                                   text-sm
                                   font-bold
                                   text-white
                                   shadow-lg
                                   shadow-[#6F4E37]/20
                                   transition
                                   duration-300
                                   hover:-translate-y-0.5
                                   hover:shadow-xl
                                   focus:outline-none
                                   focus:ring-4
                                   focus:ring-[#EAD9CD]">

                            Buat Akun

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

                            Sudah memiliki akun?

                            <a href="{{ route('login') }}"
                                class="ml-1
                                       font-bold
                                       text-[#6F4E37]
                                       transition
                                       hover:text-[#A66D4B]">

                                Masuk

                            </a>

                        </p>

                    </div>



                    {{-- SELLER INFO --}}

                    <div
                        class="mt-5
                               flex
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

                            <i class="fa-solid fa-store"></i>

                        </div>


                        <div>

                            <p
                                class="text-xs
                                       font-semibold
                                       text-slate-700">

                                Ingin menjadi seller?

                            </p>

                            <p
                                class="mt-1
                                       text-xs
                                       leading-5
                                       text-slate-500">

                                Akun seller tidak dapat didaftarkan
                                melalui halaman ini. Akun seller dibuat
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
