<div class="grid grid-cols-1 gap-4 p-6 max-md:p-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 bg-gray-50">
    <x-cards.stat-card-second
        title="Total Unit Usaha"
        :value="number_format($stats->total_umkm, 0, ',', '.')"
        icon="ionicon-storefront-sharp"
        color="bg-emerald-600 text-white" />

    <x-cards.stat-card-second
        title="Tenaga Kerja Terserap"
        :value="number_format($stats->total_workers, 0, ',', '.') . ' Orang'"
        icon="ionicon-people-sharp"
        color="bg-blue-600 text-white" />

    <x-cards.stat-card-second
        title="Estimasi Omset Desa"
        :value="'Rp ' . number_format($stats->total_turnover, 0, ',', '.')"
        icon="ionicon-cash-sharp"
        color="bg-amber-500 text-white" />

    <x-cards.stat-card-second
        title="Digitalisasi Finansial"
        :value="number_format($stats->digital_umkm, 0, ',', '.') . ' Toko'"
        icon="ionicon-qr-code-sharp"
        color="bg-purple-600 text-white" />
</div>
