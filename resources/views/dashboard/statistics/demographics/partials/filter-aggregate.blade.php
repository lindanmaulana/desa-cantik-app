<div class="p-8 bg-white border border-gray-100 shadow-sm rounded-3xl">
    <h3 class="mb-6 text-xs font-bold tracking-widest text-gray-400 uppercase">
        Pilih Jenis Agregat
    </h3>

    <div class="flex flex-wrap gap-3">
        <a href="{{ route('dashboard.statistics.demograph', ['type' => 'ageGroup']) }}">
            <x-buttons.filter-button
                icon="ri-group-fill"
                :active="request('type') && $currentType->value === 'ageGroup'">
                Kelompok Umur
            </x-buttons.filter-button>
        </a>

        <a href="{{ route('dashboard.statistics.demograph', ['type' => 'gender']) }}">
            <x-buttons.filter-button
                icon="ri-genderless-line"
                :active="request('type') && $currentType->value === 'gender'">
                Jenis Kelamin
            </x-buttons.filter-button>
        </a>

        <a href="{{ route('dashboard.statistics.demograph', ['type' => 'maritalStatus']) }}">
            <x-buttons.filter-button
                icon="ri-heart-3-fill"
                :active="request('type') && $currentType->value === 'maritalStatus'">
                Status Perkawinan
            </x-buttons.filter-button>
        </a>

        <a href="{{ route('dashboard.statistics.demograph', ['type' => 'territory']) }}">
            <x-buttons.filter-button
                icon="ri-map-pin-user-fill"
                :active="request('type') && $currentType->value === 'territory'">
                Keberadaan
            </x-buttons.filter-button>
        </a>

        <a href="{{ route('dashboard.statistics.demograph', ['type' => 'citizenStatus']) }}">
            <x-buttons.filter-button
                icon="ri-user-settings-fill"
                :active="request('type') && $currentType->value === 'citizenStatus'">
                Status Penduduk
            </x-buttons.filter-button>
        </a>
    </div>
</div>