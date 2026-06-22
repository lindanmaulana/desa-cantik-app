@props(['href', 'variant' => 'primary', 'size' => 'md', 'loadingText' => 'Memuat...', 'loadingKey' => null])

@php
    $key = $loadingKey ?? md5($href);
@endphp

<x-button :variant="$variant" :size="$size" x-bind:disabled="$store.navLoading.isLoading('{{ $key }}')"
    @click="$store.navLoading.start('{{ $key }}'); window.location.href = '{{ $href }}'">
    <template x-if="!$store.navLoading.isLoading('{{ $key }}')">
        <span class="flex items-center gap-2">
            {{ $slot }}
        </span>
    </template>
    <template x-if="$store.navLoading.isLoading('{{ $key }}')">
        <span class="flex items-center gap-2">
            <svg class="animate-spin w-5 h-5" viewBox="0 0 24 24" fill="none">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            <span>{{ $loadingText }}</span>
        </span>
    </template>
</x-button>
