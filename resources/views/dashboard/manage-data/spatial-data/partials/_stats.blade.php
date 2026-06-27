<div class="grid grid-cols-2 gap-4 mb-6 sm:grid-cols-4">
    <x-cards.stat-card-second title="Total Titik Peta" value="{{ $counts->total_Points }}" icon="iconsax-lin-map" color="text-emerald-600 bg-emerald-50" />
    <x-cards.stat-card-second title="Total Rumah Penduduk" value="{{ $counts->houses_Count }}" icon="heroicon-o-home" color="text-blue-600 bg-blue-50" />
    <x-cards.stat-card-second title="Total Fasilitas Publik" value="{{ $counts->facilities_Count}}" icon="iconsax-lin-buildings" color="text-amber-600 bg-amber-50" />
    <x-cards.stat-card-second title="Lokasi UMKM" value="{{ $counts->msmes_Count }}" icon="bi-shop" color="text-purple-600 bg-purple-50" />
</div>