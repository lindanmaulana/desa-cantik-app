{{-- <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-3">
    <x-cards.stat-card-second title="Total Kepala Keluarga" value="{{ $counts->total_Families }}" icon="heroicon-o-user" color="text-teal-600 bg-teal-50" />
    <x-cards.stat-card-second title="Total Dusun" value="{{ $counts->total_SubVillage }}" icon="heroicon-o-flag" color="text-blue-600 bg-blue-50" />
    <x-cards.stat-card-second title="Total Warga Terdata" value="{{ $counts->total_Citizens }}" icon="heroicon-o-user-group" color="text-indigo-600 bg-indigo-50" />
</div> --}}

<div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-3">
    <x-cards.stat-card-second title="Total Keluarga" value="{{ $counts->total_families }}" icon="heroicon-o-user" color="text-teal-600 bg-teal-50" />
    <x-cards.stat-card-second title="Total Dusun" value="{{ $counts->total_subvillage }}" icon="heroicon-o-flag" color="text-blue-600 bg-blue-50" />
    <x-cards.stat-card-second title="Total Warga Terdata" value="{{ $counts->total_citizens }}" icon="heroicon-o-user-group" color="text-indigo-600 bg-indigo-50" />
</div>