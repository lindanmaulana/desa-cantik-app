<x-layouts.client>
    <div class="px-4 space-y-6 max-md:space-y-4 sm:px-6 max-md:px-2" x-data="{
        isGenerated: new URLSearchParams(window.location.search).has('type'),
        isGenerating: false
    }">
        @include('client.social.partials._header')

        <div class="space-y-4 sm:space-y-6" x-show="isGenerated" x-cloak style="display: none;"
            x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            @include('client.social.partials._stats-card')
            @include('client.social.partials._filter-aggregate')
            @include('client.social.partials._chart')
        </div>
    </div>

    @push('scripts')
        <script>
            window.socialType = {
                religion: "{!! $socialType::RELIGION->value !!}",
                schoolParticipation: "{!! $socialType::SCHOOL_PARTICIPATION->value !!}",
                educationLevel: "{!! $socialType::EDUCATION_LEVEL->value !!}",
                highestDiploma: "{!! $socialType::HIGHEST_DIPLOMA->value !!}",
                welfareAssistance: "{!! $socialType::WELFARE_ASSISTANCE->value !!}",
                waterSource: "{!! $socialType::WATER_SOURCE->value !!}",
                electricitySource: "{!! $socialType::ELECTRICITY_SOURCE->value !!}",
                electricityCapacity: "{!! $socialType::ELECTRICITY_CAPACITY->value !!}",
                sanitation: "{!! $socialType::SANITATION->value !!}"
            };
        </script>
    @endpush
</x-layouts.client>
