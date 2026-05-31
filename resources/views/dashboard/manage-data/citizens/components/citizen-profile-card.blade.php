@props(['type' => 'educationProfile', 'title' => '', 'icon' => "iconsax-out-heart", 'color' => '', 'isValue' => false])

@php
$styleStatus = $isValue ? 'text-primary bg-primary/10' : 'text-slate-500 bg-slate-200';
$status = $isValue ? 'Terisi' : 'Belum Diisi';
@endphp

<article class="p-8 space-y-4 border shadow rounded-3xl">
    @if($type != 'childGrowthLogs')
    <header class="flex items-center justify-between">
        <h4 class="flex items-center gap-2 font-semibold"><x-dynamic-component :component="$icon" :class="$color . ' size-5'" {{ $attributes }} /> {{ $title }}</h4>
        <div class="{{ $styleStatus }} px-2 py-px text-xs font-semibold rounded-full uppercase">{{ $status }}</div>
    </header>
    @endif

    <section class="py-4">
        {{ $slot }}
    </section>
</article>
