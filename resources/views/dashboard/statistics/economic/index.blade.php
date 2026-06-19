<x-layouts.dashboard>
    <div class="px-4 space-y-6 max-md:space-y-4 sm:px-6 max-md:px-2" x-data="{ isGenerated: new URLSearchParams(window.location.search).has('type') }">
        @include('dashboard.statistics.economic.partials.header')

        <div class="space-y-4 sm:space-y-6" x-show="isGenerated" x-cloak style="display: none;"
            x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            @include('dashboard.statistics.economic.partials.stats-card')
            @include('dashboard.statistics.economic.partials.filter-aggregate')
            @include('dashboard.statistics.economic.partials.chart')
            @include('dashboard.statistics.economic.partials.table-aggregate-village')
            @include('dashboard.statistics.economic.partials.table-aggregate-territory')
        </div>
    </div>

    @push('scripts')
    <script>
        window.economicType = {
            occupation: "occupation",
            jobSector: "{!! $economicType::JOB_SECTOR->value !!}",
            employmentStatus: "{!! $economicType::EMPLOYMENT_STATUS->value !!}",
            houseOwnership: "{!! $economicType::HOUSE_OWNERSHIP->value !!}",
            floorMaterial: "{!! $economicType::FLOOR_MATERIAL->value !!}",
            wallMaterial: "{!! $economicType::WALL_MATERIAL->value !!}",
            roofMaterial: "{!! $economicType::ROOF_MATERIAL->value !!}",
            cookingFuel: "{!! $economicType::COOKING_FUEL->value !!}",
            electricitySource: "{!! $economicType::ELECTRICITY_SOURCE->value !!}",
            electricityCapacity: "{!! $economicType::ELECTRICITY_CAPACITY->value !!}",
            economicStatus: "{!! $economicType::ECONOMIC_STATUS->value !!}"
        };
    </script>
    @endpush
</x-layouts.dashboard>
