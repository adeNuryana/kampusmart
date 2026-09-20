@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')

    <div class="mx-auto max-w-5xl">

        <section class="mb-6">

            <a href="{{ route('admin.products.index') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-[#8B7465]
                       transition hover:text-[#4371d1]">

                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m15 18-6-6 6-6" />
                </svg>

                Kembali ke Produk

            </a>


            <div class="mt-5 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <div
                        class="inline-flex items-center gap-2 rounded-full bg-[#F4EAE2]
                               px-3 py-1.5 text-xs font-bold text-[#4371d1]">

                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M12 20h9" />
                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z" />
                        </svg>

                        Edit Produk

                    </div>

                    <h1 class="mt-3 text-2xl font-black tracking-tight text-[#332B26] lg:text-3xl">
                        Ubah Produk
                    </h1>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Perbarui harga, kuantitas stok, dan status produk seller.
                    </p>

                </div>


                @if ($product->status === 'active')
                    <span
                        class="inline-flex w-fit items-center gap-2 rounded-full border border-[#D3DFCE]
                               bg-[#EEF3EA] px-3 py-1.5 text-xs font-bold text-[#65795E]">
                        <span class="size-1.5 rounded-full bg-[#718268]"></span>
                        Aktif
                    </span>
                @else
                    <span
                        class="inline-flex w-fit items-center gap-2 rounded-full border border-[#ECD2CF]
                               bg-[#FAEDEC] px-3 py-1.5 text-xs font-bold text-[#A65954]">
                        <span class="size-1.5 rounded-full bg-[#A65954]"></span>
                        Nonaktif
                    </span>
                @endif

            </div>

        </section>


        @if ($errors->any())
            <div
                class="mb-6 flex items-start gap-3 rounded-2xl border border-[#ECD2CF]
                       bg-[#FAEDEC] px-4 py-3.5">

                <div class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-[#A65954] text-white">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="9" />
                        <path d="M12 8v5" />
                        <path d="M12 17h.01" />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-bold text-[#A65954]">Data belum dapat disimpan.</p>
                    <p class="mt-1 text-xs text-[#9B5F59]">Periksa kembali harga, stok, dan status produk.</p>
                </div>

            </div>
        @endif


        <div class="grid gap-6 lg:grid-cols-[320px_minmax(0,1fr)]">

            <aside>

                <section
                    class="overflow-hidden rounded-3xl border border-[#DFD2C7]
                           bg-white shadow-sm lg:sticky lg:top-24">

                    <div class="h-1.5 bg-gradient-to-r from-[#718268] via-[#C8795A] to-[#4371d1]"></div>

                    <div class="p-5">

                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="aspect-square w-full rounded-2xl border border-[#E7DBD1] object-cover">
                        @else
                            <div
                                class="flex aspect-square w-full items-center justify-center rounded-2xl
                                       bg-[#FAF7F2] text-[#A28A7A]">
                                <svg class="size-14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.5">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <path d="m21 15-5-5L5 21" />
                                </svg>
                            </div>
                        @endif

                        <h2 class="mt-5 text-lg font-black text-[#332B26]">
                            {{ $product->name }}
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">ID Produk #{{ $product->id }}</p>


                        <dl class="mt-5 space-y-4 border-t border-[#EEE5DE] pt-5">

                            <div>
                                <dt class="text-xs font-bold uppercase tracking-wide text-[#A28A7A]">Seller</dt>
                                <dd class="mt-1 text-sm font-semibold text-[#4D4038]">
                                    {{ $product->user?->sellerProfile?->store_name ?? $product->user?->name ?? '-' }}
                                </dd>
                                @if ($product->user?->sellerProfile?->store_name)
                                    <dd class="mt-0.5 text-xs text-slate-400">{{ $product->user?->name }}</dd>
                                @endif
                            </div>

                            <div>
                                <dt class="text-xs font-bold uppercase tracking-wide text-[#A28A7A]">Kategori</dt>
                                <dd class="mt-1 text-sm font-semibold text-[#4D4038]">
                                    {{ $product->category?->name ?? '-' }}
                                </dd>
                            </div>

                        </dl>

                    </div>

                </section>

            </aside>


            <div class="space-y-6">

                <form action="{{ route('admin.products.update', $product) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <section
                        class="overflow-hidden rounded-3xl border border-[#DFD2C7]
                               bg-white shadow-sm">

                        <div class="border-b border-[#E7DBD1] bg-[#FAF7F2] p-5 sm:p-6">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex size-10 shrink-0 items-center justify-center rounded-xl
                                           bg-[#4371d1] text-white">
                                    <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <path d="M12 20h9" />
                                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z" />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="font-bold text-[#332B26]">Pengaturan Produk</h2>
                                    <p class="mt-1 text-xs text-slate-500">
                                        Nama, gambar, kategori, dan deskripsi tetap dikelola oleh seller.
                                    </p>
                                </div>

                            </div>

                        </div>


                        <div class="grid gap-5 p-5 sm:p-6 md:grid-cols-2">

                            <div>
                                <label for="price" class="mb-2 block text-sm font-semibold text-[#4D4038]">
                                    Harga
                                    <span class="text-[#A65954]">*</span>
                                </label>

                                <div class="relative">
                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-[#806F64]">
                                        Rp
                                    </span>

                                    <input id="price" type="number" name="price" min="0" step="0.01"
                                        value="{{ old('price', $product->price) }}" required
                                        class="h-11 w-full rounded-xl border pl-12 pr-4 text-sm text-[#4D4038]
                                               outline-none transition
                                               {{ $errors->has('price') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                               focus:border-[#A97957] focus:ring-4 focus:ring-[#F1E6DE]">
                                </div>

                                @error('price')
                                    <p class="mt-2 text-xs font-medium text-[#A65954]">{{ $message }}</p>
                                @enderror
                            </div>


                            <div>
                                <label for="stock" class="mb-2 block text-sm font-semibold text-[#4D4038]">
                                    Kuantitas / Stok
                                    <span class="text-[#A65954]">*</span>
                                </label>

                                <input id="stock" type="number" name="stock" min="0" step="1"
                                    value="{{ old('stock', $product->stock) }}" required
                                    class="h-11 w-full rounded-xl border px-4 text-sm text-[#4D4038]
                                           outline-none transition
                                           {{ $errors->has('stock') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                           focus:border-[#A97957] focus:ring-4 focus:ring-[#F1E6DE]">

                                @error('stock')
                                    <p class="mt-2 text-xs font-medium text-[#A65954]">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="md:col-span-2">
                                <label for="status" class="mb-2 block text-sm font-semibold text-[#4D4038]">
                                    Status Produk
                                    <span class="text-[#A65954]">*</span>
                                </label>

                                <select id="status" name="status" required
                                    class="h-11 w-full rounded-xl border bg-white px-4 text-sm text-[#4D4038]
                                           outline-none transition
                                           {{ $errors->has('status') ? 'border-[#D79B96]' : 'border-[#DFD2C7]' }}
                                           focus:border-[#A97957] focus:ring-4 focus:ring-[#F1E6DE]">
                                    <option value="active" @selected(old('status', $product->status) === 'active')>Aktif</option>
                                    <option value="inactive" @selected(old('status', $product->status) === 'inactive')>Nonaktif</option>
                                </select>

                                <p class="mt-2 text-xs text-slate-400">
                                    Produk nonaktif tidak ditampilkan kepada pembeli.
                                </p>

                                @error('status')
                                    <p class="mt-2 text-xs font-medium text-[#A65954]">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>


                        <div
                            class="flex flex-col-reverse gap-3 border-t border-[#EEE5DE]
                                   bg-[#FCFAF7] px-5 py-4 sm:flex-row sm:justify-end sm:px-6">

                            <a href="{{ route('admin.products.index') }}"
                                class="inline-flex h-11 items-center justify-center rounded-xl border
                                       border-[#DFD2C7] bg-white px-5 text-sm font-bold text-[#6F6259]
                                       transition hover:bg-[#F5ECE6]">
                                Batal
                            </a>

                            <button type="submit"
                                class="inline-flex h-11 items-center justify-center gap-2 rounded-xl
                                       bg-[#4371d1] px-5 text-sm font-bold text-white shadow-sm
                                       transition hover:bg-[#0a1d45] hover:shadow-md">
                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="m5 12 4 4L19 6" />
                                </svg>
                                Simpan Perubahan
                            </button>

                        </div>

                    </section>

                </form>


                <section class="overflow-hidden rounded-3xl border border-[#ECD2CF] bg-white shadow-sm">

                    <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">

                        <div>
                            <h2 class="font-bold text-[#A65954]">Hapus Produk</h2>
                            <p class="mt-1 text-xs leading-5 text-slate-500">
                                Produk akan dihapus dari katalog dan keranjang pembeli. Riwayat transaksi tetap tersimpan.
                            </p>
                        </div>

                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                            onsubmit="return confirm('Hapus produk ini? Tindakan ini tidak dapat dibatalkan.')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="inline-flex h-11 w-full items-center justify-center gap-2 rounded-xl
                                       bg-[#A65954] px-5 text-sm font-bold text-white transition
                                       hover:bg-[#8F4944] sm:w-auto">
                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path d="M4 7h16" />
                                    <path d="M9 7V4h6v3" />
                                    <path d="m7 7 1 13h8l1-13" />
                                    <path d="M10 11v5" />
                                    <path d="M14 11v5" />
                                </svg>
                                Hapus Produk
                            </button>
                        </form>

                    </div>

                </section>

            </div>

        </div>

    </div>

@endsection
