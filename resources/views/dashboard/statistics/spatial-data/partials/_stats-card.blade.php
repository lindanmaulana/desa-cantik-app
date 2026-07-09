<div class="grid grid-cols-1 gap-4 p-6 overflow-hidden max-md:p-4 md:grid-cols-2 lg:grid-cols-4 bg-gray-50">
    <x-cards.stat-card
        title="Rumah Warga"
        :value="($stats['resident_house'] ?? 0) . ' Titik'"
        icon="ionicon-home-sharp"
        color="bg-amber-500" />

    <x-cards.stat-card
        title="Fasilitas Umum"
        :value="($stats['public_facility'] ?? 0) . ' Lokasi'"
        icon="ionicon-business-sharp"
        color="bg-sky-400" />

    <x-cards.stat-card
        title="Lapak UMKM"
        :value="($stats['msme_location'] ?? 0) . ' Gerai'"
        icon="ionicon-storefront-sharp"
        color="bg-rose-500" />

    <x-cards.stat-card
        title="Batas Wilayah"
        :value="($stats['village_boundary'] ?? 0) . ' Poligon'"
        icon="ionicon-map-sharp"
        color="bg-emerald-500" />
</div>