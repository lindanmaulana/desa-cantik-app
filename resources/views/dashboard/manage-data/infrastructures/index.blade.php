<x-layouts.dashboard>
    <div class="p-6 bg-gray-50" x-data="infrastructureData()">
        @include('dashboard.manage-data.infrastructures.partials.header')

        @if(session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if(session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.infrastructures.partials.modal.create')
        @include('dashboard.manage-data.infrastructures.partials.modal.update')

        @include('dashboard.manage-data.infrastructures.partials.stats')
        @include('dashboard.manage-data.infrastructures.partials.filter')
        @include('dashboard.manage-data.infrastructures.partials.table')
    </div>
</x-layouts.dashboard>