@props(['id', 'title', 'subtitle'])

<div class="bg-white p-6 max-md:p-3 rounded-3xl max-md:rounded-xl shadow-sm border border-gray-100">
    <div class="mb-6">
        <h3 class="text-xl max-md:text-base font-bold text-slate-800">{{ $title }}</h3>
        <p class="text-sm max-md:text-xs text-gray-400">{{ $subtitle }}</p>
    </div>

    <div class="text-center mb-4">
        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest text-center block">
            Distribusi Visual
        </span>
    </div>

    {{-- Tempat Chart --}}
    <div id="{{ $id }}"></div>
</div>
