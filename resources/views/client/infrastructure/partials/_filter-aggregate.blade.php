<div class="p-8 bg-white border border-gray-100 shadow-sm rounded-3xl">
    <h3 class="mb-6 text-xs font-bold tracking-widest text-gray-400 uppercase">
        Pilih Jenis Agregat Infrastruktur & Fasilitas Desa
    </h3>

    <div class="flex flex-wrap gap-3">
        @foreach($infrastructureType::cases() as $type)

        @php
        $icon = match($type) {
            $infrastructureType::FACILITY_TYPE => 'ri-building-4-line',
            $infrastructureType::CONDITION => 'ri-tools-line',
            $infrastructureType::CONSTRUCTION_YEAR => 'ri-calendar-line',
        };
        @endphp

        <a href="{{ route('statistik.infrastructure', ['type' => $type->value, 'rw' => request('rw'), 'rt' => request('rt')]) }}"
            class="max-md:w-full">
            <x-buttons.filter-button
                :icon="$icon"
                :active="request('type') === $type->value || (!request('type') && $type === $infrastructureType::FACILITY_TYPE)"
                class="justify-center text-xs max-md:w-full sm:text-sm">
                {{ $type->title() }}
            </x-buttons.filter-button>
        </a>
        @endforeach
    </div>
</div>
