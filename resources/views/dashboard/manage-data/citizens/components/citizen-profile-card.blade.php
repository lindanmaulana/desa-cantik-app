@props(['type' => 'educationProfile', 'title' => '', 'icon' => "iconsax-out-heart", 'color' => '', 'isValue' => false, 'className'])

@php
$styleStatus = $isValue ? 'text-primary bg-primary/10' : 'text-slate-500 bg-slate-200';
$status = $isValue ? 'Terisi' : 'Belum Diisi';
@endphp

<article {{ $attributes->class(['p-8 space-y-4 border shadow  rounded-3xl']) }}>
    @if($isValue || $type == "childGrowthLogs")
    <header class="flex items-center justify-start w-full ">
        <h4 class="flex items-center gap-2 font-semibold"><x-dynamic-component :component="$icon" :class="$color . ' size-5'" /> {{ $title }}</h4>
    </header>
    @endif

    <section class="py-4">
        {{ $slot }}
    </section>
</article>
