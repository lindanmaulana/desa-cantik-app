@props(['variant' => 'primary', 'size' => 'md'])

@php
    $colors = [
        'primary' => 'bg-primary text-white hover:bg-secondary',
        'danger' => 'bg-red-500 text-white hover:bg-red-600',
        'ghost' => 'bg-transparent border border-quaternary hover:bg-primary/10',
        'ghostv2' => 'bg-transparent border border-quaternary hover:border-transparent hover:bg-secondary',
        'outline' => 'border-1 border-primary text-primary',
    ];

    $sizes = [
        'sm' => 'px-2 py-1 text-sm',
        'md' => 'px-4 py-2',
        'lg' => 'px-6 py-3 text-lg',
    ];
@endphp

<button
    {{ $attributes->merge(['type' => 'button'])->class(['rounded-lg font-bold', $colors[$variant] ?? $colors['primary'], $sizes[$size] ?? $sizes['md']]) }}>
    {{ $slot }}
</button>
