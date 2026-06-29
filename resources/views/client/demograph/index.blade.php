<x-layouts.client>
    <div class="px-4 space-y-6 max-md:space-y-4 sm:px-6 max-md:px-2" x-data="{
        isGenerated: new URLSearchParams(window.location.search).has('type'),
        isGenerating: false
    }">

        @include('client.demograph.partials._header')

        <div class="space-y-4 sm:space-y-6" x-show="isGenerated" x-cloak style="display: none;"
            x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            @include('client.demograph.partials._stats-card')
            @include('client.demograph.partials._filter-aggregate')
            @include('client.demograph.partials._chart')
        </div>
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
</x-layouts.client>
