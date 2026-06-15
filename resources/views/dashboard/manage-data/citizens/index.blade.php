<x-layouts.dashboard>
    <div class="p-6 max-md:p-3" x-data="citizenData()">
        @include('dashboard.manage-data.citizens.partials.header')

        @if (session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.citizens.partials.modal.citizen-create')
        @include('dashboard.manage-data.citizens.partials.modal.citizen-update')

        @include('dashboard.manage-data.citizens.partials.stats')
        @include('dashboard.manage-data.citizens.partials.filter')
        @include('dashboard.manage-data.citizens.partials.table')
    </div>
</x-layouts.dashboard>