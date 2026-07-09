<x-layouts.dashboard>
    <div class="p-6 max-md:p-3 bg-gray-50" x-data="infrastructureData()">
        @include('dashboard.manage-data.infrastructures.partials._header')

        @if(session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if(session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.infrastructures.modals._create')
        @include('dashboard.manage-data.infrastructures.modals._update')
        @include('dashboard.manage-data.infrastructures.modals._delete')

        @include('dashboard.manage-data.infrastructures.partials._stats')
        @include('dashboard.manage-data.infrastructures.partials._filter')
        @include('dashboard.manage-data.infrastructures.partials._table')
    </div>
</x-layouts.dashboard>
