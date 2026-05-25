@props([
    'url' => 'http://localhost:8000',
    'icon' => 'iconsax-out-global',
])

<a
    {{ $attributes->merge([
        'href' => "$url",
        'target' => '_blank',
        'class' =>
            'w-12 h-12 max-md:w-10 max-md:h-10 rounded-full bg-black/30 backdrop-blur-md text-white shadow-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110',
    ]) }}>
    <x-dynamic-component :component="$icon" class="w-5 h-5 max-md:w-4 max-md:h-4" />
</a>
