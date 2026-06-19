@props([
    'url' => 'http://localhost:8000',
    'icon' => 'iconsax-out-global',
])

<a
    {{ $attributes->merge([
        'href' => "$url",
        'target' => '_blank',
        'class' =>
            'w-12 h-12 max-md:w-10 max-md:h-10 rounded-full bg-white border border-slate-200/60 text-slate-700 shadow-[0_4px_12px_rgba(0,0,0,0.05)] flex items-center justify-center transition-all duration-150 ease-out transform hover:-translate-y-1 hover:bg-slate-50 hover:text-primary hover:shadow-[0_6px_20px_rgba(0,0,0,0.1)] group',
    ]) }}>
    <x-dynamic-component :component="$icon"
        class="w-5 h-5 max-md:w-4 max-md:h-4 transition-colors duration-150 group-hover:text-primary" />
</a>
