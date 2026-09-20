@extends('layouts.admin')

@section('title', 'Branding Website')

@section('content')

    <div class="mx-auto max-w-4xl">

        {{-- HEADER --}}
        <div class="mb-6">

            <div
                class="inline-flex items-center gap-2
                       rounded-full bg-[#F4EAE2]
                       px-3 py-1.5
                       text-xs font-bold
                       text-[#4371d1]">

                Branding Website

            </div>

            <h1
                class="mt-3 text-2xl
                       font-black tracking-tight
                       text-[#332B26]
                       lg:text-3xl">

                Identitas Website

            </h1>

            <p class="mt-2 text-sm
                       leading-6 text-slate-500">

                Atur nama, kontak WhatsApp Admin, logo,
                dan favicon yang digunakan pada website.

            </p>

        </div>



        @if (session('success'))
            <div
                class="mb-5 rounded-2xl
                       border border-[#D3DFCE]
                       bg-[#EEF3EA]
                       px-4 py-3
                       text-sm font-semibold
                       text-[#65795E]">

                {{ session('success') }}

            </div>
        @endif



        <form action="{{ route('admin.settings.website.update') }}" method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')


            <section
                class="overflow-hidden
                       rounded-3xl
                       border border-[#DFD2C7]
                       bg-white shadow-sm">


                <div
                    class="border-b
                           border-[#E7DBD1]
                           bg-[#FAF7F2]
                           p-5 sm:p-6">

                    <h2 class="font-bold
                               text-[#332B26]">

                        Branding Utama

                    </h2>

                    <p class="mt-1 text-xs
                               text-slate-500">

                        Informasi ini digunakan
                        sebagai identitas aplikasi.

                    </p>

                </div>


                <div class="space-y-6 p-5 sm:p-6">


                    {{-- SITE NAME --}}
                    <div>

                        <label for="site_name"
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-[#4D4038]">

                            Nama Website

                        </label>

                        <input type="text" name="site_name" id="site_name"
                            value="{{ old('site_name', $setting->site_name) }}"
                            placeholder="Contoh: KampusMart"
                            class="h-11 w-full
                                   rounded-xl border
                                   border-[#DFD2C7]
                                   px-4 text-sm
                                   text-[#4D4038]
                                   outline-none
                                   transition
                                   focus:border-[#4371d1]
                                   focus:ring-4
                                   focus:ring-[#F4EAE2]">

                        @error('site_name')
                            <p
                                class="mt-2 text-xs
                                       font-medium
                                       text-[#A65954]">

                                {{ $message }}

                            </p>
                        @enderror

                    </div>



                    {{-- ADMIN WHATSAPP --}}
                    <div>

                        <label for="admin_whatsapp"
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-[#4D4038]">

                            WhatsApp Admin

                        </label>

                        <input type="tel" name="admin_whatsapp" id="admin_whatsapp"
                            value="{{ old('admin_whatsapp', $setting->admin_whatsapp ?? config('app.admin_whatsapp')) }}"
                            placeholder="Contoh: 081234567890"
                            autocomplete="tel"
                            class="h-11 w-full
                                   rounded-xl border
                                   border-[#DFD2C7]
                                   px-4 text-sm
                                   text-[#4D4038]
                                   outline-none
                                   transition
                                   focus:border-[#4371d1]
                                   focus:ring-4
                                   focus:ring-[#F4EAE2]">

                        <p class="mt-2 text-xs leading-5 text-slate-400">
                            Nomor ini digunakan oleh tombol WhatsApp mengambang pada seluruh halaman pembeli dan penjual.
                            Gunakan nomor aktif, misalnya 081234567890 atau +6281234567890.
                        </p>

                        @error('admin_whatsapp')
                            <p
                                class="mt-2 text-xs
                                       font-medium
                                       text-[#A65954]">

                                {{ $message }}

                            </p>
                        @enderror

                    </div>



                    {{-- LOGO --}}
                    <div>

                        <label for="logo"
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-[#4D4038]">

                            Logo Website

                        </label>


                        <div
                            class="rounded-2xl
                                   border border-[#E7DBD1]
                                   bg-[#FAF7F2]
                                   p-5">

                            <div
                                class="flex flex-col gap-5
                                       sm:flex-row
                                       sm:items-center">


                                {{-- PREVIEW --}}
                                <div
                                    class="flex size-24
                                           shrink-0
                                           items-center
                                           justify-center
                                           overflow-hidden
                                           rounded-2xl
                                           border
                                           border-[#DFD2C7]
                                           bg-white">

                                    @if ($setting->logo)
                                        <img id="logoPreview"
                                            src="{{ asset('storage/' . $setting->logo) }}"
                                            alt="{{ $setting->site_name }}"
                                            class="h-full w-full
                                                   object-contain
                                                   p-2">
                                    @else
                                        <img id="logoPreview" src=""
                                            class="hidden
                                                   h-full w-full
                                                   object-contain
                                                   p-2">

                                        <span id="logoPlaceholder"
                                            class="text-2xl
                                                   font-black
                                                   text-[#4371d1]">

                                            {{ strtoupper(substr($setting->site_name, 0, 1)) }}

                                        </span>
                                    @endif

                                </div>


                                <div class="flex-1">

                                    <input type="file" name="logo" id="logo"
                                        accept="image/jpeg,image/png,image/webp"
                                        class="block w-full
                                               rounded-xl border
                                               border-[#DFD2C7]
                                               bg-white
                                               px-3 py-2
                                               text-sm
                                               text-[#6F6259]">

                                    <p class="mt-2 text-xs
                                               text-slate-400">

                                        JPG, PNG atau WebP.
                                        Maksimal 2 MB. Digunakan sebagai logo utama pada halaman website.

                                    </p>

                                </div>

                            </div>

                        </div>


                        @error('logo')
                            <p
                                class="mt-2 text-xs
                                       font-medium
                                       text-[#A65954]">

                                {{ $message }}

                            </p>
                        @enderror

                    </div>



                    {{-- FAVICON --}}
                    <div>

                        <label for="favicon"
                            class="mb-2 block
                                   text-sm font-semibold
                                   text-[#4D4038]">

                            Favicon Website

                        </label>


                        <div
                            class="rounded-2xl
                                   border border-[#E7DBD1]
                                   bg-[#FAF7F2]
                                   p-5">

                            <div
                                class="flex flex-col gap-5
                                       sm:flex-row
                                       sm:items-center">


                                {{-- PREVIEW --}}
                                <div
                                    class="flex size-24
                                           shrink-0
                                           items-center
                                           justify-center
                                           overflow-hidden
                                           rounded-2xl
                                           border
                                           border-[#DFD2C7]
                                           bg-white">

                                    @if ($setting->favicon)
                                        <img id="faviconPreview"
                                            src="{{ asset('storage/' . $setting->favicon) }}"
                                            alt="Favicon {{ $setting->site_name }}"
                                            class="size-14 object-contain">
                                    @else
                                        <img id="faviconPreview" src="" alt=""
                                            class="hidden size-14 object-contain">

                                        <span id="faviconPlaceholder"
                                            class="flex size-14 items-center justify-center rounded-xl
                                                   bg-[#EEF3EA] text-xl text-[#65795E]">

                                            <i class="fa-solid fa-globe"></i>

                                        </span>
                                    @endif

                                </div>


                                <div class="flex-1">

                                    <input type="file" name="favicon" id="favicon"
                                        accept=".ico,image/x-icon,image/vnd.microsoft.icon,image/jpeg,image/png,image/webp"
                                        class="block w-full
                                               rounded-xl border
                                               border-[#DFD2C7]
                                               bg-white
                                               px-3 py-2
                                               text-sm
                                               text-[#6F6259]">

                                    <p class="mt-2 text-xs
                                               leading-5 text-slate-400">

                                        ICO, JPG, PNG atau WebP. Maksimal 1 MB.
                                        Disarankan menggunakan gambar persegi berukuran 32×32 atau 64×64 piksel.

                                    </p>

                                </div>

                            </div>

                        </div>


                        @error('favicon')
                            <p
                                class="mt-2 text-xs
                                       font-medium
                                       text-[#A65954]">

                                {{ $message }}

                            </p>
                        @enderror

                    </div>

                </div>



                {{-- ACTION --}}
                <div
                    class="flex justify-end
                           border-t
                           border-[#E7DBD1]
                           bg-[#FAF7F2]
                           px-5 py-4">

                    <button type="submit"
                        class="inline-flex h-11
                               items-center justify-center
                               gap-2 rounded-xl
                               bg-[#4371d1]
                               px-5
                               text-sm font-bold
                               text-white
                               transition
                               hover:bg-[#0a1d45]">

                        Simpan Branding

                    </button>

                </div>

            </section>

        </form>

    </div>

@endsection


@push('scripts')
    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function() {

                const bindImagePreview = function(inputId, previewId, placeholderId) {
                    const input = document.getElementById(inputId);
                    const preview = document.getElementById(previewId);
                    const placeholder = document.getElementById(placeholderId);

                    input?.addEventListener('change', function(event) {
                        const file = event.target.files[0];

                        if (!file || !preview) {
                            return;
                        }

                        const reader = new FileReader();

                        reader.onload = function(event) {
                            preview.src = event.target.result;
                            preview.classList.remove('hidden');
                            placeholder?.classList.add('hidden');
                        };

                        reader.readAsDataURL(file);
                    });
                };

                bindImagePreview('logo', 'logoPreview', 'logoPlaceholder');
                bindImagePreview('favicon', 'faviconPreview', 'faviconPlaceholder');

            }
        );
    </script>
@endpush
