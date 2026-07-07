<x-layouts.dashboard>
    <div class="px-4 space-y-6 max-md:space-y-4 sm:px-6 max-md:px-2" x-data="{
        isGenerated: new URLSearchParams(window.location.search).has('type'),
        isGenerating: false
    }">

        @include('dashboard.statistics.demographics.partials._header')

        <div class="space-y-4 sm:space-y-6" x-show="isGenerated" x-cloak style="display: none;"
            x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            @include('dashboard.statistics.demographics.partials._stats-card')
            @include('dashboard.statistics.demographics.partials._filter-aggregate')
            @include('dashboard.statistics.demographics.partials._chart')
            @include('dashboard.statistics.demographics.partials._table-aggregate-village')
            @include('dashboard.statistics.demographics.partials._table-aggregate-territory')
        </div>
    </div>

    @push('scripts')
        <script>
            window.demographicsType = {
                ageGroup: "{!! $demographicsType::AGE_GROUP->value !!}",
                gender: "{!! $demographicsType::GENDER->value !!}",
                maritalStatus: "{!! $demographicsType::MARITAL_STATUS->value !!}",
                territory: "{!! $demographicsType::TERRITORY->value !!}",
                citizenStatus: "{!! $demographicsType::CITIZEN_STATUS->value !!}",
                familyRelationship: "{!! $demographicsType::FAMILY_RELATIONSHIP->value !!}",
                ktpOwnership: "{!! $demographicsType::KTP_OWNERSHIP->value !!}",
                buildingDensity: "{!! $demographicsType::BUILDING_DENSITY->value !!}"
            };
        </script>
    @endpush
</x-layouts.dashboard>
