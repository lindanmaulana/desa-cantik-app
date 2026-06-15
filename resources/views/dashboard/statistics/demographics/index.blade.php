<x-layouts.dashboard>
    <div class="space-y-6">
        @include('dashboard.statistics.demographics.partials.header')
        @include('dashboard.statistics.demographics.partials.stats-card')
        @include("dashboard.statistics.demographics.partials.filter-aggregate")
        @include("dashboard.statistics.demographics.partials.chart")
        @include("dashboard.statistics.demographics.partials.table-aggregate-village")
        @include("dashboard.statistics.demographics.partials.table-aggregate-territory")
    </div>

    @push('scripts')
        <script>
            window.demographicsType = {
                ageGroup: "{!! \App\Enums\DemographicsType::AGE_GROUP->value !!}",
                gender: "{!! \App\Enums\DemographicsType::GENDER->value !!}",
                maritalStatus: "{!! \App\Enums\DemographicsType::MARITAL_STATUS->value !!}",
                territory: "{!! \App\Enums\DemographicsType::TERRITORY->value !!}",
                citizenStatus: "{!! \App\Enums\DemographicsType::CITIZEN_STATUS->value !!}",
                familyRelationship: "{!! \App\Enums\DemographicsType::FAMILY_RELATIONSHIP->value !!}",
                ktpOwnership: "{!! \App\Enums\DemographicsType::KTP_OWNERSHIP->value !!}",
                buildingDensity: "{!! \App\Enums\DemographicsType::BUILDING_DENSITY->value !!}"
            };
        </script>
    @endpush
</x-layouts.dashboard>
