<div class="grid grid-cols-1 gap-4 p-6 max-md:p-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 bg-gray-50">

    <x-cards.stat-card-second
        title="Warga Bekerja"
        :value="number_format($stats->total_employed, 0, ',', '.')"
        icon="ionicon-briefcase-sharp"
        color="bg-primary text-white" />

    <x-cards.stat-card-second
        title="Pengangguran Aktif"
        :value="number_format($stats->total_unemployed, 0, ',', '.')"
        icon="ionicon-alert-circle-sharp"
        color="bg-amber-500 text-white" />

    <x-cards.stat-card-second
        title="Keluarga Rumah Sendiri"
        :value="number_format($stats->total_self_owned_houses, 0, ',', '.')"
        icon="ionicon-home-sharp"
        color="bg-[#6366f1] text-white" />

    <x-cards.stat-card-second
        title="Penerima Bansos"
        :value="number_format($stats->total_welfare_recipients, 0, ',', '.')"
        icon="ionicon-gift-sharp"
        color="bg-emerald-600 text-white" />

</div>