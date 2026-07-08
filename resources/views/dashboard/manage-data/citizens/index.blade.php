<x-layouts.dashboard>
    <div class="p-6 max-md:p-3" x-data="citizenData()">
        @include('dashboard.manage-data.citizens.index.partials._header')

        @if (session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.citizens.index.modals._citizen-create')
        @include('dashboard.manage-data.citizens.index.modals._citizen-update')
        @include('dashboard.manage-data.citizens.index.modals._citizen-delete')

        @include('dashboard.manage-data.citizens.index.partials._stats')
        @include('dashboard.manage-data.citizens.index.partials._filter')
        @include('dashboard.manage-data.citizens.index.partials._table')
    </div>
</x-layouts.dashboard>
