<x-layouts.client>
    <div class="px-4 space-y-6 max-md:space-y-4 sm:px-6 max-md:px-2" x-data="{ isGenerated: new URLSearchParams(window.location.search).has('type'), isGenerating: false }">
        @include('client.infrastructure.partials._header')

        <div class="space-y-4 sm:space-y-6" x-show="isGenerated" x-cloak style="display: none;"
            x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            @include('client.infrastructure.partials._stats-card')
            @include('client.infrastructure.partials._filter-aggregate')
            @include('client.infrastructure.partials._chart')
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
</x-layouts.client>
