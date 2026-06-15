<div class="p-4 bg-white border border-gray-100 shadow-sm sm:p-8 rounded-2xl sm:rounded-3xl">
    <h3 class="mb-4 sm:mb-6 text-[10px] sm:text-xs font-bold tracking-widest text-gray-400 uppercase">
        Pilih Jenis Agregat
    </h3>

    <div class="flex flex-wrap gap-2 sm:gap-3">
        <a href="{{ route('dashboard.statistics.demograph', ['type' => 'ageGroup']) }}"
            class="max-md:w-full">
            <x-buttons.filter-button icon="ri-group-fill" :active="$currentType->value === 'ageGroup'"
                class="justify-center text-xs max-md:w-full sm:text-sm">
                Kelompok Umur
            </x-buttons.filter-button>
        </a>

        <a href="{{ route('dashboard.statistics.demograph', ['type' => 'gender']) }}" class="max-md:w-full">
            <x-buttons.filter-button icon="ri-genderless-line" :active="$currentType->value === 'gender'"
                class="justify-center text-xs max-md:w-full sm:text-sm">
                Jenis Kelamin
            </x-buttons.filter-button>
        </a>

        <a href="{{ route('dashboard.statistics.demograph', ['type' => 'maritalStatus']) }}"
            class="max-md:w-full">
            <x-buttons.filter-button icon="ri-heart-3-fill" :active="$currentType->value === 'maritalStatus'"
                class="justify-center text-xs max-md:w-full sm:text-sm">
                Status Perkawinan
            </x-buttons.filter-button>
        </a>

        <a href="{{ route('dashboard.statistics.demograph', ['type' => 'presence']) }}"
            class="max-md:w-full">
            <x-buttons.filter-button icon="ri-map-pin-user-fill" :active="$currentType->value === 'presence'"
                class="justify-center text-xs max-md:w-full sm:text-sm">
                Keberadaan
            </x-buttons.filter-button>
        </a>

        <a href="{{ route('dashboard.statistics.demograph', ['type' => 'residencyStatus']) }}"
            class="max-md:w-full">
            <x-buttons.filter-button icon="ri-user-settings-fill" :active="$currentType->value === 'residencyStatus'"
                class="justify-center text-xs max-md:w-full sm:text-sm">
                Status Penduduk
            </x-buttons.filter-button>
        </a>
    </div>
</div>
