<x-layouts.dashboard>
    <div class="p-6 max-lg:p4 max-md:p-3" x-data="msmeData">
        @include('dashboard.manage-data.msmes.partials._header')

        @if(session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if(session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.msmes.partials.modal._create')
        @include('dashboard.manage-data.msmes.partials.modal._update')
        @include('dashboard.manage-data.msmes.partials.modal._delete')

        @include('dashboard.manage-data.msmes.partials._stats')
        @include('dashboard.manage-data.msmes.partials._filter')
        @include('dashboard.manage-data.msmes.partials._table')
    </div>
</x-layouts.dashboard>
