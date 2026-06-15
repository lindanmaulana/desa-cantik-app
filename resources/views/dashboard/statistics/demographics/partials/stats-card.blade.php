<div class="grid grid-cols-1 gap-4 p-6 max-md:p-4 md:grid-cols-2 lg:grid-cols-4 bg-gray-50">
    <x-cards.stat-card
        title="Penduduk Total"
        :value="$stats->total_citizens"
        icon="solar-database-linear"
        color="bg-amber-500" />

    <x-cards.stat-card
        title="Laki-laki"
        :value="$stats->total_male"
        icon="iconsax-lin-man"
        color="bg-sky-400" />

    <x-cards.stat-card
        title="Perempuan"
        :value="$stats->total_female"
        icon="iconsax-lin-woman"
        color="bg-pink-500" />

    <x-cards.stat-card
        title="Total Keluarga"
        :value="$stats->total_families"
        icon="ionicon-people-sharp"
        color="bg-indigo-500" />
</div>