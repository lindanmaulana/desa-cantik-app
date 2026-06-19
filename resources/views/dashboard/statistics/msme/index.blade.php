<x-layouts.dashboard>
    <div class="px-4 space-y-6 max-md:space-y-4 sm:px-6 max-md:px-2" x-data="{ isGenerated: new URLSearchParams(window.location.search).has('type') }">
        @include('dashboard.statistics.msme.partials.header')

        <div class="space-y-4 sm:space-y-6" x-show="isGenerated" x-cloak style="display: none;"
            x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            @include('dashboard.statistics.msme.partials.stats-card')
            @include('dashboard.statistics.msme.partials.filter-aggregate')
            @include('dashboard.statistics.msme.partials.chart')
            @include('dashboard.statistics.msme.partials.table-aggregate-village')
            @include('dashboard.statistics.msme.partials.table-aggregate-territory')
        </div>
    </div>


    @push('scripts')
    <script>
        if (!window.msmeType) {
            window.msmeType = {
                businessSector: "{!! \App\Enums\UmkmType::BUSINESS_SECTOR->value !!}",
                ownerAge: "{!! \App\Enums\UmkmType::OWNER_AGE->value !!}",
                ownerEducation: "{!! \App\Enums\UmkmType::OWNER_EDUCATION->value !!}",
                businessLocation: "{!! \App\Enums\UmkmType::BUSINESS_LOCATION->value !!}",
                legalStatus: "{!! \App\Enums\UmkmType::LEGAL_STATUS->value !!}",
                nibOwnership: "{!! \App\Enums\UmkmType::NIB_OWNERSHIP->value !!}",
                monthlyTurnover: "{!! \App\Enums\UmkmType::MONTHLY_TURNOVER->value !!}",
                digitalTransaction: "{!! \App\Enums\UmkmType::DIGITAL_TRANSACTION->value !!}",
                digitalPlatform: "{!! \App\Enums\UmkmType::DIGITAL_PLATFORM->value !!}",
                capitalSource: "{!! \App\Enums\UmkmType::CAPITAL_SOURCE->value !!}",
                ecoFriendly: "{!! \App\Enums\UmkmType::ECO_FRIENDLY->value !!}",
                bumdesPartnership: "{!! \App\Enums\UmkmType::BUMDES_PARTNERSHIP->value !!}"
            };
        }
    </script>
    @endpush
</x-layouts.dashboard>
