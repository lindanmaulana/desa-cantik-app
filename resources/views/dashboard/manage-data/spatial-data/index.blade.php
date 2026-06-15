@php
$featureType = App\Enums\FeatureType::class;
@endphp

<x-layouts.dashboard>
    <div class="p-6" x-data="spatialData()">
        @include('dashboard.manage-data.spatial-data.partials.header')

        @if(session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if(session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.spatial-data.partials.modal.create')
        @include('dashboard.manage-data.spatial-data.partials.modal.update')

        @include('dashboard.manage-data.spatial-data.partials.stats')
        @include('dashboard.manage-data.spatial-data.partials.filter')
        @include('dashboard.manage-data.spatial-data.partials.table')
    </div>
</x-layouts.dashboard>
