@php
    $errorMessage = session('error');

    if (! $errorMessage && isset($errors) && $errors->any()) {
        $errorMessage = $errors->first();
    }
@endphp

@if ($errorMessage)
    <div x-data="{ open: true }" x-cloak x-show="open" x-transition.opacity
        @keydown.escape.window="open = false"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-slate-950/60 p-4 backdrop-blur-sm"
        role="alertdialog" aria-modal="true" aria-labelledby="flash-error-title">
        <div x-show="open" x-transition.scale.origin.center
            class="w-full max-w-md overflow-hidden rounded-3xl border border-red-100 bg-white shadow-2xl">
            <div class="h-1.5 bg-red-500"></div>

            <div class="p-6 sm:p-8">
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-100 text-red-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v4m0 4h.01M10.3 3.8 2.4 17.5A2 2 0 0 0 4.1 20h15.8a2 2 0 0 0 1.7-2.5L13.7 3.8a2 2 0 0 0-3.4 0Z" />
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <h2 id="flash-error-title" class="text-lg font-bold text-slate-900">Terjadi kesalahan</h2>
                        <p class="mt-2 text-sm leading-6 text-slate-600">{{ $errorMessage }}</p>
                    </div>
                </div>

                <button type="button" @click="open = false"
                    class="mt-6 w-full rounded-2xl bg-red-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-200">
                    Mengerti
                </button>
            </div>
        </div>
    </div>
@endif
