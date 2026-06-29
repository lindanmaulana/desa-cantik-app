<div class="p-8 bg-white border border-gray-100 shadow-sm rounded-3xl">
    <h3 class="mb-6 text-xs font-bold tracking-widest text-gray-400 uppercase">
        Pilih Jenis Agregat Ekonomi
    </h3>

    <div class="flex flex-wrap gap-3">
        @foreach($economicType::cases() as $type)

        @php
        $icon = match($type) {
            $economicType::OCCUPATION => 'ri-briefcase-line',
            $economicType::JOB_SECTOR => 'ri-settings-3-line',
            $economicType::EMPLOYMENT_STATUS => 'ri-user-shared-line',
            $economicType::HOUSE_OWNERSHIP => 'ri-home-4-line',
            $economicType::FLOOR_MATERIAL => 'ri-grid-line',
            $economicType::WALL_MATERIAL => 'ri-building-line',
            $economicType::ROOF_MATERIAL => 'ri-home-gear-line',
            $economicType::COOKING_FUEL => 'ri-fire-line',
            $economicType::ELECTRICITY_SOURCE => 'ri-flashlight-line',
            $economicType::ELECTRICITY_CAPACITY => 'ri-flashlight-line',
            $economicType::ECONOMIC_STATUS => 'ri-line-chart-line',
        };
        @endphp

        <a href="{{ route('statistik.economy', ['type' => $type->value, 'rw' => request('rw'), 'rt' => request('rt')]) }}"
            class="max-md:w-full">
            <x-buttons.filter-button
                :icon="$icon"
                :active="request('type') === $type->value || (!request('type') && $type === $economicType::OCCUPATION)"
                class="justify-center text-xs max-md:w-full sm:text-sm">
                {{ $type->title() }}
            </x-buttons.filter-button>
        </a>
        @endforeach
    </div>
</div>
