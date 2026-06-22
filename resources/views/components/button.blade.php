@props([
    'variant' => 'primary',
    'size' => 'md',
])

@php
    $baseClasses =
        'inline-flex items-center justify-center font-bold rounded-lg transition-all duration-200 active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-primary/40 disabled:opacity-50 disabled:pointer-events-none select-none';

    $colors = [
        'primary' => 'bg-primary text-white hover:bg-primary/90 shadow-sm shadow-primary/20',
        'danger' => 'bg-red-500 text-white hover:bg-red-600 shadow-sm shadow-red-500/20',
        'ghost' => 'max-md:w-full bg-transparent border border-textSecondary text-textPrimary hover:bg-textSecondary/10',
        'ghostv2' =>
            'bg-transparent border border-quaternary text-textPrimary hover:border-transparent hover:bg-secondary',
        'outline' => 'border border-primary text-primary hover:bg-primary/5',
        'secondary' => 'bg-secondary text-primary hover:bg-tertiary shadow-sm',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs gap-1.5',
        'md' => 'px-5 py-2.5 text-sm gap-2',
        'lg' => 'px-7 py-3 text-base gap-2.5',
    ];
@endphp

<button
    {{ $attributes->merge(['type' => 'button'])->class([$baseClasses, $colors[$variant] ?? $colors['primary'], $sizes[$size] ?? $sizes['md']]) }}>
    {{ $slot }}
</button>
