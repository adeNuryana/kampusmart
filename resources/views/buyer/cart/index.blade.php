@extends('layouts.public')

@section('title', 'Keranjang - KampusMart')

@section('content')

    <div
        class="min-h-screen
               bg-gradient-to-br
               from-[#FBF8F5]
               via-[#FAF5F1]
               to-[#F4EAE2]">

        <main
            class="mx-auto
                   max-w-7xl
                   px-4
                   py-6
                   pb-28
                   sm:px-5
                   sm:py-8
                   md:pb-10">


            {{-- ===================================================== --}}
            {{-- HEADER --}}
            {{-- ===================================================== --}}

            <section
                class="relative
                       mb-5
                       overflow-hidden
                       rounded-3xl
                       border
                       border-[#E6D8CD]
                       bg-gradient-to-br
                       from-white
                       via-[#FBF8F5]
                       to-[#F4EAE2]
                       p-5
                       shadow-sm
                       sm:p-6">


                {{-- DECORATION --}}

                <div
                    class="pointer-events-none
                           absolute
                           -right-20
                           -top-20
                           size-52
                           rounded-full
                           bg-[#C89B55]/10
                           blur-3xl">
                </div>


                <div
                    class="relative
                           flex
                           flex-col
                           gap-5
                           sm:flex-row
                           sm:items-center
                           sm:justify-between">


                    <div>

                        <div
                            class="inline-flex
                                   items-center
                                   gap-2
                                   rounded-full
                                   bg-[#F4EAE2]
                                   px-3
                                   py-1.5
                                   text-xs
                                   font-bold
                                   text-[#4371d1]">

                            <i class="fa-solid fa-cart-shopping"></i>

                            Belanja

                        </div>


                        <h1
                            class="mt-3
                                   text-2xl
                                   font-black
                                   tracking-tight
                                   text-slate-900
                                   sm:text-3xl">

                            Keranjang Saya

                        </h1>


                        <p
                            class="mt-2
                                   max-w-2xl
                                   text-sm
                                   leading-6
                                   text-slate-500">

                            Produk dikelompokkan berdasarkan penjual.
                            Kamu dapat membuat pesanan dari satu toko
                            terlebih dahulu.

                        </p>

                    </div>


                    {{-- SUMMARY MINI --}}

                    @if (!$sellerGroups->isEmpty())
                        <div
                            class="flex
                                   shrink-0
                                   items-center
                                   gap-3">


                            <div
                                class="rounded-2xl
                                       border
                                       border-[#E5D8CE]
                                       bg-white
                                       px-4
                                       py-3
                                       text-center
                                       shadow-sm">

                                <p
                                    class="text-xl
                                           font-black
                                           text-[#4371d1]">

                                    {{ $cartItems->sum('quantity') }}

                                </p>

                                <p class="text-[10px]
                                           text-slate-400">

                                    Item

                                </p>

                            </div>


                            <div
                                class="rounded-2xl
                                       border
                                       border-[#D7E1D2]
                                       bg-[#F1F5ED]
                                       px-4
                                       py-3
                                       text-center">

                                <p
                                    class="text-xl
                                           font-black
                                           text-[#65795E]">

                                    {{ $sellerGroups->count() }}

                                </p>

                                <p class="text-[10px]
                                           text-slate-400">

                                    Toko

                                </p>

                            </div>

                        </div>
                    @endif

                </div>

            </section>





            {{-- ===================================================== --}}
            {{-- VALIDATION ERRORS --}}
            {{-- ===================================================== --}}

            @if ($errors->any())

                <div
                    class="mb-5
                           rounded-2xl
                           border
                           border-[#E9C9C5]
                           bg-[#FAEDEC]
                           px-4
                           py-4
                           text-sm
                           text-[#A65954]">

                    <div
                        class="mb-2
                               flex
                               items-center
                               gap-2
                               font-semibold">

                        <i class="fa-solid fa-triangle-exclamation"></i>

                        Periksa kembali data berikut

                    </div>


                    <ul
                        class="list-disc
                               space-y-1
                               pl-5
                               text-xs">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif



            {{-- ===================================================== --}}
            {{-- EMPTY CART --}}
            {{-- ===================================================== --}}

            @if ($sellerGroups->isEmpty())

                <section
                    class="relative
                           overflow-hidden
                           rounded-3xl
                           border
                           border-[#E5D8CE]
                           bg-white
                           px-6
                           py-16
                           text-center
                           shadow-sm">


                    <div
                        class="pointer-events-none
                               absolute
                               left-1/2
                               top-10
                               size-52
                               -translate-x-1/2
                               rounded-full
                               bg-[#C89B55]/10
                               blur-3xl">
                    </div>


                    <div class="relative">


                        <div
                            class="mx-auto
                                   flex
                                   size-20
                                   items-center
                                   justify-center
                                   rounded-3xl
                                   bg-gradient-to-br
                                   from-[#F4EAE2]
                                   to-[#E9D8CB]
                                   text-3xl
                                   text-[#4371d1]
                                   shadow-sm">

                            <i class="fa-solid fa-cart-shopping"></i>

                        </div>


                        <h2
                            class="mt-6
                                   text-xl
                                   font-black
                                   text-slate-900">

                            Keranjang masih kosong

                        </h2>


                        <p
                            class="mx-auto
                                   mt-2
                                   max-w-md
                                   text-sm
                                   leading-6
                                   text-slate-500">

                            Tambahkan produk yang kamu inginkan
                            terlebih dahulu untuk mulai berbelanja.

                        </p>


                        <a href="{{ route('buyer.products.index') }}"
                            class="mt-6
                                   inline-flex
                                   h-11
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
                                   hover:shadow-xl">

                            <i class="fa-solid fa-bag-shopping"></i>

                            Cari Produk

                        </a>

                    </div>

                </section>
            @else
                {{-- ================================================= --}}
                {{-- CART CONTENT --}}
                {{-- ================================================= --}}

                <div
                    class="grid
                           gap-5
                           lg:grid-cols-[minmax(0,1fr)_320px]">


                    {{-- ================================================= --}}
                    {{-- SELLER GROUPS --}}
                    {{-- ================================================= --}}

                    <div class="space-y-5">


                        @foreach ($sellerGroups as $sellerId => $items)
                            @php

                                $firstItem = $items->first();

                                $seller = $firstItem?->product?->user;

                                $storeName = $seller?->sellerProfile?->store_name ?? ($seller?->name ?? 'Penjual');

                                $storePhoto = $seller?->sellerProfile?->photo;

                                $sellerSubtotal = $sellerSubtotals[$sellerId] ?? 0;

                            @endphp



                            <section
                                class="relative
                                       overflow-hidden
                                       rounded-3xl
                                       border
                                       border-[#E5D8CE]
                                       bg-white
                                       shadow-sm">


                                {{-- ================================================= --}}
                                {{-- SELLER HEADER --}}
                                {{-- ================================================= --}}

                                <div
                                    class="relative
                                           flex
                                           items-center
                                           justify-between
                                           gap-4
                                           border-b
                                           border-[#EFE4DC]
                                           bg-gradient-to-r
                                           from-[#FBF8F5]
                                           via-white
                                           to-[#F4EAE2]
                                           px-4
                                           py-4
                                           sm:px-5">


                                    <div
                                        class="flex
                                               min-w-0
                                               items-center
                                               gap-3">


                                        {{-- STORE PHOTO --}}

                                        @if ($storePhoto)
                                            <img src="{{ asset('storage/' . $storePhoto) }}" alt="{{ $storeName }}"
                                                class="size-12
                                                       shrink-0
                                                       rounded-full
                                                       border-2
                                                       border-white
                                                       object-cover
                                                       shadow-sm">
                                        @else
                                            <div
                                                class="flex
                                                       size-12
                                                       shrink-0
                                                       items-center
                                                       justify-center
                                                       rounded-full
                                                       bg-gradient-to-br
                                                       from-[#0a1d45]
                                                       via-[#4371d1]
                                                       to-[#4371d1]
                                                       font-black
                                                       text-white
                                                       shadow-sm">

                                                {{ strtoupper(substr($storeName, 0, 1)) }}

                                            </div>
                                        @endif



                                        {{-- STORE INFO --}}

                                        <div class="min-w-0">

                                            <div
                                                class="flex
                                                       items-center
                                                       gap-2">

                                                <i
                                                    class="fa-solid
                                                           fa-store
                                                           text-xs
                                                           text-[#C8795A]">
                                                </i>

                                                <p
                                                    class="truncate
                                                           text-sm
                                                           font-bold
                                                           text-slate-900">

                                                    {{ $storeName }}

                                                </p>

                                            </div>


                                            <p
                                                class="mt-1
                                                       truncate
                                                       text-xs
                                                       text-slate-400">

                                                {{ $seller?->name ?? '-' }}

                                            </p>

                                        </div>

                                    </div>



                                    {{-- PRODUCT COUNT --}}

                                    <span
                                        class="shrink-0
                                               rounded-full
                                               bg-[#F4EAE2]
                                               px-3
                                               py-1.5
                                               text-[10px]
                                               font-bold
                                               text-[#4371d1]
                                               sm:text-xs">

                                        {{ $items->count() }}
                                        produk

                                    </span>

                                </div>



                                {{-- ================================================= --}}
                                {{-- PRODUCT ITEMS --}}
                                {{-- ================================================= --}}

                                <div class="divide-y
                                           divide-[#F0E7E0]">


                                    @foreach ($items as $item)
                                        @php

                                            $product = $item->product;

                                            $itemSubtotal = $product->price * $item->quantity;

                                        @endphp



                                        <article x-data="{
                                            quantity: {{ (int) $item->quantity }},
                                            price: {{ (float) $product->price }},
                                            maxStock: {{ (int) $product->stock }},
                                            saving: false,

                                            formatPrice(value) {
                                                return new Intl.NumberFormat(
                                                    'id-ID', {
                                                        style: 'currency',
                                                        currency: 'IDR',
                                                        minimumFractionDigits: 0
                                                    }
                                                ).format(value);
                                            },

                                            updateCart() {
                                                if (this.quantity < 1) {
                                                    this.quantity = 1;
                                                }

                                                if (this.quantity > this.maxStock) {
                                                    this.quantity = this.maxStock;
                                                }

                                                this.saving = true;

                                                this.$nextTick(() => {
                                                    this.$refs.updateForm.requestSubmit();
                                                });
                                            },

                                            decrease() {
                                                if (this.quantity > 1) {
                                                    this.quantity--;
                                                    this.updateCart();
                                                }
                                            },

                                            increase() {
                                                if (this.quantity < this.maxStock) {
                                                    this.quantity++;
                                                    this.updateCart();
                                                }
                                            }
                                        }"
                                            class="group
           p-4
           transition
           hover:bg-[#FCF9F7]
           sm:p-5">


                                            <div
                                                class="flex
                                                       gap-3
                                                       sm:gap-4">


                                                {{-- ================================= --}}
                                                {{-- IMAGE --}}
                                                {{-- ================================= --}}

                                                <a href="{{ route('buyer.products.show', $product) }}" class="shrink-0">


                                                    @if ($product->image)
                                                        <div
                                                            class="size-20
                                                                   overflow-hidden
                                                                   rounded-2xl
                                                                   bg-[#F4EFEB]
                                                                   sm:size-24">

                                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                                alt="{{ $product->name }}"
                                                                class="size-full
                                                                       object-cover
                                                                       transition
                                                                       duration-500
                                                                       group-hover:scale-105">

                                                        </div>
                                                    @else
                                                        <div
                                                            class="flex
                                                                   size-20
                                                                   items-center
                                                                   justify-center
                                                                   rounded-2xl
                                                                   bg-gradient-to-br
                                                                   from-[#F5EFEB]
                                                                   to-[#EEE4DC]
                                                                   text-[#C7B4A7]
                                                                   sm:size-24">

                                                            <i
                                                                class="fa-regular
                                                                       fa-image
                                                                       text-3xl">
                                                            </i>

                                                        </div>
                                                    @endif

                                                </a>



                                                {{-- ================================= --}}
                                                {{-- PRODUCT INFO --}}
                                                {{-- ================================= --}}

                                                <div
                                                    class="min-w-0
                                                           flex-1">


                                                    <a href="{{ route('buyer.products.show', $product) }}"
                                                        class="line-clamp-2
                                                               text-sm
                                                               font-bold
                                                               leading-5
                                                               text-slate-800
                                                               transition
                                                               hover:text-[#4371d1]
                                                               sm:text-base">

                                                        {{ $product->name }}

                                                    </a>


                                                    <div
                                                        class="mt-1.5
                                                               flex
                                                               flex-wrap
                                                               items-center
                                                               gap-2">


                                                        <span
                                                            class="rounded-md
                                                                   bg-[#FAF6F3]
                                                                   px-2
                                                                   py-1
                                                                   text-[9px]
                                                                   font-medium
                                                                   text-slate-500
                                                                   sm:text-[10px]">

                                                            {{ $product->category?->name ?? 'Tanpa kategori' }}

                                                        </span>


                                                        <span
                                                            class="text-[10px]
                                                                   text-[#65795E]">

                                                            <i
                                                                class="fa-solid
                                                                       fa-circle-check
                                                                       mr-1">
                                                            </i>

                                                            Stok
                                                            {{ $product->stock }}

                                                        </span>

                                                    </div>



                                                    {{-- PRICE --}}

                                                    <p
                                                        class="mt-2
                                                               text-sm
                                                               font-black
                                                               text-[#4371d1]
                                                               sm:text-base">

                                                        Rp{{ number_format($product->price, 0, ',', '.') }}

                                                    </p>



                                                    {{-- ================================= --}}
                                                    {{-- MOBILE CONTROLS --}}
                                                    {{-- ================================= --}}

                                                    <div
                                                        class="mt-3
                                                               flex
                                                               flex-wrap
                                                               items-end
                                                               justify-between
                                                               gap-3
                                                               sm:hidden">




                                                        {{-- ================================================= --}}
                                                        {{-- QUANTITY --}}
                                                        {{-- ================================================= --}}

                                                        <div
                                                            class="mt-3
           flex
           flex-wrap
           items-center
           justify-between
           gap-3
           sm:mt-0
           sm:block">


                                                            <form x-ref="updateForm"
                                                                action="{{ route('buyer.cart.update', $item) }}"
                                                                method="POST">

                                                                @csrf
                                                                @method('PATCH')


                                                                <input type="hidden" name="quantity"
                                                                    :value="quantity">


                                                                <div
                                                                    class="flex
                   items-center
                   overflow-hidden
                   rounded-xl
                   border
                   border-[#E5D5C9]
                   bg-white
                   shadow-sm">


                                                                    {{-- MINUS --}}

                                                                    <button type="button" @click="decrease()"
                                                                        :disabled="quantity <= 1 || saving"
                                                                        class="flex
                       size-10
                       items-center
                       justify-center
                       text-[#4371d1]
                       transition
                       hover:bg-[#F4EAE2]
                       disabled:cursor-not-allowed
                       disabled:text-slate-300">

                                                                        <i
                                                                            class="fa-solid
                           fa-minus
                           text-[10px]">
                                                                        </i>

                                                                    </button>



                                                                    {{-- QUANTITY --}}

                                                                    <input type="number" x-model.number="quantity"
                                                                        min="1" :max="maxStock"
                                                                        @input.debounce.500ms="updateCart()"
                                                                        class="h-10
                       w-14
                       border-x
                       border-y-0
                       border-[#E5D5C9]
                       bg-white
                       px-1
                       text-center
                       text-sm
                       font-bold
                       text-[#0a1d45]
                       outline-none
                       focus:ring-0">



                                                                    {{-- PLUS --}}

                                                                    <button type="button" @click="increase()"
                                                                        :disabled="quantity >= maxStock ||
                                                                            saving"
                                                                        class="flex
                       size-10
                       items-center
                       justify-center
                       text-[#4371d1]
                       transition
                       hover:bg-[#F4EAE2]
                       disabled:cursor-not-allowed
                       disabled:text-slate-300">

                                                                        <i
                                                                            class="fa-solid
                           fa-plus
                           text-[10px]">
                                                                        </i>

                                                                    </button>

                                                                </div>

                                                            </form>



                                                        </div>


                                                        <div class="text-right">

                                                            <p
                                                                class="text-[9px]
                                                                       text-slate-400">

                                                                Subtotal

                                                            </p>

                                                            <div class="text-right">

                                                                <p class="text-[10px]
               text-slate-400">

                                                                    Subtotal

                                                                </p>


                                                                <p class="mt-1
               text-sm
               font-black
               text-[#0a1d45]
               sm:text-base"
                                                                    x-text="
            formatPrice(
                quantity * price
            )
        ">

                                                                    Rp{{ number_format($itemSubtotal, 0, ',', '.') }}

                                                                </p>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>



                                                {{-- ================================= --}}
                                                {{-- DESKTOP QUANTITY --}}
                                                {{-- ================================= --}}

                                                <div
                                                    class="hidden
                                                           shrink-0
                                                           items-center
                                                           sm:flex">


                                                    <form action="{{ route('buyer.cart.update', $item) }}" method="POST"
                                                        class="flex
                                                               items-center
                                                               overflow-hidden
                                                               rounded-xl
                                                               border
                                                               border-[#E5D5C9]
                                                               bg-white
                                                               shadow-sm">

                                                        @csrf
                                                        @method('PATCH')


                                                        <input type="number" x-model.number="quantity" min="1"
                                                            :max="maxStock" @input.debounce.500ms="updateCart()"
                                                            class="h-10
           w-14
           border-x
           border-y-0
           border-[#E5D5C9]
           bg-white
           px-1
           text-center
           text-sm
           font-bold
           text-[#0a1d45]
           outline-none
           focus:ring-0">
                                                    </form>

                                                </div>



                                                {{-- ================================= --}}
                                                {{-- DESKTOP SUBTOTAL --}}
                                                {{-- ================================= --}}

                                                <div
                                                    class="hidden
                                                           w-32
                                                           shrink-0
                                                           text-right
                                                           sm:block">

                                                    <p
                                                        class="text-[10px]
                                                               text-slate-400">

                                                        Subtotal

                                                    </p>


                                                    <div class="text-right">

                                                        <p class="text-[10px]
               text-slate-400">

                                                            Subtotal

                                                        </p>


                                                        <p class="mt-1
               text-sm
               font-black
               text-[#0a1d45]
               sm:text-base"
                                                            x-text="
            formatPrice(
                quantity * price
            )
        ">

                                                            Rp{{ number_format($itemSubtotal, 0, ',', '.') }}

                                                        </p>

                                                    </div>

                                                </div>



                                                {{-- ================================= --}}
                                                {{-- DELETE --}}
                                                {{-- ================================= --}}

                                                <form action="{{ route('buyer.cart.destroy', $item) }}" method="POST"
                                                    class="shrink-0"
                                                    onsubmit="return confirm(
                                                        'Hapus produk ini dari keranjang?'
                                                    )">

                                                    @csrf
                                                    @method('DELETE')


                                                    <button type="submit" title="Hapus Produk"
                                                        class="flex
                                                               size-9
                                                               items-center
                                                               justify-center
                                                               rounded-xl
                                                               text-slate-400
                                                               transition
                                                               hover:bg-[#FAEDEC]
                                                               hover:text-[#A65954]
                                                               sm:size-10">

                                                        <i
                                                            class="fa-regular
                                                                   fa-trash-can">
                                                        </i>

                                                    </button>

                                                </form>

                                            </div>

                                        </article>
                                    @endforeach

                                </div>



                                {{-- ================================================= --}}
                                {{-- SELLER FOOTER --}}
                                {{-- ================================================= --}}

                                <div
                                    class="flex
                                           flex-col
                                           gap-4
                                           border-t
                                           border-[#EFE4DC]
                                           bg-gradient-to-r
                                           from-[#FCF9F7]
                                           to-[#F8F0EA]
                                           px-4
                                           py-5
                                           sm:flex-row
                                           sm:items-center
                                           sm:justify-between
                                           sm:px-5">


                                    <div>

                                        <p
                                            class="text-xs
                                                   text-slate-400">

                                            Total dari

                                            <span
                                                class="font-semibold
                                                       text-slate-600">

                                                {{ $storeName }}

                                            </span>

                                        </p>


                                        <p
                                            class="mt-1
                                                   text-xl
                                                   font-black
                                                   text-[#0a1d45]">

                                            Rp{{ number_format($sellerSubtotal, 0, ',', '.') }}

                                        </p>

                                    </div>



                                    {{-- CHECKOUT PER SELLER --}}

                                    <a href="{{ route('buyer.checkout.index', $sellerId) }}"
                                        class="group
                                               inline-flex
                                               h-11
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
                                               shadow-[#4371d1]/15
                                               transition
                                               duration-300
                                               hover:-translate-y-0.5
                                               hover:shadow-xl">

                                        Buat Pesanan

                                        <i
                                            class="fa-solid
                                                   fa-arrow-right
                                                   text-xs
                                                   transition
                                                   group-hover:translate-x-1">
                                        </i>

                                    </a>

                                </div>

                            </section>
                        @endforeach

                    </div>



                    {{-- ================================================= --}}
                    {{-- CART SUMMARY --}}
                    {{-- ================================================= --}}

                    <aside>


                        <div
                            class="sticky
                                   top-24
                                   overflow-hidden
                                   rounded-3xl
                                   border
                                   border-[#E5D8CE]
                                   bg-white
                                   shadow-sm">


                            {{-- SUMMARY HEADER --}}

                            <div
                                class="relative
                                       overflow-hidden
                                       border-b
                                       border-[#EFE4DC]
                                       bg-gradient-to-br
                                       from-[#0a1d45]
                                       via-[#4371d1]
                                       to-[#4371d1]
                                       p-5
                                       text-white">


                                <div
                                    class="pointer-events-none
                                           absolute
                                           -right-10
                                           -top-10
                                           size-28
                                           rounded-full
                                           bg-[#E3B66D]/15">
                                </div>


                                <div
                                    class="relative
                                           flex
                                           items-center
                                           gap-3">


                                    <div
                                        class="flex
                                               size-10
                                               shrink-0
                                               items-center
                                               justify-center
                                               rounded-xl
                                               bg-white/10
                                               backdrop-blur">

                                        <i class="fa-solid
                                                   fa-receipt">
                                        </i>

                                    </div>


                                    <div>

                                        <h2 class="font-bold">

                                            Ringkasan Keranjang

                                        </h2>

                                        <p
                                            class="mt-0.5
                                                   text-[10px]
                                                   text-[#E8D6CA]">

                                            Detail belanja kamu

                                        </p>

                                    </div>

                                </div>

                            </div>



                            {{-- SUMMARY BODY --}}

                            <div class="p-5">


                                <div class="space-y-4
                                           text-sm">


                                    {{-- STORE COUNT --}}

                                    <div
                                        class="flex
                                               items-center
                                               justify-between
                                               gap-4">


                                        <div
                                            class="flex
                                                   items-center
                                                   gap-2
                                                   text-slate-500">

                                            <div
                                                class="flex
                                                       size-8
                                                       items-center
                                                       justify-center
                                                       rounded-lg
                                                       bg-[#F4EAE2]
                                                       text-xs
                                                       text-[#4371d1]">

                                                <i class="fa-solid fa-store"></i>

                                            </div>

                                            Jumlah Toko

                                        </div>


                                        <span
                                            class="font-bold
                                                   text-slate-800">

                                            {{ $sellerGroups->count() }}

                                        </span>

                                    </div>



                                    {{-- PRODUCT COUNT --}}

                                    <div
                                        class="flex
                                               items-center
                                               justify-between
                                               gap-4">


                                        <div
                                            class="flex
                                                   items-center
                                                   gap-2
                                                   text-slate-500">

                                            <div
                                                class="flex
                                                       size-8
                                                       items-center
                                                       justify-center
                                                       rounded-lg
                                                       bg-[#EEF3EA]
                                                       text-xs
                                                       text-[#65795E]">

                                                <i
                                                    class="fa-solid
                                                           fa-bag-shopping">
                                                </i>

                                            </div>

                                            Total Item

                                        </div>


                                        <span
                                            class="font-bold
                                                   text-slate-800">

                                            {{ $cartItems->sum('quantity') }}

                                        </span>

                                    </div>



                                    {{-- DIVIDER --}}

                                    <div
                                        class="border-t
                                               border-dashed
                                               border-[#DED0C5]">
                                    </div>



                                    {{-- TOTAL --}}

                                    <div
                                        class="flex
                                               items-end
                                               justify-between
                                               gap-3">

                                        <div>

                                            <p
                                                class="text-xs
                                                       font-medium
                                                       text-slate-500">

                                                Total Keranjang

                                            </p>

                                            <p
                                                class="mt-1
                                                       text-[10px]
                                                       text-slate-400">

                                                Belum termasuk biaya lainnya

                                            </p>

                                        </div>


                                        <span
                                            class="text-xl
                                                   font-black
                                                   text-[#0a1d45]">

                                            Rp{{ number_format($subtotal, 0, ',', '.') }}

                                        </span>

                                    </div>

                                </div>



                                {{-- INFO CHECKOUT --}}

                                <div
                                    class="mt-5
                                           flex
                                           gap-3
                                           rounded-2xl
                                           border
                                           border-[#D7E1D2]
                                           bg-gradient-to-br
                                           from-[#F1F5ED]
                                           to-[#E7EFE3]
                                           p-4">


                                    <div
                                        class="flex
                                               size-8
                                               shrink-0
                                               items-center
                                               justify-center
                                               rounded-lg
                                               bg-[#7F9275]
                                               text-xs
                                               text-white">

                                        <i
                                            class="fa-solid
                                                   fa-circle-info">
                                        </i>

                                    </div>


                                    <p
                                        class="text-xs
                                               leading-5
                                               text-slate-600">

                                        Checkout dilakukan

                                        <strong class="text-[#65795E]">

                                            satu toko

                                        </strong>

                                        dalam satu pesanan. Produk dari
                                        toko lain tetap tersimpan di
                                        keranjang.

                                    </p>

                                </div>



                                {{-- CONTINUE SHOPPING --}}

                                <a href="{{ route('buyer.products.index') }}"
                                    class="mt-4
                                           flex
                                           w-full
                                           items-center
                                           justify-center
                                           gap-2
                                           rounded-xl
                                           border
                                           border-[#DCC9BB]
                                           bg-white
                                           px-4
                                           py-2.5
                                           text-xs
                                           font-bold
                                           text-[#4371d1]
                                           transition
                                           hover:bg-[#FBF4EF]">

                                    <i
                                        class="fa-solid
                                               fa-arrow-left
                                               text-[10px]">
                                    </i>

                                    Lanjut Belanja

                                </a>

                            </div>

                        </div>

                    </aside>

                </div>

            @endif

        </main>

    </div>

@endsection
