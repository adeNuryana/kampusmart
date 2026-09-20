@props(['user'])

@php
    $photo = $user?->photo;
    $avatarUrl = null;

    if ($photo) {
        $avatarUrl = str_starts_with($photo, 'http://') || str_starts_with($photo, 'https://')
            ? $photo
            : asset('storage/' . $photo);
    } elseif ($user?->google_avatar) {
        $avatarUrl = $user->google_avatar;
    }

    $initial = strtoupper(substr($user?->name ?? 'A', 0, 1));
@endphp

<div {{ $attributes->class(['flex shrink-0 items-center justify-center overflow-hidden']) }}>
    @if ($avatarUrl)
        <img src="{{ $avatarUrl }}" alt="Foto profil {{ $user?->name ?? 'pengguna' }}"
            referrerpolicy="no-referrer" class="h-full w-full object-cover">
    @else
        <span>{{ $initial }}</span>
    @endif
</div>
