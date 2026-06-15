<x-layouts.dashboard>
    <div class="p-6" x-data="msmeData">
        @include('dashboard.manage-data.msmes.partials.header')

        @if(session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if(session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.msmes.partials.modal.create')
        @include('dashboard.manage-data.msmes.partials.modal.update')

        @include('dashboard.manage-data.msmes.partials.stats')
        @include('dashboard.manage-data.msmes.partials.filter')
        @include('dashboard.manage-data.msmes.partials.table')
    </div>
</x-layouts.dashboard>