@props(['active' => false, 'icon'])

<button {{ $attributes->merge([
    'class' => 'flex items-center gap-2 px-4 py-2 rounded-full border transition-all duration-200 text-sm font-medium ' .
    ($active
        ? 'bg-indigo-600 border-indigo-600 text-white shadow-md'
        : 'bg-white border-gray-200 text-gray-700 hover:border-indigo-300 hover:bg-indigo-50')
]) }}>
    {{-- Memanggil Blade Icon secara dinamis --}}
    <x-dynamic-component :component="$icon" class="w-4 h-4 {{ $active ? 'text-white' : 'text-gray-500' }}" />

    <span>{{ $slot }}</span>
</button>
