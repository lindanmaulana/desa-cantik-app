<div class="p-8 bg-white border border-gray-100 shadow-sm rounded-3xl">
    <h3 class="mb-6 text-xs font-bold tracking-widest text-gray-400 uppercase">
        Pilih Jenis Agregat UMKM & Usaha Desa
    </h3>

    <div class="flex flex-wrap gap-3">
        @foreach($msmeType::cases() as $type)

        @php
        $icon = match($type) {
            $msmeType::BUSINESS_SECTOR => 'ri-apps-2-line',
            $msmeType::OWNER_AGE => 'ri-user-star-line',
            $msmeType::OWNER_EDUCATION => 'ri-graduation-cap-line',
            $msmeType::BUSINESS_LOCATION => 'ri-map-pin-5-line',
            $msmeType::LEGAL_STATUS => 'ri-bank-card-line',
            $msmeType::NIB_OWNERSHIP => 'ri-file-shield-2-line',
            $msmeType::MONTHLY_TURNOVER => 'ri-line-chart-line',
            $msmeType::DIGITAL_TRANSACTION => 'ri-qr-code-line',
            $msmeType::DIGITAL_PLATFORM => 'ri-global-line',
            $msmeType::CAPITAL_SOURCE => 'ri-hand-coin-line',
            $msmeType::ECO_FRIENDLY => 'ri-leaf-line',
            $msmeType::BUMDES_PARTNERSHIP => 'ri-user-shared-line',
        };
        @endphp

        <a href="{{ route('dashboard.statistics.msme', ['type' => $type->value, 'rw' => request('rw'), 'rt' => request('rt')]) }}"
            class="max-md:w-full">
            <x-buttons.filter-button
                :icon="$icon"
                :active="request('type') === $type->value || (!request('type') && $type === $msmeType::BUSINESS_SECTOR)"
                class="justify-center text-xs max-md:w-full sm:text-sm">
                {{ $type->title() }}
            </x-buttons.filter-button>
        </a>
        @endforeach
    </div>
</div>
