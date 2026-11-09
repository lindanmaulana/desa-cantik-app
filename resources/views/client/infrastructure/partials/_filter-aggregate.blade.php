<div class="p-8 bg-white border border-gray-100 shadow-sm rounded-3xl">
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <h3 class="text-xs font-bold tracking-widest text-gray-400 uppercase">
        Pilih Jenis Agregat Infrastruktur & Fasilitas Desa
    </h3>
    <button type="button" class="inline-flex items-center gap-2 px-3 py-2 text-xs font-semibold text-gray-500 transition border border-gray-200 rounded-xl bg-transparent hover:bg-gray-50" onclick="window.location.reload()">
        <x-iconsax-bro-refresh-2 class="size-4" />
        Reload Agregat
    </button>
    </div>

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
