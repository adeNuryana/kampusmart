@if ($siteSetting?->favicon)
    <link rel="icon" href="{{ asset('storage/' . $siteSetting->favicon) }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/' . $siteSetting->favicon) }}">
@else
    <link rel="icon" href="{{ asset('favicon.ico') }}">
@endif
