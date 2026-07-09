<x-layouts.dashboard>
    <div class="px-4 space-y-6 max-md:space-y-4 sm:px-6 max-md:px-2"
        x-data="{
            isGenerated: new URLSearchParams(window.location.search).has('generated') || {{ $isGenerated ? 'true' : 'false' }},
            isGenerating: false,
            activeId: null,
            activeLat: '{{ $villageSettings->latitude ?? "-6.977484656144307" }}',
            activeLng: '{{ $villageSettings->longitude ?? "108.48431009591388" }}',
            isMapSelected: false
        }">

        @include('dashboard.statistics.spatial-data.partials._header')

        <div class="space-y-4 sm:space-y-6" x-show="isGenerated" x-cloak style="display: none;"
            x-transition:enter="transition ease-out duration-500 delay-200"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            @include('dashboard.statistics.spatial-data.partials._stats-card')

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                @include('dashboard.statistics.spatial-data.partials._registri-data')
                @include('dashboard.statistics.spatial-data.partials._geoportal-preview')
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    </script>
    @endpush
</x-layouts.dashboard>