<div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-3">
    <x-cards.stat-card-second title="Total Dusun" value="{{ $counts->total_SubVillage }}" icon="heroicon-o-flag" color="text-teal-600 bg-teal-50" />
    <x-cards.stat-card-second title="Total RW" value="{{ $counts->total_RW }}" icon="heroicon-o-squares-2x2" color="text-blue-600 bg-blue-50" />
    <x-cards.stat-card-second title="Total RT" value="{{ $counts->total_RT }}" icon="heroicon-o-home" color="text-indigo-600 bg-indigo-50" />
</div>