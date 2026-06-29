<div class="p-8 bg-white border border-gray-100 shadow-sm rounded-3xl">
    <h3 class="mb-6 text-xs font-bold tracking-widest text-gray-400 uppercase">
        Pilih Jenis Agregat Sosial
    </h3>

    <div class="flex flex-wrap gap-3">
        @foreach($socialType::cases() as $type)

        @php
        $icon = match($type) {
            $socialType::RELIGION => 'ri-bank-line',
            $socialType::SCHOOL_PARTICIPATION => 'ri-book-open-line',
            $socialType::EDUCATION_LEVEL => 'ri-graduation-cap-line',
            $socialType::HIGHEST_DIPLOMA => 'ri-checkbox-circle-line',
            $socialType::WELFARE_ASSISTANCE => 'ri-gift-line',
            $socialType::WATER_SOURCE => 'ri-water-flash-line',
            $socialType::ELECTRICITY_SOURCE => 'ri-flashlight-line',
            $socialType::ELECTRICITY_CAPACITY => 'ri-lightbulb-line',
            $socialType::SANITATION => 'ri-home-heart-line',
        };
        @endphp

        <a href="{{ route('statistik.social', ['type' => $type->value, 'rw' => request('rw'), 'rt' => request('rt')]) }}"
            class="max-md:w-full">
            <x-buttons.filter-button
                :icon="$icon"
                :active="request('type') === $type->value || (!request('type') && $type === $socialType::RELIGION)"
                class="justify-center text-xs max-md:w-full sm:text-sm">
                {{ $type->title() }}
            </x-buttons.filter-button>
        </a>
        @endforeach
    </div>
</div>
