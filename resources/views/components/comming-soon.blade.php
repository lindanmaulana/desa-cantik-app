@props([
'title',
'description',
'icon'
])


<div class="flex flex-col items-center justify-center w-full h-full gap-6 ">
    <div class="flex items-center justify-center rounded-full size-20 bg-tertiary">
        <x-dynamic-component :component="$icon" class="size-10 text-slate-600" />
    </div>

    <div class="flex flex-col items-center justify-center gap-2">
        <h4 class="text-2xl font-bold">{{ $title }}</h4>
        <p class="mb-2 text-base text-slate-600">{{ $description }}</p>

        <div class="flex items-center gap-1 px-4 py-1 text-sm font-semibold bg-yellow-500 rounded-full">
            <x-bi-hourglass-split class="size-3" />
            <span class="block mb-px">Segera Hadir</span>
        </div>
    </div>
</div>
