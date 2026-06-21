<div class="grid grid-cols-1 gap-4 p-6 max-md:p-3 md:grid-cols-2 lg:grid-cols-3 bg-gray-50">
    <x-cards.stat-card-second
        title="Total Fasilitas Publik"
        :value="number_format($stats->total_facilities, 0, ',', '.') . ' Unit'"
        icon="ri-building-4-line"
        color="bg-blue-600 text-white" />

    <x-cards.stat-card-second
        title="Kondisi Layak (Baik)"
        :value="number_format($stats->good_condition, 0, ',', '.') . ' Unit'"
        icon="ri-checkbox-circle-line"
        color="bg-emerald-600 text-white" />

    <x-cards.stat-card-second
        title="Fasilitas Rusak"
        :value="number_format($stats->damaged_facilities, 0, ',', '.') . ' Unit'"
        icon="ri-error-warning-line"
        color="bg-rose-600 text-white" />
</div>