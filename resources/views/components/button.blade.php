@props(['variant' => 'primary', 'size' => 'md'])

@php
    $colors = [
        'primary' => 'bg-blue-500 text-white hover:bg-blue-600',
        'danger'  => 'bg-red-500 text-white hover:bg-red-600',
        'ghost'   => 'bg-transparent border border-gray-300',
        'outline' => 'border-1 border-slate-400 text-slate-400'
    ];

    $sizes = [
        'sm' => 'px-2 py-1 text-sm',
        'md' => 'px-4 py-2',
        'lg' => 'px-6 py-3 text-lg',
    ];
@endphp

<button {{ $attributes->merge(['class' => "rounded-lg font-bold " . $colors[$variant] . " " . $sizes[$size]]) }}>
    {{ $slot }}
</button>
