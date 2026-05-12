@props([
    'title',
    'value',
    'icon',
    'color' => 'bg-purple-500'
])

<div {{ $attributes->merge(['class' => "$color p-6 rounded-2xl text-white shadow-lg flex flex-col justify-between min-w-[250px]"]) }}>
    <div class="flex items-center space-x-2 opacity-80">
        <i class="{{ $icon }} text-lg"></i>
        <span class="text-sm font-medium">{{ $title }}</span>
    </div>
    <div class="mt-4">
        <h2 class="text-4xl font-bold">{{ $value }}</h2>
    </div>
</div>
