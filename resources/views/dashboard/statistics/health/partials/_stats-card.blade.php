<div class="grid grid-cols-1 gap-4 p-6 overflow-hidden max-md:p-4 md:grid-cols-2 lg:grid-cols-4 bg-gray-50">
    <x-cards.stat-card
        title="Warga Disabilitas"
        :value="$stats->total_disabilities"
        icon="ionicon-accessibility-sharp"
        color="bg-amber-500" />

    <x-cards.stat-card
        title="Golongan Darah Terdata"
        :value="$stats->total_blood_registered"
        icon="ionicon-water-sharp"
        color="bg-sky-400" />

    <x-cards.stat-card
        title="Kasus Stunting Balita"
        :value="$stats->total_stunting_cases . ' Balita'"
        icon="ionicon-trending-down-sharp"
        color="bg-rose-500" />

    <x-cards.stat-card
        title="Ibu Hamil Aktif"
        :value="$stats->total_active_pregnancy . ' Warga'"
        icon="ionicon-heart-sharp"
        color="bg-emerald-500" />
</div>