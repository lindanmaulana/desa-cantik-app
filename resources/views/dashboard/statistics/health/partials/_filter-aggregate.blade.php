<div class="p-8 bg-white border border-gray-100 shadow-sm rounded-3xl">
    <h3 class="mb-6 text-xs font-bold tracking-widest text-gray-400 uppercase">
        Pilih Jenis Agregat Kesehatan
    </h3>

    <div class="flex flex-wrap gap-3">
        @foreach($healthType::cases() as $type)

        @php
        $icon = match($type) {
            $healthType::STUNTING_STATUS => 'ri-bubble-chart-line',
            $healthType::NUTRITIONAL_STATUS => 'ri-scales-3-line',
            $healthType::PREGNANCY => 'ri-parent-line',
            $healthType::FAMILY_PLANNING => 'ri-team-line',
            $healthType::BPJS_STATUS => 'ri-heart-pulse-line',
            $healthType::BLOOD_TYPE => 'ri-drop-line',
            $healthType::DISABILITY => 'ri-accessibility-fill',
        };
        @endphp

        <a href="{{ route('dashboard.statistics.health', ['type' => $type->value, 'rw' => request('rw'), 'rt' => request('rt')]) }}"
            class="max-md:w-full">
            <x-buttons.filter-button
                :icon="$icon"
                :active="request('type') === $type->value || (!request('type') && $type === $healthType::STUNTING_STATUS)"
                class="justify-center text-xs max-md:w-full sm:text-sm">
                {{ $type->title() }}
            </x-buttons.filter-button>
        </a>
        @endforeach
    </div>
</div>
