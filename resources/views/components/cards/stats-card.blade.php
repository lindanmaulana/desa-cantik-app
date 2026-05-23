@props([
    'title',
    'value',
    'icon',
    'color' => 'bg-purple-500'
])

<div {{ $attributes->merge(['class' => "$color p-6 max-md:p-3 rounded-2xl max-md:rounded-xl text-white shadow-lg flex flex-col justify-between min-w-[250px]"]) }}>
    <div class="flex items-center space-x-3 opacity-90">
        <div class="flex items-center justify-center w-6 h-6 text-white">
            <x-dynamic-component :component="$icon" class="w-full h-full" />
        </div>
        <span class="text-sm max-md:text-xs font-medium">{{ $title }}</span>
    </div>
    <div class="mt-4">
        <h2 class="text-4xl max-md:text-xl font-bold">{{ $value }}</h2>
    </div>
</div>
