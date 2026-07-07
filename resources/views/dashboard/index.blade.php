<x-layouts.dashboard>
    <div class="p-4 space-y-8 sm:p-6 lg:p-8 sm:space-y-12 bg-tertiary content-fade">
        @include('dashboard.partials._header')

        @include('dashboard.partials._stats')

        @include('dashboard.partials._pilar-data')
    </div>
</x-layouts.dashboard>
