<x-layouts.client>
    <div class="px-4 space-y-6 max-md:space-y-4 sm:px-6 max-md:px-2" x-data="{ isGenerated: new URLSearchParams(window.location.search).has('type'), isGenerating: false }">
        @include('client.msme.partials._header')

        <div class="space-y-4 sm:space-y-6" x-show="isGenerated" x-cloak style="display: none;"
            x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            @include('client.msme.partials._stats-card')
            @include('client.msme.partials._filter-aggregate')
            @include('client.msme.partials._chart')
        </div>
    </div>


    @push('scripts')
        <script>
            if (!window.msmeType) {
                window.msmeType = {
                    businessSector: "{!! $msmeType::BUSINESS_SECTOR->value !!}",
                    ownerAge: "{!! $msmeType::OWNER_AGE->value !!}",
                    ownerEducation: "{!! $msmeType::OWNER_EDUCATION->value !!}",
                    businessLocation: "{!! $msmeType::BUSINESS_LOCATION->value !!}",
                    legalStatus: "{!! $msmeType::LEGAL_STATUS->value !!}",
                    nibOwnership: "{!! $msmeType::NIB_OWNERSHIP->value !!}",
                    monthlyTurnover: "{!! $msmeType::MONTHLY_TURNOVER->value !!}",
                    digitalTransaction: "{!! $msmeType::DIGITAL_TRANSACTION->value !!}",
                    digitalPlatform: "{!! $msmeType::DIGITAL_PLATFORM->value !!}",
                    capitalSource: "{!! $msmeType::CAPITAL_SOURCE->value !!}",
                    ecoFriendly: "{!! $msmeType::ECO_FRIENDLY->value !!}",
                    bumdesPartnership: "{!! $msmeType::BUMDES_PARTNERSHIP->value !!}"
                };
            }
        </script>
    @endpush
</x-layouts.client>
