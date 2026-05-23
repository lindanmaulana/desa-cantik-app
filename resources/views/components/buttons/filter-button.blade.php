@props(['active' => false, 'icon'])

<button
    {{ $attributes->merge([
        'class' =>
            'flex items-center gap-2 px-4 py-2 rounded-full border transition-all duration-200 text-sm max-md:text-xs font-medium ' .
            ($active
                ? 'bg-primary border-primary text-white shadow-md'
                : 'bg-white border-gray-200 text-gray-700 hover:border-primary hover:bg-quaternary'),
    ]) }}>
    {{-- Memanggil Blade Icon secara dinamis --}}
    <x-dynamic-component :component="$icon" class="w-4 h-4 {{ $active ? 'text-white' : 'text-gray-500' }}" />

    <span>{{ $slot }}</span>
</button>
