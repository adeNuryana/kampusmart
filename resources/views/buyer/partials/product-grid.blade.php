@if ($products->isNotEmpty())

    <div
        class="grid grid-cols-2 gap-3
               sm:grid-cols-3 sm:gap-4
               lg:grid-cols-5">

        @foreach ($products as $index => $product)

            @php

                $productImage =
                    $product->image
                    ?? $product->photo
                    ?? $product->thumbnail
                    ?? null;

                if ($productImage) {

                    $imageUrl =
                        \Illuminate\Support\Str::startsWith(
                            $productImage,
                            ['http://', 'https://']
                        )
                            ? $productImage
                            : asset('storage/' . $productImage);

                } else {

                    $imageUrl = null;

                }


                $colors = [
                    'bg-blue-50 text-blue-700',
                    'bg-violet-50 text-violet-700',
                    'bg-orange-50 text-orange-700',
                    'bg-emerald-50 text-emerald-700',
                    'bg-pink-50 text-pink-700',
                ];

                $color = $colors[$index % count($colors)];

            @endphp


            <a
                href="{{ route('buyer.products.show', $product) }}"
                class="group overflow-hidden
                       rounded-2xl
                       border border-slate-100
                       bg-white
                       transition duration-300
                       hover:-translate-y-1
                       hover:shadow-xl">


                {{-- FOTO --}}

                <div
                    class="relative aspect-square
                           overflow-hidden bg-slate-100">

                    @if ($imageUrl)

                        <img
                            src="{{ $imageUrl }}"
                            alt="{{ $product->name }}"
                            loading="lazy"
                            class="size-full object-cover
                                   transition duration-500
                                   group-hover:scale-105">

                    @else

                        <div
                            class="flex size-full
                                   items-center justify-center">

                            <i
                                class="fa-regular fa-image
                                       text-4xl text-slate-300">
                            </i>

                        </div>

                    @endif


                    @if ($product->category)

                        <span
                            class="absolute bottom-2 left-2
                                   max-w-[85%] truncate
                                   rounded-lg px-2 py-1
                                   text-[9px] font-semibold
                                   {{ $color }}">

                            {{ $product->category->name }}

                        </span>

                    @endif

                </div>


                {{-- INFORMASI --}}

                <div class="p-3 sm:p-4">

                    <h3
                        class="line-clamp-2
                               min-h-10
                               text-xs font-medium
                               leading-5
                               sm:text-sm">

                        {{ $product->name }}

                    </h3>


                    <p
                        class="mt-2
                               text-sm font-bold
                               text-[#0F2747]
                               sm:text-lg">

                        Rp{{ number_format(
                            $product->price ?? 0,
                            0,
                            ',',
                            '.'
                        ) }}

                    </p>


                    <div
                        class="mt-3 flex
                               items-center justify-between
                               gap-2">

                        <span
                            class="text-[10px]
                                   text-slate-500
                                   sm:text-xs">

                            Stok {{ $product->stock ?? 0 }}

                        </span>


                        @if ($product->user)

                            <span
                                class="max-w-24 truncate
                                       text-[9px]
                                       text-slate-400
                                       sm:text-[10px]">

                                <i
                                    class="fa-solid
                                           fa-store mr-1">
                                </i>

                                {{ $product->user->name }}

                            </span>

                        @endif

                    </div>

                </div>

            </a>

        @endforeach

    </div>

@else

    <div
        class="rounded-3xl
               border border-dashed
               border-slate-200
               bg-white py-14
               text-center">

        <div
            class="mx-auto flex
                   size-16 items-center
                   justify-center
                   rounded-2xl
                   bg-slate-100">

            <i
                class="fa-solid fa-box-open
                       text-2xl text-slate-400">
            </i>

        </div>

        <h3
            class="mt-4 font-bold
                   text-slate-700">

            Belum ada produk

        </h3>

        <p
            class="mt-1 text-sm
                   text-slate-500">

            Tidak ada produk dalam kategori ini.

        </p>

    </div>

@endif
