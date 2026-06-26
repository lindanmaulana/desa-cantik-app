<x-layouts.dashboard>
    <div class="px-4 space-y-6 max-md:space-y-4 sm:px-6 max-md:px-2" x-data="{
        isGenerated: new URLSearchParams(window.location.search).has('type'),
        isGenerating: false
    }">
        @include('dashboard.statistics.health.partials._header')

        <div class="space-y-4 sm:space-y-6" x-show="isGenerated" x-cloak style="display: none;"
            x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            @include('dashboard.statistics.health.partials._stats-card')
            @include('dashboard.statistics.health.partials._filter-aggregate')
            @include('dashboard.statistics.health.partials._chart')
            @include('dashboard.statistics.health.partials._table-aggregate-village')
            @include('dashboard.statistics.health.partials._table-aggregate-territory')
        </div>
    </div>

    @push('scripts')
    <script>
        window.healthType = {
            stuntingStatus: "{!! $healthType::STUNTING_STATUS->value !!}",
            nutritionalStatus: "{!! $healthType::NUTRITIONAL_STATUS->value !!}",
            pregnancy: "{!! $healthType::PREGNANCY->value !!}",
            familyPlanning: "{!! $healthType::FAMILY_PLANNING->value !!}",
            bpjsStatus: "{!! $healthType::BPJS_STATUS->value !!}",
            bloodType: "{!! $healthType::BLOOD_TYPE->value !!}",
            disability: "{!! $healthType::DISABILITY->value !!}"
        };
    </script>
    @endpush
</x-layouts.dashboard>