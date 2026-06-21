<x-layouts.dashboard>
    <div class="px-4 space-y-6 max-md:space-y-4 sm:px-6 max-md:px-2" x-data="{ isGenerated: new URLSearchParams(window.location.search).has('type') }">
        @include('dashboard.statistics.infrastructure.partials.header')

        <div class="space-y-4 sm:space-y-6" x-show="isGenerated" x-cloak style="display: none;"
            x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            @include('dashboard.statistics.infrastructure.partials.stats-card')
            @include('dashboard.statistics.infrastructure.partials.filter-aggregate')
            @include('dashboard.statistics.infrastructure.partials.chart')
            @include('dashboard.statistics.infrastructure.partials.table-aggregate-village')
            @include('dashboard.statistics.infrastructure.partials.table-aggregate-territory')
        </div>
    </div>

    @push('scripts')
    <script>
        if (!window.infrastructureType) {
            window.infrastructureType = {
                facilityType: "{!! $infrastructureType::FACILITY_TYPE->value !!}",
                condition: "{!! $infrastructureType::CONDITION->value !!}",
                constructionYear: "{!! $infrastructureType::CONSTRUCTION_YEAR->value !!}",
            };
        }
    </script>
    @endpush
</x-layouts.dashboard>
