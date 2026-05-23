<div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-3">
    <x-cards.stat-card-second title="Total Inventaris Aset" value="{{ $counts->total_Assets }}" icon="iconsax-lin-buildings" color="text-emerald-600 bg-emerald-50" />
    <x-cards.stat-card-second title="Kondisi Layak / Baik" value="{{ $counts->good_Condition }}" icon="heroicon-o-check-circle" color="text-blue-600 bg-blue-50" />
    <x-cards.stat-card-second title="Mengalami Kerusakan" value="{{ $counts->damaged_Assets }}" icon="heroicon-o-exclamation-triangle" color="text-rose-600 bg-rose-50" />
</div>
