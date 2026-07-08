<x-layouts.dashboard>
    <div class="p-6 max-md:p-3" x-data="familyData()">
        @include('dashboard.manage-data.families.index.partials._header')

        @if(session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if(session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.families.index.modals._create')
        @include('dashboard.manage-data.families.index.modals._update')
        @include('dashboard.manage-data.families.index.modals._delete')

        @include('dashboard.manage-data.families.index.partials._stats')
        @include('dashboard.manage-data.families.index.partials._filter')
        @include('dashboard.manage-data.families.index.partials._table')
    </div>
</x-layouts.dashboard>
