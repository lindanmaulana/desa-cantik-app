<x-layouts.dashboard>
    <div class="p-6 max-md:p-3" x-data="territoryData()">
        @include('dashboard.manage-data.territories.partials._header')

        @if (session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.territories.modals._create')
        @include('dashboard.manage-data.territories.modals._update')
        @include('dashboard.manage-data.territories.modals._delete')

        @include('dashboard.manage-data.territories.partials._stats')
        @include('dashboard.manage-data.territories.partials._filter')
        @include('dashboard.manage-data.territories.partials._table')
    </div>

    @push('scripts')
    <script></script>
    @endpush
</x-layouts.dashboard>
