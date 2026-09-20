@auth
    @if (auth()->user()->role === 'buyer')
        <form
            action="{{ route('buyer.cart.store', $product) }}"
            method="POST"
        >
            @csrf

            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="redirect_to" value="home">

            <button
                type="submit"
                class="flex size-9 items-center justify-center rounded-full bg-white/95 text-[#315ebc] shadow-lg ring-1 ring-slate-200 transition hover:scale-105 hover:bg-[#315ebc] hover:text-white focus:outline-none focus:ring-2 focus:ring-[#315ebc] focus:ring-offset-2"
                title="Tambah ke keranjang"
                aria-label="Tambah {{ $product->name }} ke keranjang"
            >
                <i class="fa-solid fa-cart-plus text-xs"></i>
            </button>
        </form>
    @else
        <button
            type="button"
            disabled
            class="flex size-9 cursor-not-allowed items-center justify-center rounded-full bg-white/90 text-slate-300 shadow-md ring-1 ring-slate-200"
            title="Keranjang hanya tersedia untuk akun pembeli"
            aria-label="Keranjang hanya tersedia untuk akun pembeli"
        >
            <i class="fa-solid fa-cart-plus text-xs"></i>
        </button>
    @endif
@else
    <a
        href="{{ route('login') }}"
        class="flex size-9 items-center justify-center rounded-full bg-white/95 text-[#315ebc] shadow-lg ring-1 ring-slate-200 transition hover:scale-105 hover:bg-[#315ebc] hover:text-white focus:outline-none focus:ring-2 focus:ring-[#315ebc] focus:ring-offset-2"
        title="Masuk untuk menambah ke keranjang"
        aria-label="Masuk untuk menambah {{ $product->name }} ke keranjang"
    >
        <i class="fa-solid fa-cart-plus text-xs"></i>
    </a>
@endauth
