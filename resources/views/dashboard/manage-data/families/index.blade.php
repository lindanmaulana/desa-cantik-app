<x-layouts.dashboard>
    <div class="p-6 max-md:p-3" x-data="familyData()">
        @include('dashboard.manage-data.families.partials.header')

        @if(session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if(session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.families.partials.modal.create')
        @include('dashboard.manage-data.families.partials.modal.update')

        @include('dashboard.manage-data.families.partials.stats')
        @include('dashboard.manage-data.families.partials.filter')
        @include('dashboard.manage-data.families.partials.table')
    </div>
</x-layouts.dashboard>