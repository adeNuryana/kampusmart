@extends('layouts.seller')

@section('title', 'Detail Pesanan')

@section('content')

    <div class="mx-auto max-w-5xl">

        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <section class="mb-6">

            <a href="{{ route('seller.orders.index') }}"
                class="inline-flex items-center gap-2
                       text-sm font-semibold
                       text-[#8B7465]
                       transition
                       hover:text-[#A95E43]">

                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                    <path d="m15 18-6-6 6-6" />

                </svg>

                Kembali ke Pesanan

            </a>


            @php
                $statusClass = match ($order->status) {
                    'pending' => 'border-[#E8D8B9] bg-[#FAF2DF] text-[#A87A37]',

                    'confirmed' => 'border-[#DFD2C7] bg-[#F1E6DE] text-[#6F4E37]',

                    'processing' => 'border-[#EBCFC2] bg-[#FBEAE2] text-[#A95E43]',

                    'completed', 'sold' => 'border-[#D3DFCE] bg-[#EEF3EA] text-[#65795E]',

                    'cancelled' => 'border-[#ECD2CF] bg-[#FAEDEC] text-[#A65954]',

                    default => 'border-slate-200 bg-slate-100 text-slate-600',
                };

                $statusDot = match ($order->status) {
                    'pending' => 'bg-[#C89B55]',
                    'confirmed' => 'bg-[#8B6245]',
                    'processing' => 'bg-[#C8795A]',
                    'completed', 'sold' => 'bg-[#718268]',
                    'cancelled' => 'bg-[#A65954]',
                    default => 'bg-slate-400',
                };

                $statusLabel = match ($order->status) {
                    'pending' => 'Menunggu',
                    'confirmed' => 'Dikonfirmasi',
                    'processing' => 'Diproses',
                    'completed' => 'Selesai',
                    'sold' => 'Sudah Terjual',
                    'cancelled' => 'Dibatalkan',
                    default => ucfirst($order->status),
                };
            @endphp


            <div
                class="mt-5 flex flex-col gap-4
                       sm:flex-row sm:items-end
                       sm:justify-between">

                <div>

                    <div
                        class="inline-flex items-center gap-2
                               rounded-full bg-[#FBEAE2]
                               px-3 py-1.5
                               text-xs font-bold
                               text-[#A95E43]">

                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                            <path d="M6 3h12v18H6z" />
                            <path d="M9 8h6" />

                        </svg>

                        {{ $order->order_number }}

                    </div>


                    <h1
                        class="mt-3 text-2xl
                               font-black tracking-tight
                               text-[#332B26]
                               lg:text-3xl">

                        Detail Pesanan

                    </h1>


                    <p class="mt-2 text-sm
                               text-slate-500">

                        Dibuat pada

                        {{ $order->created_at->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y, H:i') }}
                        WIB

                    </p>

                </div>


                <span
                    class="inline-flex w-fit
                           items-center gap-2
                           rounded-full border
                           px-3 py-1.5
                           text-xs font-bold
                           {{ $statusClass }}">

                    <span class="size-1.5 rounded-full
                               {{ $statusDot }}">
                    </span>

                    {{ $statusLabel }}

                </span>

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- SUCCESS --}}
        {{-- ===================================================== --}}

        @if (session('success'))
            <div
                class="mb-5 flex items-start gap-3
                       rounded-2xl
                       border border-[#D3DFCE]
                       bg-[#EEF3EA]
                       px-4 py-3.5">

                <div
                    class="flex size-8 shrink-0
                           items-center justify-center
                           rounded-lg
                           bg-[#718268]
                           text-white">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <path d="m5 12 4 4L19 6" />

                    </svg>

                </div>

                <p class="pt-1 text-sm
                           font-medium
                           text-[#65795E]">

                    {{ session('success') }}

                </p>

            </div>
        @endif



        @error('status')
            <div
                class="mb-5 flex items-start gap-3
                       rounded-2xl
                       border border-[#ECD2CF]
                       bg-[#FAEDEC]
                       px-4 py-3.5">

                <div
                    class="flex size-8 shrink-0
                           items-center justify-center
                           rounded-lg
                           bg-[#A65954]
                           text-white">

                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                        <circle cx="12" cy="12" r="9" />
                        <path d="M12 8v5" />
                        <path d="M12 17h.01" />

                    </svg>

                </div>

                <p class="pt-1 text-sm
                           font-medium
                           text-[#A65954]">

                    {{ $message }}

                </p>

            </div>
        @enderror



        {{-- ===================================================== --}}
        {{-- CONTENT --}}
        {{-- ===================================================== --}}

        <div class="grid gap-6 lg:grid-cols-3">


            {{-- ================================================= --}}
            {{-- LEFT --}}
            {{-- ================================================= --}}

            <div class="space-y-6 lg:col-span-2">


                {{-- BUYER --}}
                <section
                    class="overflow-hidden
                           rounded-3xl
                           border border-[#DFD2C7]
                           bg-white shadow-sm">

                    <div
                        class="border-b
                               border-[#E7DBD1]
                               bg-[#FAF7F2]
                               p-5">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex size-9
                                       items-center justify-center
                                       rounded-xl
                                       bg-[#F4EAE2]
                                       text-[#6F4E37]">

                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <circle cx="12" cy="8" r="3.5" />
                                    <path d="M5 20c0-4 3-7 7-7s7 3 7 7" />

                                </svg>

                            </div>


                            <div>

                                <h2 class="font-bold
                                           text-[#332B26]">

                                    Informasi Pembeli

                                </h2>

                                <p class="mt-0.5 text-xs
                                           text-slate-500">

                                    Informasi pemesan yang dapat dihubungi.

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-5 sm:p-6">

                        <div class="grid gap-5
                                   sm:grid-cols-2">


                            <div>

                                <p
                                    class="text-[10px]
                                           font-bold uppercase
                                           tracking-[0.12em]
                                           text-[#A28A7A]">

                                    Nama Pembeli

                                </p>

                                <p
                                    class="mt-2 text-sm
                                           font-bold
                                           text-[#4D4038]">

                                    {{ $order->buyer_name }}

                                </p>

                            </div>



                            <div>

                                <p
                                    class="text-[10px]
                                           font-bold uppercase
                                           tracking-[0.12em]
                                           text-[#A28A7A]">

                                    Nomor Telepon

                                </p>

                                <p
                                    class="mt-2 text-sm
                                           font-semibold
                                           text-[#4D4038]">

                                    {{ $order->buyer_phone ?? '-' }}

                                </p>

                            </div>

                        </div>



                        @if ($order->notes)
                            <div
                                class="mt-5 border-t
                                       border-[#EEE5DE]
                                       pt-5">

                                <p
                                    class="text-[10px]
                                           font-bold uppercase
                                           tracking-[0.12em]
                                           text-[#A28A7A]">

                                    Catatan Pembeli

                                </p>


                                <div
                                    class="mt-3 rounded-2xl
                                           border border-[#E8D8B9]
                                           bg-[#FAF2DF]
                                           p-4">

                                    <p
                                        class="whitespace-pre-line
                                               text-sm leading-6
                                               text-[#6F5B36]">

                                        {{ $order->notes }}

                                    </p>

                                </div>

                            </div>
                        @endif

                    </div>

                </section>



                {{-- ================================================= --}}
                {{-- ORDER ITEMS --}}
                {{-- ================================================= --}}

                <section
                    class="overflow-hidden
                           rounded-3xl
                           border border-[#DFD2C7]
                           bg-white shadow-sm">

                    <div
                        class="border-b
                               border-[#E7DBD1]
                               bg-[#FAF7F2]
                               p-5">

                        <div class="flex items-center
                                   justify-between gap-4">

                            <div>

                                <h2 class="font-bold
                                           text-[#332B26]">

                                    Produk Pesanan

                                </h2>

                                <p class="mt-1 text-xs
                                           text-slate-500">

                                    Item yang dibeli pada pesanan ini.

                                </p>

                            </div>


                            <span
                                class="rounded-full
                                       bg-[#F4EAE2]
                                       px-3 py-1.5
                                       text-xs font-bold
                                       text-[#6F4E37]">

                                {{ $order->items->sum('quantity') }}
                                barang

                            </span>

                        </div>

                    </div>


                    <div class="divide-y divide-[#EEE5DE]">

                        @foreach ($order->items as $item)
                            <div
                                class="flex flex-col gap-4
                                       p-5 sm:flex-row
                                       sm:items-center">


                                {{-- IMAGE --}}
                                @if ($item->product?->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                        alt="{{ $item->product_name }}"
                                        class="size-20
                                               shrink-0
                                               rounded-2xl
                                               border
                                               border-[#E7DBD1]
                                               object-cover">
                                @else
                                    <div
                                        class="flex size-20
                                               shrink-0
                                               items-center
                                               justify-center
                                               rounded-2xl
                                               bg-[#FAF7F2]
                                               text-[#B09C90]">

                                        <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.6">

                                            <rect x="3" y="3" width="18" height="18" rx="2" />

                                            <circle cx="8.5" cy="8.5" r="1.5" />

                                            <path d="m21 15-5-5L5 21" />

                                        </svg>

                                    </div>
                                @endif



                                {{-- INFO --}}
                                <div class="min-w-0 flex-1">

                                    <p class="font-bold
                                               text-[#332B26]">

                                        {{ $item->product_name }}

                                    </p>


                                    <p class="mt-2 text-sm
                                               text-slate-500">

                                        {{ $item->quantity }}

                                        ×

                                        Rp{{ number_format($item->price, 0, ',', '.') }}

                                    </p>

                                </div>



                                {{-- SUBTOTAL --}}
                                <div class="sm:text-right">

                                    <p
                                        class="text-xs font-medium
                                               text-slate-400">

                                        Subtotal

                                    </p>

                                    <p
                                        class="mt-1 whitespace-nowrap
                                               font-black
                                               text-[#332B26]">

                                        Rp{{ number_format($item->subtotal, 0, ',', '.') }}

                                    </p>

                                </div>

                            </div>
                        @endforeach

                    </div>

                </section>

            </div>



            {{-- ================================================= --}}
            {{-- RIGHT --}}
            {{-- ================================================= --}}

            <aside class="space-y-6">


                {{-- ================================================= --}}
                {{-- SUMMARY --}}
                {{-- ================================================= --}}

                <section
                    class="overflow-hidden
                           rounded-3xl
                           border border-[#DFD2C7]
                           bg-white shadow-sm">

                    <div
                        class="border-b
                               border-[#E7DBD1]
                               bg-[#FAF7F2]
                               p-5">

                        <h2 class="font-bold
                                   text-[#332B26]">

                            Ringkasan Pesanan

                        </h2>

                    </div>


                    <div class="p-5">

                        <div class="flex items-center
                                   justify-between">

                            <span class="text-sm
                                       text-slate-500">

                                Total Barang

                            </span>

                            <span class="text-sm font-bold
                                       text-[#4D4038]">

                                {{ $order->items->sum('quantity') }}

                            </span>

                        </div>


                        <div
                            class="mt-5 border-t
                                   border-[#EEE5DE]
                                   pt-5">

                            <p class="text-xs font-semibold
                                       text-slate-500">

                                Total Pesanan

                            </p>


                            <p
                                class="mt-2 text-2xl
                                       font-black
                                       tracking-tight
                                       text-[#6F4E37]">

                                Rp{{ number_format($order->subtotal, 0, ',', '.') }}

                            </p>

                        </div>

                    </div>

                </section>



                {{-- ================================================= --}}
                {{-- STATUS ACTION --}}
                {{-- ================================================= --}}

                <section
                    class="overflow-hidden
                           rounded-3xl
                           border border-[#DFD2C7]
                           bg-white shadow-sm">

                    <div
                        class="border-b
                               border-[#E7DBD1]
                               bg-[#FAF7F2]
                               p-5">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex size-9
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-[#FBEAE2]
                                       text-[#A95E43]">

                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">

                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M12 7v5l3 2" />

                                </svg>

                            </div>


                            <div>

                                <h2 class="font-bold
                                           text-[#332B26]">

                                    Status Pesanan

                                </h2>

                                <p class="mt-0.5 text-xs
                                           text-slate-500">

                                    Kelola proses pesanan.

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-5">


                        {{-- CURRENT --}}
                        <div
                            class="rounded-2xl
                                   border border-[#E7DBD1]
                                   bg-[#FAF7F2]
                                   p-4">

                            <p
                                class="text-[10px]
                                       font-bold uppercase
                                       tracking-wider
                                       text-[#A28A7A]">

                                Status Saat Ini

                            </p>


                            <span
                                class="mt-2 inline-flex
                                       items-center gap-2
                                       rounded-full border
                                       px-3 py-1.5
                                       text-xs font-bold
                                       {{ $statusClass }}">

                                <span
                                    class="size-1.5 rounded-full
                                           {{ $statusDot }}">
                                </span>

                                {{ $statusLabel }}

                            </span>

                        </div>



                        {{-- ========================================= --}}
                        {{-- PENDING --}}
                        {{-- ========================================= --}}

                        @if ($order->status === 'pending')
                            <div class="mt-5 space-y-3">

                                <form
                                    action="{{ route('seller.orders.status', $order) }}"
                                    method="POST">

                                    @csrf
                                    @method('PATCH')


                                    <input type="hidden" name="status" value="confirmed">


                                    <button type="submit"
                                        onclick="return confirm(
                                            'Terima pesanan ini?'
                                        )"
                                        class="inline-flex h-11
                                               w-full items-center
                                               justify-center gap-2
                                               rounded-xl
                                               bg-[#6F4E37]
                                               px-4
                                               text-sm font-bold
                                               text-white
                                               transition
                                               hover:bg-[#5B3B2B]">

                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">

                                            <path d="m5 12 4 4L19 6" />

                                        </svg>

                                        Terima Pesanan

                                    </button>

                                </form>



                                <form
                                    action="{{ route('seller.orders.status', $order) }}"
                                    method="POST">

                                    @csrf
                                    @method('PATCH')


                                    <input type="hidden" name="status" value="cancelled">


                                    <button type="submit"
                                        onclick="return confirm(
                                            'Batalkan pesanan ini? Stok produk akan dikembalikan.'
                                        )"
                                        class="inline-flex h-11
                                               w-full items-center
                                               justify-center gap-2
                                               rounded-xl
                                               bg-[#FAEDEC]
                                               px-4
                                               text-sm font-bold
                                               text-[#A65954]
                                               transition
                                               hover:bg-[#F5DEDB]">

                                        Batalkan Pesanan

                                    </button>

                                </form>

                            </div>



                            {{-- ========================================= --}}
                            {{-- CONFIRMED --}}
                            {{-- ========================================= --}}
                        @elseif ($order->status === 'confirmed')
                            <div class="mt-5 space-y-3">

                                <form
                                    action="{{ route('seller.orders.status', $order) }}"
                                    method="POST">

                                    @csrf
                                    @method('PATCH')


                                    <input type="hidden" name="status" value="processing">


                                    <button type="submit"
                                        onclick="return confirm(
                                            'Mulai proses pesanan ini?'
                                        )"
                                        class="inline-flex h-11
                                               w-full items-center
                                               justify-center gap-2
                                               rounded-xl
                                               bg-[#C8795A]
                                               px-4
                                               text-sm font-bold
                                               text-white
                                               transition
                                               hover:bg-[#B66F52]">

                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.8">

                                            <circle cx="12" cy="12" r="9" />
                                            <path d="M12 7v5l3 2" />

                                        </svg>

                                        Proses Pesanan

                                    </button>

                                </form>


                                <form
                                    action="{{ route('seller.orders.status', $order) }}"
                                    method="POST">

                                    @csrf
                                    @method('PATCH')


                                    <input type="hidden" name="status" value="cancelled">


                                    <button type="submit"
                                        onclick="return confirm(
                                            'Batalkan pesanan ini?'
                                        )"
                                        class="h-11 w-full
                                               rounded-xl
                                               bg-[#FAEDEC]
                                               text-sm font-bold
                                               text-[#A65954]
                                               transition
                                               hover:bg-[#F5DEDB]">

                                        Batalkan Pesanan

                                    </button>

                                </form>

                            </div>



                            {{-- ========================================= --}}
                            {{-- PROCESSING --}}
                            {{-- ========================================= --}}
                        @elseif ($order->status === 'processing')
                            <div class="mt-5 space-y-3">

                                <form
                                    action="{{ route('seller.orders.status', $order) }}"
                                    method="POST">

                                    @csrf
                                    @method('PATCH')


                                    <input type="hidden" name="status" value="completed">


                                    <button type="submit"
                                        onclick="return confirm(
                                            'Tandai pesanan ini sebagai selesai?'
                                        )"
                                        class="inline-flex h-11
                                               w-full items-center
                                               justify-center gap-2
                                               rounded-xl
                                               bg-[#718268]
                                               px-4
                                               text-sm font-bold
                                               text-white
                                               transition
                                               hover:bg-[#65795E]">

                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">

                                            <path d="m5 12 4 4L19 6" />

                                        </svg>

                                        Selesaikan Pesanan

                                    </button>

                                </form>


                                <form
                                    action="{{ route('seller.orders.status', $order) }}"
                                    method="POST">

                                    @csrf
                                    @method('PATCH')


                                    <input type="hidden" name="status" value="cancelled">


                                    <button type="submit"
                                        onclick="return confirm(
                                            'Batalkan pesanan ini?'
                                        )"
                                        class="h-11 w-full
                                               rounded-xl
                                               bg-[#FAEDEC]
                                               text-sm font-bold
                                               text-[#A65954]
                                               transition
                                               hover:bg-[#F5DEDB]">

                                        Batalkan Pesanan

                                    </button>

                                </form>

                            </div>



                            {{-- ========================================= --}}
                            {{-- COMPLETED --}}
                            {{-- ========================================= --}}
                        @elseif ($order->status === 'completed' || $order->status === 'sold')
                            <div
                                class="mt-5 flex items-start gap-3
                                       rounded-2xl
                                       border border-[#D3DFCE]
                                       bg-[#EEF3EA]
                                       p-4">

                                <div
                                    class="flex size-8 shrink-0
                                           items-center justify-center
                                           rounded-lg
                                           bg-[#718268]
                                           text-white">

                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">

                                        <path d="m5 12 4 4L19 6" />

                                    </svg>

                                </div>


                                <div>

                                    <p
                                        class="text-sm font-bold
                                               text-[#65795E]">

                                        Pesanan selesai

                                    </p>

                                    <p
                                        class="mt-1 text-xs
                                               leading-5
                                               text-[#65795E]">

                                        Transaksi ini telah berhasil
                                        diselesaikan.

                                    </p>

                                </div>

                            </div>



                            {{-- ========================================= --}}
                            {{-- CANCELLED --}}
                            {{-- ========================================= --}}
                        @elseif ($order->status === 'cancelled')
                            <div
                                class="mt-5 flex items-start gap-3
                                       rounded-2xl
                                       border border-[#ECD2CF]
                                       bg-[#FAEDEC]
                                       p-4">

                                <div
                                    class="flex size-8 shrink-0
                                           items-center justify-center
                                           rounded-lg
                                           bg-[#A65954]
                                           text-white">

                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">

                                        <path d="m8 8 8 8" />
                                        <path d="m16 8-8 8" />

                                    </svg>

                                </div>


                                <div>

                                    <p
                                        class="text-sm font-bold
                                               text-[#A65954]">

                                        Pesanan dibatalkan

                                    </p>

                                    <p
                                        class="mt-1 text-xs
                                               leading-5
                                               text-[#A65954]">

                                        Pesanan ini sudah tidak dapat diproses.

                                    </p>

                                </div>

                            </div>
                        @endif

                    </div>

                </section>

            </aside>

        </div>

    </div>

@endsection
