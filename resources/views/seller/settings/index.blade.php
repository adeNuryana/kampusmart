@extends('layouts.seller')

@section('title', 'Pengaturan')

@section('content')

<div class="mx-auto max-w-6xl">

    {{-- HEADER --}}
    <div class="mb-7">

        <p class="text-sm font-semibold text-violet-600">
            Seller Center
        </p>

        <h1
            class="mt-1 text-2xl font-bold
                   tracking-tight text-slate-900
                   lg:text-3xl"
        >
            Pengaturan
        </h1>

        <p class="mt-2 text-sm text-slate-500">
            Kelola informasi akun, toko, dan keamanan seller.
        </p>

    </div>


    <div class="grid gap-6 lg:grid-cols-3">

        {{-- =========================
            PROFILE CARD
        ========================== --}}
        <div>

            <div
                class="rounded-2xl border
                       border-slate-200
                       bg-white p-6 shadow-sm"
            >

                {{-- PHOTO --}}
                @if ($seller->sellerProfile?->photo)

                    <img
                        src="{{ asset(
                            'storage/' .
                            $seller->sellerProfile->photo
                        ) }}"
                        alt="{{ $seller->name }}"
                        class="mx-auto size-24
                               rounded-full
                               border border-slate-200
                               object-cover"
                    >

                @else

                    <div
                        class="mx-auto flex size-24
                               items-center justify-center
                               rounded-full bg-violet-100
                               text-3xl font-bold
                               text-violet-700"
                    >
                        {{ strtoupper(
                            substr(
                                $seller->name,
                                0,
                                1
                            )
                        ) }}
                    </div>

                @endif


                <div class="mt-5 text-center">

                    <h2 class="text-lg font-bold text-slate-900">
                        {{ $seller->name }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        {{
                            $seller->sellerProfile?->store_name
                            ?? 'Belum ada nama toko'
                        }}
                    </p>


                    <span
                        class="mt-4 inline-flex
                               rounded-full
                               bg-violet-50
                               px-3 py-1.5
                               text-xs font-semibold
                               text-violet-700"
                    >
                        Seller
                    </span>

                </div>


                <div
                    class="mt-6 border-t
                           border-slate-100 pt-5"
                >

                    <div
                        class="flex items-center
                               justify-between gap-4"
                    >

                        <span class="text-sm text-slate-500">
                            Status
                        </span>


                        @if ($seller->status === 'active')

                            <span
                                class="text-sm font-semibold
                                       text-green-600"
                            >
                                Aktif
                            </span>

                        @else

                            <span
                                class="text-sm font-semibold
                                       text-red-600"
                            >
                                Nonaktif
                            </span>

                        @endif

                    </div>


                    <div
                        class="mt-4 flex items-center
                               justify-between gap-4"
                    >

                        <span class="text-sm text-slate-500">
                            Bergabung
                        </span>

                        <span
                            class="text-sm font-medium
                                   text-slate-700"
                        >
                            {{ $seller->created_at->format('d M Y') }}
                        </span>

                    </div>


                    <div
                        class="mt-4 flex items-center
                               justify-between gap-4"
                    >

                        <span class="text-sm text-slate-500">
                            NIM
                        </span>

                        <span
                            class="text-sm font-medium
                                   text-slate-700"
                        >
                            {{ $seller->sellerProfile?->nim ?? '-' }}
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
            RIGHT
        ========================== --}}
        <div class="space-y-6 lg:col-span-2">

            {{-- PROFILE --}}
            <div
                class="rounded-2xl border
                       border-slate-200
                       bg-white shadow-sm"
            >

                <div
                    class="border-b border-slate-100
                           px-6 py-5"
                >

                    <h2 class="font-semibold text-slate-900">
                        Informasi Seller & Toko
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Informasi ini akan ditampilkan pada produk dan profil toko.
                    </p>

                </div>


                <div class="p-6">

                    @if (session('profile_success'))

                        <div
                            class="mb-5 rounded-xl
                                   border border-green-200
                                   bg-green-50 px-4 py-3
                                   text-sm text-green-700"
                        >
                            {{ session('profile_success') }}
                        </div>

                    @endif


                    <form
                        action="{{ route(
                            'seller.settings.profile'
                        ) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf
                        @method('PUT')


                        <div class="grid gap-5 sm:grid-cols-2">

                            {{-- NAME --}}
                            <div>

                                <label
                                    for="name"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    Nama Lengkap
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ old(
                                        'name',
                                        $seller->name
                                    ) }}"
                                    class="h-11 w-full
                                           rounded-xl border
                                           border-slate-200
                                           px-4 text-sm
                                           outline-none
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >

                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- STORE NAME --}}
                            <div>

                                <label
                                    for="store_name"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    Nama Toko
                                </label>

                                <input
                                    type="text"
                                    name="store_name"
                                    id="store_name"
                                    value="{{ old(
                                        'store_name',
                                        $seller->sellerProfile?->store_name
                                    ) }}"
                                    placeholder="Nama toko"
                                    class="h-11 w-full
                                           rounded-xl border
                                           border-slate-200
                                           px-4 text-sm
                                           outline-none
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >

                                @error('store_name')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- EMAIL --}}
                            <div>

                                <label
                                    for="email"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old(
                                        'email',
                                        $seller->email
                                    ) }}"
                                    class="h-11 w-full
                                           rounded-xl border
                                           border-slate-200
                                           px-4 text-sm
                                           outline-none
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >

                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- PHONE --}}
                            <div>

                                <label
                                    for="phone"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    Nomor Telepon
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    id="phone"
                                    value="{{ old(
                                        'phone',
                                        $seller->phone
                                    ) }}"
                                    placeholder="081234567890"
                                    class="h-11 w-full
                                           rounded-xl border
                                           border-slate-200
                                           px-4 text-sm
                                           outline-none
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >

                                @error('phone')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- WHATSAPP --}}
                            <div>

                                <label
                                    for="whatsapp"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    WhatsApp
                                </label>

                                <input
                                    type="text"
                                    name="whatsapp"
                                    id="whatsapp"
                                    value="{{ old(
                                        'whatsapp',
                                        $seller->sellerProfile?->whatsapp
                                    ) }}"
                                    placeholder="6281234567890"
                                    class="h-11 w-full
                                           rounded-xl border
                                           border-slate-200
                                           px-4 text-sm
                                           outline-none
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >

                                @error('whatsapp')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- NIM --}}
                            <div>

                                <label
                                    for="nim"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    NIM
                                </label>

                                <input
                                    type="text"
                                    name="nim"
                                    id="nim"
                                    value="{{ old(
                                        'nim',
                                        $seller->sellerProfile?->nim
                                    ) }}"
                                    class="h-11 w-full
                                           rounded-xl border
                                           border-slate-200
                                           px-4 text-sm
                                           outline-none
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >

                                @error('nim')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- FACULTY --}}
                            <div class="sm:col-span-2">

                                <label
                                    for="faculty"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    Fakultas
                                </label>

                                <input
                                    type="text"
                                    name="faculty"
                                    id="faculty"
                                    value="{{ old(
                                        'faculty',
                                        $seller->sellerProfile?->faculty
                                    ) }}"
                                    placeholder="Contoh: Fakultas Teknik"
                                    class="h-11 w-full
                                           rounded-xl border
                                           border-slate-200
                                           px-4 text-sm
                                           outline-none
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >

                                @error('faculty')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- DESCRIPTION --}}
                            <div class="sm:col-span-2">

                                <label
                                    for="description"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    Deskripsi Toko
                                </label>

                                <textarea
                                    name="description"
                                    id="description"
                                    rows="5"
                                    placeholder="Ceritakan tentang toko kamu..."
                                    class="w-full rounded-xl
                                           border border-slate-200
                                           px-4 py-3 text-sm
                                           outline-none
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >{{ old(
                                    'description',
                                    $seller->sellerProfile?->description
                                ) }}</textarea>

                                @error('description')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- PHOTO --}}
                            <div class="sm:col-span-2">

                                <label
                                    for="photo"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    Foto Seller
                                </label>


                                <div
                                    class="flex flex-col gap-4
                                           sm:flex-row
                                           sm:items-center"
                                >

                                    <div
                                        class="flex size-20
                                               shrink-0 items-center
                                               justify-center
                                               overflow-hidden
                                               rounded-full
                                               bg-slate-100"
                                    >

                                        @if ($seller->sellerProfile?->photo)

                                            <img
                                                id="photoPreview"
                                                src="{{ asset(
                                                    'storage/' .
                                                    $seller
                                                        ->sellerProfile
                                                        ->photo
                                                ) }}"
                                                alt="{{ $seller->name }}"
                                                class="h-full w-full
                                                       object-cover"
                                            >

                                        @else

                                            <img
                                                id="photoPreview"
                                                class="hidden h-full
                                                       w-full object-cover"
                                            >

                                            <span
                                                id="photoPlaceholder"
                                                class="text-xl
                                                       font-bold
                                                       text-slate-400"
                                            >
                                                {{ strtoupper(
                                                    substr(
                                                        $seller->name,
                                                        0,
                                                        1
                                                    )
                                                ) }}
                                            </span>

                                        @endif

                                    </div>


                                    <div class="flex-1">

                                        <input
                                            type="file"
                                            name="photo"
                                            id="photo"
                                            accept="image/jpeg,image/png,image/webp"
                                            class="block w-full
                                                   rounded-xl border
                                                   border-slate-200
                                                   bg-white px-3 py-2
                                                   text-sm
                                                   text-slate-600"
                                        >

                                        <p
                                            class="mt-2 text-xs
                                                   text-slate-400"
                                        >
                                            JPG, PNG atau WebP.
                                            Maksimal 2 MB.
                                        </p>

                                    </div>

                                </div>


                                @error('photo')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>


                        <div class="mt-6 flex justify-end">

                            <button
                                type="submit"
                                class="inline-flex h-11
                                       items-center justify-center
                                       rounded-xl bg-violet-600
                                       px-5 text-sm font-semibold
                                       text-white transition
                                       hover:bg-violet-700"
                            >
                                Simpan Perubahan
                            </button>

                        </div>

                    </form>

                </div>

            </div>


            {{-- PASSWORD --}}
            <div
                class="rounded-2xl border
                       border-slate-200
                       bg-white shadow-sm"
            >

                <div
                    class="border-b border-slate-100
                           px-6 py-5"
                >

                    <h2 class="font-semibold text-slate-900">
                        Keamanan Akun
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Ubah password akun seller.
                    </p>

                </div>


                <div class="p-6">

                    @if (session('password_success'))

                        <div
                            class="mb-5 rounded-xl
                                   border border-green-200
                                   bg-green-50 px-4 py-3
                                   text-sm text-green-700"
                        >
                            {{ session('password_success') }}
                        </div>

                    @endif


                    <form
                        action="{{ route(
                            'seller.settings.password'
                        ) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')


                        <div class="space-y-5">

                            {{-- CURRENT --}}
                            <div>

                                <label
                                    for="current_password"
                                    class="mb-2 block
                                           text-sm font-medium
                                           text-slate-700"
                                >
                                    Password Saat Ini
                                </label>

                                <input
                                    type="password"
                                    name="current_password"
                                    id="current_password"
                                    autocomplete="current-password"
                                    class="h-11 w-full
                                           rounded-xl border
                                           border-slate-200
                                           px-4 text-sm
                                           outline-none
                                           focus:border-violet-400
                                           focus:ring-4
                                           focus:ring-violet-100"
                                >

                                @error(
                                    'current_password',
                                    'updatePassword'
                                )
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            <div class="grid gap-5 sm:grid-cols-2">

                                {{-- NEW --}}
                                <div>

                                    <label
                                        for="password"
                                        class="mb-2 block
                                               text-sm font-medium
                                               text-slate-700"
                                    >
                                        Password Baru
                                    </label>

                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        autocomplete="new-password"
                                        class="h-11 w-full
                                               rounded-xl border
                                               border-slate-200
                                               px-4 text-sm
                                               outline-none
                                               focus:border-violet-400
                                               focus:ring-4
                                               focus:ring-violet-100"
                                    >

                                    @error(
                                        'password',
                                        'updatePassword'
                                    )
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- CONFIRM --}}
                                <div>

                                    <label
                                        for="password_confirmation"
                                        class="mb-2 block
                                               text-sm font-medium
                                               text-slate-700"
                                    >
                                        Konfirmasi Password
                                    </label>

                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        autocomplete="new-password"
                                        class="h-11 w-full
                                               rounded-xl border
                                               border-slate-200
                                               px-4 text-sm
                                               outline-none
                                               focus:border-violet-400
                                               focus:ring-4
                                               focus:ring-violet-100"
                                    >

                                </div>

                            </div>

                        </div>


                        <div class="mt-6 flex justify-end">

                            <button
                                type="submit"
                                class="inline-flex h-11
                                       items-center justify-center
                                       rounded-xl bg-slate-900
                                       px-5 text-sm font-semibold
                                       text-white transition
                                       hover:bg-slate-800"
                            >
                                Ubah Password
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>
    const photoInput =
        document.getElementById('photo');

    const photoPreview =
        document.getElementById('photoPreview');

    const photoPlaceholder =
        document.getElementById('photoPlaceholder');


    photoInput?.addEventListener(
        'change',
        function (event) {

            const file = event.target.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                photoPreview.src =
                    event.target.result;

                photoPreview.classList.remove(
                    'hidden'
                );

                photoPlaceholder?.classList.add(
                    'hidden'
                );
            };

            reader.readAsDataURL(file);
        }
    );
</script>

@endpush
