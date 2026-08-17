@extends('layouts.admin')

@section('title', 'Edit Penjual')

@section('content')

    <div class="mx-auto max-w-5xl">

        {{-- HEADER --}}
        <div class="mb-7">

            <a href="{{ route('admin.sellers.index') }}"
                class="inline-flex items-center gap-2
                   text-sm font-medium
                   text-slate-500
                   transition
                   hover:text-violet-600">
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m15 18-6-6 6-6" />
                </svg>

                Kembali ke Penjual
            </a>


            <div
                class="mt-5 flex flex-col gap-3
                   sm:flex-row
                   sm:items-center
                   sm:justify-between">

                <div>

                    <h1
                        class="text-2xl font-bold
                           tracking-tight
                           text-slate-900
                           lg:text-3xl">
                        Edit Penjual
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Perbarui data akun dan informasi
                        toko penjual.
                    </p>

                </div>


                <span
                    class="inline-flex w-fit
                       rounded-full px-3 py-1.5
                       text-xs font-semibold
                       {{ $seller->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                    {{ $seller->status === 'active' ? 'Akun Aktif' : 'Akun Nonaktif' }}
                </span>

            </div>

        </div>


        {{-- GLOBAL ERROR --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl
                   border border-red-200
                   bg-red-50 p-4">

                <p class="text-sm font-semibold text-red-700">
                    Data belum dapat disimpan.
                </p>

                <p class="mt-1 text-sm text-red-600">
                    Periksa kembali form di bawah.
                </p>

            </div>
        @endif


        <form action="{{ route('admin.sellers.update', $seller) }}" method="POST" class="space-y-6"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')


            {{-- ========================================================= --}}
            {{-- INFORMASI AKUN --}}
            {{-- ========================================================= --}}

            <section
                class="overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white shadow-sm">

                <div class="border-b border-slate-200
                       px-6 py-5">
                    <h2 class="text-lg font-semibold">
                        Informasi Akun
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Informasi yang digunakan
                        penjual untuk mengakses KampusMart.
                    </p>
                </div>


                <div class="grid gap-5 p-6
                       md:grid-cols-2">

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                        <h2 class="text-base font-semibold text-slate-900">
                            Foto Penjual
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Gunakan foto profil yang jelas untuk identitas penjual.
                        </p>


                        <div class="mt-6 flex flex-col gap-5 sm:flex-row sm:items-center">

                            {{-- Preview --}}
                            <div>

                                @if ($seller->sellerProfile?->photo)
                                    <img id="photoPreview" src="{{ asset('storage/' . $seller->sellerProfile->photo) }}"
                                        alt="{{ $seller->name }}"
                                        class="size-24 rounded-2xl border
                           border-slate-200 object-cover">
                                @else
                                    <div id="photoPlaceholder"
                                        class="flex size-24 items-center justify-center
                           rounded-2xl bg-violet-100
                           text-2xl font-bold text-violet-700">
                                        {{ strtoupper(substr($seller->name, 0, 1)) }}
                                    </div>

                                    <img id="photoPreview" src="" alt="Preview"
                                        class="hidden size-24 rounded-2xl
                           border border-slate-200 object-cover">
                                @endif

                            </div>


                            <div class="flex-1">

                                <label for="photo" class="mb-2 block text-sm font-medium text-slate-700">
                                    Ganti Foto
                                </label>

                                <input type="file" name="photo" id="photo" accept="image/jpeg,image/png,image/webp"
                                    class="block w-full rounded-xl
                       border border-slate-200
                       bg-white px-4 py-3 text-sm
                       text-slate-600
                       file:mr-4 file:rounded-lg
                       file:border-0 file:bg-violet-50
                       file:px-4 file:py-2
                       file:text-sm file:font-semibold
                       file:text-violet-700
                       hover:file:bg-violet-100">

                                <p class="mt-2 text-xs text-slate-400">
                                    Kosongkan jika tidak ingin mengganti foto. JPG, PNG, atau WEBP maksimal 2 MB.
                                </p>

                                @error('photo')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>

                    {{-- NAMA --}}
                    <div>

                        <label for="name"
                            class="mb-2 block
                               text-sm font-medium
                               text-slate-700">
                            Nama Penjual
                            <span class="text-red-500">*</span>
                        </label>

                        <input id="name" type="text" name="name"
                            value="{{ old('name', $seller->name) }}"
                            required
                            class="h-12 w-full rounded-xl
                               border
                               {{ $errors->has('name') ? 'border-red-300' : 'border-slate-200' }}
                               bg-white px-4
                               text-sm outline-none
                               transition
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100">

                        @error('name')
                            <p class="mt-2 text-xs
                                   text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- NIM --}}
                    <div>

                        <label for="nim"
                            class="mb-2 block
                               text-sm font-medium
                               text-slate-700">
                            NIM
                        </label>

                        <input id="nim" type="text" name="nim"
                            value="{{ old('nim', $seller->sellerProfile?->nim) }}"
                            placeholder="Contoh: 230001234"
                            class="h-12 w-full rounded-xl
                               border border-slate-200
                               bg-white px-4
                               text-sm outline-none
                               transition
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100">

                        @error('nim')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- EMAIL --}}
                    <div>

                        <label for="email"
                            class="mb-2 block
                               text-sm font-medium
                               text-slate-700">
                            Email
                            <span class="text-red-500">*</span>
                        </label>

                        <input id="email" type="email" name="email"
                            value="{{ old('email', $seller->email) }}"
                            required
                            class="h-12 w-full rounded-xl
                               border
                               {{ $errors->has('email') ? 'border-red-300' : 'border-slate-200' }}
                               bg-white px-4
                               text-sm outline-none
                               transition
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100">

                        @error('email')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- PHONE --}}
                    <div>

                        <label for="phone"
                            class="mb-2 block
                               text-sm font-medium
                               text-slate-700">
                            Nomor HP
                        </label>

                        <input id="phone" type="text" name="phone"
                            value="{{ old('phone', $seller->phone) }}"
                            placeholder="08xxxxxxxxxx"
                            class="h-12 w-full rounded-xl
                               border border-slate-200
                               bg-white px-4
                               text-sm outline-none
                               transition
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100">

                        @error('phone')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- STATUS --}}
                    <div class="md:col-span-2">

                        <label for="status"
                            class="mb-2 block
                               text-sm font-medium
                               text-slate-700">
                            Status Akun
                        </label>

                        <select id="status" name="status"
                            class="h-12 w-full rounded-xl
                               border border-slate-200
                               bg-white px-4
                               text-sm outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100
                               md:max-w-sm">

                            <option value="active" @selected(old('status', $seller->status) === 'active')>
                                Aktif
                            </option>

                            <option value="inactive" @selected(old('status', $seller->status) === 'inactive')>
                                Nonaktif
                            </option>

                        </select>


                        <p class="mt-2 text-xs
                               text-slate-500">
                            Penjual dengan status nonaktif
                            tidak dapat masuk ke sistem.
                        </p>

                    </div>

                </div>

            </section>



            {{-- ========================================================= --}}
            {{-- INFORMASI TOKO --}}
            {{-- ========================================================= --}}

            <section
                class="overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white shadow-sm">

                <div class="border-b border-slate-200
                       px-6 py-5">

                    <h2 class="text-lg font-semibold">
                        Informasi Toko
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Informasi toko yang akan
                        ditampilkan kepada pembeli.
                    </p>

                </div>


                <div class="grid gap-5 p-6
                       md:grid-cols-2">

                    {{-- STORE NAME --}}
                    <div>

                        <label for="store_name" class="mb-2 block
                               text-sm font-medium">
                            Nama Toko
                            <span class="text-red-500">*</span>
                        </label>

                        <input id="store_name" type="text" name="store_name"
                            value="{{ old('store_name', $seller->sellerProfile?->store_name) }}"
                            required
                            class="h-12 w-full rounded-xl
                               border
                               {{ $errors->has('store_name') ? 'border-red-300' : 'border-slate-200' }}
                               px-4 text-sm
                               outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100">

                        @error('store_name')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- WHATSAPP --}}
                    <div>

                        <label for="whatsapp" class="mb-2 block
                               text-sm font-medium">
                            Nomor WhatsApp
                            <span class="text-red-500">*</span>
                        </label>

                        <input id="whatsapp" type="text" name="whatsapp"
                            value="{{ old('whatsapp', $seller->sellerProfile?->whatsapp) }}"
                            placeholder="08xxxxxxxxxx" required
                            class="h-12 w-full rounded-xl
                               border
                               {{ $errors->has('whatsapp') ? 'border-red-300' : 'border-slate-200' }}
                               px-4 text-sm
                               outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100">

                        <p class="mt-2 text-xs text-slate-500">
                            Nomor ini digunakan untuk
                            menghubungkan pembeli
                            ke WhatsApp penjual.
                        </p>

                        @error('whatsapp')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- FACULTY --}}
                    <div class="md:col-span-2">

                        <label for="faculty" class="mb-2 block
                               text-sm font-medium">
                            Fakultas
                        </label>

                        <input id="faculty" type="text" name="faculty"
                            value="{{ old('faculty', $seller->sellerProfile?->faculty) }}"
                            placeholder="Contoh: Fakultas Teknik"
                            class="h-12 w-full rounded-xl
                               border border-slate-200
                               px-4 text-sm
                               outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100">

                        @error('faculty')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="md:col-span-2">

                        <label for="description" class="mb-2 block
                               text-sm font-medium">
                            Deskripsi Toko
                        </label>

                        <textarea id="description" name="description" rows="5" placeholder="Jelaskan secara singkat tentang toko..."
                            class="w-full resize-none
                               rounded-xl border
                               border-slate-200
                               p-4 text-sm
                               leading-6 outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100">{{ old('description', $seller->sellerProfile?->description) }}</textarea>

                        <div class="mt-2 flex
                               justify-between">

                            @error('description')
                                <p class="text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @else
                                <span></span>
                            @enderror

                            <span class="text-xs text-slate-400">
                                Maksimal 1000 karakter
                            </span>

                        </div>

                    </div>

                </div>

            </section>



            {{-- ========================================================= --}}
            {{-- PASSWORD --}}
            {{-- ========================================================= --}}

            <section
                class="overflow-hidden rounded-2xl
                   border border-slate-200
                   bg-white shadow-sm">

                <div class="border-b border-slate-200
                       px-6 py-5">

                    <h2 class="text-lg font-semibold">
                        Ubah Password
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Kosongkan bagian ini jika
                        password penjual tidak ingin diubah.
                    </p>

                </div>


                <div class="grid gap-5 p-6
                       md:grid-cols-2">

                    <div>

                        <label for="password" class="mb-2 block
                               text-sm font-medium">
                            Password Baru
                        </label>

                        <input id="password" type="password" name="password" autocomplete="new-password"
                            placeholder="Minimal 8 karakter"
                            class="h-12 w-full rounded-xl
                               border border-slate-200
                               px-4 text-sm
                               outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100">

                        @error('password')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <div>

                        <label for="password_confirmation"
                            class="mb-2 block
                               text-sm font-medium">
                            Konfirmasi Password Baru
                        </label>

                        <input id="password_confirmation" type="password" name="password_confirmation"
                            autocomplete="new-password" placeholder="Ulangi password baru"
                            class="h-12 w-full rounded-xl
                               border border-slate-200
                               px-4 text-sm
                               outline-none
                               focus:border-violet-500
                               focus:ring-4
                               focus:ring-violet-100">

                    </div>

                </div>

            </section>



            {{-- ========================================================= --}}
            {{-- ACTION BUTTONS --}}
            {{-- ========================================================= --}}

            <div
                class="sticky bottom-0
                   flex flex-col-reverse gap-3
                   border-t border-slate-200
                   bg-[#fafafa]/95
                   py-4 backdrop-blur
                   sm:flex-row
                   sm:justify-end">

                <a href="{{ route('admin.sellers.show', $seller) }}"
                    class="inline-flex h-12
                       items-center justify-center
                       rounded-xl border
                       border-slate-200
                       bg-white px-6
                       text-sm font-semibold
                       text-slate-600
                       transition
                       hover:bg-slate-50">
                    Batal
                </a>


                <button type="submit"
                    class="inline-flex h-12
                       items-center justify-center
                       gap-2 rounded-xl
                       bg-violet-600 px-7
                       text-sm font-semibold
                       text-white shadow-sm
                       transition
                       hover:bg-violet-700
                       focus:outline-none
                       focus:ring-4
                       focus:ring-violet-200">

                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5
                                 a2 2 0 0 1 2-2h11l5 5v11
                                 a2 2 0 0 1-2 2Z" />
                        <path d="M17 21v-8H7v8" />
                        <path d="M7 3v5h8" />
                    </svg>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>
<script>
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photoPreview');
    const photoPlaceholder = document.getElementById('photoPlaceholder');

    photoInput?.addEventListener('change', function (event) {

        const file = event.target.files[0];

        if (!file) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {

            photoPreview.src = e.target.result;

            photoPreview.classList.remove('hidden');

            if (photoPlaceholder) {
                photoPlaceholder.classList.add('hidden');
            }
        };

        reader.readAsDataURL(file);
    });
</script>
@endsection
