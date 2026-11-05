<div class="p-4 bg-secondary border border-textTertiary/30 shadow-sm sm:p-8 rounded-2xl sm:rounded-3xl">

    <div class="flex flex-wrap items-center justify-between gap-3 mb-4 sm:mb-6">
        <h3 class="text-[10px] sm:text-xs font-bold tracking-widest text-textSecondary uppercase">
            Pilih Jenis Agregat
        </h3>
        <button type="button" class="inline-flex items-center gap-2 px-3 py-2 text-xs font-semibold transition border rounded-xl border-textTertiary/40 bg-transparent text-textSecondary hover:bg-textTertiary/10"
            onclick="window.location.reload()">
            <x-iconsax-bro-refresh-2 class="size-4" />
            Reload Agregat
        </button>
    </div>

    <div class="flex flex-wrap gap-2 sm:gap-3">
        <a href="{{ route('statistik.demografi', ['type' => $demographicsType::AGE_GROUP->value]) }}"
            class="max-md:w-full">
            <x-buttons.filter-button icon="ri-group-fill" :active="$currentType->value === $demographicsType::AGE_GROUP->value"
                class="justify-center text-xs max-md:w-full sm:text-sm">
                Kelompok Umur
            </x-buttons.filter-button>
        </a>

        <a href="{{ route('statistik.demografi', ['type' => $demographicsType::GENDER->value]) }}"
            class="max-md:w-full">
            <x-buttons.filter-button icon="ri-genderless-line" :active="$currentType->value === $demographicsType::GENDER->value"
                class="justify-center text-xs max-md:w-full sm:text-sm">
                Jenis Kelamin
            </x-buttons.filter-button>
        </a>

        <a href="{{ route('statistik.demografi', ['type' => $demographicsType::MARITAL_STATUS->value]) }}"
            class="max-md:w-full">
            <x-buttons.filter-button icon="ri-heart-3-fill" :active="$currentType->value === $demographicsType::MARITAL_STATUS->value"
                class="justify-center text-xs max-md:w-full sm:text-sm">
                Status Perkawinan
            </x-buttons.filter-button>
        </a>

        <a href="{{ route('statistik.demografi', ['type' => $demographicsType::TERRITORY->value]) }}"
            class="max-md:w-full">
            <x-buttons.filter-button icon="ri-map-pin-user-fill" :active="$currentType->value === $demographicsType::TERRITORY->value"
                class="justify-center text-xs max-md:w-full sm:text-sm">
                Keberadaan
            </x-buttons.filter-button>
        </a>

        <a href="{{ route('statistik.demografi', ['type' => $demographicsType::CITIZEN_STATUS->value]) }}"
            class="max-md:w-full">
            <x-buttons.filter-button icon="ri-user-settings-fill" :active="$currentType->value === $demographicsType::CITIZEN_STATUS->value"
                class="justify-center text-xs max-md:w-full sm:text-sm">
                Status Penduduk
            </x-buttons.filter-button>
        </a>
    </div>
</div>
