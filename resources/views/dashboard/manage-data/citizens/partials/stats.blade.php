<div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-3">
    <x-cards.stat-card-second title="Total Penduduk" value="{{ $counts->total_Citizens }}" icon="heroicon-o-user-group" color="text-teal-600 bg-teal-50" />
    <x-cards.stat-card-second title="Laki-Laki" value="{{ $counts->total_Male }}" icon="heroicon-o-user" color="text-blue-600 bg-blue-50" />
    <x-cards.stat-card-second title="Perempuan" value="{{ $counts->total_Female }}" icon="heroicon-o-user" color="text-rose-600 bg-rose-50" />
</div>
