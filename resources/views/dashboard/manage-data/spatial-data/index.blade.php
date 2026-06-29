@php
$featureType = App\Enums\FeatureType::class;
@endphp

<x-layouts.dashboard>
    <div class="p-6" x-data="spatialData()">
        @include('dashboard.manage-data.spatial-data.partials._header')

        @if(session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif

        @if(session('error'))
        <x-alert type="error" :message="session('error')" />
        @endif

        @include('dashboard.manage-data.spatial-data.partials.modal._create')
        @include('dashboard.manage-data.spatial-data.partials.modal._update')
        @include('dashboard.manage-data.spatial-data.partials.modal._delete')

        @include('dashboard.manage-data.spatial-data.partials._stats')
        @include('dashboard.manage-data.spatial-data.partials._filter')
        @include('dashboard.manage-data.spatial-data.partials._table')
    </div>
</x-layouts.dashboard>
