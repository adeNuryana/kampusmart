@php
    $adminWhatsapp = preg_replace(
        '/\D+/',
        '',
        (string) ($siteSetting?->admin_whatsapp ?? config('app.admin_whatsapp', '')),
    );

    if (str_starts_with($adminWhatsapp, '0')) {
        $adminWhatsapp = '62' . substr($adminWhatsapp, 1);
    } elseif (str_starts_with($adminWhatsapp, '8')) {
        $adminWhatsapp = '62' . $adminWhatsapp;
    }

    $siteName = $siteSetting?->site_name ?? 'KampusMart';
    $message = urlencode("Halo Admin {$siteName}, saya membutuhkan bantuan.");
    $whatsappUrl = $adminWhatsapp ? "https://wa.me/{$adminWhatsapp}?text={$message}" : null;
@endphp

@if ($whatsappUrl)
    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
        title="Hubungi Admin melalui WhatsApp" aria-label="Hubungi Admin melalui WhatsApp"
        class="group fixed bottom-24 right-4 z-40 flex size-14 items-center justify-center
               rounded-full bg-[#25D366] text-white shadow-xl shadow-emerald-950/20
               ring-4 ring-white/90 transition hover:-translate-y-1 hover:bg-[#1EBE5D]
               hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-emerald-200
               md:bottom-6 md:right-6">

        <svg class="size-7" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path
                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.198-.347.223-.644.075-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.297-.497.1-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.371-.272.297-1.04 1.016-1.04 2.479s1.065 2.875 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.693.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.981.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.9 6.994c-.003 5.45-4.437 9.884-9.892 9.884m8.413-18.297A11.815 11.815 0 0 0 12.055 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.689 1.448h.005c6.557 0 11.892-5.335 11.895-11.893a11.821 11.821 0 0 0-3.487-8.413Z" />
        </svg>

        <span
            class="pointer-events-none absolute right-full mr-3 hidden whitespace-nowrap rounded-lg
                   bg-slate-900 px-3 py-2 text-xs font-bold text-white opacity-0 shadow-lg
                   transition group-hover:opacity-100 lg:block">
            Hubungi Admin
        </span>

    </a>
@endif
