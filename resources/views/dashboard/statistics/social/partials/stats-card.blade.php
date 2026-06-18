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
        title="Keberagaman Agama"
        :value="$stats->total_religions . ' Agama'"
        icon="ionicon-ribbon-sharp"
        color="bg-pink-500" />

    <x-cards.stat-card
        title="Sanitasi Keluarga Layak"
        :value="$stats->total_sanitation_covered"
        icon="solar-database-linear"
        color="bg-indigo-500" />
</div>