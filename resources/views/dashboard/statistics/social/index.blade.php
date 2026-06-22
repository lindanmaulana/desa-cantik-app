<x-layouts.dashboard>
    <div class="px-4 space-y-6 max-md:space-y-4 sm:px-6 max-md:px-2" x-data="{
        isGenerated: new URLSearchParams(window.location.search).has('type'),
        isGenerating: false
    }">
        @include('dashboard.statistics.social.partials.header')

        <div class="space-y-4 sm:space-y-6" x-show="isGenerated" x-cloak style="display: none;"
            x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            @include('dashboard.statistics.social.partials.stats-card')
            @include('dashboard.statistics.social.partials.filter-aggregate')
            @include('dashboard.statistics.social.partials.chart')
            @include('dashboard.statistics.social.partials.table-aggregate-village')
            @include('dashboard.statistics.social.partials.table-aggregate-territory')
        </div>
    </div>

    @push('scripts')
        <script>
            window.socialType = {
                religion: "{!! $socialType::RELIGION->value !!}",
                schoolParticipation: "{!! $socialType::SCHOOL_PARTICIPATION->value !!}",
                educationLevel: "{!! $socialType::EDUCATION_LEVEL->value !!}",
                highestDiploma: "{!! $socialType::HIGHEST_DIPLOMA->value !!}",
                bloodType: "{!! $socialType::BLOOD_TYPE->value !!}",
                disability: "{!! $socialType::DISABILITY->value !!}",
                pregnancy: "{!! $socialType::PREGNANCY->value !!}",
                familyPlanning: "{!! $socialType::FAMILY_PLANNING->value !!}",
                bpjsStatus: "{!! $socialType::BPJS_STATUS->value !!}",
                welfareAssistance: "{!! $socialType::WELFARE_ASSISTANCE->value !!}",
                waterSource: "{!! $socialType::WATER_SOURCE->value !!}",
                electricitySource: "{!! $socialType::ELECTRICITY_SOURCE->value !!}",
                electricityCapacity: "{!! $socialType::ELECTRICITY_CAPACITY->value !!}",
                sanitation: "{!! $socialType::SANITATION->value !!}"
            };
        </script>
    @endpush
</x-layouts.dashboard>
