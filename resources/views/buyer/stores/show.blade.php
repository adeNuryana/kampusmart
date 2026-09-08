@extends('layouts.public')

@section('title', ($seller->sellerProfile?->store_name ?? $seller->name) . ' - MarketKu')

@section('content')

    @php
        $profile = $seller->sellerProfile;

        $photo = $profile?->photo;

        if ($photo) {
            $photoUrl = \Illuminate\Support\Str::startsWith(
                $photo,
                ['http://', 'https://']
            )
                ? $photo
                : asset('storage/' . $photo);
        } else {
            $photoUrl = null;
        }
    @endphp


    <div
        class="min-h-screen
               bg-gradient-to-br
               from-[#FBF8F5]
               via-[#FAF5F1]
               to-[#F4EAE2]"
    >

        <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

            {{-- BACK --}}
            <div class="mb-5">

                <a
                    href="{{ route('buyer.dashboard') }}"
                    class="inline-flex items-center gap-2
                           text-sm font-semibold
                           text-slate-500
                           transition
                           hover:text-[#4371d1]"
                >
                    <i class="fa-solid fa-arrow-left"></i>

                    Dashboard
                </a>

            </div>


            {{-- STORE PROFILE --}}
            <section
                class="relative
                       overflow-hidden
                       rounded-3xl
                       bg-gradient-to-br
                       from-[#0a1d45]
                       via-[#254b94]
                       to-[#4371d1]
                       p-6
                       text-white
                       shadow-xl
                       sm:p-8"
            >

                <div
                    class="pointer-events-none
                           absolute
                           -right-20
                           -top-20
                           size-64
                           rounded-full
                           bg-white/10
                           blur-3xl"
                ></div>


                <div
                    class="relative
                           flex flex-col
                           gap-6
                           sm:flex-row
                           sm:items-center"
                >

                    {{-- FOTO --}}
                    @if ($photoUrl)

                        <img
                            src="{{ $photoUrl }}"
                            alt="{{ $seller->name }}"
                            class="size-24
                                   rounded-3xl
                                   border-4
                                   border-white/20
                                   object-cover
                                   shadow-xl"
                        >

                    @else

                        <div
                            class="flex size-24
                                   items-center
                                   justify-center
                                   rounded-3xl
                                   border
                                   border-white/20
                                   bg-white/10
                                   text-3xl"
                        >
                            <i class="fa-solid fa-store"></i>
                        </div>

                    @endif


                    {{-- INFO --}}
                    <div>

                        <p
                            class="text-xs
                                   font-semibold
                                   uppercase
                                   tracking-[0.2em]
                                   text-blue-200"
                        >
                            Seller MarketKu
                        </p>

                        <h1
                            class="mt-2
                                   text-2xl
                                   font-black
                                   sm:text-3xl"
                        >
                            {{ $profile?->store_name ?? $seller->name }}
                        </h1>

                        <p
                            class="mt-2
                                   text-sm
                                   text-blue-100"
                        >
                            <i class="fa-solid fa-user mr-1"></i>

                            {{ $seller->name }}
                        </p>

                        @if ($profile?->city)
                            <p
                                class="mt-2
                                       text-sm
                                       text-blue-100"
                            >
                                <i class="fa-solid fa-location-dot mr-1"></i>

                                {{ $profile->city }}
                            </p>
                        @endif

                    </div>

                </div>

            </section>


            {{-- PRODUCTS --}}
            <section class="mt-8">

                <div class="mb-5">

                    <h2
                        class="text-xl
                               font-black
                               text-slate-900"
                    >
                        Produk Toko
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Semua produk yang dijual oleh
                        {{ $profile?->store_name ?? $seller->name }}
                    </p>

                </div>


                <div
                    class="grid
                           grid-cols-2
                           gap-4
                           sm:grid-cols-3
                           lg:grid-cols-4"
                >

                    @forelse ($products as $product)

                        @php
                            $image =
                                $product->image
                                ?? $product->photo
                                ?? $product->thumbnail;

                            $imageUrl = $image
                                ? asset('storage/' . $image)
                                : null;
                        @endphp


                        <a
                            href="{{ route('buyer.products.show', $product) }}"
                            class="group
                                   overflow-hidden
                                   rounded-2xl
                                   border
                                   border-slate-200
                                   bg-white
                                   shadow-sm
                                   transition
                                   duration-300
                                   hover:-translate-y-1
                                   hover:shadow-xl"
                        >

                            <div
                                class="aspect-square
                                       overflow-hidden
                                       bg-slate-100"
                            >

                                @if ($imageUrl)

                                    <img
                                        src="{{ $imageUrl }}"
                                        alt="{{ $product->name }}"
                                        class="size-full
                                               object-cover
                                               transition
                                               duration-500
                                               group-hover:scale-105"
                                    >

                                @else

                                    <div
                                        class="flex size-full
                                               items-center
                                               justify-center
                                               text-4xl
                                               text-slate-300"
                                    >
                                        <i class="fa-regular fa-image"></i>
                                    </div>

                                @endif

                            </div>


                            <div class="p-4">

                                @if ($product->category)

                                    <p
                                        class="text-[10px]
                                               font-bold
                                               uppercase
                                               tracking-wider
                                               text-[#4371d1]"
                                    >
                                        {{ $product->category->name }}
                                    </p>

                                @endif


                                <h3
                                    class="mt-1
                                           line-clamp-2
                                           text-sm
                                           font-bold
                                           text-slate-800"
                                >
                                    {{ $product->name }}
                                </h3>


                                <p
                                    class="mt-3
                                           text-lg
                                           font-black
                                           text-[#0a1d45]"
                                >
                                    Rp{{ number_format(
                                        $product->price,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </p>


                                <p class="mt-2 text-xs text-slate-400">
                                    Stok {{ $product->stock }}
                                </p>

                            </div>

                        </a>

                    @empty

                        <div
                            class="col-span-full
                                   rounded-2xl
                                   border
                                   border-dashed
                                   border-slate-300
                                   bg-white
                                   px-6
                                   py-16
                                   text-center"
                        >

                            <i
                                class="fa-solid
                                       fa-box-open
                                       text-4xl
                                       text-slate-300"
                            ></i>

                            <h3
                                class="mt-4
                                       font-bold
                                       text-slate-800"
                            >
                                Belum ada produk
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Seller belum memiliki produk aktif.
                            </p>

                        </div>

                    @endforelse

                </div>


                @if ($products->hasPages())

                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>

                @endif

            </section>

        </main>

    </div>

@endsection
